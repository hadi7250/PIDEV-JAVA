package gui;

import entities.User;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.layout.VBox;
import javafx.stage.Stage;
import services.UserService;

import java.io.IOException;
import java.net.URL;
import java.sql.SQLException;
import java.util.List;
import java.util.ResourceBundle;
import java.util.stream.Collectors;

public class AfficherPersonne implements Initializable {

    private final UserService userService = new UserService();
    private ObservableList<User> observableList;
    private ObservableList<User> allUsersList;
    private User selectedUser;
    private User loggedInAdmin;
    private boolean isDarkMode = false;

    // FXML Components
    @FXML
    private VBox mainContainer;
    @FXML
    private Label adminInfoLabel;
    @FXML
    private TableView<User> tableView;
    @FXML
    private TableColumn<User, Integer> idCol;
    @FXML
    private TableColumn<User, Integer> ageCol;
    @FXML
    private TableColumn<User, String> nomCol;
    @FXML
    private TableColumn<User, String> prenomCol;
    @FXML
    private TableColumn<User, String> emailCol;
    @FXML
    private TableColumn<User, String> roleCol;
    @FXML
    private TextField editNomField;
    @FXML
    private TextField editPrenomField;
    @FXML
    private TextField editAgeField;
    @FXML
    private TextField editEmailField;
    @FXML
    private ComboBox<String> editRoleCombo;
    @FXML
    private PasswordField editPasswordField;
    @FXML
    private TextField searchField;

    @Override
    public void initialize(URL location, ResourceBundle resources) {
        // Configure table columns
        idCol.setCellValueFactory(new PropertyValueFactory<>("id"));
        nomCol.setCellValueFactory(new PropertyValueFactory<>("lastName"));
        prenomCol.setCellValueFactory(new PropertyValueFactory<>("firstName"));
        ageCol.setCellValueFactory(new PropertyValueFactory<>("age"));
        emailCol.setCellValueFactory(new PropertyValueFactory<>("email"));
        roleCol.setCellValueFactory(new PropertyValueFactory<>("role"));

        // Setup role combo box
        editRoleCombo.setItems(FXCollections.observableArrayList("USER", "ADMIN"));

        // Load data into table
        refreshTable();

        // Add selection listener - when a row is clicked, load data into edit fields
        tableView.getSelectionModel().selectedItemProperty().addListener(
                (obs, oldSelection, newSelection) -> {
                    if (newSelection != null) {
                        selectedUser = newSelection;
                        editNomField.setText(selectedUser.getLastName());
                        editPrenomField.setText(selectedUser.getFirstName());
                        editAgeField.setText(String.valueOf(selectedUser.getAge()));
                        editEmailField.setText(selectedUser.getEmail());
                        editRoleCombo.setValue(selectedUser.getRole());
                        editPasswordField.clear();
                    }
                }
        );

        // Real-time search as you type
        searchField.textProperty().addListener((obs, oldText, newText) -> {
            searchUsers();
        });
    }

    // Set the logged-in admin user
    public void setLoggedInUser(User admin) {
        this.loggedInAdmin = admin;
        if (adminInfoLabel != null) {
            adminInfoLabel.setText("👑 Logged in as: " + admin.getFirstName() + " " + admin.getLastName() + " (Admin)");
        }
    }

    @FXML
    void toggleTheme() {
        Button themeButton = (Button) mainContainer.lookup(".theme-toggle-btn");

        if (isDarkMode) {
            mainContainer.getStyleClass().remove("dark-theme");
            mainContainer.getStyleClass().add("light-theme");
            if (themeButton != null) themeButton.setText("🌙 Dark Mode");
            isDarkMode = false;
        } else {
            mainContainer.getStyleClass().remove("light-theme");
            mainContainer.getStyleClass().add("dark-theme");
            if (themeButton != null) themeButton.setText("☀️ Light Mode");
            isDarkMode = true;
        }
    }

    @FXML
    void refreshTable() {
        try {
            List<User> users = userService.getAllUsers();
            allUsersList = FXCollections.observableArrayList(users);
            observableList = FXCollections.observableArrayList(users);
            tableView.setItems(observableList);
        } catch (Exception e) {
            showAlert("Erreur", "Impossible de charger les données: " + e.getMessage(), Alert.AlertType.ERROR);
        }
    }

    @FXML
    void searchUsers() {
        String searchText = searchField.getText().toLowerCase().trim();

        if (searchText.isEmpty()) {
            tableView.setItems(allUsersList);
        } else {
            ObservableList<User> filteredList = FXCollections.observableArrayList(
                    allUsersList.stream()
                            .filter(user ->
                                    user.getLastName().toLowerCase().contains(searchText) ||
                                            user.getFirstName().toLowerCase().contains(searchText) ||
                                            user.getEmail().toLowerCase().contains(searchText)
                            )
                            .collect(Collectors.toList())
            );
            tableView.setItems(filteredList);

            if (filteredList.isEmpty()) {
                showAlert("Information", "Aucun utilisateur trouvé avec: " + searchText, Alert.AlertType.INFORMATION);
            }
        }
    }

    @FXML
    void resetSearch() {
        searchField.clear();
        tableView.setItems(allUsersList);
    }

