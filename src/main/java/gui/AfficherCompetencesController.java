package gui;

import entities.Competence;
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
import javafx.scene.layout.StackPane;
import javafx.scene.layout.VBox;
import javafx.stage.Stage;
import services.CompetenceService;
import services.CVGeneratorService;

import java.net.URL;
import java.sql.SQLException;
import java.util.ResourceBundle;
import java.util.stream.Collectors;

public class AfficherCompetencesController implements Initializable {
    @FXML private StackPane mainContainer;
    @FXML private TableView<Competence> tableView;
    @FXML private TableColumn<Competence, String> nameCol;
    @FXML private TableColumn<Competence, String> categoryCol;
    @FXML private TableColumn<Competence, Integer> levelCol;
    @FXML private TableColumn<Competence, String> descCol;

    @FXML private Label totalLabel;
    @FXML private TextField searchField;
    @FXML private TextField editNameField;
    @FXML private TextArea editDescriptionArea;
    @FXML private ComboBox<String> editCategoryCombo;
    @FXML private Slider editLevelSlider;
    @FXML private Button btnUpdate;
    @FXML private Button btnDelete;
    @FXML private Button btnAdd;
    @FXML private Button btnGenerateCV;

    private CompetenceService service = new CompetenceService();
    private CVGeneratorService cvService = new CVGeneratorService();
    private User loggedInUser;
    private Competence selectedCompetence;
    private ObservableList<Competence> allCompetences = FXCollections.observableArrayList();
    private boolean isDarkMode = false;

    @Override
    public void initialize(URL location, ResourceBundle resources) {
        nameCol.setCellValueFactory(new PropertyValueFactory<>("title"));
        categoryCol.setCellValueFactory(new PropertyValueFactory<>("category"));
        levelCol.setCellValueFactory(new PropertyValueFactory<>("maxLevel"));
        descCol.setCellValueFactory(new PropertyValueFactory<>("description"));

        editCategoryCombo.setItems(FXCollections.observableArrayList("technique", "comportementale", "langue", "autre"));

        tableView.getSelectionModel().selectedItemProperty().addListener((obs, oldVal, newVal) -> {
            if (newVal != null) {
                selectedCompetence = newVal;
                loadSelectedCompetence();
                updateEditability();
            }
        });

        searchField.textProperty().addListener((obs, oldVal, newVal) -> searchCompetences());
    }

    private void updateEditability() {
        if (selectedCompetence == null || loggedInUser == null) return;

        boolean canEdit = loggedInUser.isAdmin() || selectedCompetence.getUserId() == loggedInUser.getId();
        btnUpdate.setDisable(!canEdit);
        btnDelete.setDisable(!canEdit);
    }

    public void setLoggedInUser(User user) {
        this.loggedInUser = user;
        refreshTable();

        // Hide "Add" button for teachers, they don't add student competences here
        if (user != null && "TEACHER".equals(user.getRole().toUpperCase())) {
            btnAdd.setVisible(false);
            btnAdd.setManaged(false);
        }
    }

    private void loadSelectedCompetence() {
        editNameField.setText(selectedCompetence.getTitle());
        editDescriptionArea.setText(selectedCompetence.getDescription());
        editCategoryCombo.setValue(selectedCompetence.getCategory());
        editLevelSlider.setValue(selectedCompetence.getMaxLevel());
    }

