package services;

import com.google.gson.JsonObject;
import com.google.gson.JsonParser;
import entities.User;

import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.nio.charset.StandardCharsets;
import java.util.List;
import java.util.Scanner;

public class GeminiAIService {

    // TA CLÉ API GEMINI
    private static final String API_KEY = "AIzaSyDxHniWbPst89ZciUBnE45SJX_3Mea18ek";
    private static final String GEMINI_URL = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash-exp:generateContent?key=" + API_KEY;

    private UserService userService = new UserService();

    /**
     * Pose une question au chatbot et obtient une réponse
     */
    public String askQuestion(String question) {
        try {
            // 1. Analyser la question et exécuter la requête SQL
            String sqlResult = executeIntelligentQuery(question);

            // 2. Construire le prompt pour Gemini
            String prompt = buildPrompt(question, sqlResult);

            // 3. Appeler l'API Gemini
            String aiResponse = callGeminiAPI(prompt);

            return aiResponse;

        } catch (Exception e) {
            e.printStackTrace();
            return "❌ Désolé, une erreur s'est produite: " + e.getMessage();
        }
    }

    /**
     * Construit le prompt pour l'API Gemini
     */
    private String buildPrompt(String question, String sqlResult) {
        return "Tu es un assistant IA pour un administrateur de base de données utilisateurs. "
                + "L'administrateur a posé la question: \"" + question + "\"\n\n"
                + "Voici le résultat de l'interrogation de la base de données:\n"
                + sqlResult + "\n\n"
                + "Réponds à l'administrateur de manière claire, professionnelle et conviviale en français. "
                + "Si le résultat contient des données, présente-les de façon organisée. "
                + "Sois bref mais complet. N'invente pas d'informations qui ne sont pas dans le résultat.";
    }

    /**
     * Analyse la question et exécute la requête SQL appropriée
     */
    private String executeIntelligentQuery(String question) {
        String lowerQuestion = question.toLowerCase();
        List<User> allUsers = userService.getAllUsers();

        // Requête: nombre d'utilisateurs
        if (lowerQuestion.contains("combien") || lowerQuestion.contains("nombre")) {
            if (lowerQuestion.contains("utilisateur") || lowerQuestion.contains("personne")) {
                int total = allUsers.size();
                return "📊 Il y a actuellement " + total + " utilisateur(s) dans le système.";
            }
            if (lowerQuestion.contains("admin")) {
                long count = allUsers.stream().filter(User::isAdmin).count();
                return "👑 Il y a " + count + " administrateur(s) dans le système.";
            }
        }

        // Requête: âge moyen
        if (lowerQuestion.contains("âge") || lowerQuestion.contains("age")) {
            if (lowerQuestion.contains("moyen") || lowerQuestion.contains("moyenne")) {
                double avgAge = allUsers.stream().mapToInt(User::getAge).average().orElse(0);
                return "📊 L'âge moyen des utilisateurs est de " + String.format("%.1f", avgAge) + " ans.";
            }
        }

        // Requête: liste des utilisateurs
        if (lowerQuestion.contains("liste") || lowerQuestion.contains("affiche") || lowerQuestion.contains("tous")) {
            StringBuilder sb = new StringBuilder("📋 Liste des utilisateurs:\n");
            for (User user : allUsers) {
                sb.append("  • ").append(user.getFirstName()).append(" ").append(user.getLastName())
                        .append(" (").append(user.getRole()).append(") - ").append(user.getEmail()).append("\n");
            }
            return sb.toString();
        }

        // Requête: recherche par email
        if (lowerQuestion.contains("email") || lowerQuestion.contains("mail")) {
            for (User user : allUsers) {
                if (lowerQuestion.contains(user.getEmail().toLowerCase())) {
                    return "🔍 Utilisateur trouvé: " + user.getFirstName() + " " + user.getLastName() +
                            " (Âge: " + user.getAge() + ", Rôle: " + user.getRole() + ")";
                }
            }
        }

        // Requête: recherche par nom
        for (User user : allUsers) {
            if (lowerQuestion.contains(user.getFirstName().toLowerCase()) ||
                    lowerQuestion.contains(user.getLastName().toLowerCase())) {
                return "🔍 J'ai trouvé: " + user.getFirstName() + " " + user.getLastName() +
                        " (Âge: " + user.getAge() + ", Email: " + user.getEmail() + ", Rôle: " + user.getRole() + ")";
            }
        }

        // Requête: statistiques
        if (lowerQuestion.contains("statistique") || lowerQuestion.contains("dashboard")) {
            int total = allUsers.size();
            long adminCount = allUsers.stream().filter(User::isAdmin).count();
            long userCount = total - adminCount;
            double avgAge = allUsers.stream().mapToInt(User::getAge).average().orElse(0);
            return String.format("📊 STATISTIQUES:\n" +
                    "• Total utilisateurs: %d\n" +
                    "• Administrateurs: %d\n" +
                    "• Utilisateurs standards: %d\n" +
                    "• Âge moyen: %.1f ans", total, adminCount, userCount, avgAge);
        }

        // Si aucune requête spécifique n'est identifiée
        return "🤔 Je n'ai pas compris votre question. Voici ce que je peux faire:\n" +
                "  • Combien d'utilisateurs ?\n" +
                "  • Quel est l'âge moyen ?\n" +
                "  • Affiche la liste des utilisateurs\n" +
                "  • Cherche [nom ou email]\n" +
                "  • Statistiques\n" +
                "  • Qui est l'administrateur ?";
    }

    /**
     * Appelle l'API Gemini pour une réponse plus naturelle
     */
    private String callGeminiAPI(String prompt) throws Exception {
        URL url = new URL(GEMINI_URL);
        HttpURLConnection conn = (HttpURLConnection) url.openConnection();
        conn.setRequestMethod("POST");
        conn.setRequestProperty("Content-Type", "application/json");
        conn.setDoOutput(true);

        // Construire le corps de la requête JSON
        String jsonBody = "{"
                + "\"contents\": [{"
                + "\"parts\": [{\"text\": \"" + escapeJson(prompt) + "\"}]"
                + "}]"
                + "}";

        try (OutputStream os = conn.getOutputStream()) {
            os.write(jsonBody.getBytes(StandardCharsets.UTF_8));
        }

        int responseCode = conn.getResponseCode();
        if (responseCode == 200) {
            Scanner scanner = new Scanner(conn.getInputStream(), StandardCharsets.UTF_8);
            String response = scanner.useDelimiter("\\A").next();
            scanner.close();

            // Extraire le texte de la réponse
            JsonObject jsonResponse = JsonParser.parseString(response).getAsJsonObject();
            String aiText = jsonResponse
                    .getAsJsonArray("candidates")
                    .get(0).getAsJsonObject()
                    .getAsJsonObject("content")
                    .getAsJsonArray("parts")
                    .get(0).getAsJsonObject()
                    .get("text").getAsString();

            return aiText;
        } else {
            return "❌ Erreur API: " + responseCode;
        }
    }

    private String escapeJson(String text) {
        return text.replace("\\", "\\\\")
                .replace("\"", "\\\"")
                .replace("\n", "\\n")
                .replace("\r", "\\r")
                .replace("\t", "\\t");
    }

    /**
     * Version simplifiée sans API externe (fonctionne toujours)
     */
    public String askQuestionLocal(String question) {
        return executeIntelligentQuery(question);
    }
}