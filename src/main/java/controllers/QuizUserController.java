package controllers;

import controllers.ThemeManager;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.geometry.Insets;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.layout.*;
import javafx.stage.Modality;
import javafx.stage.Stage;
import models.Quiz;
import services.QuizService;

import java.io.IOException;
import java.sql.SQLException;
import java.util.List;
import java.util.stream.Collectors;

public class QuizUserController {

    @FXML private TextField searchField;
    @FXML private FlowPane quizCardsPane;
    @FXML private Label lblCount;

    private final QuizService service = new QuizService();
    private List<Quiz> allQuizzes;

    @FXML
    public void initialize() {
        loadQuizzes();
    }

    private void loadQuizzes() {
        try {
            allQuizzes = service.getAll();
            renderCards(allQuizzes);
        } catch (SQLException e) {
            showAlert("Could not load quizzes: " + e.getMessage());
        }
    }

    @FXML
    public void handleSearch() {
        String kw = searchField.getText().toLowerCase().trim();
        if (kw.isEmpty()) {
            renderCards(allQuizzes);
            return;
        }
        List<Quiz> filtered = allQuizzes.stream()
                .filter(q -> q.getTitle().toLowerCase().contains(kw)
                          || q.getDescription().toLowerCase().contains(kw))
                .collect(Collectors.toList());
        renderCards(filtered);
    }

    @FXML
    public void handleRefresh() {
        searchField.clear();
        loadQuizzes();
    }

    private void renderCards(List<Quiz> quizzes) {
        quizCardsPane.getChildren().clear();
        lblCount.setText(quizzes.size() + " quiz" + (quizzes.size() != 1 ? "zes" : "") + " available");

        if (quizzes.isEmpty()) {
            Label empty = new Label("No quizzes available yet.");
            empty.setStyle("-fx-text-fill: #888; -fx-font-size: 14px;");
            quizCardsPane.getChildren().add(empty);
            return;
        }

        for (Quiz quiz : quizzes) {
            quizCardsPane.getChildren().add(buildCard(quiz));
        }
    }

    private VBox buildCard(Quiz quiz) {
        VBox card = new VBox(10);
        card.setPrefWidth(280);
        card.setPrefHeight(180);
        card.setPadding(new Insets(20));
        card.getStyleClass().add("quiz-user-card");
        card.setStyle(
            "-fx-background-color: #ffffff;" +
            "-fx-background-radius: 14;" +
            "-fx-border-color: #d0ece6;" +
            "-fx-border-radius: 14;" +
            "-fx-effect: dropshadow(gaussian, rgba(0,0,0,0.08), 10, 0.1, 0, 3);" +
            "-fx-cursor: hand;"
        );

        // Title
        Label title = new Label(quiz.getTitle());
        title.setStyle("-fx-font-size: 16px; -fx-font-weight: bold; -fx-text-fill: #0f3d2e; -fx-wrap-text: true;");
        title.setMaxWidth(240);
        title.setWrapText(true);

        // Description
        String desc = quiz.getDescription() != null && !quiz.getDescription().isBlank()
                ? quiz.getDescription() : "No description";
        if (desc.length() > 80) desc = desc.substring(0, 80) + "…";
        Label description = new Label(desc);
        description.setStyle("-fx-text-fill: #555; -fx-font-size: 12px; -fx-wrap-text: true;");
        description.setMaxWidth(240);
        description.setWrapText(true);

        Region spacer = new Region();
        VBox.setVgrow(spacer, Priority.ALWAYS);

        // Info badges
        HBox badges = new HBox(8);
        badges.getChildren().addAll(
            badge("⏱ " + formatTime(quiz.getTimeLimit()), "#e8f5e9", "#2e7d32"),
            badge("⭐ " + quiz.getTotalScore() + " pts", "#fff8e1", "#f57f17")
        );

        // Start button
        Button startBtn = new Button("▶  Take Quiz");
        startBtn.setMaxWidth(Double.MAX_VALUE);
        startBtn.setStyle(
            "-fx-background-color: linear-gradient(to right, #1a7d73, #0f5f5a);" +
            "-fx-text-fill: white; -fx-font-weight: bold; -fx-font-size: 13px;" +
            "-fx-background-radius: 10; -fx-padding: 8 0; -fx-cursor: hand;"
        );
        startBtn.setOnAction(e -> openTakeQuiz(quiz));

        card.getChildren().addAll(title, description, spacer, badges, startBtn);

        // Double-click also opens quiz
        card.setOnMouseClicked(e -> {
            if (e.getClickCount() == 2) openTakeQuiz(quiz);
        });

        // Hover effect
        card.setOnMouseEntered(e -> card.setStyle(
            "-fx-background-color: #f0faf7;" +
            "-fx-background-radius: 14;" +
            "-fx-border-color: #1a7d73;" +
            "-fx-border-radius: 14;" +
            "-fx-border-width: 2;" +
            "-fx-effect: dropshadow(gaussian, rgba(26,125,115,0.18), 14, 0.2, 0, 4);" +
            "-fx-cursor: hand;"
        ));
        card.setOnMouseExited(e -> card.setStyle(
            "-fx-background-color: #ffffff;" +
            "-fx-background-radius: 14;" +
            "-fx-border-color: #d0ece6;" +
            "-fx-border-radius: 14;" +
            "-fx-effect: dropshadow(gaussian, rgba(0,0,0,0.08), 10, 0.1, 0, 3);" +
            "-fx-cursor: hand;"
        ));

        return card;
    }

    private Label badge(String text, String bg, String fg) {
        Label l = new Label(text);
        l.setStyle(
            "-fx-background-color: " + bg + ";" +
            "-fx-text-fill: " + fg + ";" +
            "-fx-font-size: 11px; -fx-font-weight: bold;" +
            "-fx-background-radius: 999; -fx-padding: 3 10;"
        );
        return l;
    }

    private String formatTime(int seconds) {
        if (seconds < 60) return seconds + "s";
        int m = seconds / 60, s = seconds % 60;
        return s == 0 ? m + "min" : m + "m" + s + "s";
    }

    private void openTakeQuiz(Quiz quiz) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/quiz/TakeQuizView.fxml"));
            Parent root = loader.load();
            TakeQuizController ctrl = loader.getController();
            ctrl.setQuiz(quiz);
            Scene scene = new Scene(root, 820, 620);
            // Apply dark mode if active
            if (ThemeManager.getInstance().isDarkMode()) {
                root.getStyleClass().add("dark-mode");
            }
            ThemeManager.getInstance().register(scene);
            Stage stage = new Stage();
            stage.setTitle("📝 " + quiz.getTitle());
            stage.initModality(Modality.APPLICATION_MODAL);
            stage.setScene(scene);
            stage.setOnHidden(e -> ThemeManager.getInstance().unregister(scene));
            stage.show();
        } catch (IOException e) {
            showAlert("Could not open quiz: " + e.getMessage());
        }
    }

    private void showAlert(String msg) {
        Alert a = new Alert(Alert.AlertType.ERROR);
        a.setTitle("Error"); a.setHeaderText(null);
        a.setContentText(msg);
        a.showAndWait();
    }

    @FXML
    private void goBack() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/UserHomeDashboard.fxml"));
            Parent root = loader.load();
            Stage stage = (Stage) quizCardsPane.getScene().getWindow();
            stage.setScene(new Scene(root));
            stage.setTitle("EduConnect - Home");
            stage.setMaximized(true);
            stage.show();
        } catch (IOException e) {
            showAlert("Could not return to home: " + e.getMessage());
        }
    }
}
