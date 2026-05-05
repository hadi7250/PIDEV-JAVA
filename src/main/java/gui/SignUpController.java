package gui;

import entities.User;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.stage.Stage;
import services.UserService;

public class SignUpController {

    // Form Fields
    @FXML
    private TextField firstNameField;
    @FXML
    private TextField lastNameField;
    @FXML
    private TextField ageField;
    @FXML
    private TextField emailField;
    @FXML
    private PasswordField passwordField;
    @FXML
    private PasswordField confirmPasswordField;

    // Error Labels
    @FXML
    private Label firstNameErrorLabel;
    @FXML
    private Label lastNameErrorLabel;
    @FXML
    private Label ageErrorLabel;
    @FXML
    private Label emailErrorLabel;
    @FXML
    private Label passwordErrorLabel;
    @FXML
    private Label confirmPasswordErrorLabel;

    // Terms Checkbox
    @FXML
    private CheckBox termsCheckbox;

    private UserService userService = new UserService();

    // Validation flags
    private boolean isValidFirstName = false;
    private boolean isValidLastName = false;
    private boolean isValidAge = false;
    private boolean isValidEmail = false;
    private boolean isValidPassword = false;
    private boolean isValidConfirmPassword = false;

    // ==================== INITIALIZATION ====================

    @FXML
    public void initialize() {
        // Add real-time validation listeners
        firstNameField.textProperty().addListener((obs, old, newVal) -> validateFirstName());
        lastNameField.textProperty().addListener((obs, old, newVal) -> validateLastName());
        ageField.textProperty().addListener((obs, old, newVal) -> validateAge());
        emailField.textProperty().addListener((obs, old, newVal) -> validateEmail());
        passwordField.textProperty().addListener((obs, old, newVal) -> validatePassword());
        confirmPasswordField.textProperty().addListener((obs, old, newVal) -> validateConfirmPassword());
    }

    // ==================== VALIDATION METHODS ====================

    private boolean isValidName(String name) {
        return name != null && !name.isEmpty() && name.matches("^[a-zA-ZÀ-ÖØ-öø-ÿ\\s-]+$");
    }

    private boolean isValidEmailFormat(String email) {
        return email != null && email.contains("@") && email.contains(".");
    }

    private void validateFirstName() {
        String firstName = firstNameField.getText().trim();
        if (firstName.isEmpty()) {
            firstNameErrorLabel.setText("Le prénom est requis");
            firstNameErrorLabel.setVisible(true);
            isValidFirstName = false;
        } else if (!isValidName(firstName)) {
            firstNameErrorLabel.setText("Le prénom ne doit contenir que des lettres");
            firstNameErrorLabel.setVisible(true);
            isValidFirstName = false;
        } else {
            firstNameErrorLabel.setText("");
            firstNameErrorLabel.setVisible(false);
            isValidFirstName = true;
        }
        updateFieldStyle(firstNameField, isValidFirstName);
    }

    private void validateLastName() {
        String lastName = lastNameField.getText().trim();
        if (lastName.isEmpty()) {
            lastNameErrorLabel.setText("Le nom est requis");
            lastNameErrorLabel.setVisible(true);
            isValidLastName = false;
        } else if (!isValidName(lastName)) {
            lastNameErrorLabel.setText("Le nom ne doit contenir que des lettres");
            lastNameErrorLabel.setVisible(true);
            isValidLastName = false;
        } else {
            lastNameErrorLabel.setText("");
            lastNameErrorLabel.setVisible(false);
            isValidLastName = true;
        }
        updateFieldStyle(lastNameField, isValidLastName);
    }

    private void validateAge() {
        String ageText = ageField.getText().trim();
        if (ageText.isEmpty()) {
            ageErrorLabel.setText("L'âge est requis");
            ageErrorLabel.setVisible(true);
            isValidAge = false;
        } else {
            try {
                int age = Integer.parseInt(ageText);
                if (age < 1 || age > 120) {
                    ageErrorLabel.setText("L'âge doit être entre 1 et 120");
                    ageErrorLabel.setVisible(true);
                    isValidAge = false;
                } else {
                    ageErrorLabel.setText("");
                    ageErrorLabel.setVisible(false);
                    isValidAge = true;
                }
            } catch (NumberFormatException e) {
                ageErrorLabel.setText("L'âge doit être un nombre");
                ageErrorLabel.setVisible(true);
                isValidAge = false;
            }
        }
        updateFieldStyle(ageField, isValidAge);
    }

    private void validateEmail() {
        String email = emailField.getText().trim();
        if (email.isEmpty()) {
            emailErrorLabel.setText("L'email est requis");
            emailErrorLabel.setVisible(true);
            isValidEmail = false;
        } else if (!isValidEmailFormat(email)) {
            emailErrorLabel.setText("Email invalide (ex: nom@domaine.com)");
            emailErrorLabel.setVisible(true);
            isValidEmail = false;
        } else if (userService.emailExists(email)) {
            emailErrorLabel.setText("Cet email existe déjà");
            emailErrorLabel.setVisible(true);
            isValidEmail = false;
        } else {
            emailErrorLabel.setText("");
            emailErrorLabel.setVisible(false);
            isValidEmail = true;
        }
        updateFieldStyle(emailField, isValidEmail);
    }

