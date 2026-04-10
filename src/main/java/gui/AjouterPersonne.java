package gui;

import entities.Person;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.TextField;
import javafx.scene.layout.VBox;
import services.PersonService;

import java.io.IOException;
import java.sql.SQLException;

public class AjouterPersonne {

    private final PersonService personService = new PersonService();
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

        if (TFAge.getText().isEmpty() || TFNom.getText().isEmpty() || TFPrenom.getText().isEmpty()) {
            showAlert("Erreur", "Veuillez remplir tous les champs", Alert.AlertType.ERROR);
            return;
        }

        try {
            isProcessing = true;

            int age = Integer.parseInt(TFAge.getText());
            String Nom = TFNom.getText();
            String Prenom = TFPrenom.getText();

            Person p = new Person(age, Prenom, Nom);
            personService.create(p);

            TFAge.clear();
            TFNom.clear();
            TFPrenom.clear();

            showAlert("Succès", "Personne ajoutée avec succès!", Alert.AlertType.INFORMATION);

        } catch (NumberFormatException e) {
            showAlert("Erreur", "L'âge doit être un nombre valide", Alert.AlertType.ERROR);
        } catch (SQLException e) {
            showAlert("Erreur", e.getMessage(), Alert.AlertType.ERROR);
        } finally {
            isProcessing = false;
        }
    }

    @FXML
    void afficher(ActionEvent event) {
        try {
            Parent root = FXMLLoader.load(getClass().getResource("/AfficherPersonne.fxml"));
            TFAge.getScene().setRoot(root);
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