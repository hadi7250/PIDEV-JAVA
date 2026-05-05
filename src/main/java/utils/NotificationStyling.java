package utils;

import app.MainFx;
import javafx.application.Platform;
import javafx.scene.Node;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Labeled;
import javafx.scene.paint.Color;
import javafx.scene.text.Font;
import javafx.scene.text.FontWeight;
import javafx.stage.Window;
import javafx.util.Duration;
import javafx.animation.PauseTransition;

import java.net.URL;
import java.util.Set;
import java.util.function.Consumer;

/**
 * Les toasts ControlsFX s’ouvrent dans un {@link Scene} à part (popup) : les feuilles de
 * style du {@link app.MainFx#switchScene} ne s’y appliquent pas. Cette
 * classe ajoute {@code modern.css} sur ce scene et, en secours, colore le texte en bleu
 * (sinon thème intégré = fond sombre / texte illisible).
 */
public final class NotificationStyling {

    private static String modernCssHref;

    private NotificationStyling() {}

    public static String getModernStylesheetHref() {
        if (modernCssHref == null) {
            URL url = MainFx.class.getResource("/styles/modern.css");
            if (url != null) {
                modernCssHref = url.toExternalForm();
            }
        }
        return modernCssHref;
    }

    /**
     * À appeler juste après {@code showInformation} / {@code showWarning} : la fenêtre
     * du toast n’existe pas toujours dans le 1er {@link Platform#runLater}.
     */
    public static void afterControlsFxShow() {
        String href = getModernStylesheetHref();
        if (href == null) {
            return;
        }
        Runnable work = () -> {
            for (Window w : Window.getWindows()) {
                Scene s = w.getScene();
                if (s == null || s.getRoot() == null) {
                    continue;
                }
                touchNotificationScene(s, href);
            }
        };
        Platform.runLater(() -> {
            work.run();
            Platform.runLater(work);
        });
        PauseTransition t = new PauseTransition(Duration.millis(120));
        t.setOnFinished(e -> {
            for (Window w : Window.getWindows()) {
                Scene s = w.getScene();
                if (s != null && s.getRoot() != null) {
                    touchNotificationScene(s, href);
                }
            }
        });
        t.playFromStart();
    }

    private static void touchNotificationScene(Scene s, String href) {
        Node root = s.getRoot();
        root.applyCss();
        if (root instanceof Parent p) {
            p.layout();
        }
        if (root.lookup(".notification-bar") == null) {
            return;
        }
        if (!s.getStylesheets().contains(href)) {
            s.getStylesheets().add(href);
        }
        forceBlueLabels(root);
    }

    /** Contourne les styles inline / thème intégré des labels (ControlsFX: classes .title / .text). */
    private static void forceBlueLabels(Node anyRoot) {
        Node bar = anyRoot.lookup(".notification-bar");
        if (bar == null) {
            return;
        }
        Labeled titleL = firstLabeledWithClass(bar, "title");
        Labeled textL = firstLabeledWithClass(bar, "text");
        if (titleL != null) {
            titleL.setTextFill(Color.web("#1e3a8a"));
            titleL.setFont(Font.font(null, FontWeight.BOLD, 15.0));
        }
        if (textL != null) {
            textL.setTextFill(Color.web("#2563eb"));
            textL.setFont(Font.font(13.0));
        }
        if (titleL == null && textL == null) {
            // Fallback: tout mettre en bleu lisible (l’ordre de lookupAll n’est pas fiable)
            forAllLabelsIn(bar, lab -> {
                lab.setTextFill(Color.web("#2563eb"));
                lab.setFont(Font.font(13.0));
            });
        }
    }

    private static Set<Node> labelsUnder(Node bar) {
        return bar.lookupAll(".label");
    }

    private static Labeled firstLabeledWithClass(Node bar, String sc) {
        for (Node n : labelsUnder(bar)) {
            if (n instanceof Labeled lab && lab.getStyleClass().contains(sc)) {
                return lab;
            }
        }
        return null;
    }

    private static void forAllLabelsIn(Node bar, Consumer<Labeled> c) {
        for (Node n : labelsUnder(bar)) {
            if (n instanceof Labeled lab) {
                c.accept(lab);
            }
        }
    }
}
