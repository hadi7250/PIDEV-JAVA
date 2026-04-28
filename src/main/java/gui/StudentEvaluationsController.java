package gui;

import entities.Evaluation;
import entities.User;
import eu.mihosoft.monacofx.MonacoFX;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.layout.FlowPane;
import javafx.scene.layout.StackPane;
import javafx.scene.layout.VBox;
import javafx.stage.Stage;
import services.EvaluationService;

import javax.tools.JavaCompiler;
import javax.tools.ToolProvider;
import java.io.*;
import java.net.URL;
import java.sql.SQLException;
import java.time.LocalDateTime;
import java.util.List;
import java.util.ResourceBundle;
import java.util.concurrent.TimeUnit;
import java.util.stream.Collectors;
import javafx.application.Platform;

public class StudentEvaluationsController implements Initializable {
    @FXML private StackPane mainContainer;
    @FXML private FlowPane evaluationGrid;

    @FXML private TextField searchField;
    @FXML private ComboBox<String> statusFilter;
    @FXML private Label scoreDetailLabel;
    @FXML private Label commentDetailLabel;

    @FXML private VBox answerContainer;
    @FXML private StackPane monacoContainer;
    @FXML private TextArea regularAnswerArea;
    @FXML private Button btnRun;
    @FXML private TextArea consoleOutput;

    private EvaluationService service = new EvaluationService();
    private User loggedInUser;
    private ObservableList<Evaluation> allEvaluations = FXCollections.observableArrayList();
    private boolean isDarkMode = false;
    private Evaluation selectedEvaluation;
    private MonacoFX monacoFX;

    @Override
    public void initialize(URL location, ResourceBundle resources) {
        statusFilter.setItems(FXCollections.observableArrayList("All", "pending", "graded", "rejected"));
        statusFilter.setValue("All");
        searchField.textProperty().addListener((obs, oldVal, newVal) -> applyFilters());
        statusFilter.valueProperty().addListener((obs, oldVal, newVal) -> applyFilters());
    }

    public void showDetails(Evaluation e) {
        this.selectedEvaluation = e;
        scoreDetailLabel.setText("Weight: " + e.getWeight() + "% (" + e.getStatus() + ")");
        commentDetailLabel.setText(e.getComment() != null && !e.getComment().isEmpty() ? e.getComment() : "No feedback provided yet.");
        
        loadEvaluationMode();
    }

    private void loadEvaluationMode() {
        if (selectedEvaluation == null) return;

        answerContainer.setVisible(true);
        answerContainer.setManaged(true);

        if (selectedEvaluation.isCodeEvaluation()) {
            monacoContainer.setVisible(true);
            monacoContainer.setManaged(true);
            regularAnswerArea.setVisible(false);
            regularAnswerArea.setManaged(false);

            monacoFX = new MonacoFX();
            monacoFX.getEditor().setCurrentTheme("vs-dark");
            monacoFX.getEditor().setCurrentLanguage(selectedEvaluation.getLanguage());
            monacoFX.getEditor().getDocument().setText(selectedEvaluation.getCodeContent() != null ? selectedEvaluation.getCodeContent() : "// Write your code here");
            monacoContainer.getChildren().setAll(monacoFX);
        } else {
            monacoContainer.setVisible(false);
            monacoContainer.setManaged(false);
            regularAnswerArea.setVisible(true);
            regularAnswerArea.setManaged(true);

            regularAnswerArea.setText(selectedEvaluation.getCodeContent() != null ? selectedEvaluation.getCodeContent() : "");
        }
    }

    @FXML
    private void handleSaveAnswer() {
        if (selectedEvaluation == null) return;

        String answer = selectedEvaluation.isCodeEvaluation() 
            ? monacoFX.getEditor().getDocument().getText()
            : regularAnswerArea.getText();

        selectedEvaluation.setCodeContent(answer);
        
        try {
            service.update(selectedEvaluation);
            showAlert(Alert.AlertType.INFORMATION, "Success", "Your answer has been committed successfully.");
        } catch (SQLException e) {
            e.printStackTrace();
            showAlert(Alert.AlertType.ERROR, "Database Error", "Could not save your answer: " + e.getMessage());
        }
    }

