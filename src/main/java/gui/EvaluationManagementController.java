package gui;

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
import javafx.scene.layout.VBox;
import javafx.stage.Stage;
import services.EvaluationService;

import java.io.IOException;
import java.net.URL;
import java.sql.SQLException;
import java.time.LocalDateTime;
import java.util.List;
import java.util.ResourceBundle;
import java.util.stream.Collectors;

public class EvaluationManagementController implements Initializable {
    @FXML private VBox mainContainer;
    @FXML private TableView<Evaluation> tableView;
    @FXML private TableColumn<Evaluation, String> compCol;
    @FXML private TableColumn<Evaluation, String> titleCol;
    @FXML private TableColumn<Evaluation, Float> scoreCol;
    @FXML private TableColumn<Evaluation, String> statusCol;
    @FXML private TableColumn<Evaluation, LocalDateTime> dateCol;

    @FXML private TextField searchField;
    @FXML private TextField scoreField;
    @FXML private ComboBox<String> statusCombo;
    @FXML private TextArea commentArea;

    private EvaluationService service = new EvaluationService();
    private User loggedInUser;
    private Evaluation selectedEvaluation;
    private ObservableList<Evaluation> allEvaluations = FXCollections.observableArrayList();
    private boolean isDarkMode = false;

    @Override
    public void initialize(URL location, ResourceBundle resources) {
        compCol.setCellValueFactory(new PropertyValueFactory<>("competence"));
        titleCol.setCellValueFactory(new PropertyValueFactory<>("title"));
        scoreCol.setCellValueFactory(new PropertyValueFactory<>("score"));
        statusCol.setCellValueFactory(new PropertyValueFactory<>("status"));
        dateCol.setCellValueFactory(new PropertyValueFactory<>("date"));

        statusCombo.setItems(FXCollections.observableArrayList("pending", "graded", "rejected"));

        tableView.getSelectionModel().selectedItemProperty().addListener((obs, oldVal, newVal) -> {
            if (newVal != null) {
                selectedEvaluation = newVal;
                loadSelectedEvaluation();
            }
        });

        searchField.textProperty().addListener((obs, oldVal, newVal) -> searchEvaluations());
    }

    public void setLoggedInUser(User user) {
        this.loggedInUser = user;
        refreshTable();
    }

    private void loadSelectedEvaluation() {
        scoreField.setText(String.valueOf(selectedEvaluation.getScore()));
        statusCombo.setValue(selectedEvaluation.getStatus());
        commentArea.setText(selectedEvaluation.getComment());
    }

    private void refreshTable() {
        try {
            List<Evaluation> list = service.readAll();
            allEvaluations = FXCollections.observableArrayList(list);
            tableView.setItems(allEvaluations);
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    private void searchEvaluations() {
        String text = searchField.getText().toLowerCase();
        tableView.setItems(FXCollections.observableArrayList(
            allEvaluations.stream()
                .filter(e -> e.getTitle().toLowerCase().contains(text) || e.getCompetence().getTitle().toLowerCase().contains(text))
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
            refreshTable();
            showAlert(Alert.AlertType.INFORMATION, "Success", "Evaluation graded successfully!");
        } catch (NumberFormatException e) {
            showAlert(Alert.AlertType.ERROR, "Error", "Invalid score format.");
        }
    }

    @FXML
    private void handleDelete() throws SQLException {
        if (selectedEvaluation == null) return;
        service.delete(selectedEvaluation);
        refreshTable();
        showAlert(Alert.AlertType.INFORMATION, "Success", "Evaluation deleted successfully!");
    }

    @FXML
    private void goToAdd() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/AjouterEvaluation.fxml"));
            Parent root = loader.load();
            AjouterEvaluationController controller = loader.getController();
            controller.setLoggedInUser(loggedInUser);
            Stage stage = (Stage) mainContainer.getScene().getWindow();
            stage.setScene(new Scene(root));
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    @FXML
    private void toggleTheme() {
        // (Theme logic)
    }

    @FXML
    private void goToProfile() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/UserBasicPage.fxml"));
            Parent root = loader.load();
            UserBasicPageController controller = loader.getController();
            controller.setLoggedInUser(loggedInUser);
            Stage stage = (Stage) mainContainer.getScene().getWindow();
            stage.setScene(new Scene(root));
            stage.setTitle("EduConnect - My Profile");
        } catch (IOException e) {
            e.printStackTrace();
            showAlert(Alert.AlertType.ERROR, "Error", "Could not load profile page: " + e.getMessage());
        }
    }

    @FXML
    private void goBack() {
        // (Back logic)
    }

    private void showAlert(Alert.AlertType type, String title, String msg) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setContentText(msg);
        alert.showAndWait();
    }
}