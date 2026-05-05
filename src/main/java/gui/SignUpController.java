package gui;

import entities.User;
import javafx.collections.FXCollections;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Alert;
import javafx.scene.control.ComboBox;
import javafx.scene.control.PasswordField;
import javafx.scene.control.TextField;
import javafx.stage.Stage;
import services.UserService;

public class SignUpController {

    @FXML
    private TextField firstNameField;

    @FXML
    private TextField lastNameField;

    @FXML
    private TextField ageField;

    @FXML
    private TextField emailField;

    @FXML
    private ComboBox<String> roleComboBox;

    @FXML
    private PasswordField passwordField;

    @FXML
    private PasswordField confirmPasswordField;

    private UserService userService = new UserService();

    @FXML
    public void initialize() {
        roleComboBox.setItems(FXCollections.observableArrayList("STUDENT", "TEACHER"));
        roleComboBox.setValue("STUDENT");
    }

    @FXML
    void handleSignUp() {
        // Get values
        String firstName = firstNameField.getText().trim();
        String lastName = lastNameField.getText().trim();
        String ageText = ageField.getText().trim();
        String email = emailField.getText().trim();
        String selectedRole = roleComboBox.getValue();
        String password = passwordField.getText();
        String confirmPassword = confirmPasswordField.getText();

        // Validate all fields
        if (firstName.isEmpty() || lastName.isEmpty() || ageText.isEmpty() ||
                email.isEmpty() || password.isEmpty() || selectedRole == null) {
            showAlert("Error", "Please fill in all fields", Alert.AlertType.ERROR);
            return;
        }

        // Validate password match
        if (!password.equals(confirmPassword)) {
            showAlert("Error", "Passwords do not match", Alert.AlertType.ERROR);
            return;
        }

        // Validate age
        int age;
        try {
            age = Integer.parseInt(ageText);
            if (age < 1 || age > 120) {
                showAlert("Error", "Please enter a valid age (1-120)", Alert.AlertType.ERROR);
                return;
            }
        } catch (NumberFormatException e) {
            showAlert("Error", "Age must be a number", Alert.AlertType.ERROR);
            return;
        }

        // Check if email already exists
        if (userService.emailExists(email)) {
            showAlert("Error", "Email already exists. Please use another email.", Alert.AlertType.ERROR);
            return;
        }

        // Create new user
        User newUser = new User();
        newUser.setPrenom(firstName);
        newUser.setNom(lastName);
        newUser.setEmail(email);
        newUser.setPassword(password);
        newUser.setRole(selectedRole); // Uses our new setRole helper
        
        // Approximate birth date since the UI only asks for age
        newUser.setDateNaissance(java.time.LocalDate.now().minusYears(age));

        // Save to database
        boolean success = userService.register(newUser);

        if (success) {
            showAlert("Success", "Account created successfully! Please login.", Alert.AlertType.INFORMATION);
            goToSignIn();
        } else {
            showAlert("Error", "Registration failed. Please try again.", Alert.AlertType.ERROR);
        }
    }

    @FXML
    void goToSignIn() {
        try {
            Parent root = FXMLLoader.load(getClass().getResource("/fxml/SignIn.fxml"));
            Stage stage = (Stage) firstNameField.getScene().getWindow();
            stage.setScene(new Scene(root));
            stage.setTitle("Sign In");
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private void showAlert(String title, String message, Alert.AlertType type) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setContentText(message);
        alert.showAndWait();
    }
}