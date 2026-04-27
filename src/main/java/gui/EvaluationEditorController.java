package gui;

import entities.Evaluation;
import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.Label;
import javafx.scene.control.TextArea;
import services.EvaluationService;

import java.sql.SQLException;

public class EvaluationEditorController {
    @FXML private Label titleLabel;
    @FXML private Label descriptionLabel;
    @FXML private Label langLabel;
    @FXML private TextArea codeEditor;

    private Evaluation evaluation;
    private StudentEvaluationsController parentController;
    private final EvaluationService service = new EvaluationService();

    public void setEvaluation(Evaluation evaluation, StudentEvaluationsController parentController) {
        this.evaluation = evaluation;
        this.parentController = parentController;

        titleLabel.setText("Evaluation: " + evaluation.getTitle());
        descriptionLabel.setText(evaluation.getDescription());
        langLabel.setText(evaluation.getLanguage() != null ? evaluation.getLanguage().toUpperCase() : "JAVA");

        // Initialize editor with existing code or default template
        String initialCode = evaluation.getCodeContent();
        if (initialCode == null || initialCode.isEmpty()) {
            initialCode = "// Write your solution here...\n\npublic class Solution {\n    public static void main(String[] args) {\n        \n    }\n}";
        }
        if (codeEditor != null) {
            codeEditor.setText(initialCode);
        }
    }

    @FXML
    private void handleBack() {
        parentController.closeEditor();
    }

    @FXML
    private void handleSubmit() {
        if (codeEditor == null) {
            showAlert(Alert.AlertType.ERROR, "Error", "Code editor is not available.");
            return;
        }
        String code = codeEditor.getText();
        evaluation.setCodeContent(code);
        evaluation.setStatus("submitted");
        
        try {
            service.update(evaluation);
            showAlert(Alert.AlertType.INFORMATION, "Success", "Your solution has been submitted successfully!");
            parentController.closeEditor();
            parentController.refreshTable();
        } catch (SQLException e) {
            showAlert(Alert.AlertType.ERROR, "Database Error", "Failed to submit solution: " + e.getMessage());
        }
    }

    private void showAlert(Alert.AlertType type, String title, String content) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setContentText(content);
        alert.showAndWait();
    }
}
