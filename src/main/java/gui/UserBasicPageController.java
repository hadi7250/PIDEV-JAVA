package gui;

import entities.User;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.ButtonType;
import javafx.scene.control.Label;
import javafx.scene.control.PasswordField;
import javafx.scene.control.TextField;
import javafx.scene.image.Image;
import javafx.scene.paint.ImagePattern;
import javafx.scene.layout.VBox;
import javafx.scene.shape.Circle;
import javafx.stage.FileChooser;
import javafx.stage.Stage;
import services.UserService;

import java.io.File;
import java.net.URL;
import java.nio.file.Files;
import java.nio.file.StandardCopyOption;
import java.time.LocalDate;
import java.time.format.DateTimeFormatter;
import java.util.ResourceBundle;

public class UserBasicPageController implements Initializable {

    @FXML
    private VBox mainContainer;
    @FXML
    private Label welcomeLabel;
    @FXML
    private Label roleBadge;
    @FXML
    private TextField firstNameField;
    @FXML
    private TextField lastNameField;
    @FXML
    private TextField ageField;
    @FXML
    private TextField emailField;
    @FXML
    private TextField roleField;
    @FXML
    private PasswordField newPasswordField;
    @FXML
    private PasswordField confirmPasswordField;
    @FXML
    private Label memberSinceLabel;
    @FXML
    private Label userIdLabel;
    @FXML
    private Circle profileCircle;  // NEW: For profile photo

    private UserService userService = new UserService();
    private User loggedInUser;
    private boolean isDarkMode = false;

    @Override
    public void initialize(URL location, ResourceBundle resources) {
        // Initialization will happen after user is set
    }

    public void setLoggedInUser(User user) {
        this.loggedInUser = user;
        loadUserData();
        updateWelcomeMessage();
        updateRoleBadge();
        setupMemberSince();
        loadProfilePhoto();  // NEW: Load profile photo
    }

    private void loadUserData() {
        if (loggedInUser != null) {
            firstNameField.setText(loggedInUser.getFirstName());
            lastNameField.setText(loggedInUser.getLastName());
            ageField.setText(String.valueOf(loggedInUser.getAge()));
            emailField.setText(loggedInUser.getEmail());
            roleField.setText(loggedInUser.getRole());
            userIdLabel.setText(String.valueOf(loggedInUser.getId()));
        }
    }

    private void updateWelcomeMessage() {
        if (loggedInUser != null) {
            String hour = java.time.LocalTime.now().format(DateTimeFormatter.ofPattern("HH"));
            String greeting;

            int hourInt = Integer.parseInt(hour);
            if (hourInt < 12) {
                greeting = "Bonjour";
            } else if (hourInt < 18) {
                greeting = "Bon après-midi";
            } else {
                greeting = "Bonsoir";
            }

            welcomeLabel.setText(greeting + ", " + loggedInUser.getFirstName() + " " + loggedInUser.getLastName() + " !");
        }
    }

    private void updateRoleBadge() {
        if (loggedInUser != null) {
            if (loggedInUser.isAdmin()) {
                roleBadge.setText("👑 ADMINISTRATEUR");
                roleBadge.setStyle("-fx-background-color: linear-gradient(to right, #f43b47, #ff6b6b); -fx-text-fill: white; -fx-padding: 5 15 5 15; -fx-background-radius: 20; -fx-font-size: 11px; -fx-font-weight: bold;");
            } else {
                roleBadge.setText("👤 UTILISATEUR");
                roleBadge.setStyle("-fx-background-color: linear-gradient(to right, #4facfe, #00f2fe); -fx-text-fill: white; -fx-padding: 5 15 5 15; -fx-background-radius: 20; -fx-font-size: 11px; -fx-font-weight: bold;");
            }
        }
    }

    private void setupMemberSince() {
        memberSinceLabel.setText(String.valueOf(LocalDate.now().getYear()));
    }

    // ==================== PROFILE PHOTO METHODS ====================

    private void loadProfilePhoto() {
        String photoPath = userService.getUserPhotoPath(loggedInUser.getId());
        if (photoPath != null && !photoPath.isEmpty()) {
            File photoFile = new File(photoPath);
            if (photoFile.exists()) {
                try {
                    Image image = new Image("file:" + photoPath);
                    profileCircle.setFill(new ImagePattern(image));
                    loggedInUser.setPhotoPath(photoPath);
                } catch (Exception e) {
                    System.err.println("Could not load photo: " + e.getMessage());
                    // Set default avatar
                    profileCircle.setFill(null);
                    profileCircle.setStyle("-fx-background-color: #667eea;");
                }
            }
        }
    }

