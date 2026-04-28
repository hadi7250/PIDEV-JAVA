package gui;

import entities.Evaluation;
import entities.User;
import javafx.collections.FXCollections;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.layout.StackPane;
import javafx.scene.layout.VBox;
import javafx.stage.Stage;
import services.EvaluationService;

import java.io.IOException;
import java.sql.SQLException;
import java.util.Arrays;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.Random;
import java.util.ArrayList;

public class AjouterEvaluationController {
    @FXML private StackPane mainContainer;
    private boolean isDarkMode = false;
    @FXML private TextField titleField;
    @FXML private TextArea descriptionArea;
    @FXML private ComboBox<String> typeComboBox;
    @FXML private DatePicker datePicker;
    @FXML private TextField weightField;
    @FXML private CheckBox codeEvalCheckBox;
    @FXML private VBox codeOptionsContainer;
    @FXML private ComboBox<String> languageComboBox;
    @FXML private TextArea codeContentArea;
    private EvaluationService evaluationService = new EvaluationService();
    private User loggedInUser;

    public void setLoggedInUser(User user) {
        this.loggedInUser = user;
    }

    @FXML
    public void initialize() {
        typeComboBox.setItems(FXCollections.observableArrayList("exam", "quiz", "project", "oral", "homework"));
        typeComboBox.setValue("exam");
        
        languageComboBox.setItems(FXCollections.observableArrayList("java", "python", "javascript", "c", "cpp"));
        languageComboBox.setValue("java");

        codeOptionsContainer.visibleProperty().bind(codeEvalCheckBox.selectedProperty());
        codeOptionsContainer.managedProperty().bind(codeEvalCheckBox.selectedProperty());
    }

    @FXML
    private void generateExercise() {
        String language = languageComboBox.getValue();
        if (language == null) {
            showAlert(Alert.AlertType.WARNING, "Warning", "Please select a language first.");
            return;
        }

        Map<String, List<String[]>> exercises = new HashMap<>();
        exercises.put("java", Arrays.asList(
            new String[]{"Reverse a String",
                "Write a method that takes a String and returns it reversed."},
            new String[]{"FizzBuzz",
                "Print numbers 1-100. For multiples of 3 print Fizz, " +
                "for multiples of 5 print Buzz, for both print FizzBuzz."},
            new String[]{"Palindrome Check",
                "Write a method that checks if a given string is a palindrome."}
        ));
        exercises.put("python", Arrays.asList(
            new String[]{"Sum of Digits",
                "Write a function that returns the sum of digits of a number."},
            new String[]{"Count Vowels",
                "Write a function that counts the number of vowels in a string."},
            new String[]{"Fibonacci",
                "Write a function that returns the nth Fibonacci number."}
        ));
        exercises.put("javascript", Arrays.asList(
            new String[]{"Array Flatten",
                "Write a function that flattens a nested array into a single array."},
            new String[]{"Capitalize Words",
                "Write a function that capitalizes the first letter of every word."},
            new String[]{"Count Occurrences",
                "Write a function that counts occurrences of each character in a string."}
        ));
        exercises.put("c", Arrays.asList(
            new String[]{"Factorial",
                "Write a recursive function to compute the factorial of n."},
            new String[]{"Array Sum",
                "Write a function that returns the sum of all elements in an array."},
            new String[]{"String Length",
                "Write a function that returns the length of a string without strlen()."}
        ));
        exercises.put("cpp", Arrays.asList(
            new String[]{"Stack Implementation",
                "Implement a simple stack using an array with push, pop, and peek."},
            new String[]{"Binary Search",
                "Implement binary search on a sorted integer array."},
            new String[]{"Linked List",
                "Implement a singly linked list with insert and delete operations."}
        ));

        List<String[]> defaultExercise = new ArrayList<>();
        defaultExercise.add(new String[]{"Hello World", "Write a program that prints Hello World."});

        List<String[]> options = exercises.getOrDefault(language, defaultExercise);

        String[] chosen = options.get(new Random().nextInt(options.size()));

        titleField.setText(chosen[0]);
        codeContentArea.setText(chosen[1]);
    }

    @FXML
    private void handleCreate() {
        String title = titleField.getText();
        String description = descriptionArea.getText();
        String type = typeComboBox.getValue();
        java.time.LocalDate date = datePicker.getValue();
        String scoreStr = weightField.getText();
        
        boolean isCodeEval = codeEvalCheckBox.isSelected();
        String language = isCodeEval ? languageComboBox.getValue() : null;
        String codeContent = isCodeEval ? codeContentArea.getText() : null;

        if (title.isEmpty() || date == null || scoreStr.isEmpty()) {
            showAlert(Alert.AlertType.ERROR, "Form Error!", "Please fill in all required fields.");
            return;
        }

        try {
            Float weight = Float.parseFloat(scoreStr);
            Evaluation evaluation = new Evaluation(title, description, type,
                    date.atStartOfDay(), 0f, "pending", "", codeContent, language,
                    isCodeEval, null, weight);
            evaluationService.create(evaluation);
            showAlert(Alert.AlertType.INFORMATION, "Success!", "Evaluation created successfully!");
            goBack();
        } catch (NumberFormatException e) {
            showAlert(Alert.AlertType.ERROR, "Form Error!", "Weight must be a valid number.");
        } catch (SQLException e) {
            showAlert(Alert.AlertType.ERROR, "Database Error!", e.getMessage());
        }
    }

    private void showAlert(Alert.AlertType alertType, String title, String message) {
        Alert alert = new Alert(alertType);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }

    @FXML
    private void handleCancel() {
        goBack();
    }

    private void goBack() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/EvaluationManagement.fxml"));
            Parent root = loader.load();
            EvaluationManagementController controller = loader.getController();
            controller.setLoggedInUser(loggedInUser);
            
            StackPane contentHost = (StackPane) mainContainer.getScene().lookup("#contentHost");
            if (contentHost != null) {
                contentHost.getChildren().setAll(root);
            } else {
                Stage stage = (Stage) mainContainer.getScene().getWindow();
                stage.setScene(new Scene(root));
            }
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    private void clearForm() {
        titleField.clear();
        descriptionArea.clear();
        typeComboBox.setValue("exam");
        datePicker.setValue(null);
        weightField.clear();
        languageComboBox.setValue("java");
        codeContentArea.clear();
    }

    @FXML
    private void toggleTheme() {
        Button themeButton = (Button) mainContainer.lookup(".theme-toggle-btn");
        if (isDarkMode) {
            mainContainer.getStyleClass().remove("dark-theme");
            mainContainer.getStyleClass().add("light-theme");
            if (themeButton != null) themeButton.setText("🌙 Dark Mode");
            isDarkMode = false;
        } else {
            mainContainer.getStyleClass().remove("light-theme");
            mainContainer.getStyleClass().add("dark-theme");
            if (themeButton != null) themeButton.setText("☀️ Light Mode");
            isDarkMode = true;
        }
    }
}
