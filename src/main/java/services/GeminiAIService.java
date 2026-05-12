package services;

import entities.User;

import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import java.sql.SQLException;
import java.time.Duration;

import java.util.List;

/**
 * AI Chatbot powered by Groq API.
 *
 * Capabilities:
 *  - Answers ANY casual / general question (greetings, chitchat, etc.)
 *  - Answers questions about the user table (stats, search, list, etc.)
 *  - Speaks English or French depending on the user's message
 */
public class GeminiAIService {

    private static final String API_URL = "https://api.groq.com/openai/v1/chat/completions";
    private static final String MODEL   = "llama-3.3-70b-versatile";

    private final HttpClient http = HttpClient.newBuilder()
            .connectTimeout(Duration.ofSeconds(30))
            .build();

    private final UserService userService = new UserService();

    // ================================================================
    // PUBLIC API
    // ================================================================

    /**
     * Main entry point — sends message to Groq with full user DB context.
     */
    public String askQuestion(String userMessage) {
        try {
            String dbSummary = buildDatabaseSummary();
            String systemPrompt = buildSystemPrompt(dbSummary);
            return callGroq(systemPrompt, userMessage);
        } catch (Exception e) {
            e.printStackTrace();
            return "❌ Error: " + e.getMessage();
        }
    }

    /**
     * Fallback — same logic but catches all exceptions silently.
     */
    public String askQuestionLocal(String userMessage) {
        return askQuestion(userMessage);
    }

    // ================================================================
    // SYSTEM PROMPT
    // ================================================================

    private String buildSystemPrompt(String dbSummary) {
        return "You are EduBot, a friendly and smart AI assistant embedded in the EduConnect admin panel.\n\n"

                + "## YOUR PERSONALITY\n"
                + "- Warm, helpful, and conversational.\n"
                + "- You handle BOTH casual talk (greetings, jokes, general questions) AND database queries.\n"
                + "- Never refuse a question. Always try to help.\n"
                + "- Respond in the same language the user writes in (French or English).\n"
                + "- Keep answers concise but complete. Use bullet points or tables when listing data.\n\n"

                + "## WHAT YOU KNOW\n"
                + "You have access to the live user database of EduConnect. Here is a full snapshot:\n\n"
                + dbSummary + "\n\n"

                + "## HOW TO HANDLE QUESTIONS\n"
                + "- Greetings / chitchat → respond naturally and warmly.\n"
                + "- 'How many users?' → count from the data above.\n"
                + "- 'Who is the admin?' → list users with role ADMIN.\n"
                + "- 'Show all users' → format a clean list.\n"
                + "- 'Average age?' → calculate from the data.\n"
                + "- 'Find [name/email]' → search in the data and show their info.\n"
                + "- 'Statistics' → total, admins vs users, avg age, active/inactive.\n"
                + "- Any general question (history, science, coding, etc.) → answer it normally.\n\n"

                + "## FORMAT RULES\n"
                + "- Use emojis to make responses feel alive.\n"
                + "- For user lists, use this format per user: • Firstname Lastname | email | role | age | status\n"
                + "- Never show passwords.\n"
                + "- Keep responses under 300 words unless a full list is requested.";
    }

    // ================================================================
    // DATABASE SUMMARY BUILDER
    // ================================================================

    private String buildDatabaseSummary() {
        List<User> users;
        try {
            users = userService.getAll();
        } catch (java.sql.SQLException e) {
            e.printStackTrace();
            return "Error retrieving database context: " + e.getMessage();
        }


        if (users.isEmpty()) {

            return "The user table is currently empty.";
        }

        long adminCount  = users.stream().filter(User::isAdmin).count();
        long userCount   = users.size() - adminCount;
        long activeCount = users.stream().filter(User::isActive).count();
        double avgAge    = users.stream()
                .mapToInt(User::getAge)
                .filter(a -> a > 0)
                .average()
                .orElse(0);

        StringBuilder sb = new StringBuilder();
        sb.append("### SUMMARY\n");
        sb.append("- Total users: ").append(users.size()).append("\n");
        sb.append("- Admins: ").append(adminCount).append("\n");
        sb.append("- Regular users: ").append(userCount).append("\n");
        sb.append("- Active accounts: ").append(activeCount).append("\n");
        sb.append(String.format("- Average age: %.1f years%n", avgAge));
        sb.append("\n### FULL USER LIST\n");

        for (User u : users) {
            sb.append("- ID:").append(u.getId())
                    .append(" | ").append(u.getFirstName()).append(" ").append(u.getLastName())
                    .append(" | email: ").append(u.getEmail())
                    .append(" | role: ").append(u.getRole())
                    .append(" | age: ").append(u.getAge())
                    .append(" | status: ").append(u.getStatus() != null ? u.getStatus() : "active")
                    .append(" | username: ").append(u.getUsername() != null ? u.getUsername() : "N/A");

            if (u.getBio() != null && !u.getBio().isBlank()) {
                sb.append(" | bio: ").append(u.getBio());
            }
            sb.append("\n");
        }

        return sb.toString();
    }

    // ================================================================
    // GROQ API CALL
    // ================================================================

    private String callGroq(String systemPrompt, String userMessage) throws Exception {
        String body = "{"
                + "\"model\":\"" + MODEL + "\","
                + "\"messages\":["
                +   "{\"role\":\"system\",\"content\":" + toJsonString(systemPrompt) + "},"
                +   "{\"role\":\"user\",\"content\":"   + toJsonString(userMessage)  + "}"
                + "],"
                + "\"max_tokens\":600,"
                + "\"temperature\":0.7"
                + "}";

        HttpRequest req = HttpRequest.newBuilder()
                .uri(URI.create(API_URL))
                .header("Content-Type", "application/json")
                .header("Authorization", "Bearer " + QuizGeneratorService.API_KEY)
                .timeout(Duration.ofSeconds(30))
                .POST(HttpRequest.BodyPublishers.ofString(body))
                .build();

        HttpResponse<String> resp = http.send(req, HttpResponse.BodyHandlers.ofString());

        return switch (resp.statusCode()) {
            case 200  -> extractContent(resp.body());
            case 401  -> "❌ Invalid API key. Check QuizGeneratorService.API_KEY.";
            case 429  -> "⏳ Too many requests — wait a moment and try again.";
            default   -> "❌ API error " + resp.statusCode() + ": " + resp.body();
        };
    }

    // ================================================================
    // JSON HELPERS
    // ================================================================

    private String extractContent(String apiResp) {
        int idx = apiResp.indexOf("\"content\":");
        if (idx < 0) return "Sorry, I couldn't process that.";
        int q = apiResp.indexOf('"', idx + 10) + 1;
        return unescape(apiResp, q);
    }

    private String unescape(String s, int start) {
        StringBuilder sb = new StringBuilder();
        for (int i = start; i < s.length(); i++) {
            char c = s.charAt(i);
            if (c == '\\' && i + 1 < s.length()) {
                char n = s.charAt(++i);
                switch (n) {
                    case '"'  -> sb.append('"');
                    case '\\' -> sb.append('\\');
                    case 'n'  -> sb.append('\n');
                    case 'r'  -> sb.append('\r');
                    case 't'  -> sb.append('\t');
                    default   -> { sb.append('\\'); sb.append(n); }
                }
            } else if (c == '"') break;
            else sb.append(c);
        }
        return sb.toString();
    }

    private String toJsonString(String s) {
        return "\"" + s.replace("\\", "\\\\")
                .replace("\"", "\\\"")
                .replace("\n", "\\n")
                .replace("\r", "\\r")
                .replace("\t", "\\t") + "\"";
    }
}