package controllers;

import app.MainFx;
import javafx.fxml.FXML;

public class MainAppController {

    @FXML
    private void goToAdmin() {
        MainFx.switchScene("/fxml/Event/admin_dashboard.fxml");
    }

    @FXML
    private void goToFront() {
        MainFx.switchScene("/fxml/Event/front_events.fxml");
    }
}
