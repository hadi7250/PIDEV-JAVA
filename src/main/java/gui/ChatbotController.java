package gui;

import javafx.application.Platform;
import javafx.fxml.FXML;
import javafx.scene.control.Button;
import javafx.scene.control.TextArea;
import javafx.scene.control.TextField;
import javafx.stage.Stage;
import services.GeminiAIService;

public class ChatbotController {

    @FXML private TextArea  chatArea;
    @FXML private TextField questionField;

    private final GeminiAIService aiService = new GeminiAIService();

    @FXML
    public void initialize() {
        addBotMessage("👋 Hello! I'm EduBot, your AI assistant for EduConnect.");
        addBotMessage("💬 You can ask me anything — about users, statistics, or just chat!\n"
                + "  • How many users do we have?\n"
                + "  • Show me all admins\n"
                + "  • What is the average age?\n"
                + "  • Find user [name or email]\n"
                + "  • Or just say hello 😊");

        // Allow sending with Enter key
        questionField.setOnAction(e -> sendQuestion());
    }

    // ================================================================
    // SEND MESSAGE
    // ================================================================

    @FXML
    void sendQuestion() {
        String message = questionField.getText().trim();
        if (message.isEmpty()) return;

        addUserMessage(message);
        questionField.clear();
        questionField.setDisable(true);

        // Run API call on background thread so UI doesn't freeze
        Thread thread = new Thread(() -> {
            addBotMessage("⏳ Thinking...");
            String response = aiService.askQuestion(message);

            Platform.runLater(() -> {
                // Remove the "Thinking..." line
                String current = chatArea.getText();
                int thinkingIdx = current.lastIndexOf("🤖: ⏳ Thinking...");
                if (thinkingIdx >= 0) {
                    chatArea.setText(current.substring(0, thinkingIdx));
                }
                addBotMessage(response);
                questionField.setDisable(false);
                questionField.requestFocus();
            });
        });
        thread.setDaemon(true);
        thread.start();
    }

    // ================================================================
    // QUICK QUESTION BUTTONS
    // ================================================================

    @FXML void askExample1() { ask("How many users do we have?"); }
    @FXML void askExample2() { ask("What is the average age of users?"); }
    @FXML void askExample3() { ask("Who are the admins?"); }
    @FXML void askExample4() { ask("Show me all users"); }
    @FXML void askExample5() { ask("Show statistics"); }
    @FXML void askExample6() { ask("How many active users are there?"); }

    private void ask(String question) {
        questionField.setText(question);
        sendQuestion();
    }

    // ================================================================
    // CHAT DISPLAY HELPERS
    // ================================================================

    private void addUserMessage(String message) {
        String time = java.time.LocalTime.now()
                .format(java.time.format.DateTimeFormatter.ofPattern("HH:mm"));
        chatArea.appendText("\n👤 [" + time + "]: " + message + "\n");
    }

    private void addBotMessage(String message) {
        Platform.runLater(() ->
                chatArea.appendText("🤖: " + message + "\n")
        );
    }

    // ================================================================
    // CLOSE
    // ================================================================

    @FXML
    void closeChat() {
        Stage stage = (Stage) chatArea.getScene().getWindow();
        stage.close();
    }
}