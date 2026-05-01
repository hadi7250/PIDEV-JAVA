package controllers;

import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.geometry.Insets;
import javafx.scene.Node;
import javafx.scene.control.*;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.layout.GridPane;
import models.Quiz;
import models.Question;
import services.QuestionService;

import java.sql.SQLException;
import java.util.List;
import java.util.Optional;
import java.util.stream.Collectors;

public class QuestionController {

    @FXML private Label quizTitleLabel;
    @FXML private TextField searchField;
    @FXML private TableView<Question> questionTable;
    @FXML private TableColumn<Question, Integer> colId;
    @FXML private TableColumn<Question, String>  colText;
    @FXML private TableColumn<Question, String>  colOptions;
    @FXML private TableColumn<Question, String>  colAnswer;
    @FXML private TableColumn<Question, Integer> colPoints;

    private final QuestionService service = new QuestionService();
    private ObservableList<Question> allData = FXCollections.observableArrayList();
    private Quiz currentQuiz;

    @FXML
    public void initialize() {
        colId.setCellValueFactory(new PropertyValueFactory<>("id"));
        colText.setCellValueFactory(new PropertyValueFactory<>("questionText"));
        colOptions.setCellValueFactory(new PropertyValueFactory<>("options"));
        colAnswer.setCellValueFactory(new PropertyValueFactory<>("correctAnswer"));
        colPoints.setCellValueFactory(new PropertyValueFactory<>("points"));
    }

    public void setQuiz(Quiz quiz) {
        this.currentQuiz = quiz;
        quizTitleLabel.setText("Questions for: " + quiz.getTitle());
        loadData();
    }

    private void loadData() {
        try {
            List<Question> data = service.getByQuizId(currentQuiz.getId());
            allData = FXCollections.observableArrayList(data);
            questionTable.setItems(allData);
        } catch (SQLException e) {
            showAlert(Alert.AlertType.ERROR, "DB Error", "Could not load questions: " + e.getMessage());
        }
    }

    @FXML public void handleRefresh() { searchField.clear(); loadData(); }

    @FXML
    public void handleSearch() {
        String keyword = searchField.getText().toLowerCase().trim();
        if (keyword.isEmpty()) { questionTable.setItems(allData); return; }
        questionTable.setItems(allData.stream()
                .filter(q -> q.getQuestionText().toLowerCase().contains(keyword)
                        || q.getCorrectAnswer().toLowerCase().contains(keyword))
                .collect(Collectors.toCollection(FXCollections::observableArrayList)));
    }

    @FXML
    public void handleAdd() {
        Question newQ = new Question(0, "", "", "", 10, currentQuiz.getId());
        if (showQuestionDialog(newQ, "Add Question")) {
            try {
                service.createQuestion(newQ);
                loadData();
            } catch (SQLException e) {
                showAlert(Alert.AlertType.ERROR, "DB Error", "Failed to add question: " + e.getMessage());
            }
        }
    }

    @FXML
    public void handleEdit() {
        Question selected = questionTable.getSelectionModel().getSelectedItem();
        if (selected == null) { showAlert(Alert.AlertType.WARNING, "No Selection", "Please select a question to edit."); return; }
        if (showQuestionDialog(selected, "Edit Question")) {
            try {
                service.updateQuestion(selected);
                loadData();
            } catch (SQLException e) {
                showAlert(Alert.AlertType.ERROR, "DB Error", "Failed to update question: " + e.getMessage());
            }
        }
    }

    @FXML
    public void handleDelete() {
        Question selected = questionTable.getSelectionModel().getSelectedItem();
        if (selected == null) { showAlert(Alert.AlertType.WARNING, "No Selection", "Please select a question to delete."); return; }
        Alert confirm = new Alert(Alert.AlertType.CONFIRMATION);
        confirm.setTitle("Confirm Delete");
        confirm.setHeaderText("Delete this question?");
        confirm.setContentText(selected.getQuestionText());
        applyThemeToDialog(confirm.getDialogPane());
        if (confirm.showAndWait().orElse(ButtonType.CANCEL) == ButtonType.OK) {
            try {
                service.deleteQuestion(selected.getId());
                loadData();
            } catch (SQLException e) {
                showAlert(Alert.AlertType.ERROR, "DB Error", "Failed to delete question: " + e.getMessage());
            }
        }
    }

    // ── Themed dialog builder ──────────────────────────────────────────────────

