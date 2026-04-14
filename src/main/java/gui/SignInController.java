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

        // Validate inputs
        if (email.isEmpty() || password.isEmpty()) {
            showAlert("Error", "Please fill in all fields", Alert.AlertType.ERROR);
            return;
        }

        // Try to login
        User loggedInUser = userService.login(email, password);

        if (loggedInUser != null) {
            showAlert("Success", "Welcome " + loggedInUser.getFirstName() + "!", Alert.AlertType.INFORMATION);

            // Redirect based on role
            try {
                Parent root;
                String role = loggedInUser.getRole().toUpperCase();
                
                if (loggedInUser.isAdmin()) {
                    // Admin goes to the full CRUD page
                    FXMLLoader loader = new FXMLLoader(getClass().getResource("/AfficherPersonne.fxml"));
                    root = loader.load();
                    AfficherPersonne controller = loader.getController();
                    controller.setLoggedInUser(loggedInUser);
                } else if ("TEACHER".equals(role)) {
                    // Teachers go to the evaluation management page
                    FXMLLoader loader = new FXMLLoader(getClass().getResource("/EvaluationManagement.fxml"));
                    root = loader.load();
                    EvaluationManagementController controller = loader.getController();
                    controller.setLoggedInUser(loggedInUser);
                } else if ("STUDENT".equals(role)) {
                    // Students go to their competence view
                    FXMLLoader loader = new FXMLLoader(getClass().getResource("/AfficherCompetences.fxml"));
                    root = loader.load();
                    AfficherCompetencesController controller = loader.getController();
                    controller.setLoggedInUser(loggedInUser);
                } else {
                    // Fallback for other users
                    FXMLLoader loader = new FXMLLoader(getClass().getResource("/UserBasicPage.fxml"));
                    root = loader.load();
                    UserBasicPageController controller = loader.getController();
                    controller.setLoggedInUser(loggedInUser);
                }

                Stage stage = (Stage) emailField.getScene().getWindow();
                stage.setScene(new Scene(root));
                stage.setTitle("EduConnect - " + role + " Portal");
                stage.show();

            } catch (Exception e) {
                e.printStackTrace();
                showAlert("Error", "Could not load page: " + e.getMessage(), Alert.AlertType.ERROR);
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