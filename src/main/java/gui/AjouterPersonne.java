package gui;

import entities.User;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.TextField;
import javafx.scene.control.PasswordField;
import javafx.scene.layout.VBox;
import services.UserService;

import java.io.IOException;

public class AjouterPersonne {

    private final UserService userService = new UserService();
    private boolean isProcessing = false;
    private boolean isDarkMode = false;

    @FXML
    private VBox mainContainer;
    @FXML
    private TextField TFAge;
    @FXML
    private TextField TFNom;
    @FXML
    private TextField TFPrenom;
    @FXML
    private TextField TFEmail;
    @FXML
    private PasswordField TFPassword;

    @FXML
    void toggleTheme() {
        Button themeButton = (Button) mainContainer.lookup(".theme-toggle-btn");

        if (isDarkMode) {
            mainContainer.getStyleClass().remove("dark-mode");
            mainContainer.getStyleClass().add("light-theme");
            if (themeButton != null) {
                themeButton.setText("🌙 Dark Mode");
            }
            isDarkMode = false;
        } else {
            mainContainer.getStyleClass().remove("light-theme");
            mainContainer.getStyleClass().add("dark-mode");
            if (themeButton != null) {
                themeButton.setText("☀️ Light Mode");
            }
            isDarkMode = true;
        }
    }

    @FXML
    void ajouter(ActionEvent event) {
        if (isProcessing) {
            return;
        }

        if (TFAge.getText().isEmpty() || TFNom.getText().isEmpty() ||
                TFPrenom.getText().isEmpty() || TFEmail.getText().isEmpty() ||
                TFPassword.getText().isEmpty()) {
            showAlert("Error", "Please fill in all fields", Alert.AlertType.ERROR);
            return;
        }

        try {
            isProcessing = true;

            int age = Integer.parseInt(TFAge.getText());
            String nom = TFNom.getText();
            String prenom = TFPrenom.getText();
            String email = TFEmail.getText();
            String password = TFPassword.getText();

            // Validate age
            if (age < 1 || age > 120) {
                showAlert("Error", "Please enter a valid age (1-120)", Alert.AlertType.ERROR);
                return;
            }

            // Validate email
            if (!email.contains("@") || !email.contains(".")) {
                showAlert("Error", "Invalid email format", Alert.AlertType.ERROR);
                return;
            }

            // Validate password length
            if (password.length() < 4) {
                showAlert("Error", "Password must be at least 4 characters", Alert.AlertType.ERROR);
                return;
            }

            // Check if email already exists
            if (userService.emailExists(email)) {
                showAlert("Error", "This email already exists", Alert.AlertType.ERROR);
                return;
            }

            User newUser = new User(nom, prenom, age, email, password, "USER");
            boolean success = userService.register(newUser);

            if (success) {
                // Clear form
                TFAge.clear();
                TFNom.clear();
                TFPrenom.clear();
                TFEmail.clear();
                TFPassword.clear();

                showAlert("Success", "User added successfully!", Alert.AlertType.INFORMATION);
                
                // Navigate back to user management
                afficher(null);
            } else {
                showAlert("Error", "Failed to add user", Alert.AlertType.ERROR);
            }

        } catch (NumberFormatException e) {
            showAlert("Error", "Age must be a valid number", Alert.AlertType.ERROR);
        } catch (Exception e) {
            showAlert("Error", e.getMessage(), Alert.AlertType.ERROR);
        } finally {
            isProcessing = false;
        }
    }

    @FXML
    void afficher(ActionEvent event) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/AfficherPersonne.fxml"));
            Parent root = loader.load();
            
            // Replace the current content
            mainContainer.getChildren().setAll(root);
            
        } catch (IOException e) {
            System.out.println(e.getMessage());
            showAlert("Error", "Failed to load user management: " + e.getMessage(), Alert.AlertType.ERROR);
        }
    }

    private void showAlert(String title, String message, Alert.AlertType type) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setContentText(message);
        alert.showAndWait();
    }
}
