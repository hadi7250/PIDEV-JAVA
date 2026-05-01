package controllers;

import javafx.application.Platform;
import javafx.fxml.FXML;
import javafx.geometry.Pos;
import javafx.scene.control.*;
import javafx.scene.layout.*;
import services.ChatbotService;

public class ChatController {

    @FXML private Label      lblTopic;
    @FXML private Label      lblCurrentQ;
    @FXML private ScrollPane chatScroll;
    @FXML private VBox       chatMessages;
    @FXML private TextArea   chatInput;

    private final ChatbotService chatbot = new ChatbotService();
    private String currentQuestion = "";

    @FXML
    public void initialize() {}

    /** Called by TakeQuizController when opening the popup. */
    public void setup(String quizTopic, String currentQuestion) {
        this.currentQuestion = currentQuestion;
        chatbot.setContext(quizTopic, currentQuestion);

        lblTopic.setText("📚 " + quizTopic);
        updateCurrentQuestion(currentQuestion);

        addBotMessage("👋 Hi! I can help you with hints about this **" + quizTopic
                + "** quiz.\n\nAsk me anything about the topic, or click "
                + "\"💡 Hint\" for a clue about the current question!");
    }

    /** Called when the user navigates to a new question. */
    public void updateCurrentQuestion(String questionText) {
        this.currentQuestion = questionText;
        chatbot.setCurrentQuestion(questionText);
        if (questionText != null && !questionText.isBlank()) {
            String preview = questionText.length() > 80
                    ? questionText.substring(0, 80) + "…"
                    : questionText;
            lblCurrentQ.setText("Current: " + preview);
        }
    }

    @FXML
    public void handleHint() {
        String autoMsg = "Give me a hint for the current question without revealing the answer.";
        addUserMessage("💡 Hint please");
        sendToBot(autoMsg);
    }

    @FXML
    public void handleSend() {
        String msg = chatInput.getText().trim();
        if (msg.isBlank()) return;
        chatInput.clear();
        addUserMessage(msg);
        sendToBot(msg);
    }

    @FXML
    public void handleClose() {
        chatScroll.getScene().getWindow().hide();
    }

    private void sendToBot(String message) {
        Label thinking = new Label("🤖 Thinking…");
        thinking.setStyle("-fx-text-fill: #888; -fx-font-style: italic; -fx-font-size: 12px; -fx-padding: 0 0 0 4;");
        chatMessages.getChildren().add(thinking);
        scrollToBottom();

        new Thread(() -> {
            try {
                String reply = chatbot.chat(message);
                Platform.runLater(() -> {
                    chatMessages.getChildren().remove(thinking);
                    addBotMessage(reply);
                });
            } catch (Exception e) {
                Platform.runLater(() -> {
                    chatMessages.getChildren().remove(thinking);
                    addBotMessage("❌ " + e.getMessage());
                });
            }
        }, "chatbot").start();
    }

    private void addUserMessage(String text) {
        Label lbl = new Label(text);
        lbl.setWrapText(true);
        lbl.setMaxWidth(260);
        lbl.setStyle(
            "-fx-background-color: linear-gradient(to right,#6a1b9a,#4a148c);"
            + "-fx-text-fill: white; -fx-background-radius: 14 14 4 14;"
            + "-fx-padding: 8 12; -fx-font-size: 12px;");
        HBox row = new HBox(lbl);
        row.setAlignment(Pos.CENTER_RIGHT);
        chatMessages.getChildren().add(row);
        scrollToBottom();
    }

    private void addBotMessage(String text) {
        Label lbl = new Label(text);
        lbl.setWrapText(true);
        lbl.setMaxWidth(260);
        lbl.setStyle(
            "-fx-background-color: #f3e5f5;"
            + "-fx-text-fill: #1a004a; -fx-background-radius: 14 14 14 4;"
            + "-fx-padding: 8 12; -fx-font-size: 12px;"
            + "-fx-border-color: #ce93d8; -fx-border-radius: 14 14 14 4;");
        HBox row = new HBox(lbl);
        row.setAlignment(Pos.CENTER_LEFT);
        chatMessages.getChildren().add(row);
        scrollToBottom();
    }

    private void scrollToBottom() {
        Platform.runLater(() -> chatScroll.setVvalue(1.0));
    }
}
