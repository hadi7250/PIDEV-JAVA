package controllers;

import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.layout.BorderPane;
import javafx.scene.layout.StackPane;
import utils.SessionManager;

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
    private void openAdminCours() {
        load("/fxml/AdminCoursDashboard.fxml");
        setActive(btnAdmin);
    }

    @FXML
    private void openForum() {
        load("/fxml/ForumDashboard.fxml");
        setActive(btnForum);
    }

    @FXML
    private void openAdminForum() {
        load("/fxml/AdminForumDashboard.fxml");
        setActive(btnAdminForum);
    }

    @FXML
    private void openMyProfile() {
        load("/fxml/UserBasicPage.fxml");
        setActive(btnMyProfile);
    }

    @FXML
    private void openAdminUsers() {
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
    }

    private void load(String fxmlPath) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource(fxmlPath));
            Parent view = loader.load();
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
        if (themeToggleBtn != null) {
            themeToggleBtn.setText(darkMode ? "Light mode" : "Dark mode");
        }
    }

    private void setActive(Button active) {
        for (Button button : new Button[]{btnCourses, btnAdmin, btnForum, btnAdminForum, btnAdminUsers, btnMyProfile}) {
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

            // Temporarily bypass role-based admin navigation hiding so AI/forum flows
            // can be tested from the sidebar regardless of the logged-in user role.
            // boolean isAdmin = SessionManager.getInstance().isCurrentUserAdmin();
            btnAdmin.setVisible(true);
            btnAdmin.setManaged(true);
            btnAdminForum.setVisible(true);
            btnAdminForum.setManaged(true);
            btnAdminUsers.setVisible(true);
            btnAdminUsers.setManaged(true);
        } else {
            userProfileLabel.setText("Guest");
            btnMyProfile.setVisible(false);
            btnMyProfile.setManaged(false);
            btnLogout.setVisible(false);
            btnLogout.setManaged(false);
            btnAdmin.setVisible(true);
            btnAdmin.setManaged(true);
            btnAdminForum.setVisible(true);
            btnAdminForum.setManaged(true);
            btnAdminUsers.setVisible(true);
            btnAdminUsers.setManaged(true);
        }
    }
}
