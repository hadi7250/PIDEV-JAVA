package app;

import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.stage.Stage;
import services.CourseModuleSchemaService;
import services.ForumSchemaService;
import services.UserSchemaService;
import services.QuizSchemaService;

public class Main extends Application {

    @Override
    public void start(Stage stage) throws Exception {
        UserSchemaService.ensureSchema();
        ForumSchemaService.ensureSchema();
        CourseModuleSchemaService.ensureSchema();
        QuizSchemaService.ensureSchema();

        FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/SignIn.fxml"));
        stage.setScene(new Scene(loader.load()));
        stage.setTitle("EduConnect - Sign In");
        stage.show();
    }

    public static void main(String[] args) {
        launch(args);
    }
}
