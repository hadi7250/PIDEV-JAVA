package gui;

import entities.Competence;
import javafx.collections.FXCollections;
import javafx.fxml.FXML;
import javafx.scene.control.*;
import services.CompetenceService;

import java.sql.SQLException;
import java.util.Arrays;

public class AjouterCompetenceController {
    @FXML private TextField nameField;
    @FXML private TextArea descriptionArea;
    @FXML private ComboBox<String> categoryComboBox;
    @FXML private Slider levelSlider;
    @FXML private Label fileNameLabel;
    private User loggedInUser;
    private String certificatePath;

    public void setLoggedInUser(User user) {
        this.loggedInUser = user;
    }

    private CompetenceService competenceService = new CompetenceService();

    
    @FXML
    private void handleUpload() {
        javafx.stage.FileChooser fileChooser = new javafx.stage.FileChooser();
        fileChooser.setTitle("Select Certificate PDF");
        fileChooser.getExtensionFilters().addAll(
                new javafx.stage.FileChooser.ExtensionFilter("PDF Files", "*.pdf")
        );
        java.io.File selectedFile = fileChooser.showOpenDialog(nameField.getScene().getWindow());
        if (selectedFile != null) {
            certificatePath = selectedFile.getAbsolutePath();
            fileNameLabel.setText(selectedFile.getName());
        }
    }

    @FXML
    public void initialize() {
        categoryComboBox.setItems(FXCollections.observableArrayList("technique", "comportementale", "langue", "autre"));
        categoryComboBox.setValue("technique");
    }

    @FXML
    private void handleAdd() {
        String name = nameField.getText();
        String description = descriptionArea.getText();
        String category = categoryComboBox.getValue();
        int maxLevel = (int) levelSlider.getValue();

        if (name.isEmpty()) {
            showAlert(Alert.AlertType.ERROR, "Form Error!", "Please enter a name.");
            return;
        }

        Competence competence = new Competence(name, description, category, maxLevel);
        try {
            competenceService.create(competence);
            showAlert(Alert.AlertType.INFORMATION, "Success!", "Competence added successfully!");
            clearForm();
        } catch (SQLException e) {
            showAlert(Alert.AlertType.ERROR, "Database Error!", e.getMessage());
        }
    }

    @FXML
    private void handleCancel() {
        clearForm();
    }

    private void clearForm() {
        nameField.clear();
        descriptionArea.clear();
        categoryComboBox.setValue("technique");
        levelSlider.setValue(5);
    }

    private void showAlert(Alert.AlertType alertType, String title, String message) {
        Alert alert = new Alert(alertType);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }
}