    private boolean showQuestionDialog(Question q, String dialogTitle) {
        Dialog<ButtonType> dialog = new Dialog<>();
        dialog.setTitle(dialogTitle);
        dialog.setHeaderText(dialogTitle);
        ButtonType okButton = new ButtonType("Save", ButtonBar.ButtonData.OK_DONE);
        dialog.getDialogPane().getButtonTypes().addAll(okButton, ButtonType.CANCEL);

        TextArea taText    = new TextArea(q.getQuestionText());
        taText.setPromptText("Enter the question text");
        taText.setPrefRowCount(3); taText.setWrapText(true); taText.setPrefWidth(340);

        TextField tfOpts   = new TextField(q.getOptions());
        tfOpts.setPromptText("e.g. Paris;London;Berlin;Madrid"); tfOpts.setPrefWidth(340);

        TextField tfAnswer = new TextField(q.getCorrectAnswer());
        tfAnswer.setPromptText("Must match one option exactly"); tfAnswer.setPrefWidth(340);

        TextField tfPoints = new TextField(String.valueOf(q.getPoints()));
        tfPoints.setPrefWidth(340);

        Label errText   = errLabel(); Label errOpts   = errLabel();
        Label errAnswer = errLabel(); Label errPoints  = errLabel();

        GridPane g = new GridPane();
        g.setHgap(12); g.setVgap(4);
        g.setPadding(new Insets(20, 20, 10, 20));
        g.add(new Label("Question:"),                      0, 0); g.add(taText,   1, 0);
        g.add(errText,                                     1, 1);
        g.add(new Label("Options (semicolon-separated):"), 0, 2); g.add(tfOpts,   1, 2);
        g.add(errOpts,                                     1, 3);
        g.add(new Label("Correct Answer:"),                0, 4); g.add(tfAnswer, 1, 4);
        g.add(errAnswer,                                   1, 5);
        g.add(new Label("Points:"),                        0, 6); g.add(tfPoints, 1, 6);
        g.add(errPoints,                                   1, 7);

        dialog.getDialogPane().setContent(g);
        applyThemeToDialog(dialog.getDialogPane());

        Node saveBtn = dialog.getDialogPane().lookupButton(okButton);
        saveBtn.setDisable(true);

        Runnable validate = () -> {
            boolean valid = true;
            if (taText.getText().trim().length() < 3) {
                errText.setText("⚠ At least 3 characters."); taText.setStyle("-fx-border-color:#c0392b;"); valid = false;
            } else { errText.setText(""); taText.setStyle(""); }

            String opts = tfOpts.getText().trim();
            if (!opts.contains(";")) {
                errOpts.setText("⚠ Separate with semicolons (A;B;C;D)."); tfOpts.setStyle("-fx-border-color:#c0392b;"); valid = false;
            } else { errOpts.setText(""); tfOpts.setStyle(""); }

            String answer = tfAnswer.getText().trim();
            boolean matches = false;
            for (String o : opts.split(";")) if (o.trim().equalsIgnoreCase(answer)) { matches = true; break; }
            if (answer.isEmpty() || !matches) {
                errAnswer.setText("⚠ Must match one option exactly."); tfAnswer.setStyle("-fx-border-color:#c0392b;"); valid = false;
            } else { errAnswer.setText(""); tfAnswer.setStyle(""); }

            try { if (Integer.parseInt(tfPoints.getText().trim()) < 1) throw new NumberFormatException();
                errPoints.setText(""); tfPoints.setStyle("");
            } catch (NumberFormatException e) {
                errPoints.setText("⚠ Number ≥ 1."); tfPoints.setStyle("-fx-border-color:#c0392b;"); valid = false;
            }
            saveBtn.setDisable(!valid);
        };

        taText.textProperty().addListener((o,a,b) -> validate.run());
        tfOpts.textProperty().addListener((o,a,b) -> validate.run());
        tfAnswer.textProperty().addListener((o,a,b) -> validate.run());
        tfPoints.textProperty().addListener((o,a,b) -> validate.run());
        validate.run();

        if (dialog.showAndWait().orElse(ButtonType.CANCEL) == okButton) {
            q.setQuestionText(taText.getText().trim());
            q.setOptions(tfOpts.getText().trim());
            q.setCorrectAnswer(tfAnswer.getText().trim());
            q.setPoints(Integer.parseInt(tfPoints.getText().trim()));
            return true;
        }
        return false;
    }

    // ── Helpers ───────────────────────────────────────────────────────────────

    /** Apply current theme + stylesheet to any DialogPane so it matches the app. */
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

    private Label errLabel() {
        Label l = new Label();
        l.setStyle("-fx-text-fill: #c0392b; -fx-font-size: 11px;");
        return l;
    }

    private void showAlert(Alert.AlertType type, String title, String content) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(content);
        applyThemeToDialog(alert.getDialogPane());
        alert.showAndWait();
    }
}