    @FXML
    void updateUser() {
        // Check if a user is selected
        if (selectedUser == null) {
            showAlert("Attention", "Veuillez sélectionner un utilisateur à modifier", Alert.AlertType.WARNING);
            return;
        }

        // Validate inputs
        if (editNomField.getText().isEmpty() || editPrenomField.getText().isEmpty() ||
                editAgeField.getText().isEmpty() || editEmailField.getText().isEmpty()) {
            showAlert("Erreur", "Veuillez remplir tous les champs obligatoires", Alert.AlertType.ERROR);
            return;
        }

        // Validate age
        int age;
        try {
            age = Integer.parseInt(editAgeField.getText());
            if (age < 1 || age > 120) {
                showAlert("Erreur", "L'âge doit être entre 1 et 120", Alert.AlertType.ERROR);
                return;
            }
        } catch (NumberFormatException e) {
            showAlert("Erreur", "L'âge doit être un nombre valide", Alert.AlertType.ERROR);
            return;
        }

        // Validate email
        String email = editEmailField.getText().trim();
        if (!email.contains("@") || !email.contains(".")) {
            showAlert("Erreur", "Veuillez entrer un email valide", Alert.AlertType.ERROR);
            return;
        }

        try {
            // Update the selected user with new values
            selectedUser.setLastName(editNomField.getText());
            selectedUser.setFirstName(editPrenomField.getText());
            selectedUser.setAge(age);
            selectedUser.setEmail(email);
            selectedUser.setRole(editRoleCombo.getValue());

            // Update password if provided
            String newPassword = editPasswordField.getText();
            if (newPassword != null && !newPassword.isEmpty()) {
                if (newPassword.length() < 4) {
                    showAlert("Erreur", "Le mot de passe doit contenir au moins 4 caractères", Alert.AlertType.ERROR);
                    return;
                }
                selectedUser.setPassword(newPassword);
            }

            // Save to database
            boolean success = userService.updateProfile(selectedUser);

            if (success) {
                // Refresh the table
                refreshTable();
                resetSearch();
                clearSelection();
                showAlert("Succès", "Utilisateur modifié avec succès!", Alert.AlertType.INFORMATION);
            } else {
                showAlert("Erreur", "Impossible de modifier l'utilisateur", Alert.AlertType.ERROR);
            }

        } catch (Exception e) {
            showAlert("Erreur", "Impossible de modifier: " + e.getMessage(), Alert.AlertType.ERROR);
        }
    }

    @FXML
    void deleteUser() {
        // Check if a user is selected
        if (selectedUser == null) {
            showAlert("Attention", "Veuillez sélectionner un utilisateur à supprimer", Alert.AlertType.WARNING);
            return;
        }

        // Prevent admin from deleting themselves
        if (loggedInAdmin != null && selectedUser.getId() == loggedInAdmin.getId()) {
            showAlert("Attention", "Vous ne pouvez pas supprimer votre propre compte!", Alert.AlertType.WARNING);
            return;
        }

        // Confirmation dialog
        Alert confirmation = new Alert(Alert.AlertType.CONFIRMATION);
        confirmation.setTitle("Confirmation de suppression");
        confirmation.setHeaderText("Supprimer un utilisateur");
        confirmation.setContentText("Voulez-vous vraiment supprimer " + selectedUser.getFirstName() + " " + selectedUser.getLastName() + " ?");

        if (confirmation.showAndWait().get() == ButtonType.OK) {
            try {
                // Delete from database
                boolean success = userService.deleteUser(selectedUser.getId());

                if (success) {
                    // Refresh the table
                    refreshTable();
                    resetSearch();
                    clearSelection();
                    showAlert("Succès", "Utilisateur supprimé avec succès!", Alert.AlertType.INFORMATION);
                } else {
                    showAlert("Erreur", "Impossible de supprimer l'utilisateur", Alert.AlertType.ERROR);
                }

            } catch (Exception e) {
                showAlert("Erreur", "Impossible de supprimer: " + e.getMessage(), Alert.AlertType.ERROR);
            }
        }
    }

    @FXML
    void goToAddUser() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/AjouterPersonne.fxml"));
            Parent root = loader.load();

            // If AjouterPersonne has a method to set admin info, pass it
            // AjouterPersonne controller = loader.getController();
            // controller.setLoggedInUser(loggedInAdmin);

            tableView.getScene().setRoot(root);
        } catch (IOException e) {
            System.out.println(e.getMessage());
            showAlert("Erreur", "Impossible de charger la page d'ajout", Alert.AlertType.ERROR);
        }
    }

    @FXML
    void logout() {
        Alert confirmation = new Alert(Alert.AlertType.CONFIRMATION);
        confirmation.setTitle("Confirmation de déconnexion");
        confirmation.setHeaderText("Déconnexion");
        confirmation.setContentText("Voulez-vous vraiment vous déconnecter ?");

        if (confirmation.showAndWait().get() == ButtonType.OK) {
            try {
                Parent root = FXMLLoader.load(getClass().getResource("/SignIn.fxml"));
                Stage stage = (Stage) tableView.getScene().getWindow();
                stage.setScene(new Scene(root));
                stage.setTitle("Connexion - User Management System");
                stage.show();
            } catch (Exception e) {
                e.printStackTrace();
                showAlert("Erreur", "Impossible de se déconnecter", Alert.AlertType.ERROR);
            }
        }
    }

    private void clearSelection() {
        selectedUser = null;
        editNomField.clear();
        editPrenomField.clear();
        editAgeField.clear();
        editEmailField.clear();
        editRoleCombo.setValue(null);
        editPasswordField.clear();
        tableView.getSelectionModel().clearSelection();
    }

    private void showAlert(String title, String message, Alert.AlertType type) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setContentText(message);
        alert.showAndWait();
    }
}