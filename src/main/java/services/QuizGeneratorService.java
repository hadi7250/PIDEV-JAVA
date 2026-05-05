package services;

import models.Question;
import models.Quiz;

import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import java.time.Duration;
import java.util.ArrayList;
import java.util.List;

/**
 * Generates quizzes using Groq API — free, no IP restrictions, no credit card.
 *
 * GET YOUR FREE KEY (1 minute):
 * 1. Go to https://console.groq.com
 * 2. Sign in with Google or GitHub
 * 3. Click "API Keys" → "Create API Key"
 * 4. Copy the key (gsk_...) and paste it below
 */
public class QuizGeneratorService {

    // ── PASTE YOUR GROQ KEY HERE ──────────────────────────────────────────────
    public static String API_KEY = "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";
    // ─────────────────────────────────────────────────────────────────────────

    private static final String API_URL = "https://api.groq.com/openai/v1/chat/completions";
    private static final String MODEL   = "llama-3.3-70b-versatile";

    private String lastRawResponse = ""; // for debugging
    private final HttpClient http = HttpClient.newBuilder()
            .connectTimeout(Duration.ofSeconds(30))
            .build();

    public record GeneratedQuiz(Quiz quiz, List<Question> questions) {}

    public GeneratedQuiz generate(String topic, int questionCount,
                                  String difficulty) throws Exception {
        if (API_KEY == null || API_KEY.isBlank() || API_KEY.equals("PASTE_YOUR_GROQ_KEY_HERE"))
            throw new IllegalStateException(
                "No Groq API key set.\n" +
                "Get a free key at https://console.groq.com\n" +
                "then paste it in QuizGeneratorService.java");

        String prompt  = buildPrompt(topic, questionCount, difficulty);
        String rawJson = callGroq(prompt);
        return parse(rawJson, topic, questionCount, difficulty);
    }

    private String buildPrompt(String topic, int count, String diff) {
        int pts = switch (diff) { case "Easy" -> 5; case "Hard" -> 15; default -> 10; };
        return "You are a quiz generator. Output ONLY valid JSON, no markdown, no explanation.\n\n"
             + "TOPIC: " + topic + "\n"
             + "IMPORTANT: Generate ALL questions and answers in ENGLISH only.\n"
             + "Generate exactly " + count + " questions, difficulty: " + diff + "\n"
             + "Each question has exactly 4 options separated by semicolons.\n"
             + "correctAnswer must match one option exactly.\n"
             + "Points per question: " + pts + "\n\n"
             + "Output ONLY this JSON:\n"
             + "{\"title\":\"" + topic + " Quiz\","
             + "\"description\":\"A " + diff.toLowerCase() + " quiz about " + topic + "\","
             + "\"timeLimit\":" + (count * 30) + ","
             + "\"totalScore\":" + (count * pts) + ","
             + "\"questions\":[{\"questionText\":\"...\",\"options\":\"A;B;C;D\","
             + "\"correctAnswer\":\"A\",\"points\":" + pts + "}]}";
    }

    private String callGroq(String prompt) throws Exception {
        String body = "{"
            + "\"model\":\"" + MODEL + "\","
            + "\"messages\":[{\"role\":\"user\",\"content\":" + toJsonString(prompt) + "}],"
            + "\"max_tokens\":4096,"
            + "\"temperature\":0.7"
            + "}";

        int[] waitSeconds = {10, 20, 40};

        for (int attempt = 0; attempt <= waitSeconds.length; attempt++) {
            HttpRequest req = HttpRequest.newBuilder()
                .uri(URI.create(API_URL))
                .header("Content-Type", "application/json")
                .header("Authorization", "Bearer " + API_KEY)
                .timeout(Duration.ofSeconds(60))
                .POST(HttpRequest.BodyPublishers.ofString(body))
                .build();

            HttpResponse<String> resp = http.send(req, HttpResponse.BodyHandlers.ofString());
            int    status   = resp.statusCode();
            String respBody = resp.body();

            System.out.println("[Groq] status=" + status);
            System.out.println("[Groq] body=" + respBody.substring(0, Math.min(300, respBody.length())));

            if (status == 200) { lastRawResponse = respBody; return extractContent(respBody); }

            if (status == 429) {
                if (attempt < waitSeconds.length) {
                    System.out.println("[Groq] rate limit - waiting " + waitSeconds[attempt] + "s...");
                    Thread.sleep(waitSeconds[attempt] * 1000L);
                    continue;
                }
                throw new RuntimeException("Rate limit - wait 60 seconds and try again.");
            }

            if (status == 401)
                throw new RuntimeException(
                    "Invalid Groq key (401).\nGet a new one at https://console.groq.com");

            throw new RuntimeException("Groq error " + status + ":\n"
                + respBody.substring(0, Math.min(400, respBody.length())));
        }
        throw new RuntimeException("All retries failed.");
    }

