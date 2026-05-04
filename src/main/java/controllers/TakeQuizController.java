package controllers;

import javafx.animation.KeyFrame;
import javafx.animation.Timeline;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.geometry.Insets;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.layout.*;
import javafx.stage.Stage;
import javafx.stage.StageStyle;
import javafx.util.Duration;
import models.Attempt;
import models.Question;
import models.Quiz;
import services.AttemptService;
import services.QuestionService;

import java.io.IOException;
import java.net.URL;
import java.sql.SQLException;
import java.time.LocalDateTime;
import java.util.*;

public class TakeQuizController {

    @FXML private Label  quizTitleLabel;
    @FXML private Label  timerLabel;
    @FXML private Label  progressLabel;
    @FXML private Label  questionLabel;
    @FXML private VBox   optionsBox;
    @FXML private Button btnPrev;
    @FXML private Button btnNext;
    @FXML private Button btnSubmit;
    @FXML private Button btnChat;

    private Quiz currentQuiz;
    private List<Question> questions;
    private int currentIndex = 0;
    private final Map<Integer, String> userAnswers = new HashMap<>();

    private Timeline timer;
    private int secondsLeft;
    private LocalDateTime startedAt;

    private final QuestionService questionService = new QuestionService();
    private final AttemptService  attemptService  = new AttemptService();

    // Chat popup state
    private Stage chatStage;
    private ChatController chatController;

    // ── Entry point ────────────────────────────────────────────────────────────
    public void setQuiz(Quiz quiz) {
        this.currentQuiz = quiz;
        quizTitleLabel.setText("📝 " + quiz.getTitle());
        startedAt = LocalDateTime.now();
        // Register scene with ThemeManager so dark mode applies
        if (quizTitleLabel.getScene() != null) {
            ThemeManager.getInstance().register(quizTitleLabel.getScene());
        } else {
            quizTitleLabel.sceneProperty().addListener((obs, o, newScene) -> {
                if (newScene != null) ThemeManager.getInstance().register(newScene);
            });
        }

        try {
            questions = questionService.getByQuizId(quiz.getId());
        } catch (SQLException e) {
            showAlert(Alert.AlertType.ERROR, "Error", "Could not load questions: " + e.getMessage());
            return;
        }
        if (questions.isEmpty()) {
            showAlert(Alert.AlertType.WARNING, "Empty Quiz", "This quiz has no questions yet!");
            return;
        }

        secondsLeft = quiz.getTimeLimit();
        startTimer();
        showQuestion(0);
    }

    // ── Timer ──────────────────────────────────────────────────────────────────
    private void startTimer() {
        updateTimerLabel();
        timer = new Timeline(new KeyFrame(Duration.seconds(1), e -> {
            secondsLeft--;
            updateTimerLabel();
            if (secondsLeft <= 0) {
                timer.stop();
                showAlert(Alert.AlertType.WARNING, "Time's Up", "⏰ Time's up! Submitting...");
                submitQuiz();
            }
        }));
        timer.setCycleCount(Timeline.INDEFINITE);
        timer.play();
    }

    private void updateTimerLabel() {
        int mins = secondsLeft / 60, secs = secondsLeft % 60;
        timerLabel.setText(String.format("%02d:%02d", mins, secs));
        timerLabel.setStyle(secondsLeft <= 30
                ? "-fx-text-fill: #FF5252; -fx-font-size: 20px; -fx-font-weight: bold;"
                : "-fx-text-fill: white;   -fx-font-size: 20px; -fx-font-weight: bold;");
    }

