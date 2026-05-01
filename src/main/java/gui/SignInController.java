package gui;

import entities.User;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Alert;
import javafx.scene.control.PasswordField;
import javafx.scene.control.TextField;
import javafx.stage.Stage;
import services.UserService;
import utils.SessionManager;

public class SignInController {

    @FXML
    private TextField emailField;

    @FXML
    private PasswordField passwordField;

    private UserService userService = new UserService();

    @FXML
    void handleLogin() {
        String email = emailField.getText().trim();
        String password = passwordField.getText();

        // Validate inputs
        if (email.isEmpty() || password.isEmpty()) {
            showAlert("Error", "Please fill in all fields", Alert.AlertType.ERROR);
            return;
        }

        // Try to login
        User loggedInUser = userService.login(email, password);

        if (loggedInUser != null) {
            showAlert("Success", "Welcome " + loggedInUser.getFirstName() + "!", Alert.AlertType.INFORMATION);

            // Save user to session
            SessionManager.getInstance().setCurrentUser(loggedInUser);

            // Load the main EduConnect layout
            try {
                Parent root = FXMLLoader.load(getClass().getResource("/fxml/EduConnectLayout.fxml"));
                Stage stage = (Stage) emailField.getScene().getWindow();
                stage.setScene(new Scene(root));
                stage.setTitle("EduConnect");
                stage.show();

            } catch (Exception e) {
                e.printStackTrace();
                showAlert("Error", "Could not load main application: " + e.getMessage(), Alert.AlertType.ERROR);
            }
        } else {
            showAlert("Login Failed", "Invalid email or password", Alert.AlertType.ERROR);
        }
    }

    @FXML
    void goToSignUp() {
        try {
            Parent root = FXMLLoader.load(getClass().getResource("/fxml/SignUp.fxml"));
            Stage stage = (Stage) emailField.getScene().getWindow();
            stage.setScene(new Scene(root));
            stage.setTitle("Sign Up");
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
