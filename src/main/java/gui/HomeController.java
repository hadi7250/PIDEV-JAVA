package gui;

import entities.User;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.layout.StackPane;
import javafx.scene.layout.VBox;
import javafx.stage.Stage;
import services.CompetenceService;
import services.EvaluationService;

import java.io.IOException;
import java.sql.SQLException;

public class HomeController {
    @FXML private StackPane mainContainer;
    @FXML private Label welcomeLabel;
    @FXML private Label roleLabel;
    @FXML private Label statsLabel;
    @FXML private VBox quickActionsBox;

    private User loggedInUser;
    private final CompetenceService competenceService = new CompetenceService();
    private final EvaluationService evaluationService = new EvaluationService();

    public void setLoggedInUser(User user) {
        this.loggedInUser = user;
        updateHomeContent();
        loadQuickActions();
    }

    private void updateHomeContent() {
        if (loggedInUser == null) return;

        String role = loggedInUser.getRole();
        String firstName = loggedInUser.getPrenom();
        String lastName = loggedInUser.getNom();

        welcomeLabel.setText("Welcome back, " + firstName + " " + lastName + "!");
        roleLabel.setText("Role: " + role);

        // Load statistics based on role
        try {
            String stats = getUserStats();
            statsLabel.setText(stats);
        } catch (SQLException e) {
            statsLabel.setText("Unable to load statistics");
            e.printStackTrace();
        }
    }

    private String getUserStats() throws SQLException {
        String role = loggedInUser.getRole().toUpperCase();

        if ("STUDENT".equals(role)) {
            int competenceCount = competenceService.readAllByUser(loggedInUser.getId()).size();
            int evaluationCount = evaluationService.readByStudent(loggedInUser.getId()).size();
            return String.format("Your Competences: %d | Your Evaluations: %d", competenceCount, evaluationCount);
        } else if ("TEACHER".equals(role)) {
            int totalCompetences = competenceService.readAll().size();
            int totalEvaluations = evaluationService.readAll().size();
            return String.format("Total Student Competences: %d | Your Evaluations: %d", totalCompetences, totalEvaluations);
        } else if (loggedInUser.isAdmin()) {
            int totalUsers = 0; // Would need UserService method
            int totalCompetences = competenceService.readAll().size();
            int totalEvaluations = evaluationService.readAll().size();
            return String.format("Total Users: %d | Total Competences: %d | Total Evaluations: %d",
                               totalUsers, totalCompetences, totalEvaluations);
        }

        return "Statistics not available";
    }

    private void loadQuickActions() {
        quickActionsBox.getChildren().clear();

        String role = loggedInUser.getRole().toUpperCase();

        if ("STUDENT".equals(role)) {
            addQuickActionButton("📚 Manage My Competences", this::goToCompetences);
            addQuickActionButton("📝 Take Evaluations", this::goToEvaluations);
            addQuickActionButton("👤 View Profile", this::goToProfile);
        } else if ("TEACHER".equals(role)) {
            addQuickActionButton("👥 View Student Competences", this::goToCompetences);
            addQuickActionButton("📊 Manage Evaluations", this::goToEvaluations);
            addQuickActionButton("➕ Create New Assessment", this::createNewEvaluation);
            addQuickActionButton("👤 View Profile", this::goToProfile);
        } else if (loggedInUser.isAdmin()) {
            addQuickActionButton("👥 Manage Users", this::goToUserManagement);
            addQuickActionButton("📚 View All Competences", this::goToCompetences);
            addQuickActionButton("📊 View All Evaluations", this::goToEvaluations);
            addQuickActionButton("👤 View Profile", this::goToProfile);
        }
    }

    private void addQuickActionButton(String text, Runnable action) {
        Button button = new Button(text);
        button.getStyleClass().add("quick-action-btn");
        button.setMaxWidth(Double.MAX_VALUE);
        button.setOnAction(e -> action.run());
        quickActionsBox.getChildren().add(button);
    }

    @FXML
    private void goToCompetences() {
        loadSubModule("/fxml/AfficherCompetences.fxml");
    }

    @FXML
    private void goToEvaluations() {
        if ("STUDENT".equals(loggedInUser.getRole().toUpperCase())) {
            loadSubModule("/fxml/StudentEvaluations.fxml");
        } else {
            loadSubModule("/fxml/EvaluationManagement.fxml");
        }
    }

    @FXML
    private void goToUserManagement() {
        loadSubModule("/fxml/AfficherPersonne.fxml");
    }

    @FXML
    private void goToProfile() {
        loadSubModule("/fxml/UserBasicPage.fxml");
    }

    @FXML
    private void createNewEvaluation() {
        loadSubModule("/fxml/AjouterEvaluation.fxml");
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

    private void loadSubModule(String fxmlPath) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource(fxmlPath));
            Parent root = loader.load();

            Object controller = loader.getController();
            if (controller instanceof AfficherPersonne) ((AfficherPersonne) controller).setLoggedInUser(loggedInUser);
            else if (controller instanceof EvaluationManagementController) ((EvaluationManagementController) controller).setLoggedInUser(loggedInUser);
            else if (controller instanceof AfficherCompetencesController) ((AfficherCompetencesController) controller).setLoggedInUser(loggedInUser);
            else if (controller instanceof StudentEvaluationsController) ((StudentEvaluationsController) controller).setLoggedInUser(loggedInUser);
            else if (controller instanceof UserBasicPageController) ((UserBasicPageController) controller).setLoggedInUser(loggedInUser);
            else if (controller instanceof AjouterEvaluationController) ((AjouterEvaluationController) controller).setLoggedInUser(loggedInUser);

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
}
