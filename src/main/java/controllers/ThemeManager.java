package controllers;

import javafx.scene.Scene;
import java.util.ArrayList;
import java.util.List;

/**
 * Singleton that tracks all open Scenes and applies/removes
 * the "dark-mode" CSS class on the root of every one of them.
 * Any controller that opens a new window registers its Scene here.
 */
public class ThemeManager {

    private static final ThemeManager INSTANCE = new ThemeManager();
    private boolean darkMode = false;
    private final List<Scene> scenes = new ArrayList<>();

    private ThemeManager() {}

    public static ThemeManager getInstance() { return INSTANCE; }

    /** Register a scene so it receives theme changes automatically. */
    public void register(Scene scene) {
        scenes.add(scene);
        applyTo(scene); // apply current theme immediately
    }

    /** Unregister when a window closes. */
    public void unregister(Scene scene) {
        scenes.remove(scene);
    }

    public boolean isDarkMode() { return darkMode; }

    /** Toggle and propagate to every registered scene. */
    public void toggle() {
        darkMode = !darkMode;
        scenes.forEach(this::applyTo);
    }

    private void applyTo(Scene scene) {
        if (scene == null || scene.getRoot() == null) return;
        var classes = scene.getRoot().getStyleClass();
        if (darkMode) {
            if (!classes.contains("dark-mode")) classes.add("dark-mode");
        } else {
            classes.remove("dark-mode");
        }
    }
}
