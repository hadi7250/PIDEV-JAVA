package utils;

import app.Main;
import javafx.geometry.Pos;
import javafx.stage.Stage;
import javafx.util.Duration;
import org.controlsfx.control.Notifications;

public class NotificationService {

    /**
     * Toutes les notifications utilisent le même style (pas de couleur
     * succès/erreur distincte).
     */
    public void success(String title, String text) {
        showNeutral(title, text, 3);
    }

    public void warning(String title, String text) {
        showNeutral(title, text, 4);
    }

    public void error(String title, String text) {
        showNeutral(title, text, 5);
    }

    private void showNeutral(String title, String text, int seconds) {
        Notifications n = Notifications.create()
                .title(title)
                .text(text)
                .position(Pos.TOP_RIGHT)
                .hideAfter(Duration.seconds(seconds));
        Stage stage = Main.getPrimaryStage();
        if (stage != null) {
            n.owner(stage);
        }
        n.showInformation();
        NotificationStyling.afterControlsFxShow();
    }
}
