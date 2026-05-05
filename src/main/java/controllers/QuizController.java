package controllers;

import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.stage.Modality;
import javafx.stage.Stage;
import controllers.ThemeManager;
import models.Quiz;
import services.QuizService;

import java.io.IOException;
import java.net.URL;
import java.sql.SQLException;
import java.util.List;
import java.util.stream.Collectors;

public class QuizController {

    @FXML private TextField searchField;
    @FXML private TableView<Quiz> quizTable;
    @FXML private TableColumn<Quiz, Integer> colId;
    @FXML private TableColumn<Quiz, String>  colTitle;
    @FXML private TableColumn<Quiz, String>  colDesc;
    @FXML private TableColumn<Quiz, Integer> colTimeLimit;
    @FXML private TableColumn<Quiz, Integer> colTotalScore;

    private final QuizService service = new QuizService();
    private ObservableList<Quiz> allData = FXCollections.observableArrayList();

    @FXML
    public void initialize() {
        colId.setCellValueFactory(new PropertyValueFactory<>("id"));
        colTitle.setCellValueFactory(new PropertyValueFactory<>("title"));
        colDesc.setCellValueFactory(new PropertyValueFactory<>("description"));
        colTimeLimit.setCellValueFactory(new PropertyValueFactory<>("timeLimit"));
        colTotalScore.setCellValueFactory(new PropertyValueFactory<>("totalScore"));

        quizTable.setRowFactory(tv -> {
            TableRow<Quiz> row = new TableRow<>();
            row.setOnMouseClicked(event -> {
                if (event.getClickCount() == 2 && !row.isEmpty())
                    openQuestions(row.getItem());
            });
            return row;
        });

        loadData();

        // Register main scene with ThemeManager once attached
        quizTable.sceneProperty().addListener((obs, oldScene, newScene) -> {
            if (newScene != null) {
                ThemeManager.getInstance().register(newScene);
            }
        });
    }

    private void loadData() {
        try {
            List<Quiz> data = service.getAll();
            allData = FXCollections.observableArrayList(data);
            quizTable.setItems(allData);
        } catch (SQLException e) {
            showAlert(Alert.AlertType.ERROR, "DB Error", "Could not load data: " + e.getMessage());
        }
    }

    @FXML public void handleRefresh() { searchField.clear(); loadData(); }

    @FXML
    public void handleSearch() {
        String kw = searchField.getText().toLowerCase().trim();
        if (kw.isEmpty()) { quizTable.setItems(allData); return; }
        quizTable.setItems(allData.stream()
                .filter(q -> q.getTitle().toLowerCase().contains(kw)
                        || q.getDescription().toLowerCase().contains(kw))
                .collect(Collectors.toCollection(FXCollections::observableArrayList)));
    }

    @FXML
    public void handleAdd() {
        Quiz q = new Quiz(0, "", "", 30, 100);
        if (showQuizDialog(q, "Add Quiz")) {
            try { service.createQuiz(q); loadData(); }
            catch (SQLException e) { showAlert(Alert.AlertType.ERROR, "DB Error", e.getMessage()); }
        }
    }

    @FXML
    public void handleEdit() {
        Quiz sel = quizTable.getSelectionModel().getSelectedItem();
        if (sel == null) { showAlert(Alert.AlertType.WARNING, "No Selection", "Select a quiz to edit."); return; }
        if (showQuizDialog(sel, "Edit Quiz")) {
            try { service.updateQuiz(sel); loadData(); }
            catch (SQLException e) { showAlert(Alert.AlertType.ERROR, "DB Error", e.getMessage()); }
        }
    }

    @FXML
    public void handleDelete() {
        Quiz sel = quizTable.getSelectionModel().getSelectedItem();
        if (sel == null) { showAlert(Alert.AlertType.WARNING, "No Selection", "Select a quiz to delete."); return; }
        Alert c = new Alert(Alert.AlertType.CONFIRMATION);
        c.setHeaderText("Delete \"" + sel.getTitle() + "\"?");
        c.setContentText("All questions will also be deleted.");
        applyThemeToDialog(c.getDialogPane());
        if (c.showAndWait().orElse(ButtonType.CANCEL) == ButtonType.OK) {
            try { service.deleteQuiz(sel.getId()); loadData(); }
            catch (SQLException e) { showAlert(Alert.AlertType.ERROR, "DB Error", e.getMessage()); }
        }
    }

