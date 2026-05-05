package gui;

import entities.Evaluation;
import entities.User;
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
import services.CertificationService;
import services.CompetenceService;

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
import java.util.regex.Matcher;
import java.util.regex.Pattern;
import javafx.application.Platform;

public class StudentEvaluationsController implements Initializable {
    @FXML private VBox mainContainer;
    @FXML private Label exerciseTitle;
    @FXML private ComboBox<String> languageCombo;
    @FXML private ComboBox<String> themeCombo;
    @FXML private TextArea descriptionArea;
    @FXML private TextArea expectedOutputArea;
    @FXML private TextArea hintsArea;
    @FXML private Label charCountLabel;
    @FXML private VBox editorContainer;
    @FXML private Button runButton;
    @FXML private Button submitButton;
    @FXML private Button clearConsoleButton;
    @FXML private TextArea outputArea;
    @FXML private TextArea regularAnswerArea;
    @FXML private FlowPane evaluationGrid;
    @FXML private TextField searchField;
    @FXML private ComboBox<String> statusFilter;

    // Keep references to data models and services
    private EvaluationService service = new EvaluationService();
    private CertificationService certificationService = new CertificationService();
    private CompetenceService competenceService = new CompetenceService();
    
    private User loggedInUser;
    private ObservableList<Evaluation> allEvaluations = FXCollections.observableArrayList();
    private boolean isDarkMode = false;
    private Evaluation selectedEvaluation;
    private TextArea codeEditor;

    @Override
    public void initialize(URL location, ResourceBundle resources) {
        // Populate combos
        languageCombo.setItems(FXCollections.observableArrayList("Java", "Python", "C++", "JavaScript"));
        languageCombo.setValue("Java");
        
        themeCombo.setItems(FXCollections.observableArrayList("vs-dark", "light"));
        themeCombo.setValue("vs-dark");

        // Status filter
        statusFilter.setItems(FXCollections.observableArrayList("All", "pending", "graded"));
        statusFilter.setValue("All");

        // Search and filter listeners
        searchField.textProperty().addListener((obs, oldVal, newVal) -> applyFilters());
        statusFilter.valueProperty().addListener((obs, oldVal, newVal) -> applyFilters());
    }

    public void showDetails(Evaluation e) {
        this.selectedEvaluation = e;
        loadEvaluationMode();
        // Hide grid
        mainContainer.getChildren().get(0).setVisible(false);
        mainContainer.getChildren().get(0).setManaged(false);
        // Show editor
        for (int i = 1; i < mainContainer.getChildren().size(); i++) {
            mainContainer.getChildren().get(i).setVisible(true);
            mainContainer.getChildren().get(i).setManaged(true);
        }
    }

    private void loadEvaluationMode() {
        if (selectedEvaluation == null) return;

        if (codeEditor == null) {
            codeEditor = new TextArea();
            codeEditor.setStyle("-fx-font-family: 'Consolas', monospace; -fx-font-size: 13px; -fx-background-color: #1e1e1e; -fx-text-fill: #e0e0e0;");
            codeEditor.setWrapText(false);
            editorContainer.getChildren().setAll(codeEditor);
            VBox.setVgrow(codeEditor, javafx.scene.layout.Priority.ALWAYS);
            
            // Character counter
            codeEditor.textProperty().addListener((obs, oldVal, newVal) -> {
                if (newVal != null) {
                    charCountLabel.setText(newVal.length() + " chars");
                }
            });
            
            // Theme sync for TextArea
            themeCombo.valueProperty().addListener((obs, oldVal, newVal) -> {
                if (codeEditor != null) {
                    if ("vs-dark".equals(newVal)) {
                        codeEditor.setStyle("-fx-font-family: 'Consolas', monospace; -fx-font-size: 13px; -fx-background-color: #1e1e1e; -fx-text-fill: #e0e0e0;");
                    } else {
                        codeEditor.setStyle("-fx-font-family: 'Consolas', monospace; -fx-font-size: 13px; -fx-background-color: #ffffff; -fx-text-fill: #000000;");
                    }
                }
            });
        }

        exerciseTitle.setText(selectedEvaluation.getTitle());
        descriptionArea.setText(selectedEvaluation.getDescription());
        expectedOutputArea.setText(selectedEvaluation.getExpectedOutput() != null ? selectedEvaluation.getExpectedOutput() : "");
        hintsArea.setText(selectedEvaluation.getComment() != null ? selectedEvaluation.getComment() : "No hints provided.");

        String lang = selectedEvaluation.getLanguage() != null ? selectedEvaluation.getLanguage() : "Java";
        codeEditor.setText(selectedEvaluation.getCodeContent() != null ? selectedEvaluation.getCodeContent() : "// Write your code here");
        languageCombo.setValue(lang);
    }

