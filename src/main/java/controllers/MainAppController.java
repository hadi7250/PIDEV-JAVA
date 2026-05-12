package controllers;

import app.Main;
import javafx.fxml.FXML;

public class MainAppController {

    @FXML
    private void goToAdmin() {
        Main.switchScene("/fxml/admin_dashboard.fxml");
    }

    @FXML
    private void goToFront() {
        Main.switchScene("/fxml/front_events.fxml");
    }
}