    @FXML
    public void handleViewQuestions() {
        Quiz sel = quizTable.getSelectionModel().getSelectedItem();
        if (sel == null) { showAlert(Alert.AlertType.WARNING, "No Selection", "Select a quiz first."); return; }
        openQuestions(sel);
    }

    @FXML
    public void handleGenerateQuiz() {
        URL url = getClass().getResource("/fxml/quiz/GenerateQuizView.fxml");
        if (url == null) { showAlert(Alert.AlertType.ERROR, "Error", "GenerateQuizView.fxml not found."); return; }
        try {
            FXMLLoader loader = new FXMLLoader(url);
            Parent root = loader.load();
            Scene scene = new Scene(root, 580, 370);
            ThemeManager.getInstance().register(scene);
            Stage stage = new Stage();
            stage.setTitle("🤖 AI Quiz Generator");
            stage.initModality(Modality.APPLICATION_MODAL);
            stage.setScene(scene);
            // Refresh quiz table AFTER generator closes so new quiz appears
            stage.setOnHidden(e -> {
                ThemeManager.getInstance().unregister(scene);
                loadData();
            });
            stage.show();
        } catch (IOException e) {
            showAlert(Alert.AlertType.ERROR, "Error", e.getMessage());
        }
    }

    @FXML
    public void handleTakeQuiz() {
        Quiz sel = quizTable.getSelectionModel().getSelectedItem();
        if (sel == null) { showAlert(Alert.AlertType.WARNING, "No Selection", "Select a quiz to take."); return; }
        openWindow("/fxml/quiz/TakeQuizView.fxml", "Taking Quiz — " + sel.getTitle(), 820, 620,
                loader -> { TakeQuizController ctrl = loader.getController(); ctrl.setQuiz(sel); });
    }

    private void openQuestions(Quiz quiz) {
        openWindow("/fxml/quiz/QuestionView.fxml", "Questions — " + quiz.getTitle(), 1000, 600,
                loader -> { QuestionController ctrl = loader.getController(); ctrl.setQuiz(quiz); });
    }

    private void openWindow(String fxmlPath, String title, double w, double h,
                            ControllerInitializer init) {
        URL url = getClass().getResource(fxmlPath);
        if (url == null) {
            showAlert(Alert.AlertType.ERROR, "File Not Found", "Cannot find: " + fxmlPath);
            return;
        }
        try {
            FXMLLoader loader = new FXMLLoader(url);
            Parent root = loader.load();
            init.init(loader);

            Scene scene = new Scene(root, w, h);
            // Apply current dark mode immediately
            if (ThemeManager.getInstance().isDarkMode()) {
                root.getStyleClass().add("dark-mode");
            }
            ThemeManager.getInstance().register(scene);

            Stage stage = new Stage();
            stage.setTitle(title);
            stage.initModality(Modality.APPLICATION_MODAL);
            stage.setScene(scene);
            stage.setOnHidden(e -> ThemeManager.getInstance().unregister(scene));
            stage.show();
        } catch (IOException e) {
            showAlert(Alert.AlertType.ERROR, "Load Error", e.getMessage());
            e.printStackTrace();
        }
    }

    @FunctionalInterface
    interface ControllerInitializer {
        void init(FXMLLoader loader) throws IOException;
    }

    // ── Themed dialog helpers ──────────────────────────────────────────────────

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

