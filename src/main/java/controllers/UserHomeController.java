package controllers;

import entities.User;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.layout.BorderPane;
import javafx.scene.layout.VBox;
import javafx.stage.Stage;
import utils.SessionManager;

import java.io.IOException;
import java.util.prefs.Preferences;

public class UserHomeController {
    private static final String DARK_MODE_KEY = "darkMode";

    @FXML private BorderPane dashboardRoot;
    @FXML private Label welcomeLabel;
    @FXML private Label mainWelcomeLabel;
    @FXML private Button themeToggleBtn;
    @FXML private VBox forumCard;
    @FXML private VBox quizCard;
    @FXML private VBox coursesCard;
    @FXML private VBox profileCard;
    @FXML private VBox eventsCard;

    private final Preferences preferences = Preferences.userNodeForPackage(UserHomeController.class);
    private boolean darkMode;

    public void initialize() {

        darkMode = preferences.getBoolean(DARK_MODE_KEY, false);
        applyTheme();
        updateWelcomeMessage();
    }

    private void updateWelcomeMessage() {
        entities.User currentUser = utils.SessionManager.getInstance().getCurrentUser();
        if (currentUser != null) {
            String fullName = currentUser.getFirstName() + " " + currentUser.getLastName();

            welcomeLabel.setText("Welcome, " + currentUser.getFirstName());
            mainWelcomeLabel.setText("Welcome back, " + fullName + "!");
        }
    }

    @FXML
    private void openForum() {
        loadModule("/fxml/ForumDashboard.fxml", "Forum");
    }

    @FXML
    private void openQuiz() {
        loadModule("/fxml/quiz/QuizUserView.fxml", "Quiz");
    }

    @FXML
    private void openCourses() {
        loadModule("/fxml/CoursDashboard.fxml", "Courses");
    }

    @FXML
    private void openProfile() {
        loadModule("/fxml/UserBasicPage.fxml", "My Profile");
    }

    @FXML
    private void openEvents() {
        loadModule("/fxml/front_events.fxml", "Events");
    }

    private void loadModule(String fxmlPath, String title) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource(fxmlPath));
            Parent root = loader.load();

            // If loading profile page, pass the user
            if (fxmlPath.contains("UserBasicPage")) {
                gui.UserBasicPageController controller = loader.getController();
                controller.setLoggedInUser(SessionManager.getInstance().getCurrentUser());
            }

            Stage stage = (Stage) dashboardRoot.getScene().getWindow();
            stage.setScene(new Scene(root));
            stage.setTitle("EduConnect - " + title);
            stage.setMaximized(true);
            stage.show();
        } catch (IOException e) {
            throw new IllegalStateException("Failed to load " + fxmlPath, e);
        }
    }

    @FXML
    private void logout() {
        SessionManager.getInstance().logout();
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/SignIn.fxml"));
            Parent root = loader.load();
            Stage stage = (Stage) dashboardRoot.getScene().getWindow();
            stage.setScene(new Scene(root));
            stage.setTitle("EduConnect - Sign In");
            stage.setMaximized(false);
            stage.centerOnScreen();
            stage.show();
        } catch (IOException e) {
            throw new IllegalStateException("Failed to load login screen", e);
        }
    }

    @FXML
    private void toggleTheme() {
        darkMode = !darkMode;
        preferences.putBoolean(DARK_MODE_KEY, darkMode);
        applyTheme();
        // Sync with ThemeManager so all registered scenes update too
        if (controllers.ThemeManager.getInstance().isDarkMode() != darkMode) {
            controllers.ThemeManager.getInstance().toggle();
        }
    }


    private void applyTheme() {
        if (dashboardRoot != null) {
            dashboardRoot.getStyleClass().remove("dark-mode");
            if (darkMode) {
                dashboardRoot.getStyleClass().add("dark-mode");
            }
        }
        if (themeToggleBtn != null) {
            themeToggleBtn.setText(darkMode ? "Light mode" : "Dark mode");
        }
    }
}
