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

    @FXML private TextField     firstNameField;
    @FXML private TextField     lastNameField;
    @FXML private TextField     ageField;
    @FXML private TextField     emailField;
    @FXML private PasswordField passwordField;
    @FXML private PasswordField confirmPasswordField;

    @FXML private Label firstNameErrorLabel;
    @FXML private Label lastNameErrorLabel;
    @FXML private Label ageErrorLabel;
    @FXML private Label emailErrorLabel;
    @FXML private Label passwordErrorLabel;
    @FXML private Label confirmPasswordErrorLabel;

    @FXML private CheckBox termsCheckbox;

    private final UserService userService = new UserService();

    private boolean isValidFirstName       = false;
    private boolean isValidLastName        = false;
    private boolean isValidAge             = false;
    private boolean isValidEmail           = false;
    private boolean isValidPassword        = false;
    private boolean isValidConfirmPassword = false;

    @FXML
    public void initialize() {
        firstNameField.textProperty()      .addListener((o, v, n) -> validateFirstName());
        lastNameField.textProperty()       .addListener((o, v, n) -> validateLastName());
        ageField.textProperty()            .addListener((o, v, n) -> validateAge());
        emailField.textProperty()          .addListener((o, v, n) -> validateEmail());
        passwordField.textProperty()       .addListener((o, v, n) -> validatePassword());
        confirmPasswordField.textProperty().addListener((o, v, n) -> validateConfirmPassword());
    }

    private boolean isValidName(String s) {
        return s != null && !s.isEmpty() && s.matches("^[a-zA-ZÀ-ÖØ-öø-ÿ\\s-]+$");
    }

    private boolean isValidEmailFormat(String s) {
        return s != null && s.contains("@") && s.contains(".");
    }

    private void validateFirstName() {
        String v = firstNameField.getText().trim();
        if (v.isEmpty()) {
            err(firstNameErrorLabel, firstNameField, "Le prénom est requis");
            isValidFirstName = false;
        } else if (!isValidName(v)) {
            err(firstNameErrorLabel, firstNameField, "Lettres uniquement");
            isValidFirstName = false;
        } else { ok(firstNameErrorLabel, firstNameField); isValidFirstName = true; }
    }

    private void validateLastName() {
        String v = lastNameField.getText().trim();
        if (v.isEmpty()) {
            err(lastNameErrorLabel, lastNameField, "Le nom est requis");
            isValidLastName = false;
        } else if (!isValidName(v)) {
            err(lastNameErrorLabel, lastNameField, "Lettres uniquement");
            isValidLastName = false;
        } else { ok(lastNameErrorLabel, lastNameField); isValidLastName = true; }
    }

    private void validateAge() {
        String v = ageField.getText().trim();
        if (v.isEmpty()) { err(ageErrorLabel, ageField, "L'âge est requis"); isValidAge = false; return; }
        try {
            int age = Integer.parseInt(v);
            if (age < 1 || age > 120) { err(ageErrorLabel, ageField, "Entre 1 et 120"); isValidAge = false; }
            else { ok(ageErrorLabel, ageField); isValidAge = true; }
        } catch (NumberFormatException e) { err(ageErrorLabel, ageField, "Nombre invalide"); isValidAge = false; }
    }

    private void validateEmail() {
        String v = emailField.getText().trim();
        if (v.isEmpty()) { err(emailErrorLabel, emailField, "L'email est requis"); isValidEmail = false; }
        else if (!isValidEmailFormat(v)) { err(emailErrorLabel, emailField, "Email invalide"); isValidEmail = false; }
        else {
            if (userService.emailExists(v)) { err(emailErrorLabel, emailField, "Email déjà utilisé"); isValidEmail = false; }
            else { ok(emailErrorLabel, emailField); isValidEmail = true; }
        }


    }

    private void validatePassword() {
        String v = passwordField.getText();
        if (v.isEmpty()) { err(passwordErrorLabel, passwordField, "Mot de passe requis"); isValidPassword = false; }
        else if (v.length() < 4) { err(passwordErrorLabel, passwordField, "Au moins 4 caractères"); isValidPassword = false; }
        else { ok(passwordErrorLabel, passwordField); isValidPassword = true; }
        validateConfirmPassword();
    }

    private void validateConfirmPassword() {
        String v = confirmPasswordField.getText();
        if (v.isEmpty()) { err(confirmPasswordErrorLabel, confirmPasswordField, "Confirmez le mot de passe"); isValidConfirmPassword = false; }
        else if (!passwordField.getText().equals(v)) { err(confirmPasswordErrorLabel, confirmPasswordField, "Mots de passe différents"); isValidConfirmPassword = false; }
        else { ok(confirmPasswordErrorLabel, confirmPasswordField); isValidConfirmPassword = true; }
    }

    private void err(Label l, Control f, String msg) {
        l.setText(msg); l.setVisible(true);
        f.setStyle("-fx-border-color: #dc3545; -fx-border-width: 1.5;");
    }

    private void ok(Label l, Control f) {
        l.setText(""); l.setVisible(false);
        f.setStyle("-fx-border-color: #28a745; -fx-border-width: 1.5;");
    }

    private boolean isFormValid() {
        validateFirstName(); validateLastName(); validateAge();
        validateEmail(); validatePassword(); validateConfirmPassword();
        return isValidFirstName && isValidLastName && isValidAge
                && isValidEmail && isValidPassword && isValidConfirmPassword;
    }

    @FXML
    void handleSignUp() {
        if (!termsCheckbox.isSelected()) {
            alert("Erreur", "Acceptez les conditions d'utilisation", Alert.AlertType.ERROR);
            return;
        }
        if (!isFormValid()) {
            alert("Erreur", "Corrigez les erreurs dans le formulaire", Alert.AlertType.ERROR);
            return;
        }

        // ── Création du User (username/roles/status calculés automatiquement) ──
        User newUser = new User(
                firstNameField.getText().trim(),
                lastNameField.getText().trim(),
                Integer.parseInt(ageField.getText().trim()),
                emailField.getText().trim(),
                passwordField.getText(),
                "USER"
        );

        if (userService.register(newUser)) {
            alert("Succès", "Compte créé! Veuillez vous connecter.", Alert.AlertType.INFORMATION);
            goToSignIn();
        } else {
            alert("Erreur", "L'inscription a échoué. Réessayez.", Alert.AlertType.ERROR);
        }


    }

    @FXML
    void goToSignIn() {
        try {
            Parent root = FXMLLoader.load(getClass().getResource("/fxml/SignIn.fxml"));
            Stage stage = (Stage) firstNameField.getScene().getWindow();
            stage.setScene(new Scene(root));
            stage.setTitle("Connexion");
            stage.centerOnScreen();
            stage.show();
        } catch (Exception e) { e.printStackTrace(); }
    }

    @FXML void googleSignUp()   { alert("Info", "Google — bientôt disponible",   Alert.AlertType.INFORMATION); }
    @FXML void facebookSignUp() { alert("Info", "Facebook — bientôt disponible", Alert.AlertType.INFORMATION); }
    @FXML void linkedinSignUp() { alert("Info", "LinkedIn — bientôt disponible", Alert.AlertType.INFORMATION); }

    @FXML
    void showTerms() {
        Alert a = new Alert(Alert.AlertType.INFORMATION);
        a.setTitle("Conditions d'utilisation");
        a.setHeaderText("Terms & Conditions");
        a.setContentText("""
                1. Utilisez l'application conformément aux lois applicables.
                2. Vous êtes responsable de votre compte.
                3. Données protégées conformément au RGPD.
                """);
        a.showAndWait();
    }

    private void alert(String title, String msg, Alert.AlertType type) {
        Alert a = new Alert(type);
        a.setTitle(title);
        a.setContentText(msg);
        a.showAndWait();
    }
}