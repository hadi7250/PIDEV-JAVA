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
import java.util.List;
import java.util.ResourceBundle;
import java.util.stream.Collectors;

import java.io.File;
import java.io.PrintWriter;
import javafx.stage.FileChooser;
import javafx.scene.chart.PieChart;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;

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

    // Statistics Labels
    @FXML
    private Label totalUsersLabel;
    @FXML
    private Label adminCountLabel;
    @FXML
    private Label userCountLabel;
    @FXML
    private Label averageAgeLabel;

    // Helper method to validate name
    private boolean isValidName(String name) {
        return name != null && name.matches("^[a-zA-ZÀ-ÖØ-öø-ÿ\\s-]+$");
    }

    // Helper method to validate email
    private boolean isValidEmail(String email) {
        return email != null && email.contains("@") && email.contains(".");
    }

    // Update statistics dashboard
    private void updateStatistics() {
        if (allUsersList != null && !allUsersList.isEmpty()) {
            int total = allUsersList.size();
            long adminCount = allUsersList.stream().filter(User::isAdmin).count();
            long userCount = total - adminCount;
            double avgAge = allUsersList.stream().mapToInt(User::getAge).average().orElse(0);

            totalUsersLabel.setText(String.valueOf(total));
            adminCountLabel.setText(String.valueOf(adminCount));
            userCountLabel.setText(String.valueOf(userCount));
            averageAgeLabel.setText(String.format("%.1f", avgAge));
        } else {
            totalUsersLabel.setText("0");
            adminCountLabel.setText("0");
            userCountLabel.setText("0");
            averageAgeLabel.setText("0");
        }
    }

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

        // Add selection listener
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

        // Real-time search
        searchField.textProperty().addListener((obs, oldText, newText) -> {
            searchUsers();
        });
    }

    public void setLoggedInUser(User admin) {
        this.loggedInAdmin = admin;
        if (adminInfoLabel != null) {
            adminInfoLabel.setText("👑 Connecté en tant que: " + admin.getFirstName() + " " + admin.getLastName() + " (Administrateur)");
        }
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
    void refreshTable() {
        try {
            List<User> users = userService.getAllUsers();
            allUsersList = FXCollections.observableArrayList(users);
            observableList = FXCollections.observableArrayList(users);
            tableView.setItems(observableList);
            updateStatistics(); // Update statistics after loading data
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
        if (selectedUser == null) {
            showAlert("Attention", "Veuillez sélectionner un utilisateur à modifier", Alert.AlertType.WARNING);
            return;
        }

        String nom = editNomField.getText().trim();
        String prenom = editPrenomField.getText().trim();
        String email = editEmailField.getText().trim();

        // Validate inputs
        if (nom.isEmpty() || prenom.isEmpty() || editAgeField.getText().isEmpty() || email.isEmpty()) {
            showAlert("Erreur", "Veuillez remplir tous les champs obligatoires", Alert.AlertType.ERROR);
            return;
        }

        // Validate name contains only letters
        if (!isValidName(nom)) {
            showAlert("Erreur", "Le nom ne doit contenir que des lettres", Alert.AlertType.ERROR);
            return;
        }

        if (!isValidName(prenom)) {
            showAlert("Erreur", "Le prénom ne doit contenir que des lettres", Alert.AlertType.ERROR);
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
        if (!isValidEmail(email)) {
            showAlert("Erreur", "Veuillez entrer un email valide (ex: nom@domaine.com)", Alert.AlertType.ERROR);
            return;
        }

        try {
            selectedUser.setLastName(nom);
            selectedUser.setFirstName(prenom);
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

            boolean success = userService.updateProfile(selectedUser);

            if (success) {
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
        if (selectedUser == null) {
            showAlert("Attention", "Veuillez sélectionner un utilisateur à supprimer", Alert.AlertType.WARNING);
            return;
        }

        if (loggedInAdmin != null && selectedUser.getId() == loggedInAdmin.getId()) {
            showAlert("Attention", "Vous ne pouvez pas supprimer votre propre compte!", Alert.AlertType.WARNING);
            return;
        }

        Alert confirmation = new Alert(Alert.AlertType.CONFIRMATION);
        confirmation.setTitle("Confirmation de suppression");
        confirmation.setHeaderText("Supprimer un utilisateur");
        confirmation.setContentText("Voulez-vous vraiment supprimer " + selectedUser.getFirstName() + " " + selectedUser.getLastName() + " ?");

        if (confirmation.showAndWait().get() == ButtonType.OK) {
            try {
                boolean success = userService.deleteUser(selectedUser.getId());

                if (success) {
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
            // Load AjouterPersonne inside the EduConnect shell's contentHost
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/AjouterPersonne.fxml"));
            Parent root = loader.load();
            // Replace only the content inside the shell, not the whole scene
            tableView.getScene().getRoot().lookup("#contentHost")
                    .getParent().getChildrenUnmodifiable();
            // Use the parent StackPane (contentHost)
            javafx.scene.layout.StackPane contentHost =
                    (javafx.scene.layout.StackPane) tableView.getScene().getRoot().lookup("#contentHost");
            contentHost.getChildren().setAll(root);
        } catch (IOException e) {
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
                Parent root = FXMLLoader.load(getClass().getResource("/fxml/SignIn.fxml"));
                Stage stage = (Stage) tableView.getScene().getWindow();
                stage.setScene(new Scene(root));
                stage.setTitle("Connexion - Gestion des Utilisateurs");
                stage.show();
            } catch (Exception e) {
                e.printStackTrace();
                showAlert("Erreur", "Impossible de se déconnecter", Alert.AlertType.ERROR);
            }
        }
    }

    @FXML
    void openChatbot() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/Chatbot.fxml"));
            Parent root = loader.load();
            Stage chatStage = new Stage();
            chatStage.setTitle("🤖 Assistant IA - Gestion des Utilisateurs");
            chatStage.setScene(new Scene(root, 600, 550));
            chatStage.show();
        } catch (IOException e) {
            e.printStackTrace();
            showAlert("Erreur", "Impossible d'ouvrir l'assistant", Alert.AlertType.ERROR);
        }
    }

    private void clearSelection() {
        selectedUser = null;
        editNomField.clear();
        editPrenomField.clear();
        editAgeField.clear();
        editEmailField      .clear();
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

    // ==================== EXPORT TO CSV ====================

    @FXML
    void exportToCSV() {
        try {
            // Create file chooser
            FileChooser fileChooser = new FileChooser();
            fileChooser.setTitle("Exporter la liste des utilisateurs");
            fileChooser.getExtensionFilters().add(
                    new FileChooser.ExtensionFilter("CSV Files", "*.csv")
            );
            fileChooser.setInitialFileName("utilisateurs_" + java.time.LocalDate.now() + ".csv");

            File file = fileChooser.showSaveDialog(tableView.getScene().getWindow());

            if (file != null) {
                try (PrintWriter writer = new PrintWriter(file)) {
                    // Write header (French)
                    writer.println("ID,Prénom,Nom,Âge,Email,Rôle");

                    // Write data
                    for (User user : allUsersList) {
                        writer.printf("%d,%s,%s,%d,%s,%s%n",
                                user.getId(),
                                user.getFirstName(),
                                user.getLastName(),
                                user.getAge(),
                                user.getEmail(),
                                user.getRole()
                        );
                    }

                    showAlert("Succès", "Export réussi! Fichier: " + file.getName(), Alert.AlertType.INFORMATION);

                }
            }
        } catch (Exception e) {
            showAlert("Erreur", "Erreur lors de l'export: " + e.getMessage(), Alert.AlertType.ERROR);
        }
    }

// ==================== AGE CHART ====================

    @FXML
    void showAgeChart() {
        // Create age groups
        int under18 = 0;
        int under30 = 0;
        int under50 = 0;
        int over50 = 0;

        for (User user : allUsersList) {
            int age = user.getAge();
            if (age < 18) under18++;
            else if (age < 30) under30++;
            else if (age < 50) under50++;
            else over50++;
        }

        // Create pie chart data (only include non-zero groups)
        ObservableList<PieChart.Data> pieChartData = FXCollections.observableArrayList();

        if (under18 > 0) pieChartData.add(new PieChart.Data("Moins de 18 ans (" + under18 + ")", under18));
        if (under30 > 0) pieChartData.add(new PieChart.Data("18-29 ans (" + under30 + ")", under30));
        if (under50 > 0) pieChartData.add(new PieChart.Data("30-49 ans (" + under50 + ")", under50));
        if (over50 > 0) pieChartData.add(new PieChart.Data("50+ ans (" + over50 + ")", over50));

        // Create chart
        PieChart chart = new PieChart(pieChartData);
        chart.setTitle("Répartition par âge des utilisateurs");
        chart.setLabelsVisible(true);
        chart.setLegendVisible(true);
        chart.setClockwise(true);

        // Style the chart
        chart.setStyle("-fx-font-size: 13px;");

        // Create popup window
        Stage chartStage = new Stage();
        chartStage.setTitle("📊 Statistiques d'âge");
        chartStage.setScene(new Scene(chart, 600, 450));
        chartStage.show();
    }
}