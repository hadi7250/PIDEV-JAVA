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

public class StudentEvaluationsController implements Initializable {
    @FXML private VBox mainContainer;
    @FXML private TableView<Evaluation> tableView;
    @FXML private TableColumn<Evaluation, String> compCol;
    @FXML private TableColumn<Evaluation, String> titleCol;
    @FXML private TableColumn<Evaluation, Float> scoreCol;
    @FXML private TableColumn<Evaluation, LocalDateTime> dateCol;
    @FXML private TableColumn<Evaluation, String> statusCol;

    @FXML private TextField searchField;
    @FXML private ComboBox<String> statusFilter;

    private EvaluationService service = new EvaluationService();
    private User loggedInUser;
    private ObservableList<Evaluation> allEvaluations = FXCollections.observableArrayList();
    private boolean isDarkMode = false;

    @Override
    public void initialize(URL location, ResourceBundle resources) {
        compCol.setCellValueFactory(new PropertyValueFactory<>("competence"));
        titleCol.setCellValueFactory(new PropertyValueFactory<>("title"));
        scoreCol.setCellValueFactory(new PropertyValueFactory<>("score"));
        dateCol.setCellValueFactory(new PropertyValueFactory<>("date"));
        statusCol.setCellValueFactory(new PropertyValueFactory<>("status"));

        statusFilter.setItems(FXCollections.observableArrayList("pending", "graded", "rejected"));
        searchField.textProperty().addListener((obs, oldVal, newVal) -> applyFilters());
        statusFilter.valueProperty().addListener((obs, oldVal, newVal) -> applyFilters());
    }

    public void setLoggedInUser(User user) {
        this.loggedInUser = user;
        refreshTable();
    }

    private void refreshTable() {
        try {
            if (loggedInUser != null) {
                List<Evaluation> list = service.readByStudent(loggedInUser.getId());
                allEvaluations = FXCollections.observableArrayList(list);
                tableView.setItems(allEvaluations);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    private void applyFilters() {
        String search = searchField.getText().toLowerCase();
        String status = statusFilter.getValue();

        List<Evaluation> filtered = allEvaluations.stream()
            .filter(e -> e.getTitle().toLowerCase().contains(search) || (e.getCompetence() != null && e.getCompetence().getTitle().toLowerCase().contains(search)))
            .filter(e -> status == null || e.getStatus().equalsIgnoreCase(status))
            .collect(Collectors.toList());

        tableView.setItems(FXCollections.observableArrayList(filtered));
    }

    @FXML
    private void handleExport() {
        // Placeholder for CSV export logic
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
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/AfficherCompetences.fxml"));
            Parent root = loader.load();
            AfficherCompetencesController controller = loader.getController();
            controller.setLoggedInUser(loggedInUser);
            Stage stage = (Stage) mainContainer.getScene().getWindow();
            stage.setScene(new Scene(root));
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
}