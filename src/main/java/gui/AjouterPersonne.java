package gui;

import entities.Person;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.control.Alert;
import javafx.scene.control.TextField;
import services.PersonService;

import java.io.IOException;
import java.sql.SQLException;

public class AjouterPersonne {

    private final PersonService personService = new PersonService();

    // Add this flag to prevent double submission
    private boolean isProcessing = false;

    @FXML
    private TextField TFAge;

    @FXML
    private TextField TFNom;

    @FXML
    private TextField TFPrenom;

    @FXML
    void ajouter(ActionEvent event) {
        // Prevent double submission
        if (isProcessing) {
            return; // Don't do anything if already processing
        }

        // Validate inputs
        if (TFAge.getText().isEmpty() || TFNom.getText().isEmpty() || TFPrenom.getText().isEmpty()) {
            showAlert("Erreur", "Veuillez remplir tous les champs", Alert.AlertType.ERROR);
            return;
        }

        try {
            isProcessing = true; // Lock the button

            int age = Integer.parseInt(TFAge.getText());
            String Nom = TFNom.getText();
            String Prenom = TFPrenom.getText();

            Person p = new Person(age, Prenom, Nom);

            personService.create(p);

            // Clear fields after successful creation
            TFAge.clear();
            TFNom.clear();
            TFPrenom.clear();

            showAlert("Succès", "Personne ajoutée avec succès!", Alert.AlertType.INFORMATION);

        } catch (NumberFormatException e) {
            showAlert("Erreur", "L'âge doit être un nombre valide", Alert.AlertType.ERROR);
        } catch (SQLException e) {
            showAlert("Erreur", e.getMessage(), Alert.AlertType.ERROR);
        } finally {
            isProcessing = false; // Unlock the button
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