    // ── Question display ───────────────────────────────────────────────────────
    private void showQuestion(int index) {
        currentIndex = index;
        Question q = questions.get(index);
        progressLabel.setText("Question " + (index + 1) + " of " + questions.size());
        questionLabel.setText((index + 1) + ". " + q.getQuestionText());

        // Update chat popup with current question if it's open
        if (chatController != null)
            chatController.updateCurrentQuestion(q.getQuestionText());

        optionsBox.getChildren().clear();
        ToggleGroup group = new ToggleGroup();
        String previousAnswer = userAnswers.get(q.getId());

        for (String opt : parseOptions(q.getOptions())) {
            String trimmed = opt.trim();
            if (trimmed.isEmpty()) continue;

            RadioButton rb = new RadioButton(trimmed);
            rb.setToggleGroup(group);
            rb.getStyleClass().add("quiz-option");
            rb.setMaxWidth(Double.MAX_VALUE);

            HBox card = new HBox(rb);
            card.getStyleClass().add("option-card");
            card.setPadding(new Insets(10, 16, 10, 16));
            HBox.setHgrow(rb, Priority.ALWAYS);

            if (trimmed.equalsIgnoreCase(previousAnswer)) {
                rb.setSelected(true);
                card.getStyleClass().add("option-card-selected");
            }

            final String answer = trimmed;
            rb.setOnAction(e -> {
                userAnswers.put(q.getId(), answer);
                optionsBox.getChildren().forEach(n -> n.getStyleClass().remove("option-card-selected"));
                card.getStyleClass().add("option-card-selected");
            });
            optionsBox.getChildren().add(card);
        }

        btnPrev.setDisable(index == 0);
        boolean isLast = (index == questions.size() - 1);
        btnNext.setVisible(!isLast);
        btnSubmit.setVisible(isLast);
    }

    private String[] parseOptions(String raw) {
        if (raw == null || raw.isBlank()) return new String[0];
        String s = raw.trim();
        if (s.startsWith("[") && s.endsWith("]")) {
            s = s.substring(1, s.length() - 1);
            String[] parts = s.split(",(?=(?:[^\"]*\"[^\"]*\")*[^\"]*$)");
            return Arrays.stream(parts)
                    .map(p -> p.trim().replaceAll("^\"|\"$", ""))
                    .toArray(String[]::new);
        }
        if (s.contains(";")) return s.split(";");
        return s.split(",");
    }

    // ── Navigation ─────────────────────────────────────────────────────────────
    @FXML public void handlePrev() { if (currentIndex > 0) showQuestion(currentIndex - 1); }
    @FXML public void handleNext() { if (currentIndex < questions.size() - 1) showQuestion(currentIndex + 1); }

    @FXML public void handleSubmit() {
        Alert confirm = new Alert(Alert.AlertType.CONFIRMATION);
        confirm.setTitle("Submit Quiz");
        confirm.setHeaderText("Submit quiz?");
        confirm.setContentText("Answered: " + userAnswers.size() + " / " + questions.size());
        applyThemeToDialog(confirm.getDialogPane());
        if (confirm.showAndWait().orElse(ButtonType.CANCEL) != ButtonType.OK) return;
        if (timer != null) timer.stop();
        if (chatStage != null) chatStage.close();
        submitQuiz();
    }

    // ── Chat popup ─────────────────────────────────────────────────────────────
    @FXML
    public void handleToggleChat() {
        if (chatStage != null && chatStage.isShowing()) {
            chatStage.hide();
            btnChat.setText("💬  AI Hint");
            return;
        }

        // First time — create the popup
        if (chatStage == null) {
            URL url = getClass().getResource("/fxml/quiz/ChatPopup.fxml");
            if (url == null) {
                showAlert(Alert.AlertType.ERROR, "Error", "ChatPopup.fxml not found — rebuild project.");
                return;
            }
            try {
                FXMLLoader loader = new FXMLLoader(url);
                Parent root = loader.load();
                chatController = loader.getController();
                chatController.setup(
                        currentQuiz.getTitle(),
                        questions.get(currentIndex).getQuestionText());

                Scene scene = new Scene(root, 360, 500);
                ThemeManager.getInstance().register(scene);

                chatStage = new Stage(StageStyle.DECORATED);
                chatStage.setTitle("🤖 AI Quiz Assistant");
                chatStage.setScene(scene);
                chatStage.setAlwaysOnTop(true);
                chatStage.setResizable(false);

                // Position popup to the right of the quiz window
                Stage quizStage = (Stage) btnChat.getScene().getWindow();
                chatStage.setX(quizStage.getX() + quizStage.getWidth() + 10);
                chatStage.setY(quizStage.getY() + 80);

                chatStage.setOnHidden(e -> {
                    ThemeManager.getInstance().unregister(scene);
                    btnChat.setText("💬  AI Hint");
                    chatStage = null;
                    chatController = null;
                });

            } catch (IOException e) {
                showAlert(Alert.AlertType.ERROR, "Error", "Cannot open chat: " + e.getMessage());
                return;
            }
        }

        chatStage.show();
        btnChat.setText("✕  Close Chat");
    }

