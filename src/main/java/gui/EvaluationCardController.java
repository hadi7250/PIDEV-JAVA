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
        typeLabel.setText(evaluation.getType().toUpperCase());
        statusLabel.setText(evaluation.getStatus().toUpperCase());
        compLabel.setText(evaluation.getCompetence().getTitle());
        dateLabel.setText(evaluation.getDate().format(DateTimeFormatter.ofPattern("MMM dd, yyyy")));
        scoreLabel.setText(evaluation.getScore() + "/100");

        // Style status
        statusLabel.getStyleClass().removeAll("badge-pending", "badge-success", "badge-rejected");
        if (evaluation.getStatus().equalsIgnoreCase("graded")) {
            statusLabel.getStyleClass().add("badge-success");
            takeBtn.setText("View Code");
        } else if (evaluation.getStatus().equalsIgnoreCase("rejected")) {
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
        parentController.openEditor(evaluation);
    }
}
