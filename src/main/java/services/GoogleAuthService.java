package services;

import com.google.gson.JsonObject;
import com.google.gson.JsonParser;
import entities.User;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLDecoder;
import java.net.URLEncoder;
import java.nio.charset.StandardCharsets;

public class GoogleAuthService {

    // UPDATED WITH YOUR NEW GOOGLE CLOUD WEB APPLICATION CREDENTIALS
    private static final String CLIENT_ID =
            "359672727918-29nv3e1e10ie1isqm49j7m5i34ujgmiv.apps.googleusercontent.com";

    private static final String CLIENT_SECRET =
            "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";

    private static final String REDIRECT_URI = "http://localhost";

    private static final String AUTHORIZATION_URL =
            "https://accounts.google.com/o/oauth2/v2/auth";

    private static final String TOKEN_URL =
            "https://oauth2.googleapis.com/token";

    private static final String USER_INFO_URL =
            "https://www.googleapis.com/oauth2/v3/userinfo";

    private final UserService userService = new UserService();
    private String authorizationCode;

    /**
     * Generate Google login URL
     */
    public String getGoogleLoginUrl() {
        try {
            String url = AUTHORIZATION_URL + "?" +
                    "client_id=" + URLEncoder.encode(CLIENT_ID, StandardCharsets.UTF_8.toString()) +
                    "&redirect_uri=" + URLEncoder.encode(REDIRECT_URI, StandardCharsets.UTF_8.toString()) +
                    "&response_type=code" +
                    "&scope=" + URLEncoder.encode("email profile openid", StandardCharsets.UTF_8.toString()) +
                    "&access_type=offline" +
                    "&prompt=consent";

            System.out.println("URL de connexion: " + url);
            return url;

        } catch (Exception e) {
            e.printStackTrace();
            return null;
        }
    }

    /**
     * Save authorization code
     */
    public void setAuthorizationCode(String code) {
        this.authorizationCode = code;
    }

    /**
     * Final Google Login Process
     */
    public User completeGoogleLogin() {
        try {
            System.out.println("=== Starting Google Login ===");

            if (authorizationCode == null || authorizationCode.isEmpty()) {
                System.err.println("Authorization code is missing");
                return null;
            }

            System.out.println("Authorization Code: " + authorizationCode);
            System.out.println("CLIENT_ID: " + CLIENT_ID);
            System.out.println("CLIENT_SECRET: " + CLIENT_SECRET);
            System.out.println("REDIRECT_URI: " + REDIRECT_URI);

            // STEP 1 → Get Access Token
            String accessToken = getAccessToken();

            if (accessToken == null) {
                System.err.println("Failed to get access token");
                return null;
            }

            System.out.println("Access Token received successfully");

            // STEP 2 → Get Google User Info
            JsonObject userInfo = getUserInfo(accessToken);

            if (userInfo == null) {
                System.err.println("Failed to retrieve user info");
                return null;
            }

            // STEP 3 → Extract user data
            String email = userInfo.get("email").getAsString();
            String firstName = userInfo.has("given_name")
                    ? userInfo.get("given_name").getAsString()
                    : "";

            String lastName = userInfo.has("family_name")
                    ? userInfo.get("family_name").getAsString()
                    : "";

            String googleId = userInfo.get("sub").getAsString();

            System.out.println("Google Email: " + email);
            System.out.println("Google Name: " + firstName + " " + lastName);

            User user;

            // STEP 4 → Existing user
            if (userService.emailExists(email)) {

                user = userService.login(email, "google_" + googleId);

                if (user == null) {
                    user = userService.getUserByEmail(email);

                    if (user != null) {
                        user.setPassword("google_" + googleId);
                        userService.updateProfile(user);
                        user = userService.login(email, "google_" + googleId);
                    }
                }

            } else {
                // STEP 5 → New user
                user = new User(
                        firstName,
                        lastName,
                        25,
                        email,
                        "google_" + googleId,
                        "USER"
                );

                userService.register(user);
                user = userService.login(email, "google_" + googleId);
            }

            return user;

        } catch (Exception e) {
            e.printStackTrace();
            return null;
        }
    }

    /**
     * Exchange authorization code for access token
     */
    private String getAccessToken() throws Exception {

        String decodedCode = URLDecoder.decode(
                authorizationCode,
                StandardCharsets.UTF_8.toString()
        );

        System.out.println("Decoded authorization code: " + decodedCode);

        String params =
                "code=" + URLEncoder.encode(decodedCode, StandardCharsets.UTF_8.toString()) +
                        "&client_id=" + URLEncoder.encode(CLIENT_ID, StandardCharsets.UTF_8.toString()) +
                        "&client_secret=" + URLEncoder.encode(CLIENT_SECRET, StandardCharsets.UTF_8.toString()) +
                        "&redirect_uri=" + URLEncoder.encode(REDIRECT_URI, StandardCharsets.UTF_8.toString()) +
                        "&grant_type=authorization_code";

        System.out.println("POST Params:");
        System.out.println(params);

        URL url = new URL(TOKEN_URL);
        HttpURLConnection conn = (HttpURLConnection) url.openConnection();

        conn.setRequestMethod("POST");
        conn.setDoOutput(true);

        conn.setRequestProperty(
                "Content-Type",
                "application/x-www-form-urlencoded; charset=UTF-8"
        );

        conn.setRequestProperty(
                "Accept",
                "application/json"
        );

        try (OutputStream os = conn.getOutputStream()) {
            byte[] input = params.getBytes(StandardCharsets.UTF_8);
            os.write(input, 0, input.length);
        }

        int responseCode = conn.getResponseCode();
        System.out.println("Response code: " + responseCode);

        BufferedReader reader;

        if (responseCode == 200) {
            reader = new BufferedReader(
                    new InputStreamReader(conn.getInputStream(), StandardCharsets.UTF_8)
            );
        } else {
            reader = new BufferedReader(
                    new InputStreamReader(conn.getErrorStream(), StandardCharsets.UTF_8)
            );
        }

        StringBuilder response = new StringBuilder();
        String line;

        while ((line = reader.readLine()) != null) {
            response.append(line);
        }

        reader.close();

        String responseBody = response.toString();
        System.out.println("Response: " + responseBody);

        if (responseCode == 200) {
            JsonObject json = JsonParser
                    .parseString(responseBody)
                    .getAsJsonObject();

            if (json.has("access_token")) {
                return json.get("access_token").getAsString();
            }
        }

        return null;
    }

    /**
     * Get Google user profile
     */
    private JsonObject getUserInfo(String accessToken) throws Exception {

        URL url = new URL(USER_INFO_URL);
        HttpURLConnection conn = (HttpURLConnection) url.openConnection();

        conn.setRequestMethod("GET");
        conn.setRequestProperty(
                "Authorization",
                "Bearer " + accessToken
        );

        int responseCode = conn.getResponseCode();
        System.out.println("User Info Response Code: " + responseCode);

        if (responseCode == 200) {

            BufferedReader reader = new BufferedReader(
                    new InputStreamReader(conn.getInputStream(), StandardCharsets.UTF_8)
            );

            StringBuilder response = new StringBuilder();
            String line;

            while ((line = reader.readLine()) != null) {
                response.append(line);
            }

            reader.close();

            System.out.println("User Info Response: " + response);

            return JsonParser
                    .parseString(response.toString())
                    .getAsJsonObject();
        }

        return null;
    }
}