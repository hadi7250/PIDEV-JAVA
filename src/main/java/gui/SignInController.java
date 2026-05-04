package gui;

import entities.User;
import javafx.application.Platform;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Alert;
import javafx.scene.control.CheckBox;
import javafx.scene.control.Label;
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
    @FXML
    private Label emailErrorLabel;
    @FXML
    private Label passwordErrorLabel;
    @FXML
    private CheckBox rememberMeCheckbox;

    private UserService userService = new UserService();
    private boolean isValidEmail = false;
    private boolean isValidPassword = false;

    @FXML
    public void initialize() {
        emailField.textProperty().addListener((obs, old, newVal) -> validateEmail());
        passwordField.textProperty().addListener((obs, old, newVal) -> validatePassword());
        loadSavedEmail();
    }

    private void validateEmail() {
        String email = emailField.getText().trim();
        if (email.isEmpty()) {
            emailErrorLabel.setText("Email est requis");
            emailErrorLabel.setVisible(true);
            isValidEmail = false;
        } else if (!email.contains("@") || !email.contains(".")) {
            emailErrorLabel.setText("Email invalide (ex: nom@domaine.com)");
            emailErrorLabel.setVisible(true);
            isValidEmail = false;
        } else {
            emailErrorLabel.setText("");
            emailErrorLabel.setVisible(false);
            isValidEmail = true;
        }
        emailField.setStyle(isValidEmail ? "-fx-border-color: #28a745;" : "-fx-border-color: #dc3545;");
    }

    private void validatePassword() {
        String password = passwordField.getText();
        if (password.isEmpty()) {
            passwordErrorLabel.setText("Mot de passe requis");
            passwordErrorLabel.setVisible(true);
            isValidPassword = false;
        } else {
            passwordErrorLabel.setText("");
            passwordErrorLabel.setVisible(false);
            isValidPassword = true;
        }
        passwordField.setStyle(isValidPassword ? "-fx-border-color: #28a745;" : "-fx-border-color: #dc3545;");
    }

    private boolean isFormValid() {
        validateEmail();
        validatePassword();
        return isValidEmail && isValidPassword;
    }

    private void loadSavedEmail() {
        String savedEmail = java.util.prefs.Preferences.userNodeForPackage(SignInController.class)
                .get("saved_email", "");
        if (!savedEmail.isEmpty()) {
            emailField.setText(savedEmail);
            rememberMeCheckbox.setSelected(true);
        }
    }

    private void saveEmailIfNeeded() {
        if (rememberMeCheckbox.isSelected()) {
            java.util.prefs.Preferences.userNodeForPackage(SignInController.class)
                    .put("saved_email", emailField.getText().trim());
        } else {
            java.util.prefs.Preferences.userNodeForPackage(SignInController.class)
                    .remove("saved_email");
        }
    }

    @FXML
    void handleLogin() {
        if (!isFormValid()) {
            showAlertMessage("Erreur", "Veuillez corriger les erreurs", Alert.AlertType.ERROR);
            return;
        }

        String email = emailField.getText().trim();
        String password = passwordField.getText();

        User loggedInUser = userService.login(email, password);

        if (loggedInUser != null) {
            saveEmailIfNeeded();
            navigateToDashboard(loggedInUser);
        } else {
            showAlertMessage("Erreur", "Email ou mot de passe incorrect", Alert.AlertType.ERROR);
        }
    }

    @FXML
    void googleLogin() {
        GoogleLoginWebView googleLogin = new GoogleLoginWebView(this);
        googleLogin.showLoginWindow();
    }

    @FXML
    void facebookLogin() {
        showAlertMessage("Information", "Connexion Facebook bientôt disponible!", Alert.AlertType.INFORMATION);
    }

    @FXML
    void linkedinLogin() {
        showAlertMessage("Information", "Connexion LinkedIn bientôt disponible!", Alert.AlertType.INFORMATION);
    }

    @FXML
    void forgotPassword() {
        try {
            Parent root = FXMLLoader.load(getClass().getResource("/fxml/ForgotPassword.fxml"));
            Stage stage = (Stage) emailField.getScene().getWindow();
            stage.setScene(new Scene(root));
            stage.setTitle("Mot de passe oublié");
        } catch (Exception e) {
            e.printStackTrace();
            showAlertMessage("Erreur", "Impossible d'ouvrir la page", Alert.AlertType.ERROR);
        }
    }

    // ==================== MÉTHODE POUR GOOGLE LOGIN ====================

    public void completeGoogleLogin(User user) {
        if (user != null) {
            showAlertMessage("Succès", "Bienvenue " + user.getFirstName() + "! Connexion Google réussie.", Alert.AlertType.INFORMATION);
            navigateToDashboard(user);
        } else {
            showAlertMessage("Erreur", "La connexion Google a échoué. Veuillez réessayer.", Alert.AlertType.ERROR);
        }
    }

    // ==================== NAVIGATION ====================

    private void navigateToDashboard(User user) {
        try {
            SessionManager.getInstance().setCurrentUser(user);

            if (user.isAdmin()) {
                // Admin goes to the main EduConnect dashboard
                FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/EduConnectLayout.fxml"));
                Parent root = loader.load();
                Stage stage = (Stage) emailField.getScene().getWindow();
                stage.setScene(new Scene(root));
                stage.setTitle("EduConnect");
                stage.setMaximized(true);
                stage.show();
            } else {
                // Regular user goes to their basic page
                FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/UserBasicPage.fxml"));
                Parent root = loader.load();
                UserBasicPageController controller = loader.getController();
                controller.setLoggedInUser(user);
                Stage stage = (Stage) emailField.getScene().getWindow();
                stage.setScene(new Scene(root));
                stage.setTitle("User Management System");
                stage.setMaximized(true);
                stage.show();
            }

        } catch (Exception e) {
            e.printStackTrace();
            showAlertMessage("Erreur", "Erreur de navigation: " + e.getMessage(), Alert.AlertType.ERROR);
        }
    }

    @FXML
    void goToSignUp() {
        try {
            Parent root = FXMLLoader.load(getClass().getResource("/fxml/SignUp.fxml"));
            Stage stage = (Stage) emailField.getScene().getWindow();
            Scene scene = new Scene(root);
            stage.setScene(scene);
            stage.setTitle("Créer un compte");
            stage.centerOnScreen();
            stage.show();
        } catch (Exception e) {
            e.printStackTrace();
            showAlertMessage("Erreur", "Impossible d'ouvrir la page d'inscription", Alert.AlertType.ERROR);
        }
    }

    // ==================== ALERTES ====================

    public void showAlertMessage(String title, String message, Alert.AlertType type) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setContentText(message);
        alert.showAndWait();
    }
}