    @FXML
    private void refreshTable() {

        try {
            if (loggedInUser != null) {
                String role = loggedInUser.getRole().toUpperCase();
                if (loggedInUser.isAdmin() || "TEACHER".equals(role)) {
                    allCompetences = FXCollections.observableArrayList(service.readAll());
                } else {
                    allCompetences = FXCollections.observableArrayList(service.readAllByUser(loggedInUser.getId()));
                }
                tableView.setItems(allCompetences);
                if (totalLabel != null) {
                    totalLabel.setText("Total Records: " + allCompetences.size());
                }
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    private void searchCompetences() {
        String text = searchField.getText().toLowerCase();
        tableView.setItems(FXCollections.observableArrayList(
            allCompetences.stream()
                .filter(c -> (c.getTitle() != null && c.getTitle().toLowerCase().contains(text)) ||
                             (c.getCategory() != null && c.getCategory().toLowerCase().contains(text)))
                .collect(Collectors.toList())
        ));
    }

    @FXML
    private void toggleTheme() {
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
    private void goToProfile() {
        loadSubModule("/fxml/UserBasicPage.fxml");
    }

    @FXML
    private void goBack() {
        try {
            Parent root = FXMLLoader.load(getClass().getResource("/fxml/SignIn.fxml"));
            Stage stage = (Stage) mainContainer.getScene().getWindow();
            stage.setScene(new Scene(root));
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    @FXML
    private void goToAdd() {
        loadSubModule("/fxml/AjouterCompetence.fxml");
    }

    @FXML
    private void goToEvaluations() {
        loadSubModule("/fxml/StudentEvaluations.fxml");
    }

    private void loadSubModule(String fxmlPath) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource(fxmlPath));
            Parent root = loader.load();

            Object controller = loader.getController();
            if (controller instanceof AjouterCompetenceController) ((AjouterCompetenceController) controller).setLoggedInUser(loggedInUser);
            else if (controller instanceof StudentEvaluationsController) ((StudentEvaluationsController) controller).setLoggedInUser(loggedInUser);
            else if (controller instanceof UserBasicPageController) ((UserBasicPageController) controller).setLoggedInUser(loggedInUser);

            StackPane contentHost = (StackPane) mainContainer.getScene().lookup("#contentHost");
            if (contentHost != null) {
                contentHost.getChildren().setAll(root);
            } else {
                Stage stage = (Stage) mainContainer.getScene().getWindow();
                stage.setScene(new Scene(root));
            }
        } catch (Exception e) {
            e.printStackTrace();
            showAlert(Alert.AlertType.ERROR, "Error", "Could not load module: " + e.getMessage());
        }
    }

    @FXML
    private void handleUpdate() throws SQLException {
        if (selectedCompetence == null) return;

        selectedCompetence.setName(editNameField.getText());
        selectedCompetence.setDescription(editDescriptionArea.getText());
        selectedCompetence.setCategory(editCategoryCombo.getValue());
        selectedCompetence.setMaxLevel((int) editLevelSlider.getValue());

        service.update(selectedCompetence);
        refreshTable();
        showAlert(Alert.AlertType.INFORMATION, "Success", "Competence updated!");
    }

    @FXML
    private void handleDelete() throws SQLException {
        if (selectedCompetence == null) return;

        Alert alert = new Alert(Alert.AlertType.CONFIRMATION);
        alert.setTitle("Confirm Delete");
        alert.setHeaderText("Are you sure you want to delete this competence?");

        if (alert.showAndWait().get() == ButtonType.OK) {
            service.delete(selectedCompetence);
            refreshTable();
            showAlert(Alert.AlertType.INFORMATION, "Success", "Competence deleted!");
        }
    }

    @FXML
    private void generateCV() {
        if (loggedInUser == null) {
            showAlert(Alert.AlertType.WARNING, "Warning", "No user logged in.");
            return;
        }

        if (allCompetences.isEmpty()) {
            showAlert(Alert.AlertType.WARNING, "Warning", "No competences to include in CV.");
            return;
        }

        try {
            String path = cvService.generateCV(loggedInUser, allCompetences);
            showAlert(Alert.AlertType.INFORMATION, "CV Generated", "Your CV has been successfully generated and saved to:\n" + path);
        } catch (Exception e) {
            e.printStackTrace();
            showAlert(Alert.AlertType.ERROR, "Generation Error", "Failed to generate CV: " + e.getMessage());
        }
    }

    private void showAlert(Alert.AlertType type, String title, String msg) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setContentText(msg);
        alert.showAndWait();
    }
    }