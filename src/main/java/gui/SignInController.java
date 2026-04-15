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

        if (email.isEmpty() || password.isEmpty()) {
            showAlert("Error", "Please fill in all fields", Alert.AlertType.ERROR);
            return;
        }

        User loggedInUser = userService.login(email, password);

        if (loggedInUser != null) {
            try {
                // Load the Shell Layout (Template)
                FXMLLoader loader = new FXMLLoader(getClass().getResource("/EduConnectLayout.fxml"));
                Parent root = loader.load();
                
                // Get the shell controller and pass the user
                EduConnectController shellController = loader.getController();
                shellController.initUser(loggedInUser);

                Stage stage = (Stage) emailField.getScene().getWindow();
                stage.setScene(new Scene(root));
                stage.setTitle("EduConnect - Main Dashboard");
                stage.show();

            } catch (Exception e) {
                e.printStackTrace();
                showAlert("Error", "Could not load dashboard: " + e.getMessage(), Alert.AlertType.ERROR);
            }
        } else {
            showAlert("Login Failed", "Invalid email or password", Alert.AlertType.ERROR);
        }
    }

    @FXML
    void goToSignUp() {
        try {
            Parent root = FXMLLoader.load(getClass().getResource("/SignUp.fxml"));
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
