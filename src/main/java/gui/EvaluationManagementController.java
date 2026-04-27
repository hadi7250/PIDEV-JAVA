package gui;

import entities.Competence;
import entities.Evaluation;
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
import javafx.stage.Stage;
import services.CompetenceService;
import services.EvaluationService;

import java.io.IOException;
import java.net.URL;
import java.sql.SQLException;
import java.time.LocalDateTime;
import java.util.List;
import java.util.ResourceBundle;
import java.util.stream.Collectors;

public class EvaluationManagementController implements Initializable {
    @FXML private StackPane mainContainer;
    
    // Competences Table
    @FXML private TableView<Competence> competenceTableView;
    @FXML private TableColumn<Competence, String> compNameCol;
    @FXML private TableColumn<Competence, Integer> compUserCol;

    // Evaluations Table
    @FXML private TableView<Evaluation> tableView;
    @FXML private TableColumn<Evaluation, String> titleCol;
    @FXML private TableColumn<Evaluation, Float> scoreCol;
    @FXML private TableColumn<Evaluation, String> statusCol;
    @FXML private TableColumn<Evaluation, LocalDateTime> dateCol;

    @FXML private Label totalLabel;
    @FXML private TextField searchField;
    @FXML private TextField scoreField;
    @FXML private ComboBox<String> statusCombo;
    @FXML private TextArea commentArea;

    private EvaluationService service = new EvaluationService();
    private CompetenceService competenceService = new CompetenceService();
    private User loggedInUser;
    
    private Evaluation selectedEvaluation;
    private Competence selectedCompetence;
    
    private ObservableList<Evaluation> allEvaluations = FXCollections.observableArrayList();
    private ObservableList<Competence> allCompetences = FXCollections.observableArrayList();
    
    private boolean isDarkMode = false;

    @Override
    public void initialize(URL location, ResourceBundle resources) {
        // Competence Columns
        compNameCol.setCellValueFactory(new PropertyValueFactory<>("title"));
        compUserCol.setCellValueFactory(new PropertyValueFactory<>("userId"));

        // Evaluation Columns
        titleCol.setCellValueFactory(new PropertyValueFactory<>("title"));
        scoreCol.setCellValueFactory(new PropertyValueFactory<>("score"));
        statusCol.setCellValueFactory(new PropertyValueFactory<>("status"));
        dateCol.setCellValueFactory(new PropertyValueFactory<>("date"));

        statusCombo.setItems(FXCollections.observableArrayList("pending", "graded", "rejected"));

        // Competence Selection
        competenceTableView.getSelectionModel().selectedItemProperty().addListener((obs, oldVal, newVal) -> {
            if (newVal != null) {
                selectedCompetence = newVal;
                filterEvaluationsByCompetence(newVal);
            }
        });

        // Evaluation Selection
        tableView.getSelectionModel().selectedItemProperty().addListener((obs, oldVal, newVal) -> {
            if (newVal != null) {
                selectedEvaluation = newVal;
                loadSelectedEvaluation();
            }
        });

        searchField.textProperty().addListener((obs, oldVal, newVal) -> searchData());
    }

    public void setLoggedInUser(User user) {
        this.loggedInUser = user;
        refreshData();
    }

    private void loadSelectedEvaluation() {
        scoreField.setText(String.valueOf(selectedEvaluation.getScore()));
        statusCombo.setValue(selectedEvaluation.getStatus());
        commentArea.setText(selectedEvaluation.getComment());
    }

    @FXML
    private void refreshData() {
        try {
            // Load competences based on user role
            List<Competence> cList;
            if (loggedInUser != null) {
                String role = loggedInUser.getRole().toUpperCase();
                if (loggedInUser.isAdmin() || "TEACHER".equals(role)) {
                    // Teachers and admins see all competences
                    cList = competenceService.readAll();
                } else {
                    // Students only see their own competences
                    cList = competenceService.readAllByUser(loggedInUser.getId());
                }
            } else {
                cList = competenceService.readAll();
            }
            allCompetences = FXCollections.observableArrayList(cList);
            competenceTableView.setItems(allCompetences);

            List<Evaluation> eList = service.readAll();
            allEvaluations = FXCollections.observableArrayList(eList);
            tableView.setItems(allEvaluations);
            
            if (totalLabel != null) {
                totalLabel.setText("Total Evaluations: " + allEvaluations.size());
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    private void filterEvaluationsByCompetence(Competence comp) {
        List<Evaluation> filtered = allEvaluations.stream()
            .filter(e -> e.getCompetence() != null && e.getCompetence().getId() == comp.getId())
            .collect(Collectors.toList());
        tableView.setItems(FXCollections.observableArrayList(filtered));
    }

    private void searchData() {
        String text = searchField.getText().toLowerCase();
        
        // Search in competences
        competenceTableView.setItems(FXCollections.observableArrayList(
            allCompetences.stream()
                .filter(c -> c.getTitle().toLowerCase().contains(text))
                .collect(Collectors.toList())
        ));

        // Search in evaluations
        tableView.setItems(FXCollections.observableArrayList(
            allEvaluations.stream()
                .filter(e -> e.getTitle().toLowerCase().contains(text))
                .collect(Collectors.toList())
        ));
    }

    @FXML
    private void handleGrade() throws SQLException {
        if (selectedEvaluation == null) return;
        try {
            selectedEvaluation.setScore(Float.parseFloat(scoreField.getText()));
            selectedEvaluation.setStatus(statusCombo.getValue());
            selectedEvaluation.setComment(commentArea.getText());
            service.update(selectedEvaluation);
            refreshData();
            showAlert(Alert.AlertType.INFORMATION, "Success", "Evaluation graded successfully!");
        } catch (NumberFormatException e) {
            showAlert(Alert.AlertType.ERROR, "Error", "Invalid score format.");
        }
    }

    @FXML
    private void handleDelete() throws SQLException {
        if (selectedEvaluation == null) return;
        service.delete(selectedEvaluation);
        refreshData();
        showAlert(Alert.AlertType.INFORMATION, "Success", "Evaluation deleted successfully!");
    }

    @FXML
    private void goToAdd() {
        loadSubModule("/fxml/AjouterEvaluation.fxml");
    }

    @FXML
    private void goToProfile() {
        loadSubModule("/fxml/UserBasicPage.fxml");
    }

    private void loadSubModule(String fxmlPath) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource(fxmlPath));
            Parent root = loader.load();
            
            Object controller = loader.getController();
            if (controller instanceof AjouterEvaluationController) ((AjouterEvaluationController) controller).setLoggedInUser(loggedInUser);
            else if (controller instanceof UserBasicPageController) ((UserBasicPageController) controller).setLoggedInUser(loggedInUser);

            StackPane contentHost = (StackPane) mainContainer.getScene().lookup("#contentHost");
            if (contentHost != null) {
                contentHost.getChildren().setAll(root);
            } else {
                Stage stage = (Stage) mainContainer.getScene().getWindow();
                stage.setScene(new Scene(root));
            }
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    @FXML
    private void goBack() {
        try {
            Parent root = FXMLLoader.load(getClass().getResource("/fxml/SignIn.fxml"));
            Stage stage = (Stage) mainContainer.getScene().getWindow();
            stage.setScene(new Scene(root));
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    private void showAlert(Alert.AlertType type, String title, String msg) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setContentText(msg);
        alert.showAndWait();
    }
}