    // ── Submit & results ───────────────────────────────────────────────────────
    private void submitQuiz() {
        int totalScore = 0;
        StringBuilder answersLog    = new StringBuilder();
        StringBuilder resultDetails = new StringBuilder();

        for (Question q : questions) {
            String chosen   = userAnswers.getOrDefault(q.getId(), "");
            boolean correct = !chosen.isEmpty() && chosen.equalsIgnoreCase(q.getCorrectAnswer());
            if (correct) totalScore += q.getPoints();
            answersLog.append(q.getId()).append(":").append(
                    chosen.isEmpty() ? "-" : chosen.replaceAll("[|:]", "_")).append("|");
            resultDetails.append("Q: ").append(q.getQuestionText()).append("\n");
            resultDetails.append("  Your answer:    ").append(chosen.isEmpty() ? "(no answer)" : chosen).append("\n");
            resultDetails.append("  Correct answer: ").append(q.getCorrectAnswer()).append("\n");
            resultDetails.append(correct ? "  ✅ Correct (+" + q.getPoints() + " pts)\n" : "  ❌ Wrong\n");
            resultDetails.append("\n");
        }

        try {
            attemptService.saveAttempt(new Attempt(
                    currentQuiz.getId(), startedAt, LocalDateTime.now(),
                    totalScore, answersLog.toString()));
        } catch (SQLException e) {
            showAlert(Alert.AlertType.ERROR, "Save Error", e.getMessage());
        }

        showResults(totalScore, resultDetails.toString());
    }

    private void showResults(int totalScore, String details) {
        int maxScore = questions.stream().mapToInt(Question::getPoints).sum();
        Alert result = new Alert(Alert.AlertType.INFORMATION);
        result.setTitle("Quiz Results");
        result.setHeaderText("🎉 Quiz Complete!\n\nYour Score: " + totalScore + " / " + maxScore);
        applyThemeToDialog(result.getDialogPane());
        TextArea ta = new TextArea(details);
        ta.setEditable(false); ta.setWrapText(true);
        ta.setPrefWidth(560);  ta.setPrefHeight(360);
        result.getDialogPane().setExpandableContent(ta);
        result.getDialogPane().setExpanded(true);
        result.showAndWait();
        btnSubmit.getScene().getWindow().hide();
    }

    private void applyThemeToDialog(DialogPane pane) {
        pane.getStylesheets().add(
                getClass().getResource("/css/courses-module.css").toExternalForm());
        if (ThemeManager.getInstance().isDarkMode()) {
            pane.getStyleClass().add("dark-mode");
            pane.setStyle("-fx-background-color: #12211d;");
        } else {
            pane.setStyle("-fx-background-color: #f7fbf9;");
        }
    }

    private void showAlert(Alert.AlertType type, String title, String content) {
        Alert a = new Alert(type); a.setTitle(title); a.setHeaderText(null);
        a.setContentText(content);
        applyThemeToDialog(a.getDialogPane());
        a.showAndWait();
    }
}
