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

public class AdminHomeController {
    private static final String DARK_MODE_KEY = "darkMode";

    @FXML private BorderPane dashboardRoot;
    @FXML private Label welcomeLabel;
    @FXML private Label mainWelcomeLabel;
    @FXML private Button themeToggleBtn;
    @FXML private VBox usersCard;
    @FXML private VBox forumCard;
    @FXML private VBox quizCard;
    @FXML private VBox coursesCard;
    @FXML private VBox eventsCard;

    private final Preferences preferences = Preferences.userNodeForPackage(AdminHomeController.class);
    private boolean darkMode;

    @FXML
    public void initialize() {
        darkMode = preferences.getBoolean(DARK_MODE_KEY, false);
        applyTheme();
        updateWelcomeMessage();
    }

    private void updateWelcomeMessage() {
        entities.User currentUser = utils.SessionManager.getInstance().getCurrentUser();
        if (currentUser != null) {
            String fullName = currentUser.getFirstName() + " " + currentUser.getLastName();

            welcomeLabel.setText("Admin: " + currentUser.getFirstName());
            mainWelcomeLabel.setText("Admin Dashboard - " + fullName);
        }
    }

    @FXML
    private void openUserManagement() {
        loadAdminModule("/fxml/AfficherPersonne.fxml", "User Management", "Admin Users");
    }

    @FXML
    private void openForumManagement() {
        loadAdminModule("/fxml/AdminForumDashboard.fxml", "Forum Management", "Admin Forum");
    }

    @FXML
    private void openQuizManagement() {
        loadAdminModule("/fxml/quiz/MainView.fxml", "Quiz Management", "Admin Quiz");
    }

    @FXML
    private void openCoursesManagement() {
        loadAdminModule("/fxml/AdminCoursDashboard.fxml", "Courses Management", "Admin Cours");
    }

    @FXML
    private void openEventsManagement() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/admin_dashboard.fxml"));
            Parent root = loader.load();
            Stage stage = (Stage) dashboardRoot.getScene().getWindow();
            stage.setScene(new Scene(root));
            stage.setTitle("EduConnect - Events Management");
            stage.setMaximized(true);
            stage.show();
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    private void loadAdminModule(String fxmlPath, String title, String navButton) {
        try {
            // Load the main EduConnect layout
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/EduConnectLayout.fxml"));
            Parent root = loader.load();
            EduConnectController controller = loader.getController();

            Stage stage = (Stage) dashboardRoot.getScene().getWindow();
            stage.setScene(new Scene(root));
            stage.setTitle("EduConnect - " + title);
            stage.setMaximized(true);
            stage.show();

            // After layout loads, navigate to the appropriate admin panel
            javafx.application.Platform.runLater(() -> {
                switch (navButton) {
                    case "Admin Users":
                        controller.openAdminUsers();
                        break;
                    case "Admin Forum":
                        controller.openAdminForum();
                        break;
                    case "Admin Quiz":
                        controller.openAdminQuiz();
                        break;
                    case "Admin Cours":
                        controller.openAdminCours();
                        break;
                }
            });
        } catch (IOException e) {
            throw new IllegalStateException("Failed to load admin module: " + fxmlPath, e);
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
