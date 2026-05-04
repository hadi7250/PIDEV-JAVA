package gui;

import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Alert;
import javafx.scene.control.Label;
import javafx.scene.control.PasswordField;
import javafx.scene.control.TextField;
import javafx.scene.layout.VBox;
import javafx.stage.Stage;
import services.EmailService;
import services.UserService;

public class ForgotPasswordController {

    @FXML
    private TextField emailField;
    @FXML
    private Label emailErrorLabel;

    @FXML
    private VBox codeSection;
    @FXML
    private TextField codeField;
    @FXML
    private Label codeErrorLabel;

    @FXML
    private VBox passwordSection;
    @FXML
    private PasswordField newPasswordField;
    @FXML
    private PasswordField confirmPasswordField;
    @FXML
    private Label passwordErrorLabel;
    @FXML
    private Label confirmErrorLabel;

    private UserService userService = new UserService();
    private EmailService emailService = new EmailService();
    private String currentEmail;
    private String currentCode;

    @FXML
    void sendCode() {
        String email = emailField.getText().trim();

        // Validation email
        if (email.isEmpty()) {
            emailErrorLabel.setText("L'email est requis");
            return;
        }
        if (!email.contains("@") || !email.contains(".")) {
            emailErrorLabel.setText("Email invalide");
            return;
        }

        // Vérifier si l'email existe
        if (!userService.emailExists(email)) {
            emailErrorLabel.setText("Aucun compte associé à cet email");
            return;
        }

        // Générer et envoyer le code
        currentEmail = email;
        currentCode = emailService.generateCode();

        boolean sent = emailService.sendResetCode(email, currentCode);

        if (sent) {
            // Sauvegarder le code dans la base de données
            userService.saveResetCode(email, currentCode);

            emailErrorLabel.setText("");
            showAlert("Succès", "Un code de réinitialisation a été envoyé à votre email.", Alert.AlertType.INFORMATION);

            // Afficher la section code
            codeSection.setVisible(true);
            codeSection.setManaged(true);
        } else {
            showAlert("Erreur", "Impossible d'envoyer l'email. Vérifiez votre configuration.", Alert.AlertType.ERROR);
        }
    }

    @FXML
    void verifyCode() {
        String code = codeField.getText().trim();

        if (code.isEmpty()) {
            codeErrorLabel.setText("Veuillez entrer le code reçu");
            return;
        }

        // Vérifier le code
        if (userService.verifyResetCode(currentEmail, code)) {
            codeErrorLabel.setText("");
            showAlert("Succès", "Code vérifié! Vous pouvez maintenant changer votre mot de passe.", Alert.AlertType.INFORMATION);

            // Afficher la section nouveau mot de passe
            passwordSection.setVisible(true);
            passwordSection.setManaged(true);
        } else {
            codeErrorLabel.setText("Code invalide ou expiré");
        }
    }

    @FXML
    void resetPassword() {
        String newPassword = newPasswordField.getText();
        String confirmPassword = confirmPasswordField.getText();

        // Validation
        if (newPassword.isEmpty()) {
            passwordErrorLabel.setText("Le mot de passe est requis");
            return;
        }
        if (newPassword.length() < 4) {
            passwordErrorLabel.setText("Le mot de passe doit contenir au moins 4 caractères");
            return;
        }
        if (!newPassword.equals(confirmPassword)) {
            confirmErrorLabel.setText("Les mots de passe ne correspondent pas");
            return;
        }

        // Mettre à jour le mot de passe
        boolean updated = userService.updatePasswordWithReset(currentEmail, newPassword);

        if (updated) {
            showAlert("Succès", "Votre mot de passe a été réinitialisé avec succès! Veuillez vous connecter.", Alert.AlertType.INFORMATION);
            goBackToLogin();
        } else {
            showAlert("Erreur", "Une erreur s'est produite. Veuillez réessayer.", Alert.AlertType.ERROR);
        }
    }

    @FXML
    void goBackToLogin() {
        try {
            Parent root = FXMLLoader.load(getClass().getResource("/fxml/SignIn.fxml"));
            Stage stage = (Stage) emailField.getScene().getWindow();
            stage.setScene(new Scene(root));
            stage.setTitle("Connexion");
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