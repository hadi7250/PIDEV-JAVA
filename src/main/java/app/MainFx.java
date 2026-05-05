package app;

import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.stage.Stage;

/**
 * Point d’entrée partagé pour la navigation JavaFX (scène principale).
 */
public final class MainFx {

    private static Stage primaryStage;

    private MainFx() {
    }

    public static void setPrimaryStage(Stage stage) {
        primaryStage = stage;
    }

    public static Stage getPrimaryStage() {
        return primaryStage;
    }

    public static void switchScene(String resourcePath) {
        try {
            if (primaryStage == null) {
                System.err.println("MainFx: primaryStage non défini (appeler MainFx.setPrimaryStage).");
                return;
            }
            var url = MainFx.class.getResource(resourcePath);
            if (url == null) {
                System.err.println("FXML introuvable: " + resourcePath);
                return;
            }
            FXMLLoader loader = new FXMLLoader(url);
            Parent root = loader.load();
            primaryStage.setScene(new Scene(root));
            primaryStage.show();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}
