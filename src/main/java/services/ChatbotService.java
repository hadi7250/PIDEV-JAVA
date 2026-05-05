package services;

import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import java.time.Duration;

/**
 * AI chatbot restricted to the quiz topic using Groq API.
 * Refuses off-topic questions politely.
 */
public class ChatbotService {

    private static final String API_URL = "https://api.groq.com/openai/v1/chat/completions";
    private static final String MODEL   = "llama-3.3-70b-versatile";

    private final HttpClient http = HttpClient.newBuilder()
            .connectTimeout(Duration.ofSeconds(30))
            .build();

    private String quizTopic      = "";
    private String currentQuestion = "";

    public void setContext(String quizTopic, String currentQuestion) {
        this.quizTopic       = quizTopic;
        this.currentQuestion = currentQuestion;
    }

    public void setCurrentQuestion(String currentQuestion) {
        this.currentQuestion = currentQuestion;
    }

    /**
     * Sends a message and returns the chatbot reply.
     * The chatbot only knows about the quiz topic.
     */
    public String chat(String userMessage) throws Exception {
        String systemPrompt =
            "You are a helpful quiz assistant for a quiz about: \"" + quizTopic + "\".\n\n" +
            "YOUR RULES:\n" +
            "1. You ONLY answer questions related to the topic: \"" + quizTopic + "\".\n" +
            "2. If the user asks about ANYTHING else, respond ONLY with: " +
            "\"I can only help with questions about " + quizTopic + ". Ask me something related to that!\"\n" +
            "3. Never give away the direct answer to the quiz question. Give hints only.\n" +
            "4. Keep responses short (2-3 sentences max).\n" +
            "5. Be friendly and encouraging.\n\n" +
            "CURRENT QUIZ QUESTION (for context):\n" + currentQuestion + "\n\n" +
            "Remember: hints only, never the direct answer.";

        String body = "{"
            + "\"model\":\"" + MODEL + "\","
            + "\"messages\":["
            +   "{\"role\":\"system\",\"content\":" + toJsonString(systemPrompt) + "},"
            +   "{\"role\":\"user\",\"content\":" + toJsonString(userMessage) + "}"
            + "],"
            + "\"max_tokens\":200,"
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

        if (resp.statusCode() == 200) return extractContent(resp.body());
        if (resp.statusCode() == 401) return "❌ Invalid API key.";
        if (resp.statusCode() == 429) return "⏳ Rate limit — wait a moment and try again.";
        return "❌ Error " + resp.statusCode();
    }

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
        return "\"" + s.replace("\\", "\\\\").replace("\"", "\\\"")
                       .replace("\n", "\\n").replace("\r", "\\r")
                       .replace("\t", "\\t") + "\"";
    }
}
