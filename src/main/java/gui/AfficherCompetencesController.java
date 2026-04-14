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
import javafx.scene.layout.VBox;
import javafx.stage.Stage;
import services.CompetenceService;

import java.net.URL;
import java.sql.SQLException;
import java.util.ResourceBundle;

public class AfficherCompetencesController implements Initializable {
    @FXML private VBox mainContainer;
    @FXML private TableView<Competence> tableView;
    @FXML private TableColumn<Competence, String> nameCol;
    @FXML private TableColumn<Competence, String> categoryCol;
    @FXML private TableColumn<Competence, Integer> levelCol;
    @FXML private TableColumn<Competence, String> descCol;
    
    @FXML private TextField searchField;
    @FXML private TextField editNameField;
    @FXML private TextArea editDescriptionArea;
    @FXML private ComboBox<String> editCategoryCombo;
    @FXML private Slider editLevelSlider;

    private CompetenceService service = new CompetenceService();
    private User loggedInUser;
    private Competence selectedCompetence;
    private boolean isDarkMode = false;

    @Override
    public void initialize(URL location, ResourceBundle resources) {
        nameCol.setCellValueFactory(new PropertyValueFactory<>("name"));
        categoryCol.setCellValueFactory(new PropertyValueFactory<>("category"));
        levelCol.setCellValueFactory(new PropertyValueFactory<>("maxLevel"));
        descCol.setCellValueFactory(new PropertyValueFactory<>("description"));

        editCategoryCombo.setItems(FXCollections.observableArrayList("technique", "comportementale", "langue", "autre"));

        tableView.getSelectionModel().selectedItemProperty().addListener((obs, oldVal, newVal) -> {
            if (newVal != null) {
                selectedCompetence = newVal;
                loadSelectedCompetence();
            }
        });
    }

    public void setLoggedInUser(User user) {
        this.loggedInUser = user;
        refreshTable();
    }

    private void loadSelectedCompetence() {
        editNameField.setText(selectedCompetence.getName());
        editDescriptionArea.setText(selectedCompetence.getDescription());
        editCategoryCombo.setValue(selectedCompetence.getCategory());
        editLevelSlider.setValue(selectedCompetence.getMaxLevel());
    }

    private void refreshTable() {
        try {
            if (loggedInUser != null) {
                tableView.setItems(FXCollections.observableArrayList(service.readAllByUser(loggedInUser.getId())));
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
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
    private void goBack() {
        try {
            Parent root = FXMLLoader.load(getClass().getResource("/SignIn.fxml"));
            Stage stage = (Stage) tableView.getScene().getWindow();
            stage.setScene(new Scene(root));
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    @FXML
    private void goToAdd() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/AjouterCompetence.fxml"));
            Parent root = loader.load();
            AjouterCompetenceController controller = loader.getController();
            controller.setLoggedInUser(loggedInUser);
            Stage stage = (Stage) tableView.getScene().getWindow();
            stage.setScene(new Scene(root));
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    @FXML
    private void goToEvaluations() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/StudentEvaluations.fxml"));
            Parent root = loader.load();
            StudentEvaluationsController controller = loader.getController();
            controller.setLoggedInUser(loggedInUser);
            Stage stage = (Stage) tableView.getScene().getWindow();
            stage.setScene(new Scene(root));
        } catch (Exception e) {
            e.printStackTrace();
            showAlert(Alert.AlertType.ERROR, "Error", "Could not load evaluations page: " + e.getMessage());
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

    private void showAlert(Alert.AlertType type, String title, String msg) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setContentText(msg);
        alert.showAndWait();
    }
    }