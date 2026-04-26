package app;

import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.stage.Stage;
import services.ForumDataPopulator;

public class Main extends Application {

    @Override
    public void start(Stage stage) throws Exception {
        // Populate forum with realistic data
        System.out.println("Creating user schema tables...");
        try {
            services.UserSchemaService.ensureSchema();
            System.out.println("User schema creation completed successfully!");
        } catch (Exception e) {
            System.err.println("User schema creation failed: " + e.getMessage());
            e.printStackTrace();
        }

        System.out.println("Populating forum with realistic data...");
        try {
            ForumDataPopulator populator = new ForumDataPopulator();
            populator.populateForum();
            System.out.println("Forum population completed successfully!");
        } catch (Exception e) {
            System.err.println("Forum population failed: " + e.getMessage());
            e.printStackTrace();
        }
        
        FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/SignIn.fxml"));
        stage.setScene(new Scene(loader.load()));
        stage.setTitle("EduConnect - Sign In");
        stage.show();
    }

    public static void main(String[] args) {
        launch(args);
    }
}
