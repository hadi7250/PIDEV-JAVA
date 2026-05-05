package utils;

import models.Event;
import services.EventService;
import services.IEventService;
import org.json.JSONArray;
import org.json.JSONObject;

import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import java.time.Duration;
import java.util.List;
import java.util.stream.Collectors;

public class GeminiService {
    private static final String API_KEY = "AIzaSyB4nTfjim9R9meZND-5jXxoDXkbIiDEFaI";
    private static final String MODEL = "gemini-2.5-flash";
    private static final String API_URL = "https://generativelanguage.googleapis.com/v1beta/models/" + MODEL
            + ":generateContent?key=" + API_KEY;

    private final HttpClient httpClient;
    private final IEventService eventService = new EventService();

    public GeminiService() {
        this.httpClient = HttpClient.newBuilder()
                .connectTimeout(Duration.ofSeconds(10))
                .build();
    }

    public String askChatbot(String userPrompt) throws Exception {
        List<Event> events = eventService.getAll();
        String context = formatEventsContext(events);

        String systemPrompt = "Tu es un assistant utile pour une plateforme de gestion d'événements. " +
                "Voici les informations sur les événements actuels en format texte : \n" + context + "\n\n" +
                "Réponds aux questions de l'utilisateur en utilisant ces informations. Si l'utilisateur demande des détails sur un événement, sois précis. "
                +
                "Sois poli et encourageant.";

        return callGeminiWithRetry(systemPrompt, userPrompt, 3);
    }

    private String formatEventsContext(List<Event> events) {
        return events.stream().map(e -> String.format(
                "- Événement: %s\n  Description: %s\n  Lieu: %s\n  Date: %s\n  Catégorie: %s",
                e.getTitre(),
                e.getDescription() != null ? e.getDescription() : "N/A",
                e.getLieu(),
                e.getDateDebut() != null ? e.getDateDebut().toString() : "N/A",
                e.getCategory() != null ? e.getCategory().getName() : "N/A")).collect(Collectors.joining("\n\n"));
    }

    private String callGeminiWithRetry(String systemPrompt, String userPrompt, int maxRetries) throws Exception {
        int attempt = 0;
        while (attempt < maxRetries) {
            try {
                return callGemini(systemPrompt, userPrompt);
            } catch (Exception e) {
                if (e.getMessage() != null && e.getMessage().contains("503") && attempt < maxRetries - 1) {
                    attempt++;
                    Thread.sleep(1000 * attempt); // Exponential backoff
                } else {
                    throw e;
                }
            }
        }
        throw new Exception("Échec après " + maxRetries + " tentatives.");
    }

    private String callGemini(String systemPrompt, String userPrompt) throws Exception {
        JSONObject body = new JSONObject();
        JSONArray contents = new JSONArray();

        // Gemini 1.5 Flash supports system instructions, but for simplicity in a single
        // call,
        // we'll combine it in the prompt or use the correct API structure if preferred.
        // Let's use the simple structure:
        JSONObject userPart = new JSONObject();
        userPart.put("text", systemPrompt + "\n\nUtilisateur: " + userPrompt);

        JSONObject contentObj = new JSONObject();
        contentObj.put("parts", new JSONArray().put(userPart));
        contents.put(contentObj);

        body.put("contents", contents);

        HttpRequest request = HttpRequest.newBuilder()
                .uri(URI.create(API_URL))
                .header("Content-Type", "application/json")
                .POST(HttpRequest.BodyPublishers.ofString(body.toString()))
                .build();

        HttpResponse<String> response = httpClient.send(request, HttpResponse.BodyHandlers.ofString());

        if (response.statusCode() != 200) {
            throw new Exception("Gemini API Error: " + response.statusCode() + " - " + response.body());
        }

        JSONObject jsonResponse = new JSONObject(response.body());
        return jsonResponse.getJSONArray("candidates")
                .getJSONObject(0)
                .getJSONObject("content")
                .getJSONArray("parts")
                .getJSONObject(0)
                .getString("text");
    }
}
