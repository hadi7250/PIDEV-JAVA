package gui;

import entities.User;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.control.*;
import javafx.scene.layout.VBox;
import services.UserService;

import java.io.IOException;

public class AjouterPersonne {

    private final UserService userService = new UserService();
    private boolean isProcessing = false;
    private boolean isDarkMode   = false;

    @FXML private VBox          mainContainer;
    @FXML private TextField     TFAge;
    @FXML private TextField     TFNom;
    @FXML private TextField     TFPrenom;
    @FXML private TextField     TFEmail;
    @FXML private PasswordField TFPassword;

    @FXML private Label nomErrorLabel;
    @FXML private Label prenomErrorLabel;
    @FXML private Label ageErrorLabel;
    @FXML private Label emailErrorLabel;
    @FXML private Label passwordErrorLabel;

    private boolean isValidNom      = false;
    private boolean isValidPrenom   = false;
    private boolean isValidAge      = false;
    private boolean isValidEmail    = false;
    private boolean isValidPassword = false;

    private boolean isValidName(String s) {
        return s != null && !s.isEmpty() && s.matches("^[a-zA-ZÀ-ÖØ-öø-ÿ\\s-]+$");
    }

    private boolean isValidEmailFormat(String s) {
        return s != null && s.contains("@") && s.contains(".");
    }

    @FXML
    public void initialize() {
        TFNom     .textProperty().addListener((o, v, n) -> validateNom());
        TFPrenom  .textProperty().addListener((o, v, n) -> validatePrenom());
        TFAge     .textProperty().addListener((o, v, n) -> validateAge());
        TFEmail   .textProperty().addListener((o, v, n) -> validateEmail());
        TFPassword.textProperty().addListener((o, v, n) -> validatePassword());
    }

    private void validateNom() {
        String v = TFNom.getText().trim();
        if (v.isEmpty())         { showErr(nomErrorLabel, TFNom, "Le nom est requis");              isValidNom = false; }
        else if (!isValidName(v)){ showErr(nomErrorLabel, TFNom, "Lettres uniquement");             isValidNom = false; }
        else                     { hideErr(nomErrorLabel, TFNom); isValidNom = true; }
    }

    private void validatePrenom() {
        String v = TFPrenom.getText().trim();
        if (v.isEmpty())         { showErr(prenomErrorLabel, TFPrenom, "Le prénom est requis");     isValidPrenom = false; }
        else if (!isValidName(v)){ showErr(prenomErrorLabel, TFPrenom, "Lettres uniquement");       isValidPrenom = false; }
        else                     { hideErr(prenomErrorLabel, TFPrenom); isValidPrenom = true; }
    }

    private void validateAge() {
        String v = TFAge.getText().trim();
        if (v.isEmpty()) { showErr(ageErrorLabel, TFAge, "L'âge est requis"); isValidAge = false; return; }
        try {
            int a = Integer.parseInt(v);
            if (a < 1 || a > 120) { showErr(ageErrorLabel, TFAge, "Entre 1 et 120"); isValidAge = false; }
            else                  { hideErr(ageErrorLabel, TFAge); isValidAge = true; }
        } catch (NumberFormatException e) { showErr(ageErrorLabel, TFAge, "Nombre invalide"); isValidAge = false; }
    }

    private void validateEmail() {
        String v = TFEmail.getText().trim();
        if (v.isEmpty())                { showErr(emailErrorLabel, TFEmail, "L'email est requis");   isValidEmail = false; }
        else if (!isValidEmailFormat(v)){ showErr(emailErrorLabel, TFEmail, "Email invalide");        isValidEmail = false; }
        else if (userService.emailExists(v)){ showErr(emailErrorLabel, TFEmail, "Email déjà utilisé"); isValidEmail = false; }
        else                            { hideErr(emailErrorLabel, TFEmail); isValidEmail = true; }
    }

    private void validatePassword() {
        String v = TFPassword.getText();
        if (v.isEmpty())    { showErr(passwordErrorLabel, TFPassword, "Mot de passe requis");    isValidPassword = false; }
        else if (v.length() < 4) { showErr(passwordErrorLabel, TFPassword, "Au moins 4 caractères"); isValidPassword = false; }
        else                { hideErr(passwordErrorLabel, TFPassword); isValidPassword = true; }
    }

    private void showErr(Label l, Control f, String msg) {
        l.setText(msg); l.setVisible(true);
        f.setStyle("-fx-border-color: #dc3545;");
    }

    private void hideErr(Label l, Control f) {
        l.setText(""); l.setVisible(false);
        f.setStyle("-fx-border-color: #28a745;");
    }

    private boolean isFormValid() {
        return isValidNom && isValidPrenom && isValidAge && isValidEmail && isValidPassword;
    }

    @FXML
    void toggleTheme() {
        Button btn = (Button) mainContainer.lookup(".theme-toggle-btn");
        if (isDarkMode) {
            mainContainer.getStyleClass().remove("dark-theme");
            mainContainer.getStyleClass().add("light-theme");
            if (btn != null) btn.setText("🌙 Mode Sombre");
            isDarkMode = false;
        } else {
            mainContainer.getStyleClass().remove("light-theme");
            mainContainer.getStyleClass().add("dark-theme");
            if (btn != null) btn.setText("☀️ Mode Clair");
            isDarkMode = true;
        }
    }

    @FXML
    void ajouter(ActionEvent event) {
        if (isProcessing) return;

        validateNom(); validatePrenom(); validateAge(); validateEmail(); validatePassword();

        if (!isFormValid()) {
            showAlert("Erreur", "Corrigez les erreurs dans le formulaire", Alert.AlertType.ERROR);
            return;
        }

        try {
            isProcessing = true;

            // ── Création avec champs Symfony calculés automatiquement ──
            User newUser = new User(
                    TFNom.getText().trim(),
                    TFPrenom.getText().trim(),
                    Integer.parseInt(TFAge.getText()),
                    TFEmail.getText().trim(),
                    TFPassword.getText(),
                    "USER"
            );
            userService.register(newUser);

            TFAge.clear(); TFNom.clear(); TFPrenom.clear(); TFEmail.clear(); TFPassword.clear();
            isValidNom = isValidPrenom = isValidAge = isValidEmail = isValidPassword = false;

            showAlert("Succès", "Utilisateur ajouté avec succès!", Alert.AlertType.INFORMATION);

        } catch (NumberFormatException e) {
            showAlert("Erreur", "L'âge doit être un nombre valide", Alert.AlertType.ERROR);
        } catch (Exception e) {
            showAlert("Erreur", e.getMessage(), Alert.AlertType.ERROR);
        } finally {
            isProcessing = false;
        }
    }

    @FXML
    void afficher(ActionEvent event) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/AfficherPersonne.fxml"));
            Parent root = loader.load();
            javafx.scene.layout.StackPane host =
                    (javafx.scene.layout.StackPane) TFAge.getScene().getRoot().lookup("#contentHost");
            host.getChildren().setAll(root);
        } catch (IOException e) { System.out.println(e.getMessage()); }
    }

    private void showAlert(String title, String message, Alert.AlertType type) {
        Alert a = new Alert(type);
        a.setTitle(title);
        a.setContentText(message);
        a.showAndWait();
    }
}