    @FXML
    void uploadPhoto() {
        FileChooser fileChooser = new FileChooser();
        fileChooser.setTitle("Choisir une photo de profil");
        fileChooser.getExtensionFilters().addAll(
                new FileChooser.ExtensionFilter("Images", "*.png", "*.jpg", "*.jpeg", "*.gif", "*.bmp")
        );

        File selectedFile = fileChooser.showOpenDialog(profileCircle.getScene().getWindow());

        if (selectedFile != null) {
            try {
                // Create photos directory if it doesn't exist
                File photosDir = new File("photos");
                if (!photosDir.exists()) {
                    photosDir.mkdir();
                }

                // Create unique filename using user ID and timestamp
                String extension = selectedFile.getName().substring(selectedFile.getName().lastIndexOf("."));
                String newFileName = "user_" + loggedInUser.getId() + "_" + System.currentTimeMillis() + extension;
                File destFile = new File(photosDir, newFileName);

                // Copy file to photos directory
                Files.copy(selectedFile.toPath(), destFile.toPath(), StandardCopyOption.REPLACE_EXISTING);

                // Update database with new photo path
                String photoPath = destFile.getAbsolutePath();
                boolean success = userService.updateUserPhoto(loggedInUser.getId(), photoPath);

                if (success) {
                    // Delete old photo if exists
                    String oldPhotoPath = userService.getUserPhotoPath(loggedInUser.getId());
                    if (oldPhotoPath != null && !oldPhotoPath.equals(photoPath)) {
                        File oldFile = new File(oldPhotoPath);
                        if (oldFile.exists()) {
                            oldFile.delete();
                        }
                    }

                    // Update UI
                    Image image = new Image("file:" + photoPath);
                    profileCircle.setFill(new ImagePattern(image));
                    loggedInUser.setPhotoPath(photoPath);
                    showAlert("Succès", "Photo de profil mise à jour!", Alert.AlertType.INFORMATION);
                } else {
                    showAlert("Erreur", "Impossible d'enregistrer la photo", Alert.AlertType.ERROR);
                }

            } catch (Exception e) {
                e.printStackTrace();
                showAlert("Erreur", "Impossible d'uploader la photo: " + e.getMessage(), Alert.AlertType.ERROR);
            }
        }
    }

    // ==================== THEME METHODS ====================

    @FXML
    void toggleTheme() {
        Button themeButton = (Button) mainContainer.lookup(".theme-toggle-btn");

        if (isDarkMode) {
            mainContainer.getStyleClass().remove("dark-theme");
            mainContainer.getStyleClass().add("light-theme");
            if (themeButton != null) themeButton.setText("🌙 Mode Sombre");
            isDarkMode = false;
        } else {
            mainContainer.getStyleClass().remove("light-theme");
            mainContainer.getStyleClass().add("dark-theme");
            if (themeButton != null) themeButton.setText("☀️ Mode Clair");
            isDarkMode = true;
        }
    }

    // ==================== PROFILE METHODS ====================

    @FXML
    void refreshProfile() {
        // Reload user data from database
        User refreshedUser = userService.getUserById(loggedInUser.getId());
        if (refreshedUser != null) {
            loggedInUser = refreshedUser;
            loadUserData();
            loadProfilePhoto();
            showAlert("Actualisé", "Vos informations ont été actualisées", Alert.AlertType.INFORMATION);
        } else {
            showAlert("Erreur", "Impossible d'actualiser vos informations", Alert.AlertType.ERROR);
        }
    }

    @FXML
    void updateProfile() {
        // Update basic info
        loggedInUser.setFirstName(firstNameField.getText().trim());
        loggedInUser.setLastName(lastNameField.getText().trim());

        try {
            int age = Integer.parseInt(ageField.getText().trim());
            if (age < 1 || age > 120) {
                showAlert("Erreur", "Veuillez entrer un âge valide (1-120)", Alert.AlertType.ERROR);
                return;
            }
            loggedInUser.setAge(age);
        } catch (NumberFormatException e) {
            showAlert("Erreur", "L'âge doit être un nombre", Alert.AlertType.ERROR);
            return;
        }

        String email = emailField.getText().trim();
        if (!email.contains("@") || !email.contains(".")) {
            showAlert("Erreur", "Veuillez entrer un email valide", Alert.AlertType.ERROR);
            return;
        }
        loggedInUser.setEmail(email);

        // Update password if provided
        String newPassword = newPasswordField.getText();
        if (!newPassword.isEmpty()) {
            if (!newPassword.equals(confirmPasswordField.getText())) {
                showAlert("Erreur", "Les mots de passe ne correspondent pas", Alert.AlertType.ERROR);
                return;
            }
            if (newPassword.length() < 4) {
                showAlert("Erreur", "Le mot de passe doit contenir au moins 4 caractères", Alert.AlertType.ERROR);
                return;
            }
            loggedInUser.setPassword(newPassword);
        }

        // Save to database
        boolean success = userService.updateProfile(loggedInUser);

        if (success) {
            showAlert("Succès", "Votre profil a été mis à jour !", Alert.AlertType.INFORMATION);
            newPasswordField.clear();
            confirmPasswordField.clear();
            updateWelcomeMessage();
        } else {
            showAlert("Erreur", "Échec de la mise à jour du profil", Alert.AlertType.ERROR);
        }
    }

    // ==================== LOGOUT METHOD ====================

    @FXML
    void logout() {
        Alert confirmation = new Alert(Alert.AlertType.CONFIRMATION);
        confirmation.setTitle("Confirmation de déconnexion");
        confirmation.setHeaderText("Déconnexion");
        confirmation.setContentText("Voulez-vous vraiment vous déconnecter ?");

        if (confirmation.showAndWait().get() == ButtonType.OK) {
            try {
                Parent root = FXMLLoader.load(getClass().getResource("/fxml/SignIn.fxml"));
                Stage stage = (Stage) firstNameField.getScene().getWindow();
                stage.setScene(new Scene(root));
                stage.setTitle("Connexion - User Management System");
                stage.show();
            } catch (Exception e) {
                e.printStackTrace();
                showAlert("Erreur", "Impossible de se déconnecter", Alert.AlertType.ERROR);
            }
        }
    }

    // ==================== HELPER METHODS ====================

    private void showAlert(String title, String message, Alert.AlertType type) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setContentText(message);
        alert.showAndWait();
    }
}