    @FXML
    private void runCode() {
        if (monacoFX == null) return;
        String code = monacoFX.getEditor().getDocument().getText();
        if (code == null || code.trim().isEmpty()) return;

        btnRun.setDisable(true);
        btnRun.setText("⏳ Running...");
        consoleOutput.setText("Compiling...");

        new Thread(() -> {
            try {
                String tmpDir = System.getProperty("java.io.tmpdir");
                String fileName = "StudentSolution.java";
                File javaFile = new File(tmpDir, fileName);

                String finalCode = code;
                if (!finalCode.contains("public class")) {
                    finalCode = "public class StudentSolution {\n" + finalCode + "\n}";
                }

                try (FileWriter writer = new FileWriter(javaFile)) {
                    writer.write(finalCode);
                }

                JavaCompiler compiler = ToolProvider.getSystemJavaCompiler();
                if (compiler == null) {
                    Platform.runLater(() -> consoleOutput.setText("System Java Compiler not found. Please ensure you are running on a JDK."));
                    return;
                }

                ByteArrayOutputStream errStream = new ByteArrayOutputStream();
                int result = compiler.run(null, null, new PrintStream(errStream), javaFile.getAbsolutePath());

                if (result != 0) {
                    String errors = errStream.toString();
                    Platform.runLater(() -> consoleOutput.setText("Compilation Error:\n" + errors));
                    return;
                }

                Platform.runLater(() -> consoleOutput.setText("Compiled successfully. Executing..."));

                ProcessBuilder pb = new ProcessBuilder("java", "-cp", tmpDir, "StudentSolution");
                pb.redirectErrorStream(true);
                Process process = pb.start();

                StringBuilder output = new StringBuilder();
                try (BufferedReader reader = new BufferedReader(new InputStreamReader(process.getInputStream()))) {
                    String line;
                    while ((line = reader.readLine()) != null) {
                        output.append(line).append("\n");
                    }
                }

                boolean finished = process.waitFor(10, TimeUnit.SECONDS);
                if (!finished) {
                    process.destroyForcibly();
                    Platform.runLater(() -> consoleOutput.setText("Execution timed out."));
                } else {
                    String resultText = output.toString();
                    Platform.runLater(() -> consoleOutput.setText(resultText));
                }

            } catch (Exception e) {
                Platform.runLater(() -> consoleOutput.setText("Error: " + e.getMessage()));
            } finally {
                Platform.runLater(() -> {
                    btnRun.setDisable(false);
                    btnRun.setText("▶ Run Code");
                });
            }
        }).start();
    }

    private void showAlert(Alert.AlertType type, String title, String msg) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setContentText(msg);
        alert.showAndWait();
    }

    public void setLoggedInUser(User user) {
        this.loggedInUser = user;
        refreshTable();
    }

    @FXML
    public void refreshTable() {
        try {
            if (loggedInUser != null) {
                List<Evaluation> list = service.readByStudent(loggedInUser.getId());
                allEvaluations = FXCollections.observableArrayList(list);
                populateGrid(allEvaluations);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    private void populateGrid(List<Evaluation> evaluations) {
        evaluationGrid.getChildren().clear();
        for (Evaluation e : evaluations) {
            try {
                FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/EvaluationCard.fxml"));
                VBox card = loader.load();
                EvaluationCardController controller = loader.getController();
                controller.setData(e, this);
                evaluationGrid.getChildren().add(card);
            } catch (IOException ex) {
                ex.printStackTrace();
            }
        }
    }

    private void applyFilters() {
        String search = searchField.getText().toLowerCase();
        String status = statusFilter.getValue();

        List<Evaluation> filtered = allEvaluations.stream()
            .filter(e -> e.getTitle().toLowerCase().contains(search) || (e.getCompetence() != null && e.getCompetence().getTitle().toLowerCase().contains(search)))
            .filter(e -> status == null || status.equals("All") || e.getStatus().equalsIgnoreCase(status))
            .collect(Collectors.toList());

        populateGrid(filtered);
    }

    public void openEditor(Evaluation evaluation) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/EvaluationEditor.fxml"));
            VBox editorRoot = loader.load();
            EvaluationEditorController controller = loader.getController();
            controller.setEvaluation(evaluation, this);
            
            mainContainer.getChildren().add(editorRoot);
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public void closeEditor() {
        if (mainContainer.getChildren().size() > 1) {
            mainContainer.getChildren().remove(mainContainer.getChildren().size() - 1);
        }
    }

    @FXML
    private void handleExport() {
        // Placeholder for CSV export logic
    }

    @FXML
    private void toggleTheme() {
        Button themeButton = (Button) mainContainer.lookup(".theme-toggle-btn");
        if (isDarkMode) {
            mainContainer.getStyleClass().remove("dark-theme");
            mainContainer.getStyleClass().add("light-theme");
            if (themeButton != null) themeButton.setText("🌙 Dark Mode");
            isDarkMode = false;
        } else {
            mainContainer.getStyleClass().remove("light-theme");
            mainContainer.getStyleClass().add("dark-theme");
            if (themeButton != null) themeButton.setText("☀️ Light Mode");
            isDarkMode = true;
        }
    }

    @FXML
    private void goToProfile() {
        loadSubModule("/fxml/UserBasicPage.fxml");
    }

    @FXML
    private void goBack() {
        loadSubModule("/fxml/AfficherCompetences.fxml");
    }

    private void loadSubModule(String fxmlPath) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource(fxmlPath));
            Parent root = loader.load();
            
            Object controller = loader.getController();
            if (controller instanceof AfficherCompetencesController) ((AfficherCompetencesController) controller).setLoggedInUser(loggedInUser);
            else if (controller instanceof UserBasicPageController) ((UserBasicPageController) controller).setLoggedInUser(loggedInUser);

            StackPane contentHost = (StackPane) mainContainer.getScene().lookup("#contentHost");
            if (contentHost != null) {
                contentHost.getChildren().setAll(root);
            } else {
                Stage stage = (Stage) mainContainer.getScene().getWindow();
                stage.setScene(new Scene(root));
            }
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
}