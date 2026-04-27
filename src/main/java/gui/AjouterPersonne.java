package gui;

import entities.User;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.TextField;
import javafx.scene.control.PasswordField;
import javafx.scene.layout.StackPane;
import javafx.scene.layout.VBox;
import javafx.stage.Stage;
import services.UserService;

import java.io.IOException;

public class AjouterPersonne {

    private final UserService userService = new UserService();
    private boolean isProcessing = false;
    private boolean isDarkMode = false;
    private User loggedInUser;

    @FXML
    private StackPane mainContainer;
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

    public void setLoggedInUser(User user) {
        this.loggedInUser = user;
    }

    @FXML
    void toggleTheme() {
        Button themeButton = (Button) mainContainer.lookup(".theme-toggle-btn");

        if (isDarkMode) {
            mainContainer.getStyleClass().remove("dark-theme");
            mainContainer.getStyleClass().add("light-theme");
            if (themeButton != null) {
                themeButton.setText("🌙 Dark Mode");
            }
            isDarkMode = false;
        } else {
            mainContainer.getStyleClass().remove("light-theme");
            mainContainer.getStyleClass().add("dark-theme");
            if (themeButton != null) {
                themeButton.setText("☀️ Light Mode");
            }
            isDarkMode = true;
        }
    }

    @FXML
    void ajouter(ActionEvent event) {
        if (isProcessing) {
            return;
        }

        if (TFAge.getText().isEmpty() || TFNom.getText().isEmpty() ||
                TFPrenom.getText().isEmpty() || TFEmail.getText().isEmpty() ||
                TFPassword.getText().isEmpty()) {
            showAlert("Erreur", "Veuillez remplir tous les champs", Alert.AlertType.ERROR);
            return;
        }

        try {
            isProcessing = true;

            int age = Integer.parseInt(TFAge.getText());
            String nom = TFNom.getText();
            String prenom = TFPrenom.getText();
            String email = TFEmail.getText();
            String password = TFPassword.getText();

            // Validate email
            if (!email.contains("@") || !email.contains(".")) {
                showAlert("Erreur", "Email invalide", Alert.AlertType.ERROR);
                return;
            }

            // Validate password length
            if (password.length() < 4) {
                showAlert("Erreur", "Le mot de passe doit contenir au moins 4 caractères", Alert.AlertType.ERROR);
                return;
            }

            // Check if email already exists
            if (userService.emailExists(email)) {
                showAlert("Erreur", "Cet email existe déjà", Alert.AlertType.ERROR);
                return;
            }

            User newUser = new User();
            newUser.setNom(nom);
            newUser.setPrenom(prenom);
            newUser.setEmail(email);
            newUser.setPassword(password);
            newUser.setRoles("[\"ROLE_USER\"]");
            newUser.setDateNaissance(java.time.LocalDate.now().minusYears(age));
            
            userService.register(newUser);

            TFAge.clear();
            TFNom.clear();
            TFPrenom.clear();
            TFEmail.clear();
            TFPassword.clear();

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
            AfficherPersonne controller = loader.getController();
            controller.setLoggedInUser(loggedInUser);
            
            StackPane contentHost = (StackPane) mainContainer.getScene().lookup("#contentHost");
            if (contentHost != null) {
                contentHost.getChildren().setAll(root);
            } else {
                Stage stage = (Stage) mainContainer.getScene().getWindow();
                stage.setScene(new Scene(root));
            }
        } catch (IOException e) {
            e.printStackTrace();
            showAlert("Erreur", "Impossible de charger la liste", Alert.AlertType.ERROR);
        }
    }

    private void showAlert(String title, String message, Alert.AlertType type) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setContentText(message);
        alert.showAndWait();
    }
}
