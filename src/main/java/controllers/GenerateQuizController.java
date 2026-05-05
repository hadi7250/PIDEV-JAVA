package controllers;

import javafx.application.Platform;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.layout.VBox;
import javafx.stage.Modality;
import javafx.stage.Stage;
import models.Question;
import models.Quiz;
import services.QuizGeneratorService;
import services.QuizService;
import services.QuestionService;

import java.io.IOException;
import java.net.URL;
import java.sql.SQLException;
import java.util.List;

public class GenerateQuizController {

    @FXML private TextField         tfTopic;
    @FXML private Spinner<Integer>  spCount;
    @FXML private ComboBox<String>  cbDifficulty;
    @FXML private Button            btnGenerate;
    @FXML private VBox              statusBox;
    @FXML private Label             lblStatus;
    @FXML private ProgressIndicator spinner;

    private final QuizGeneratorService generator   = new QuizGeneratorService();
    private final QuizService          quizService = new QuizService();
    private final QuestionService      qService    = new QuestionService();

    @FXML
    public void initialize() {
        cbDifficulty.getItems().addAll("Easy", "Medium", "Hard");
        cbDifficulty.setValue("Medium");
        spCount.setValueFactory(new SpinnerValueFactory.IntegerSpinnerValueFactory(1, 30, 10));
        statusBox.setVisible(false);
        lblStatus.setText("");
        spinner.setVisible(false);
        tfTopic.setOnAction(e -> handleGenerate());
    }

    @FXML
    public void handleGenerate() {
        String topic = tfTopic.getText().trim();
        if (topic.isBlank()) {
            showStatus("❌ Please enter a topic first.", false);
            return;
        }

        int    count = spCount.getValue();
        String diff  = cbDifficulty.getValue();

        showStatus("⏳ Generating " + count + " \"" + diff
                + "\" questions about \"" + topic + "\"…", true);
        btnGenerate.setDisable(true);

        Thread t = new Thread(() -> {
            try {
                // Update status with estimated time (10s per question roughly)
                int estSecs = count * 2;
                Platform.runLater(() -> showStatus(
                    "⏳ Generating " + count + " questions… (~" + estSecs + "s)", true));

                QuizGeneratorService.GeneratedQuiz result =
                        generator.generate(topic, count, diff);
                Platform.runLater(() -> saveAndOpen(result));
            } catch (Exception e) {
                String msg = e.getMessage();
                // Make multiline messages display better
                if (msg != null && msg.contains("\n")) {
                    msg = msg.replace("\n", " | ");
                }
                final String finalMsg = msg;
                Platform.runLater(() -> showStatus("❌ " + finalMsg, false));
            } finally {
                Platform.runLater(() -> btnGenerate.setDisable(false));
            }
        }, "gemini-gen");
        t.setDaemon(true);
        t.start();
    }

    private void saveAndOpen(QuizGeneratorService.GeneratedQuiz result) {
        try {
            quizService.createQuiz(result.quiz());

            List<Quiz> all = quizService.getAll();
            Quiz saved = all.stream()
                    .filter(q -> q.getTitle().equals(result.quiz().getTitle()))
                    .reduce((a, b) -> b)
                    .orElseThrow(() -> new SQLException("Could not retrieve saved quiz"));

            for (Question q : result.questions()) {
                q.setQuizId(saved.getId());
                qService.createQuestion(q);
            }

            showStatus("✅ " + result.questions().size()
                    + " questions generated — opening editor…", false);

            openEditor(saved);

        } catch (Exception e) {
            showStatus("❌ Save failed: " + e.getMessage(), false);
        }
    }

    private void openEditor(Quiz quiz) {
        URL url = getClass().getResource("/fxml/quiz/QuestionView.fxml");
        if (url == null) {
            showStatus("❌ QuestionView.fxml not found — rebuild project.", false);
            return;
        }
        try {
            FXMLLoader loader = new FXMLLoader(url);
            Parent root = loader.load();
            QuestionController ctrl = loader.getController();
            ctrl.setQuiz(quiz);

            Scene scene = new Scene(root, 1050, 640);
            ThemeManager.getInstance().register(scene);

            Stage stage = new Stage();
            stage.setTitle("📝 " + quiz.getTitle() + " — Review & add questions");
            stage.initModality(Modality.APPLICATION_MODAL);
            stage.setScene(scene);
            stage.setOnHidden(e -> ThemeManager.getInstance().unregister(scene));
            stage.show();

            btnGenerate.getScene().getWindow().hide();

        } catch (IOException e) {
            showStatus("❌ Cannot open editor: " + e.getMessage(), false);
        }
    }

    private void showStatus(String msg, boolean loading) {
        statusBox.setVisible(true);
        lblStatus.setText(msg);
        spinner.setVisible(loading);
    }
}