    private void validatePassword() {
        String password = passwordField.getText();
        if (password.isEmpty()) {
            passwordErrorLabel.setText("Le mot de passe est requis");
            passwordErrorLabel.setVisible(true);
            isValidPassword = false;
        } else if (password.length() < 4) {
            passwordErrorLabel.setText("Au moins 4 caractères");
            passwordErrorLabel.setVisible(true);
            isValidPassword = false;
        } else {
            passwordErrorLabel.setText("");
            passwordErrorLabel.setVisible(false);
            isValidPassword = true;
        }
        updateFieldStyle(passwordField, isValidPassword);
        validateConfirmPassword(); // Re-validate confirm password when password changes
    }

    private void validateConfirmPassword() {
        String password = passwordField.getText();
        String confirmPassword = confirmPasswordField.getText();

        if (confirmPassword.isEmpty()) {
            confirmPasswordErrorLabel.setText("Veuillez confirmer le mot de passe");
            confirmPasswordErrorLabel.setVisible(true);
            isValidConfirmPassword = false;
        } else if (!password.equals(confirmPassword)) {
            confirmPasswordErrorLabel.setText("Les mots de passe ne correspondent pas");
            confirmPasswordErrorLabel.setVisible(true);
            isValidConfirmPassword = false;
        } else {
            confirmPasswordErrorLabel.setText("");
            confirmPasswordErrorLabel.setVisible(false);
            isValidConfirmPassword = true;
        }
        updateFieldStyle(confirmPasswordField, isValidConfirmPassword);
    }

    private void updateFieldStyle(Control field, boolean isValid) {
        if (isValid) {
            field.setStyle("-fx-border-color: #28a745; -fx-border-width: 1.5;");
        } else {
            field.setStyle("-fx-border-color: #dc3545; -fx-border-width: 1.5;");
        }
    }

    private boolean isFormValid() {
        validateFirstName();
        validateLastName();
        validateAge();
        validateEmail();
        validatePassword();
        validateConfirmPassword();

        return isValidFirstName && isValidLastName && isValidAge &&
                isValidEmail && isValidPassword && isValidConfirmPassword;
    }

    // ==================== FORM ACTIONS ====================

    @FXML
    void handleSignUp() {
        // Check terms & conditions
        if (!termsCheckbox.isSelected()) {
            showAlert("Erreur", "Vous devez accepter les conditions d'utilisation", Alert.AlertType.ERROR);
            return;
        }

        if (!isFormValid()) {
            showAlert("Erreur", "Veuillez corriger les erreurs dans le formulaire", Alert.AlertType.ERROR);
            return;
        }

        String firstName = firstNameField.getText().trim();
        String lastName = lastNameField.getText().trim();
        int age = Integer.parseInt(ageField.getText().trim());
        String email = emailField.getText().trim();
        String password = passwordField.getText();

        User newUser = new User(firstName, lastName, age, email, password, "USER");
        boolean success = userService.register(newUser);

        if (success) {
            showAlert("Succès", "Compte créé avec succès! Veuillez vous connecter.", Alert.AlertType.INFORMATION);
            goToSignIn();
        } else {
            showAlert("Erreur", "L'inscription a échoué. Veuillez réessayer.", Alert.AlertType.ERROR);
        }
    }

    @FXML
    void goToSignIn() {
        try {
            Parent root = FXMLLoader.load(getClass().getResource("/fxml/SignIn.fxml"));
            Stage stage = (Stage) firstNameField.getScene().getWindow();

            Scene scene = new Scene(root);
            stage.setScene(scene);
            stage.setTitle("Connexion");
            stage.centerOnScreen();
            stage.show();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    // ==================== SOCIAL LOGIN METHODS ====================

    @FXML
    void googleSignUp() {
        showAlert("Information", "Inscription avec Google bientôt disponible!", Alert.AlertType.INFORMATION);
    }

    @FXML
    void facebookSignUp() {
        showAlert("Information", "Inscription avec Facebook bientôt disponible!", Alert.AlertType.INFORMATION);
    }

    @FXML
    void linkedinSignUp() {
        showAlert("Information", "Inscription avec LinkedIn bientôt disponible!", Alert.AlertType.INFORMATION);
    }

    @FXML
    void showTerms() {
        Alert alert = new Alert(Alert.AlertType.INFORMATION);
        alert.setTitle("Conditions d'utilisation");
        alert.setHeaderText("Terms & Conditions");
        alert.setContentText("""
            Conditions d'utilisation de l'application:
            
            1. Vous acceptez d'utiliser cette application conformément aux lois applicables.
            2. Vous êtes responsable de la sécurité de votre compte.
            3. Nous nous réservons le droit de modifier ces conditions à tout moment.
            4. Vos données personnelles sont protégées conformément au RGPD.
            
            En vous inscrivant, vous acceptez ces conditions.
            """);
        alert.showAndWait();
    }

    // ==================== HELPER METHODS ====================

    private void showAlert(String title, String message, Alert.AlertType type) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setContentText(message);
        alert.showAndWait();
    }
}