package app;

import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.stage.Stage;
import services.CourseModuleSchemaService;
import services.ForumSchemaService;
import services.UserSchemaService;
import services.QuizSchemaService;
import services.EventSchemaService;


import javafx.scene.Parent;
import java.io.IOException;
import java.net.URL;

public class Main extends Application {

    private static Stage primaryStage;
    
    public static Stage getPrimaryStage() {
        return primaryStage;
    }


    @Override
    public void start(Stage stage) throws Exception {
        primaryStage = stage;
        UserSchemaService.ensureSchema();
        ForumSchemaService.ensureSchema();
        CourseModuleSchemaService.ensureSchema();
        QuizSchemaService.ensureSchema();
        EventSchemaService.ensureSchema();


        switchScene("/fxml/SignIn.fxml");
        stage.setTitle("EduConnect - Sign In");
        stage.show();
    }

    public static void switchScene(String fxmlPath) {
        try {
            FXMLLoader loader = new FXMLLoader(Main.class.getResource(fxmlPath));
            Parent root = (Parent) loader.load();
            Scene scene = new Scene(root);
            attachModernStylesheet(scene);
            primaryStage.setScene(scene);
            primaryStage.centerOnScreen();
        } catch (IOException e) {
            e.printStackTrace();
            System.err.println("Error switching to scene: " + fxmlPath);
        }
    }

    public static void attachModernStylesheet(Scene scene) {
        URL url = Main.class.getResource("/css/modern.css");
        if (url != null) {
            String href = url.toExternalForm();
            if (!scene.getStylesheets().contains(href)) {
                scene.getStylesheets().add(href);
            }
        }
    }

    public static void main(String[] args) {
        launch(args);
    }
}