    private String extractContent(String apiResp) {
        int idx = apiResp.indexOf("\"content\":");
        if (idx < 0) throw new RuntimeException("No content in response:\n"
            + apiResp.substring(0, Math.min(300, apiResp.length())));
        int q = apiResp.indexOf('"', idx + 10) + 1;
        return unescape(apiResp, q);
    }

    private GeneratedQuiz parse(String raw, String topic, int count, String diff) {
        raw = raw.trim();
        if (raw.startsWith("```")) {
            int nl  = raw.indexOf('\n') + 1;
            int end = raw.lastIndexOf("```");
            if (end > nl) raw = raw.substring(nl, end).trim();
        }
        int start = raw.indexOf('{');
        if (start > 0) raw = raw.substring(start);

        Quiz quiz = new Quiz();
        quiz.setTitle(field(raw, "title", topic + " Quiz"));
        quiz.setDescription(field(raw, "description", diff + " quiz about " + topic));
        quiz.setTimeLimit(intField(raw, "timeLimit", count * 30));
        quiz.setTotalScore(intField(raw, "totalScore", count * 10));

        List<Question> questions = new ArrayList<>();
        int arrIdx = raw.indexOf("\"questions\"");
        if (arrIdx >= 0) {
            int bracketOpen = raw.indexOf('[', arrIdx);
            int depth = 1, objStart = -1; // start at 1 — already inside '['
            for (int i = bracketOpen; i < raw.length(); i++) {
                char c = raw.charAt(i);
                if (c == '{') { if (depth++ == 1) objStart = i; }
                else if (c == '}') {
                    if (--depth == 1 && objStart >= 0) {
                        String obj = raw.substring(objStart, i + 1);
                        Question q = new Question();
                        q.setQuestionText(field(obj, "questionText", ""));
                        q.setOptions(field(obj, "options", ""));
                        q.setCorrectAnswer(field(obj, "correctAnswer", ""));
                        q.setPoints(intField(obj, "points", 10));
                        if (!q.getQuestionText().isBlank() && !q.getQuestionText().equals("..."))
                            questions.add(q);
                        objStart = -1;
                    }
                }
            }
        }
        if (questions.isEmpty()) {
            System.out.println("[Groq] PARSE FAILED. Raw response was:\n" + raw);
            throw new RuntimeException(
                "Groq returned 0 questions.\n" +
                "Raw response (check IntelliJ console for details):\n" +
                raw.substring(0, Math.min(200, raw.length())));
        }
        return new GeneratedQuiz(quiz, questions);
    }

    private String field(String json, String key, String fallback) {
        int k = json.indexOf("\"" + key + "\"");
        if (k < 0) return fallback;
        int colon = json.indexOf(':', k);
        if (colon < 0) return fallback;
        int q = json.indexOf('"', colon + 1);
        if (q < 0) return fallback;
        String val = unescape(json, q + 1);
        return val.isBlank() ? fallback : val;
    }

    private int intField(String json, String key, int fallback) {
        int k = json.indexOf("\"" + key + "\"");
        if (k < 0) return fallback;
        int colon = json.indexOf(':', k);
        if (colon < 0) return fallback;
        StringBuilder sb = new StringBuilder();
        for (int i = colon + 1; i < json.length(); i++) {
            char c = json.charAt(i);
            if (Character.isDigit(c)) sb.append(c);
            else if (!sb.isEmpty()) break;
        }
        try { return sb.isEmpty() ? fallback : Integer.parseInt(sb.toString()); }
        catch (NumberFormatException e) { return fallback; }
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
