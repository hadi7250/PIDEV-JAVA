package gui;

import entities.User;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Parent;
import javafx.scene.control.*;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.layout.VBox;
import services.UserService;
import utils.SessionManager;

import java.io.IOException;
import java.net.URL;
import java.util.List;
import java.util.ResourceBundle;
import java.util.stream.Collectors;

public class AfficherPersonne implements Initializable {

    private final UserService userService = new UserService();
    private ObservableList<User> observableList;
    private ObservableList<User> allUsersList;
    private User selectedUser;
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

        // Update admin info label
        if (SessionManager.getInstance().isLoggedIn()) {
            User currentUser = SessionManager.getInstance().getCurrentUser();
            adminInfoLabel.setText("Logged in as: " + currentUser.getFirstName() + " " + currentUser.getLastName() + " (" + currentUser.getRole() + ")");
        }
    }

    @FXML
    void searchUsers() {
        String searchText = searchField.getText().trim().toLowerCase();
        
        if (searchText.isEmpty()) {
            tableView.setItems(allUsersList);
        } else {
            ObservableList<User> filteredList = allUsersList.stream()
                    .filter(user -> 
                        user.getFirstName().toLowerCase().contains(searchText) ||
                        user.getLastName().toLowerCase().contains(searchText) ||
                        user.getEmail().toLowerCase().contains(searchText))
                    .collect(Collectors.toCollection(FXCollections::observableArrayList));
            tableView.setItems(filteredList);
        }
    }

    @FXML
    void resetSearch() {
        searchField.clear();
        tableView.setItems(allUsersList);
    }

    @FXML
    void refreshTable() {
        try {
            List<User> users = userService.getAllUsers();
            allUsersList = FXCollections.observableArrayList(users);
            observableList = FXCollections.observableArrayList(users);
            tableView.setItems(observableList);
        } catch (Exception e) {
            showAlert("Error", "Failed to load users: " + e.getMessage(), Alert.AlertType.ERROR);
        }
    }

    @FXML
    void updateUser() {
        // Check if a user is selected
        if (selectedUser == null) {
            showAlert("Warning", "Please select a user to update", Alert.AlertType.WARNING);
            return;
        }

        // Validate input fields
        String nom = editNomField.getText().trim();
        String prenom = editPrenomField.getText().trim();
        String ageText = editAgeField.getText().trim();
        String email = editEmailField.getText().trim();
        String role = editRoleCombo.getValue();

        if (nom.isEmpty() || prenom.isEmpty() || ageText.isEmpty() || email.isEmpty() || role == null) {
            showAlert("Error", "Please fill in all fields", Alert.AlertType.ERROR);
            return;
        }

        // Validate age
        int age;
        try {
            age = Integer.parseInt(ageText);
            if (age < 1 || age > 120) {
                showAlert("Error", "Please enter a valid age (1-120)", Alert.AlertType.ERROR);
                return;
            }
        } catch (NumberFormatException e) {
            showAlert("Error", "Age must be a number", Alert.AlertType.ERROR);
            return;
        }

        // Validate email
        if (!email.contains("@") || !email.contains(".")) {
            showAlert("Error", "Please enter a valid email", Alert.AlertType.ERROR);
            return;
        }

        try {
            // Update the selected user with new values
            selectedUser.setLastName(nom);
            selectedUser.setFirstName(prenom);
            selectedUser.setAge(age);
            selectedUser.setEmail(email);
            selectedUser.setRole(role);

            // Update password if provided
            String newPassword = editPasswordField.getText();
            if (newPassword != null && !newPassword.isEmpty()) {
                if (newPassword.length() < 4) {
                    showAlert("Error", "Password must be at least 4 characters", Alert.AlertType.ERROR);
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
                showAlert("Success", "User updated successfully!", Alert.AlertType.INFORMATION);
            } else {
                showAlert("Error", "Failed to update user", Alert.AlertType.ERROR);
            }

        } catch (Exception e) {
            showAlert("Error", "Failed to update: " + e.getMessage(), Alert.AlertType.ERROR);
        }
    }

    @FXML
    void deleteUser() {
        // Check if a user is selected
        if (selectedUser == null) {
            showAlert("Warning", "Please select a user to delete", Alert.AlertType.WARNING);
            return;
        }

        // Prevent deletion of current admin user
        if (SessionManager.getInstance().isLoggedIn() && 
            selectedUser.getId() == SessionManager.getInstance().getCurrentUserId()) {
            showAlert("Error", "You cannot delete your own account", Alert.AlertType.ERROR);
            return;
        }

        Alert confirmation = new Alert(Alert.AlertType.CONFIRMATION);
        confirmation.setTitle("Confirm Deletion");
        confirmation.setHeaderText("Delete User");
        confirmation.setContentText("Are you sure you want to delete " + selectedUser.getFirstName() + " " + selectedUser.getLastName() + "?");

        confirmation.showAndWait().ifPresent(response -> {
            if (response == ButtonType.OK) {
                try {
                    boolean success = userService.deleteUser(selectedUser.getId());

                    if (success) {
                        refreshTable();
                        resetSearch();
                        clearSelection();
                        showAlert("Success", "User deleted successfully!", Alert.AlertType.INFORMATION);
                    } else {
                        showAlert("Error", "Failed to delete user", Alert.AlertType.ERROR);
                    }
                } catch (Exception e) {
                    showAlert("Error", "Failed to delete: " + e.getMessage(), Alert.AlertType.ERROR);
                }
            }
        });
    }

    @FXML
    void goToAddUser() {
        try {
            // Load the Add User form into the same content area
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/AjouterPersonne.fxml"));
            Parent addUserRoot = loader.load();
            
            // Replace the current content
            mainContainer.getChildren().setAll(addUserRoot);
            
        } catch (IOException e) {
            showAlert("Error", "Failed to load add user form: " + e.getMessage(), Alert.AlertType.ERROR);
        }
    }

    @FXML
    void logout() {
        Alert confirmation = new Alert(Alert.AlertType.CONFIRMATION);
        confirmation.setTitle("Confirm Logout");
        confirmation.setHeaderText("Logout");
        confirmation.setContentText("Are you sure you want to logout?");

        confirmation.showAndWait().ifPresent(response -> {
            if (response == ButtonType.OK) {
                // Clear session
                SessionManager.getInstance().logout();
                
                // Navigate back to login screen
                try {
                    Parent loginRoot = FXMLLoader.load(getClass().getResource("/fxml/SignIn.fxml"));
                    mainContainer.getScene().setRoot(loginRoot);
                } catch (IOException e) {
                    showAlert("Error", "Failed to load login screen: " + e.getMessage(), Alert.AlertType.ERROR);
                }
            }
        });
    }

    @FXML
    void toggleTheme() {
        isDarkMode = !isDarkMode;
        if (isDarkMode) {
            mainContainer.getStyleClass().add("dark-mode");
        } else {
            mainContainer.getStyleClass().remove("dark-mode");
        }
    }

    private void clearSelection() {
        tableView.getSelectionModel().clearSelection();
        selectedUser = null;
        editNomField.clear();
        editPrenomField.clear();
        editAgeField.clear();
        editEmailField.clear();
        editRoleCombo.setValue(null);
        editPasswordField.clear();
    }

    private void showAlert(String title, String message, Alert.AlertType type) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setContentText(message);
        alert.showAndWait();
    }
}
