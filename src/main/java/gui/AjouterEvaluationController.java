package gui;

import entities.Competence;
import entities.Evaluation;
import entities.User;
import javafx.collections.FXCollections;
import javafx.fxml.FXML;
import javafx.scene.control.*;
import services.CompetenceService;
import services.EvaluationService;

import java.sql.SQLException;
import java.time.LocalDateTime;
import java.util.List;

public class AjouterEvaluationController {
    @FXML private TextField titleField;
    @FXML private TextArea descriptionArea;
    @FXML private ComboBox<String> typeComboBox;
    @FXML private DatePicker datePicker;
    @FXML private TextField weightField;
    @FXML private ComboBox<Competence> competenceComboBox;

    private EvaluationService evaluationService = new EvaluationService();
    private CompetenceService competenceService = new CompetenceService();
    private User loggedInUser;

    public void setLoggedInUser(User user) {
        this.loggedInUser = user;
    }

    @FXML
    public void initialize() {
        typeComboBox.setItems(FXCollections.observableArrayList("exam", "quiz", "project", "oral", "homework"));
        typeComboBox.setValue("exam");

        try {
            List<Competence> competences = competenceService.readAll();
            competenceComboBox.setItems(FXCollections.observableArrayList(competences));
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    @FXML
    private void handleCreate() {
        // Implement creation logic here
    }

    @FXML
    private void handleCancel() {
        clearForm();
    }

    private void clearForm() {
        titleField.clear();
        descriptionArea.clear();
        typeComboBox.setValue("exam");
        datePicker.setValue(null);
        weightField.clear();
        competenceComboBox.setValue(null);
    }
}