    private boolean showQuizDialog(Quiz quiz, String title) {
        Dialog<ButtonType> dialog = new Dialog<>();
        dialog.setTitle(title); dialog.setHeaderText(title);
        ButtonType ok = new ButtonType("Save", ButtonBar.ButtonData.OK_DONE);
        dialog.getDialogPane().getButtonTypes().addAll(ok, ButtonType.CANCEL);

        TextField tfTitle = new TextField(quiz.getTitle());    tfTitle.setPrefWidth(300);
        TextField tfDesc  = new TextField(quiz.getDescription()); tfDesc.setPrefWidth(300);
        TextField tfTime  = new TextField(String.valueOf(quiz.getTimeLimit())); tfTime.setPrefWidth(300);
        TextField tfScore = new TextField(String.valueOf(quiz.getTotalScore())); tfScore.setPrefWidth(300);

        Label errTitle = errLabel(); Label errDesc  = errLabel();
        Label errTime  = errLabel(); Label errScore = errLabel();

        javafx.scene.layout.GridPane g = new javafx.scene.layout.GridPane();
        g.setHgap(12); g.setVgap(4);
        g.setPadding(new javafx.geometry.Insets(20, 20, 10, 20));
        g.addRow(0, new Label("Title:"),          tfTitle); g.add(errTitle, 1, 1);
        g.addRow(2, new Label("Description:"),    tfDesc);  g.add(errDesc,  1, 3);
        g.addRow(4, new Label("Time Limit (s):"), tfTime);  g.add(errTime,  1, 5);
        g.addRow(6, new Label("Total Score:"),    tfScore); g.add(errScore, 1, 7);

        dialog.getDialogPane().setContent(g);
        applyThemeToDialog(dialog.getDialogPane());

        javafx.scene.Node saveBtn = dialog.getDialogPane().lookupButton(ok);
        saveBtn.setDisable(true);

        Runnable validate = () -> {
            boolean valid = true;
            if (tfTitle.getText().trim().length() < 3) {
                errTitle.setText("⚠ At least 3 characters."); tfTitle.setStyle("-fx-border-color:#c0392b;"); valid = false;
            } else { errTitle.setText(""); tfTitle.setStyle(""); }
            if (tfDesc.getText().trim().length() < 3) {
                errDesc.setText("⚠ At least 3 characters."); tfDesc.setStyle("-fx-border-color:#c0392b;"); valid = false;
            } else { errDesc.setText(""); tfDesc.setStyle(""); }
            try { if (Integer.parseInt(tfTime.getText().trim()) < 1) throw new NumberFormatException();
                errTime.setText(""); tfTime.setStyle("");
            } catch (NumberFormatException e) { errTime.setText("⚠ Number ≥ 1."); tfTime.setStyle("-fx-border-color:#c0392b;"); valid = false; }
            try { if (Integer.parseInt(tfScore.getText().trim()) < 1) throw new NumberFormatException();
                errScore.setText(""); tfScore.setStyle("");
            } catch (NumberFormatException e) { errScore.setText("⚠ Number ≥ 1."); tfScore.setStyle("-fx-border-color:#c0392b;"); valid = false; }
            saveBtn.setDisable(!valid);
        };

        tfTitle.textProperty().addListener((o,a,b) -> validate.run());
        tfDesc .textProperty().addListener((o,a,b) -> validate.run());
        tfTime .textProperty().addListener((o,a,b) -> validate.run());
        tfScore.textProperty().addListener((o,a,b) -> validate.run());
        validate.run();

        if (dialog.showAndWait().orElse(ButtonType.CANCEL) == ok) {
            quiz.setTitle(tfTitle.getText().trim());
            quiz.setDescription(tfDesc.getText().trim());
            quiz.setTimeLimit(Integer.parseInt(tfTime.getText().trim()));
            quiz.setTotalScore(Integer.parseInt(tfScore.getText().trim()));
            return true;
        }
        return false;
    }

    private Label errLabel() {
        Label l = new Label();
        l.setStyle("-fx-text-fill: #c0392b; -fx-font-size: 11px;");
        return l;
    }

    private void showAlert(Alert.AlertType type, String title, String content) {
        Alert a = new Alert(type); a.setTitle(title); a.setHeaderText(null);
        a.setContentText(content);
        applyThemeToDialog(a.getDialogPane());
        a.showAndWait();
    }
}
