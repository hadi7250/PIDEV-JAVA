package gui;

import javafx.fxml.FXML;
import javafx.scene.control.Button;
import javafx.scene.control.TextArea;
import javafx.scene.control.TextField;
import javafx.stage.Stage;
import services.GeminiAIService;

public class ChatbotController {

    @FXML
    private TextArea chatArea;
    @FXML
    private TextField questionField;

    private GeminiAIService geminiService = new GeminiAIService();
    private boolean useGeminiAPI = false; // Met à true si tu as la clé API

    @FXML
    public void initialize() {
        addMessage("🤖", "Bonjour Administrateur! Je suis votre assistant IA.");
        addMessage("🤖", "Je peux répondre à vos questions sur les utilisateurs.");
        addMessage("🤖", "Exemples:\n  • Combien d'utilisateurs avons-nous?\n  • Quel est l'âge moyen?\n  • Affiche la liste des utilisateurs\n  • Cherche Jean");
    }

    private void addMessage(String sender, String message) {
        String timestamp = java.time.LocalTime.now().format(java.time.format.DateTimeFormatter.ofPattern("HH:mm:ss"));
        chatArea.appendText("[" + timestamp + "] " + sender + ": " + message + "\n");
    }

    @FXML
    void sendQuestion() {
        String question = questionField.getText().trim();
        if (question.isEmpty()) return;

        addMessage("👤", question);
        questionField.clear();

        // Traiter la question
        String response;
        if (useGeminiAPI) {
            response = geminiService.askQuestion(question);
        } else {
            response = geminiService.askQuestionLocal(question);
        }

        addMessage("🤖", response);
    }

    @FXML
    void askExample1() {
        questionField.setText("Combien d'utilisateurs avons-nous ?");
        sendQuestion();
    }

    @FXML
    void askExample2() {
        questionField.setText("Quel est l'âge moyen des utilisateurs ?");
        sendQuestion();
    }

    @FXML
    void askExample3() {
        questionField.setText("Qui est l'administrateur ?");
        sendQuestion();
    }

    @FXML
    void askExample4() {
        questionField.setText("Affiche-moi la liste des utilisateurs");
        sendQuestion();
    }

    @FXML
    void closeChat() {
        Stage stage = (Stage) chatArea.getScene().getWindow();
        stage.close();
    }

    @FXML
    void askExample5() {
        questionField.setText("Cherche Admin");
        sendQuestion();
    }

    @FXML
    void askExample6() {
        questionField.setText("Affiche les statistiques");
        sendQuestion();
    }
}