    @FXML
    private void handleSaveAnswer() {
        if (selectedEvaluation == null) return;

        String answer = codeEditor.getText();
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
        if (codeEditor == null) return;
        String code = codeEditor.getText();
        if (code == null || code.trim().isEmpty()) return;

        runButton.setDisable(true);
        runButton.setText("⏳ Running...");
        outputArea.setText("Compiling...");

        new Thread(() -> {
            try {
                String tmpDir = System.getProperty("java.io.tmpdir");
                
                // Detect class name using regex
                String className = "StudentSolution";
                Pattern pattern = Pattern.compile("public\\s+class\\s+([a-zA-Z0-9_$]+)");
                Matcher matcher = pattern.matcher(code);
                
                String finalCode = code;
                if (matcher.find()) {
                    className = matcher.group(1);
                } else {
                    // No public class found, wrap it
                    finalCode = "public class StudentSolution {\n" + finalCode + "\n}";
                    className = "StudentSolution";
                }

                String fileName = className + ".java";
                File javaFile = new File(tmpDir, fileName);

                try (FileWriter writer = new FileWriter(javaFile)) {
                    writer.write(finalCode);
                }

                JavaCompiler compiler = ToolProvider.getSystemJavaCompiler();
                if (compiler == null) {
                    Platform.runLater(() -> outputArea.setText("System Java Compiler not found. Please ensure you are running on a JDK."));
                    return;
                }

                ByteArrayOutputStream errStream = new ByteArrayOutputStream();
                int result = compiler.run(null, null, new PrintStream(errStream), javaFile.getAbsolutePath());

                if (result != 0) {
                    String errors = errStream.toString();
                    Platform.runLater(() -> outputArea.setText("Compilation Error:\n" + errors));
                    return;
                }

                Platform.runLater(() -> outputArea.setText("Compiled successfully. Executing..."));

                // Run the compiled class
                String finalClassName = className;
                ProcessBuilder pb = new ProcessBuilder("java", "-cp", tmpDir, finalClassName);
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
                    Platform.runLater(() -> outputArea.setText("Execution timed out."));
                } else {
                    String resultText = output.toString();
                    Platform.runLater(() -> {
                        outputArea.setText(resultText);
                        if (process.exitValue() == 0) {
                            handleSuccessfulExecution();
                        }
                    });
                }

            } catch (Exception e) {
                Platform.runLater(() -> outputArea.setText("Error: " + e.getMessage()));
                e.printStackTrace();
            } finally {
                Platform.runLater(() -> {
                    runButton.setDisable(false);
                    runButton.setText("▶ Run Code");
                });
            }
        }).start();
    }

    private void handleSuccessfulExecution() {
        if (selectedEvaluation == null) return;

        Platform.runLater(() -> {
            Alert alert = new Alert(Alert.AlertType.INFORMATION);
            alert.setTitle("Code Executed Successfully");
            alert.setHeaderText(null);
            alert.setContentText("Code ran successfully! Click Submit Solution to submit your answer.");
            alert.showAndWait();

            submitButton.setVisible(true);
            submitButton.setManaged(true);
        });
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
        showDetails(evaluation);
    }

    public void closeEditor() {
        selectedEvaluation = null;
        // Show grid
        mainContainer.getChildren().get(0).setVisible(true);
        mainContainer.getChildren().get(0).setManaged(true);
        // Hide editor
        for (int i = 1; i < mainContainer.getChildren().size(); i++) {
            mainContainer.getChildren().get(i).setVisible(false);
            mainContainer.getChildren().get(i).setManaged(false);
        }
    }

    @FXML
    private void handleExport() {
        // Placeholder for CSV export logic
    }

    @FXML
    private void toggleTheme() {
        Scene scene = mainContainer.getScene();
        Parent root = scene.getRoot();
        if (isDarkMode) {
            root.getStyleClass().remove("dark-mode");
            isDarkMode = false;
        } else {
            root.getStyleClass().add("dark-mode");
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

    @FXML
    private void clearConsole() {
        outputArea.clear();
    }

    @FXML
    private void submitSolution() {
        if (codeEditor == null || selectedEvaluation == null) return;

        String studentOutput = outputArea.getText().trim();
        String expectedOutput = selectedEvaluation.getExpectedOutput() != null
            ? selectedEvaluation.getExpectedOutput().trim() : "";

        if (studentOutput.isEmpty()
                || studentOutput.equals("Compiling...")
                || studentOutput.startsWith("Compilation Error")
                || studentOutput.startsWith("Error")
                || studentOutput.equals("Execution timed out.")) {
            showAlert(Alert.AlertType.WARNING, "Run First",
                "Please run your code successfully before submitting.");
            return;
        }

        boolean passed = compareOutputs(studentOutput, expectedOutput);

        if (passed) {
            Alert confirm = new Alert(Alert.AlertType.CONFIRMATION);
            confirm.setTitle("✅ Output Matches!");
            confirm.setHeaderText("Your output matches the expected output!");
            confirm.setContentText(
                "Would you like to submit and generate your certificate?");

            if (confirm.showAndWait().orElse(ButtonType.CANCEL) == ButtonType.OK) {
                try {
                    selectedEvaluation.setStatus("graded");
                    selectedEvaluation.setScore(100f);
                    selectedEvaluation.setComment(
                        "Automated evaluation: Output matched successfully.");
                    selectedEvaluation.setCodeContent(codeEditor.getText());
                    service.update(selectedEvaluation);

                    String certPath = certificationService.generateCertificate(
                        loggedInUser, selectedEvaluation);

                    if (selectedEvaluation.getCompetence() != null) {
                        entities.Competence comp = selectedEvaluation.getCompetence();
                        comp.setCertificate(certPath);
                        competenceService.update(comp);
                    }

                    submitButton.setDisable(true);
                    showAlert(Alert.AlertType.INFORMATION, "🎓 Certified!",
                        "Congratulations! Your certificate has been saved to:\n"
                        + certPath);
                    refreshTable();
                } catch (Exception e) {
                    showAlert(Alert.AlertType.ERROR, "Error",
                        "Failed to generate certification: " + e.getMessage());
                    e.printStackTrace();
                }
            }
        } else {
            showAlert(Alert.AlertType.ERROR, "❌ Output Mismatch",
                "Your output does not match the expected output.\n\n" +
                "Expected:\n" + expectedOutput + "\n\n" +
                "Your output:\n" + studentOutput + "\n\n" +
                "Please review your code and try again.");
        }
    }

    private boolean compareOutputs(String actual, String expected) {
        if (expected == null || expected.isEmpty()) return true;
        String[] actualLines = actual.trim().split("\\r?\\n");
        String[] expectedLines = expected.trim().split("\\r?\\n");
        if (actualLines.length != expectedLines.length) return false;
        for (int i = 0; i < actualLines.length; i++) {
            if (!actualLines[i].trim().equalsIgnoreCase(expectedLines[i].trim())) {
                return false;
            }
        }
        return true;
    }
}
