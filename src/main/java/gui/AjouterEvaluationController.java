package gui;

import entities.Competence;
import entities.Evaluation;
import entities.User;
import javafx.collections.FXCollections;
import javafx.fxml.FXML;
import javafx.scene.control.*;
import javafx.scene.layout.VBox;
import services.CompetenceService;
import services.EvaluationService;

import java.sql.SQLException;
import java.util.List;

public class AjouterEvaluationController {
    @FXML private VBox mainContainer;
    private boolean isDarkMode = false;
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
        String title = titleField.getText();
        String description = descriptionArea.getText();
        String type = typeComboBox.getValue();
        java.time.LocalDate date = datePicker.getValue();
        String scoreStr = weightField.getText();
        Competence selectedCompetence = competenceComboBox.getValue();

        if (title.isEmpty() || date == null || scoreStr.isEmpty() || selectedCompetence == null) {
            showAlert(Alert.AlertType.ERROR, "Form Error!", "Please fill in all required fields.");
            return;
        }

        try {
            Float score = Float.parseFloat(scoreStr);
            Evaluation evaluation = new Evaluation(title, description, type, date.atStartOfDay(), score, "pending", "", selectedCompetence);
            evaluationService.create(evaluation);
            showAlert(Alert.AlertType.INFORMATION, "Success!", "Evaluation created successfully!");
            clearForm();
        } catch (NumberFormatException e) {
            showAlert(Alert.AlertType.ERROR, "Form Error!", "Weight must be a valid number.");
        } catch (SQLException e) {
            showAlert(Alert.AlertType.ERROR, "Database Error!", e.getMessage());
        }
    }

    private void showAlert(Alert.AlertType alertType, String title, String message) {
        Alert alert = new Alert(alertType);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
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

    @FXML
    private void toggleTheme() {
        Button themeButton = (Button) mainContainer.lookup(".theme-toggle-btn");
        if (isDarkMode) {
            mainContainer.getStyleClass().remove("dark-theme");
            mainContainer.getStyleClass().add("light-theme");
            if (themeButton != null) themeButton.setText("ðŸŒ™ Dark Mode");
            isDarkMode = false;
        } else {
            mainContainer.getStyleClass().remove("light-theme");
            mainContainer.getStyleClass().add("dark-theme");
            if (themeButton != null) themeButton.setText("â˜€ï¸ Light Mode");
            isDarkMode = true;
        }
    }
}