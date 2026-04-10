package gui;

import entities.Person;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Parent;
import javafx.scene.control.*;
import javafx.scene.control.cell.PropertyValueFactory;
import services.PersonService;

import java.io.IOException;
import java.net.URL;
import java.sql.SQLException;
import java.util.List;
import java.util.ResourceBundle;
import java.util.stream.Collectors;

public class AfficherPersonne implements Initializable {

    private final PersonService ps = new PersonService();
    private ObservableList<Person> observableList;
    private ObservableList<Person> allPersonsList; // Store all persons for search
    private Person selectedPerson;

    @FXML
    private TableView<Person> tableView;
    @FXML
    private TableColumn<Person, Integer> ageCol;
    @FXML
    private TableColumn<Person, String> nomCol;
    @FXML
    private TableColumn<Person, String> prenomCol;
    @FXML
    private TextField editNomField;
    @FXML
    private TextField editPrenomField;
    @FXML
    private TextField editAgeField;
    @FXML
    private TextField searchField;

    @Override
    public void initialize(URL location, ResourceBundle resources) {
        // Configure table columns
        nomCol.setCellValueFactory(new PropertyValueFactory<>("lastName"));
        prenomCol.setCellValueFactory(new PropertyValueFactory<>("firstName"));
        ageCol.setCellValueFactory(new PropertyValueFactory<>("age"));

        // Load data into table
        refreshTable();

        // Add selection listener
        tableView.getSelectionModel().selectedItemProperty().addListener(
                (obs, oldSelection, newSelection) -> {
                    if (newSelection != null) {
                        selectedPerson = newSelection;
                        editNomField.setText(selectedPerson.getLastName());
                        editPrenomField.setText(selectedPerson.getFirstName());
                        editAgeField.setText(String.valueOf(selectedPerson.getAge()));
                    }
                }
        );

        // Real-time search as you type (bonus feature)
        searchField.textProperty().addListener((obs, oldText, newText) -> {
            searchPersons();
        });
    }

    @FXML
    void refreshTable() {
        try {
            List<Person> personnes = ps.readAll();
            allPersonsList = FXCollections.observableArrayList(personnes);
            observableList = FXCollections.observableArrayList(personnes);
            tableView.setItems(observableList);
        } catch (SQLException e) {
            showAlert("Erreur", "Impossible de charger les données: " + e.getMessage(), Alert.AlertType.ERROR);
        }
    }

    @FXML
    void searchPersons() {
        String searchText = searchField.getText().toLowerCase().trim();

        if (searchText.isEmpty()) {
            // If search is empty, show all persons
            tableView.setItems(allPersonsList);
        } else {
            // Filter the list
            ObservableList<Person> filteredList = FXCollections.observableArrayList(
                    allPersonsList.stream()
                            .filter(person ->
                                    person.getLastName().toLowerCase().contains(searchText) ||
                                            person.getFirstName().toLowerCase().contains(searchText)
                            )
                            .collect(Collectors.toList())
            );
            tableView.setItems(filteredList);

            // Show message if no results
            if (filteredList.isEmpty()) {
                showAlert("Information", "Aucune personne trouvée avec: " + searchText, Alert.AlertType.INFORMATION);
            }
        }
    }

    @FXML
    void resetSearch() {
        searchField.clear();
        tableView.setItems(allPersonsList);
    }

    @FXML
    void updatePerson() {
        if (selectedPerson == null) {
            showAlert("Attention", "Veuillez sélectionner une personne à modifier", Alert.AlertType.WARNING);
            return;
        }

        if (editNomField.getText().isEmpty() || editPrenomField.getText().isEmpty() || editAgeField.getText().isEmpty()) {
            showAlert("Erreur", "Veuillez remplir tous les champs", Alert.AlertType.ERROR);
            return;
        }

        try {
            selectedPerson.setLastName(editNomField.getText());
            selectedPerson.setFirstName(editPrenomField.getText());
            selectedPerson.setAge(Integer.parseInt(editAgeField.getText()));

            ps.update(selectedPerson);
            refreshTable();
            resetSearch(); // Reset search after update
            clearSelection();
            showAlert("Succès", "Personne modifiée avec succès!", Alert.AlertType.INFORMATION);

        } catch (NumberFormatException e) {
            showAlert("Erreur", "L'âge doit être un nombre valide", Alert.AlertType.ERROR);
        } catch (SQLException e) {
            showAlert("Erreur", "Impossible de modifier: " + e.getMessage(), Alert.AlertType.ERROR);
        }
    }

    @FXML
    void deletePerson() {
        if (selectedPerson == null) {
            showAlert("Attention", "Veuillez sélectionner une personne à supprimer", Alert.AlertType.WARNING);
            return;
        }

        Alert confirmation = new Alert(Alert.AlertType.CONFIRMATION);
        confirmation.setTitle("Confirmation de suppression");
        confirmation.setHeaderText("Supprimer une personne");
        confirmation.setContentText("Voulez-vous vraiment supprimer " + selectedPerson.getFirstName() + " " + selectedPerson.getLastName() + " ?");

        if (confirmation.showAndWait().get() == ButtonType.OK) {
            try {
                ps.delete(selectedPerson);
                refreshTable();
                resetSearch(); // Reset search after delete
                clearSelection();
                showAlert("Succès", "Personne supprimée avec succès!", Alert.AlertType.INFORMATION);

            } catch (SQLException e) {
                showAlert("Erreur", "Impossible de supprimer: " + e.getMessage(), Alert.AlertType.ERROR);
            }
        }
    }

    @FXML
    void goBackToAdd() {
        try {
            Parent root = FXMLLoader.load(getClass().getResource("/AjouterPersonne.fxml"));
            tableView.getScene().setRoot(root);
        } catch (IOException e) {
            System.out.println(e.getMessage());
        }
    }

    private void clearSelection() {
        selectedPerson = null;
        editNomField.clear();
        editPrenomField.clear();
        editAgeField.clear();
        tableView.getSelectionModel().clearSelection();
    }

    private void showAlert(String title, String message, Alert.AlertType type) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setContentText(message);
        alert.showAndWait();
    }
}