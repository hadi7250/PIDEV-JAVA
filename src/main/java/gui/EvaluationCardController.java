package gui;

import entities.Evaluation;
import javafx.fxml.FXML;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.layout.VBox;
import java.time.format.DateTimeFormatter;

public class EvaluationCardController {
    @FXML private VBox cardRoot;
    @FXML private Label typeLabel;
    @FXML private Label statusLabel;
    @FXML private Label titleLabel;
    @FXML private Label compLabel;
    @FXML private Label dateLabel;
    @FXML private Label scoreLabel;
    @FXML private Button takeBtn;

    private Evaluation evaluation;
    private StudentEvaluationsController parentController;

    public void setData(Evaluation evaluation, StudentEvaluationsController parentController) {
        this.evaluation = evaluation;
        this.parentController = parentController;

        titleLabel.setText(evaluation.getTitle());
        typeLabel.setText(evaluation.getType() != null ? evaluation.getType().toUpperCase() : "N/A");
        statusLabel.setText(evaluation.getStatus() != null ? evaluation.getStatus().toUpperCase() : "PENDING");

        if (evaluation.getCompetence() != null) {
            compLabel.setText(evaluation.getCompetence().getTitle());
        } else {
            compLabel.setText("No competence linked");
        }

        dateLabel.setText(evaluation.getDate() != null ?
                evaluation.getDate().format(DateTimeFormatter.ofPattern("MMM dd, yyyy")) : "No date");
        scoreLabel.setText(evaluation.getScore() + "/100");

        // Style status
        statusLabel.getStyleClass().removeAll("badge-pending", "badge-success", "badge-rejected");
        if (evaluation.getStatus() != null && evaluation.getStatus().equalsIgnoreCase("graded")) {
            statusLabel.getStyleClass().add("badge-success");
            takeBtn.setText("View Code");
        } else if (evaluation.getStatus() != null && evaluation.getStatus().equalsIgnoreCase("rejected")) {
            statusLabel.getStyleClass().add("badge-rejected");
        } else {
            statusLabel.getStyleClass().add("badge-pending");
        }
    }

    @FXML
    private void handleCardClick() {
        parentController.showDetails(evaluation);
    }

    @FXML
    private void handleTakeEvaluation() {
        System.out.println("=== DEBUG: handleTakeEvaluation called ===");
        System.out.println("evaluation is null? " + (evaluation == null));
        System.out.println("parentController is null? " + (parentController == null));
        if (evaluation != null) {
            System.out.println("Evaluation title: " + evaluation.getTitle());
        }
        parentController.openEditor(evaluation);
    }
}