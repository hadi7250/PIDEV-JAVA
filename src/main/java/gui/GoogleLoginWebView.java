package gui;

import entities.User;
import javafx.scene.Scene;
import javafx.scene.control.Alert;
import javafx.scene.web.WebView;
import javafx.stage.Stage;
import services.GoogleAuthService;

import java.net.URLDecoder;
import java.nio.charset.StandardCharsets;

public class GoogleLoginWebView {

    private Stage stage;
    private WebView webView;
    private GoogleAuthService googleAuth;
    private SignInController signInController;

    public GoogleLoginWebView(SignInController controller) {
        this.signInController = controller;
        this.googleAuth = new GoogleAuthService();
    }

    public void showLoginWindow() {
        stage = new Stage();
        stage.setTitle("Connexion Google");
        stage.setMinWidth(500);
        stage.setMinHeight(600);

        webView = new WebView();

        // Load Google login page
        String loginUrl = googleAuth.getGoogleLoginUrl();
        System.out.println("URL de connexion: " + loginUrl);
        webView.getEngine().load(loginUrl);

        // Listen for URL changes to capture the authorization code
        webView.getEngine().locationProperty().addListener((obs, oldUrl, newUrl) -> {
            System.out.println("URL changed: " + newUrl);

            // Check if redirected back with authorization code
            if (newUrl != null
                    && newUrl.startsWith("http://localhost")
                    && newUrl.contains("code=")) {

                try {
                    // Extract code from callback URL
                    String code = extractCodeFromUrl(newUrl);

                    if (code != null && !code.isEmpty()) {

                        // IMPORTANT: Decode %2F -> /
                        code = URLDecoder.decode(code, StandardCharsets.UTF_8);

                        System.out.println("Decoded authorization code: " + code);

                        // Save authorization code
                        googleAuth.setAuthorizationCode(code);

                        // Close login window
                        stage.close();

                        // Complete Google login
                        User googleUser = googleAuth.completeGoogleLogin();

                        if (googleUser != null) {
                            signInController.completeGoogleLogin(googleUser);
                        } else {
                            signInController.showAlertMessage(
                                    "Erreur",
                                    "La connexion Google a échoué",
                                    Alert.AlertType.ERROR
                            );
                        }
                    }

                } catch (Exception e) {
                    e.printStackTrace();

                    signInController.showAlertMessage(
                            "Erreur",
                            "Login failed: " + e.getMessage(),
                            Alert.AlertType.ERROR
                    );
                }
            }
        });

        Scene scene = new Scene(webView, 500, 600);
        stage.setScene(scene);
        stage.show();
    }

    private String extractCodeFromUrl(String url) {
        try {
            // Example:
            // http://localhost/?code=AUTH_CODE&scope=...

            String[] parts = url.split("\\?");

            if (parts.length > 1) {
                String[] params = parts[1].split("&");

                for (String param : params) {
                    if (param.startsWith("code=")) {
                        return param.substring(5);
                    }
                }
            }

        } catch (Exception e) {
            e.printStackTrace();
        }

        return null;
    }
}