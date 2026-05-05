package gui;

import entities.User;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
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

    // Error Labels
    @FXML
    private Label nomErrorLabel;
    @FXML
    private Label prenomErrorLabel;
    @FXML
    private Label ageErrorLabel;
    @FXML
    private Label emailErrorLabel;
    @FXML
    private Label passwordErrorLabel;

    private boolean isValidNom = false;
    private boolean isValidPrenom = false;
    private boolean isValidAge = false;
    private boolean isValidEmail = false;
    private boolean isValidPassword = false;

    private boolean isValidName(String name) {
        return name != null && !name.isEmpty() && name.matches("^[a-zA-ZÀ-ÖØ-öø-ÿ\\s-]+$");
    }

    private boolean isValidEmailFormat(String email) {
        return email != null && email.contains("@") && email.contains(".");
    }

    @FXML
    public void initialize() {
        // Real-time validation listeners
        TFNom.textProperty().addListener((obs, old, newVal) -> validateNom());
        TFPrenom.textProperty().addListener((obs, old, newVal) -> validatePrenom());
        TFAge.textProperty().addListener((obs, old, newVal) -> validateAge());
        TFEmail.textProperty().addListener((obs, old, newVal) -> validateEmail());
        TFPassword.textProperty().addListener((obs, old, newVal) -> validatePassword());
    }

    private void validateNom() {
        String nom = TFNom.getText().trim();
        if (nom.isEmpty()) {
            nomErrorLabel.setText("Le nom est requis");
            nomErrorLabel.setVisible(true);
            isValidNom = false;
        } else if (!isValidName(nom)) {
            nomErrorLabel.setText("Le nom ne doit contenir que des lettres");
            nomErrorLabel.setVisible(true);
            isValidNom = false;
        } else {
            nomErrorLabel.setText("");
            nomErrorLabel.setVisible(false);
            isValidNom = true;
        }
        TFNom.setStyle(isValidNom ? "-fx-border-color: #28a745;" : "-fx-border-color: #dc3545;");
    }

    private void validatePrenom() {
        String prenom = TFPrenom.getText().trim();
        if (prenom.isEmpty()) {
            prenomErrorLabel.setText("Le prénom est requis");
            prenomErrorLabel.setVisible(true);
            isValidPrenom = false;
        } else if (!isValidName(prenom)) {
            prenomErrorLabel.setText("Le prénom ne doit contenir que des lettres");
            prenomErrorLabel.setVisible(true);
            isValidPrenom = false;
        } else {
            prenomErrorLabel.setText("");
            prenomErrorLabel.setVisible(false);
            isValidPrenom = true;
        }
        TFPrenom.setStyle(isValidPrenom ? "-fx-border-color: #28a745;" : "-fx-border-color: #dc3545;");
    }

    private void validateAge() {
        String ageText = TFAge.getText().trim();
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
        TFAge.setStyle(isValidAge ? "-fx-border-color: #28a745;" : "-fx-border-color: #dc3545;");
    }

    private void validateEmail() {
        String email = TFEmail.getText().trim();
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
        TFEmail.setStyle(isValidEmail ? "-fx-border-color: #28a745;" : "-fx-border-color: #dc3545;");
    }

    private void validatePassword() {
        String password = TFPassword.getText();
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
        TFPassword.setStyle(isValidPassword ? "-fx-border-color: #28a745;" : "-fx-border-color: #dc3545;");
    }

    private boolean isFormValid() {
        return isValidNom && isValidPrenom && isValidAge && isValidEmail && isValidPassword;
    }

    @FXML
    void toggleTheme() {
        Button themeButton = (Button) mainContainer.lookup(".theme-toggle-btn");

        if (isDarkMode) {
            mainContainer.getStyleClass().remove("dark-theme");
            mainContainer.getStyleClass().add("light-theme");
            if (themeButton != null) themeButton.setText("🌙 Mode Sombre");
            isDarkMode = false;
        } else {
            mainContainer.getStyleClass().remove("light-theme");
            mainContainer.getStyleClass().add("dark-theme");
            if (themeButton != null) themeButton.setText("☀️ Mode Clair");
            isDarkMode = true;
        }
    }

    @FXML
    void ajouter(ActionEvent event) {
        if (isProcessing) return;

        // Run all validations
        validateNom();
        validatePrenom();
        validateAge();
        validateEmail();
        validatePassword();

        if (!isFormValid()) {
            showAlert("Erreur", "Veuillez corriger les erreurs dans le formulaire", Alert.AlertType.ERROR);
            return;
        }

        try {
            isProcessing = true;

            int age = Integer.parseInt(TFAge.getText());
            String nom = TFNom.getText().trim();
            String prenom = TFPrenom.getText().trim();
            String email = TFEmail.getText().trim();
            String password = TFPassword.getText();

            User newUser = new User(nom, prenom, age, email, password, "USER");
            userService.register(newUser);

            // Clear form
            TFAge.clear();
            TFNom.clear();
            TFPrenom.clear();
            TFEmail.clear();
            TFPassword.clear();

            // Reset validation flags
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
            // Go back into the shell's contentHost, not replace the whole scene
            javafx.scene.layout.StackPane contentHost =
                    (javafx.scene.layout.StackPane) TFAge.getScene().getRoot().lookup("#contentHost");
            contentHost.getChildren().setAll(root);
        } catch (IOException e) {
            System.out.println(e.getMessage());
        }
    }

    private void showAlert(String title, String message, Alert.AlertType type) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setContentText(message);
        alert.showAndWait();
    }
}