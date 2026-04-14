package gui;

import entities.Competence;
import entities.User;
import javafx.collections.FXCollections;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.layout.VBox;
import javafx.stage.Stage;
import services.CompetenceService;

import java.sql.SQLException;

public class AjouterCompetenceController {
    @FXML private VBox mainContainer;
    private boolean isDarkMode = false;
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
        String title = nameField.getText();
        String description = descriptionArea.getText();
        String category = categoryComboBox.getValue();
        int maxLevel = (int) levelSlider.getValue();

        if (title.isEmpty()) {
            showAlert(Alert.AlertType.ERROR, "Form Error!", "Please enter a name.");
            return;
        }

        if (loggedInUser == null) {
            showAlert(Alert.AlertType.ERROR, "Auth Error!", "No logged in user found.");
            return;
        }

        Competence competence = new Competence(loggedInUser.getId(), title, description, category, maxLevel, certificatePath);
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
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/AfficherCompetences.fxml"));
            javafx.scene.Parent root = loader.load();
            AfficherCompetencesController controller = loader.getController();
            controller.setLoggedInUser(loggedInUser);
            javafx.stage.Stage stage = (javafx.stage.Stage) mainContainer.getScene().getWindow();
            stage.setScene(new Scene(root));
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private void clearForm() {
        nameField.clear();
        descriptionArea.clear();
        categoryComboBox.setValue("technique");
        levelSlider.setValue(5);
        fileNameLabel.setText("No file selected");
        certificatePath = null;
    }

    private void showAlert(Alert.AlertType alertType, String title, String message) {
        Alert alert = new Alert(alertType);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
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
}