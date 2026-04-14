package controllers;

import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.control.Button;
import javafx.scene.layout.BorderPane;
import javafx.scene.layout.StackPane;

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
    @FXML private Button themeToggleBtn;

    private final Preferences preferences = Preferences.userNodeForPackage(EduConnectController.class);
    private boolean darkMode;

    @FXML
    public void initialize() {
        darkMode = preferences.getBoolean(DARK_MODE_KEY, false);
        applyTheme();
        openCourses();
    }

    @FXML
    private void openCourses() {
        load("/fxml/CoursDashboard.fxml");
        setActive(btnCourses);
    }

    @FXML
    private void openAdmin() {
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
        for (Button b : new Button[]{btnCourses, btnAdmin, btnForum, btnAdminForum}) {
            if (b != null) b.getStyleClass().remove("nav-btn-active");
        }
        if (active != null && !active.getStyleClass().contains("nav-btn-active")) {
            active.getStyleClass().add("nav-btn-active");
        }
    }
}
