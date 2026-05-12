package controllers;

import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.layout.BorderPane;
import javafx.scene.layout.StackPane;
import utils.SessionManager;
import controllers.ThemeManager;

import java.io.IOException;
import java.util.prefs.Preferences;

public class EduConnectController {
    private static final String DARK_MODE_KEY = "darkMode";

    @FXML private BorderPane shellRoot;
    @FXML private StackPane contentHost;
    @FXML private Button btnCourses;
    @FXML private Button btnAdmin;
    @FXML private Button btnForum;
    @FXML private Button btnAdminForum;
    @FXML private Button btnAdminUsers;
    @FXML private Button btnMyProfile;
    @FXML private Button btnQuiz;
    @FXML private Button btnAdminQuiz;
    @FXML private Button btnLogout;
    @FXML private Label userProfileLabel;
    @FXML private Button themeToggleBtn;

    private final Preferences preferences = Preferences.userNodeForPackage(EduConnectController.class);
    private boolean darkMode;

    @FXML
    public void initialize() {
        darkMode = preferences.getBoolean(DARK_MODE_KEY, false);
        applyTheme();
        updateUserDisplay();
        openCourses();
    }

    @FXML
    private void openCourses() {
        load("/fxml/CoursDashboard.fxml");
        setActive(btnCourses);
    }

    @FXML
    void openAdminCours() {
        load("/fxml/AdminCoursDashboard.fxml");
        setActive(btnAdmin);
    }

    @FXML
    private void openForum() {
        load("/fxml/ForumDashboard.fxml");
        setActive(btnForum);
    }

    @FXML
    void openAdminForum() {
        load("/fxml/AdminForumDashboard.fxml");
        setActive(btnAdminForum);
    }

    @FXML
    private void openQuiz() {
        load("/fxml/quiz/QuizUserView.fxml");
        setActive(btnQuiz);
    }

    @FXML
    void openAdminQuiz() {
        load("/fxml/quiz/MainView.fxml");
        setActive(btnAdminQuiz);
    }

    @FXML
    private void openMyProfile() {
        load("/fxml/UserBasicPage.fxml");
        setActive(btnMyProfile);
    }

    @FXML
    void openAdminUsers() {
        load("/fxml/AfficherPersonne.fxml");
        setActive(btnAdminUsers);
    }

    @FXML
    private void logout() {
        SessionManager.getInstance().logout();
        updateUserDisplay();

        contentHost.getChildren().clear();
        try {
            Parent loginRoot = FXMLLoader.load(getClass().getResource("/fxml/SignIn.fxml"));
            shellRoot.getScene().setRoot(loginRoot);
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
        if (ThemeManager.getInstance().isDarkMode() != darkMode) {
            ThemeManager.getInstance().toggle();
        }
    }

    private void load(String fxmlPath) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource(fxmlPath));
            Parent view = loader.load();
            // Apply current theme BEFORE adding to scene graph
            view.getStyleClass().remove("dark-mode");
            if (darkMode) {
                view.getStyleClass().add("dark-mode");
                // Force background via inline style as fallback for shell-root
                if (view.getStyleClass().contains("shell-root")) {
                    view.setStyle("-fx-background-color: #0d1f1a;");
                }
            } else {
                view.setStyle("");
            }
            contentHost.getChildren().setAll(view);
        } catch (IOException e) {
            throw new IllegalStateException("Failed to load " + fxmlPath, e);
        }
    }

    private void applyTheme() {
        if (shellRoot != null) {
            shellRoot.getStyleClass().remove("dark-mode");
            if (darkMode) {
                shellRoot.getStyleClass().add("dark-mode");
            }
        }
        // Also apply to any content loaded in contentHost
        if (contentHost != null && !contentHost.getChildren().isEmpty()) {
            contentHost.getChildren().forEach(node -> {
                node.getStyleClass().remove("dark-mode");
                if (darkMode) {
                    node.getStyleClass().add("dark-mode");
                    if (node.getStyleClass().contains("shell-root")) {
                        node.setStyle("-fx-background-color: #0d1f1a;");
                    }
                } else {
                    node.setStyle("");
                }
            });
        }
        if (themeToggleBtn != null) {
            themeToggleBtn.setText(darkMode ? "Light mode" : "Dark mode");
        }
    }

    private void setActive(Button active) {
        for (Button button : new Button[]{btnCourses, btnAdmin, btnForum, btnAdminForum, btnAdminUsers, btnMyProfile, btnQuiz, btnAdminQuiz}) {
            if (button != null) {
                button.getStyleClass().remove("nav-btn-active");
            }
        }
        if (active != null && !active.getStyleClass().contains("nav-btn-active")) {
            active.getStyleClass().add("nav-btn-active");
        }
    }

    private void updateUserDisplay() {
        if (SessionManager.getInstance().isLoggedIn()) {
            userProfileLabel.setText("User: " + SessionManager.getInstance().getCurrentUserFullName());
            btnMyProfile.setVisible(true);
            btnMyProfile.setManaged(true);
            btnLogout.setVisible(true);
            btnLogout.setManaged(true);

            boolean isAdmin = SessionManager.getInstance().isCurrentUserAdmin();

            // Show/hide admin buttons based on role
            btnAdmin.setVisible(isAdmin);
            btnAdmin.setManaged(isAdmin);
            btnAdminForum.setVisible(isAdmin);
            btnAdminForum.setManaged(isAdmin);
            btnAdminUsers.setVisible(isAdmin);
            btnAdminUsers.setManaged(isAdmin);
            btnAdminQuiz.setVisible(isAdmin);
            btnAdminQuiz.setManaged(isAdmin);
        } else {
            userProfileLabel.setText("Guest");
            btnMyProfile.setVisible(false);
            btnMyProfile.setManaged(false);
            btnLogout.setVisible(false);
            btnLogout.setManaged(false);
            // Hide admin buttons for guests
            btnAdmin.setVisible(false);
            btnAdmin.setManaged(false);
            btnAdminForum.setVisible(false);
            btnAdminForum.setManaged(false);
            btnAdminUsers.setVisible(false);
            btnAdminUsers.setManaged(false);
            btnAdminQuiz.setVisible(false);
            btnAdminQuiz.setManaged(false);
        }
    }
}
