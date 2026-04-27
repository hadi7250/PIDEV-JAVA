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
    @FXML private Button themeToggleBtn;
    @FXML private Button btnCompetences;
    @FXML private Button btnEvaluations;
    @FXML private Button btnStudentEvaluations;
    @FXML private Button btnAdmin;

    private User loggedInUser;
    private boolean isDarkMode = false;

    public void initUser(User user) {
        this.loggedInUser = user;
        
        String role = user.getRole().toUpperCase();

        // Visibility based on roles
        btnAdmin.setVisible(user.isAdmin());
        btnAdmin.setManaged(user.isAdmin());

        boolean isTeacher = "TEACHER".equals(role);
        btnEvaluations.setVisible(isTeacher || user.isAdmin());
        btnEvaluations.setManaged(isTeacher || user.isAdmin());

        boolean isStudent = "STUDENT".equals(role);
        btnStudentEvaluations.setVisible(isStudent);
        btnStudentEvaluations.setManaged(isStudent);

        // Initial module load
        if (user.isAdmin()) openUserManagement();
        else if (isTeacher) openEvaluationManagement();
        else {
            openCompetences();
        }
    }

    @FXML private void openUserManagement() { 
        loadModule("/fxml/AfficherPersonne.fxml"); 
        setActive(btnAdmin);
    }
    @FXML private void openEvaluationManagement() { 
        loadModule("/fxml/EvaluationManagement.fxml"); 
        setActive(btnEvaluations);
    }
    @FXML private void openCompetences() { 
        loadModule("/fxml/AfficherCompetences.fxml"); 
        setActive(btnCompetences);
    }
    @FXML private void openMyEvaluations() { 
        loadModule("/fxml/StudentEvaluations.fxml"); 
        setActive(btnStudentEvaluations);
    }

    private void setActive(Button active) {
        for (Button button : new Button[]{btnCompetences, btnEvaluations, btnStudentEvaluations, btnAdmin}) {
            if (button != null) {
                button.getStyleClass().remove("nav-btn-active");
            }
        }
        if (active != null) {
            active.getStyleClass().add("nav-btn-active");
        }
    }

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
            Parent root = FXMLLoader.load(getClass().getResource("/fxml/SignIn.fxml"));
            Stage stage = (Stage) shellRoot.getScene().getWindow();
            stage.setScene(new Scene(root));
            stage.setTitle("SignIn - EduConnect");
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
}
