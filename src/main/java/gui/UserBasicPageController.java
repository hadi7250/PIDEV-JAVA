package gui;

import entities.User;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.PasswordField;
import javafx.scene.control.TextField;
import javafx.scene.layout.StackPane;
import javafx.scene.layout.VBox;
import javafx.stage.Stage;
import services.UserService;

import java.net.URL;
import java.util.ResourceBundle;

public class UserBasicPageController implements Initializable {

    @FXML
    private StackPane mainContainer;

    @FXML
    private TextField firstNameField;

    @FXML
    private TextField lastNameField;

    @FXML
    private TextField ageField;

    @FXML
    private TextField emailField;

    @FXML
    private TextField roleField;

    @FXML
    private PasswordField newPasswordField;

    @FXML
    private PasswordField confirmPasswordField;

    private UserService userService = new UserService();
    private User loggedInUser;
    private boolean isDarkMode = false;

    @Override
    public void initialize(URL location, ResourceBundle resources) {
        // Initialization will happen after user is set
    }

    public void setLoggedInUser(User user) {
        this.loggedInUser = user;
        loadUserData();
    }

    private void loadUserData() {
        if (loggedInUser != null) {
            firstNameField.setText(loggedInUser.getFirstName());
            lastNameField.setText(loggedInUser.getLastName());
            ageField.setText(String.valueOf(loggedInUser.getAge()));
            emailField.setText(loggedInUser.getEmail());
            roleField.setText(loggedInUser.getRole());
        }
    }

    @FXML
    void toggleTheme() {
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
    void updateProfile() {
        // Update basic info
        loggedInUser.setFirstName(firstNameField.getText().trim());
        loggedInUser.setLastName(lastNameField.getText().trim());

        try {
            int age = Integer.parseInt(ageField.getText().trim());
            if (age < 1 || age > 120) {
                showAlert("Error", "Please enter a valid age (1-120)", Alert.AlertType.ERROR);
                return;
            }
            loggedInUser.setAge(age);
        } catch (NumberFormatException e) {
            showAlert("Error", "Age must be a number", Alert.AlertType.ERROR);
            return;
        }

        loggedInUser.setEmail(emailField.getText().trim());

        // Update password if provided
        String newPassword = newPasswordField.getText();
        if (!newPassword.isEmpty()) {
            if (!newPassword.equals(confirmPasswordField.getText())) {
                showAlert("Error", "Passwords do not match", Alert.AlertType.ERROR);
                return;
            }
            if (newPassword.length() < 4) {
                showAlert("Error", "Password must be at least 4 characters", Alert.AlertType.ERROR);
                return;
            }
            loggedInUser.setPassword(newPassword);
        }

        // Save to database
        boolean success = userService.updateProfile(loggedInUser);

        if (success) {
            showAlert("Success", "Profile updated successfully!", Alert.AlertType.INFORMATION);
            newPasswordField.clear();
            confirmPasswordField.clear();
        } else {
            showAlert("Error", "Failed to update profile", Alert.AlertType.ERROR);
        }
    }

    @FXML
    void logout() {
        try {
            Parent root = FXMLLoader.load(getClass().getResource("/fxml/SignIn.fxml"));
            Stage stage = (Stage) firstNameField.getScene().getWindow();
            stage.setScene(new Scene(root));
            stage.setTitle("Sign In");
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private void showAlert(String title, String message, Alert.AlertType type) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setContentText(message);
        alert.showAndWait();
    }
}