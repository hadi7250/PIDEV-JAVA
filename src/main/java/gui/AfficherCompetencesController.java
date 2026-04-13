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
        // (Logic similar to other controllers)
    }

    @FXML
    private void goBack() {
        // Navigation logic
    }

    @FXML
    private void goToAdd() {
        // Navigation logic
    }

    @FXML
    private void handleUpdate() throws SQLException {
        // Update logic
    }

    @FXML
    private void handleDelete() throws SQLException {
        // Delete logic
    }
}