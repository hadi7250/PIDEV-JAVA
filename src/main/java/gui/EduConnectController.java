package gui;

import entities.User;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.layout.BorderPane;
import javafx.scene.layout.StackPane;
import javafx.scene.layout.VBox;
import javafx.stage.Stage;

import java.io.IOException;

public class EduConnectController {

    @FXML private BorderPane shellRoot;
    @FXML private StackPane contentHost;
    @FXML private Label userWelcomeLabel;
    @FXML private Label roleLabel;
    @FXML private Button themeToggleBtn;
    @FXML private VBox adminMenu;
    @FXML private VBox teacherMenu;
    @FXML private VBox studentMenu;

    private User loggedInUser;
    private boolean isDarkMode = false;

    public void initUser(User user) {
        this.loggedInUser = user;
        userWelcomeLabel.setText("Welcome, " + user.getFirstName());
        
        String role = user.getRole().toUpperCase();
        roleLabel.setText("EduConnect Portal - " + role);

        // Visibility based on roles
        adminMenu.setVisible(user.isAdmin());
        adminMenu.setManaged(user.isAdmin());

        teacherMenu.setVisible("TEACHER".equals(role) || user.isAdmin());
        teacherMenu.setManaged("TEACHER".equals(role) || user.isAdmin());

        studentMenu.setVisible("STUDENT".equals(role) || user.isAdmin());
        studentMenu.setManaged("STUDENT".equals(role) || user.isAdmin());

        // Initial module load
        if (user.isAdmin()) openUserManagement();
        else if ("TEACHER".equals(role)) openEvaluationManagement();
        else openCompetences();
    }

    @FXML private void openUserManagement() { loadModule("/AfficherPersonne.fxml"); }
    @FXML private void openEvaluationManagement() { loadModule("/EvaluationManagement.fxml"); }
    @FXML private void openCompetences() { loadModule("/AfficherCompetences.fxml"); }
    @FXML private void openMyEvaluations() { loadModule("/StudentEvaluations.fxml"); }
    @FXML private void openProfile() { loadModule("/UserBasicPage.fxml"); }

    private void loadModule(String fxmlPath) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource(fxmlPath));
            Parent module = loader.load();
            
            // Inject user into sub-controllers
            Object controller = loader.getController();
            if (controller instanceof AfficherPersonne) ((AfficherPersonne) controller).setLoggedInUser(loggedInUser);
            else if (controller instanceof EvaluationManagementController) ((EvaluationManagementController) controller).setLoggedInUser(loggedInUser);
            else if (controller instanceof AfficherCompetencesController) ((AfficherCompetencesController) controller).setLoggedInUser(loggedInUser);
            else if (controller instanceof StudentEvaluationsController) ((StudentEvaluationsController) controller).setLoggedInUser(loggedInUser);
            else if (controller instanceof UserBasicPageController) ((UserBasicPageController) controller).setLoggedInUser(loggedInUser);

            contentHost.getChildren().setAll(module);
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    @FXML
    private void toggleTheme() {
        if (isDarkMode) {
            shellRoot.getStyleClass().remove("dark-theme");
            themeToggleBtn.setText("Dark mode");
            isDarkMode = false;
        } else {
            shellRoot.getStyleClass().add("dark-theme");
            themeToggleBtn.setText("Light mode");
            isDarkMode = true;
        }
    }

    @FXML
    private void handleLogout() {
        try {
            Parent root = FXMLLoader.load(getClass().getResource("/SignIn.fxml"));
            Stage stage = (Stage) shellRoot.getScene().getWindow();
            stage.setScene(new Scene(root));
            stage.setTitle("SignIn - EduConnect");
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
}
