package services;

import entities.User;
import utils.MyDB;
import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class UserService {

    private Connection cnx;

    public UserService() {
        cnx = MyDB.getInstance().getConnection();
    }

    // CREATE - Register a new user
    public boolean register(User user) {
        String query = "INSERT INTO user (firstName, lastName, age, email, password, role) VALUES (?, ?, ?, ?, ?, ?)";
        try (PreparedStatement pstmt = cnx.prepareStatement(query)) {
            pstmt.setString(1, user.getFirstName());
            pstmt.setString(2, user.getLastName());
            pstmt.setInt(3, user.getAge());
            pstmt.setString(4, user.getEmail());
            pstmt.setString(5, user.getPassword());
            pstmt.setString(6, user.getRole());
            pstmt.executeUpdate();
            System.out.println("✅ User registered successfully!");
            return true;
        } catch (SQLException e) {
            System.err.println("❌ Registration failed: " + e.getMessage());
            return false;
        }
    }

    // READ - Login user
    public User login(String email, String password) {
        String query = "SELECT * FROM user WHERE email = ? AND password = ?";
        try (PreparedStatement pstmt = cnx.prepareStatement(query)) {
            pstmt.setString(1, email);
            pstmt.setString(2, password);
            ResultSet rs = pstmt.executeQuery();

            if (rs.next()) {
                User user = new User(
                        rs.getInt("id"),
                        rs.getString("firstName"),
                        rs.getString("lastName"),
                        rs.getInt("age"),
                        rs.getString("email"),
                        rs.getString("password"),
                        rs.getString("role")
                );
                System.out.println("✅ Login successful! Welcome " + user.getFirstName());
                return user;
            } else {
                System.out.println("❌ Invalid email or password");
                return null;
            }
        } catch (SQLException e) {
            System.err.println("❌ Login error: " + e.getMessage());
            return null;
        }
    }

    // READ - Get all users (for admin)
    public List<User> getAllUsers() {
        List<User> users = new ArrayList<>();
        String query = "SELECT * FROM user";
        try (Statement stmt = cnx.createStatement();
             ResultSet rs = stmt.executeQuery(query)) {

            while (rs.next()) {
                User user = new User(
                        rs.getInt("id"),
                        rs.getString("firstName"),   // ← was "first_name"
                        rs.getString("lastName"),    // ← was "last_name"
                        rs.getInt("age"),
                        rs.getString("email"),
                        rs.getString("password"),
                        rs.getString("role")
                );
                users.add(user);
            }
        } catch (SQLException e) {
            System.err.println("❌ Error getting users: " + e.getMessage());
        }
        return users;
    }

    // UPDATE - Edit own profile
    public boolean updateProfile(User user) {
        String query = "UPDATE user SET firstName = ?, lastName = ?, age = ?, email = ?, password = ? WHERE id = ?";
        try (PreparedStatement pstmt = cnx.prepareStatement(query)) {
            pstmt.setString(1, user.getFirstName());
            pstmt.setString(2, user.getLastName());
            pstmt.setInt(3, user.getAge());
            pstmt.setString(4, user.getEmail());
            pstmt.setString(5, user.getPassword());
            pstmt.setInt(6, user.getId());
            pstmt.executeUpdate();
            System.out.println("✅ Profile updated successfully!");
            return true;
        } catch (SQLException e) {
            System.err.println("❌ Update failed: " + e.getMessage());
            return false;
        }
    }

    // READ - Get user by ID
    public User getUserById(int id) {
        String query = "SELECT * FROM user WHERE id = ?";
        try (PreparedStatement pstmt = cnx.prepareStatement(query)) {
            pstmt.setInt(1, id);
            ResultSet rs = pstmt.executeQuery();

            if (rs.next()) {
                return new User(
                        rs.getInt("id"),
                        rs.getString("firstName"),
                        rs.getString("lastName"),
                        rs.getInt("age"),
                        rs.getString("email"),
                        rs.getString("password"),
                        rs.getString("role")
                );
            }
        } catch (SQLException e) {
            System.err.println("❌ Error: " + e.getMessage());
        }
        return null;
    }

    // DELETE - Remove user (admin only)
    public boolean deleteUser(int id) {
        String query = "DELETE FROM user WHERE id = ?";
        try (PreparedStatement pstmt = cnx.prepareStatement(query)) {
            pstmt.setInt(1, id);
            pstmt.executeUpdate();
            System.out.println("✅ User deleted successfully!");
            return true;
        } catch (SQLException e) {
            System.err.println("❌ Delete failed: " + e.getMessage());
            return false;
        }
    }

    // Check if email already exists
    public boolean emailExists(String email) {
        String query = "SELECT COUNT(*) FROM user WHERE email = ?";
        try (PreparedStatement pstmt = cnx.prepareStatement(query)) {
            pstmt.setString(1, email);
            ResultSet rs = pstmt.executeQuery();
            if (rs.next()) {
                return rs.getInt(1) > 0;
            }
        } catch (SQLException e) {
            System.err.println("❌ Error: " + e.getMessage());
        }
        return false;
    }
    // UPDATE - Update profile with photo
    public boolean updateProfileWithPhoto(User user, String photoPath) {
        String query = "UPDATE user SET firstName = ?, lastName = ?, age = ?, email = ?, password = ?, photo_path = ? WHERE id = ?";
        try (PreparedStatement pstmt = cnx.prepareStatement(query)) {
            pstmt.setString(1, user.getFirstName());
            pstmt.setString(2, user.getLastName());
            pstmt.setInt(3, user.getAge());
            pstmt.setString(4, user.getEmail());
            pstmt.setString(5, user.getPassword());
            pstmt.setString(6, photoPath);
            pstmt.setInt(7, user.getId());
            int result = pstmt.executeUpdate();
            System.out.println("✅ Profile with photo updated successfully!");
            return result > 0;
        } catch (SQLException e) {
            System.err.println("❌ Update with photo failed: " + e.getMessage());
            return false;
        }
    }

    // READ - Get user photo path
    public String getUserPhotoPath(int userId) {
        String query = "SELECT photo_path FROM user WHERE id = ?";
        try (PreparedStatement pstmt = cnx.prepareStatement(query)) {
            pstmt.setInt(1, userId);
            ResultSet rs = pstmt.executeQuery();
            if (rs.next()) {
                return rs.getString("photo_path");
            }
        } catch (SQLException e) {
            System.err.println("❌ Error getting photo path: " + e.getMessage());
        }
        return null;
    }

    // UPDATE - Update only photo path
    public boolean updateUserPhoto(int userId, String photoPath) {
        String query = "UPDATE user SET photo_path = ? WHERE id = ?";
        try (PreparedStatement pstmt = cnx.prepareStatement(query)) {
            pstmt.setString(1, photoPath);
            pstmt.setInt(2, userId);
            return pstmt.executeUpdate() > 0;
        } catch (SQLException e) {
            System.err.println("❌ Update photo failed: " + e.getMessage());
            return false;
        }
    }

    // READ - Get user by email
    public User getUserByEmail(String email) {
        String query = "SELECT * FROM user WHERE email = ?";
        try (PreparedStatement pstmt = cnx.prepareStatement(query)) {
            pstmt.setString(1, email);
            ResultSet rs = pstmt.executeQuery();
            if (rs.next()) {
                return new User(
                        rs.getInt("id"),
                        rs.getString("firstName"),
                        rs.getString("lastName"),
                        rs.getInt("age"),
                        rs.getString("email"),
                        rs.getString("password"),
                        rs.getString("role")
                );
            }
        } catch (SQLException e) {
            System.err.println("❌ Error: " + e.getMessage());
        }
        return null;
    }


    // Ajoute ces méthodes dans UserService.java

    /**
     * Sauvegarde le code de réinitialisation pour un email
     */
    public boolean saveResetCode(String email, String code) {
        String query = "UPDATE user SET reset_code = ?, reset_code_expiry = DATE_ADD(NOW(), INTERVAL 15 MINUTE) WHERE email = ?";
        try (PreparedStatement pstmt = cnx.prepareStatement(query)) {
            pstmt.setString(1, code);
            pstmt.setString(2, email);
            return pstmt.executeUpdate() > 0;
        } catch (SQLException e) {
            System.err.println("❌ Erreur sauvegarde code: " + e.getMessage());
            return false;
        }
    }

    /**
     * Vérifie si le code de réinitialisation est valide
     */
    public boolean verifyResetCode(String email, String code) {
        String query = "SELECT * FROM user WHERE email = ? AND reset_code = ? AND reset_code_expiry > NOW()";
        try (PreparedStatement pstmt = cnx.prepareStatement(query)) {
            pstmt.setString(1, email);
            pstmt.setString(2, code);
            ResultSet rs = pstmt.executeQuery();
            return rs.next();
        } catch (SQLException e) {
            System.err.println("❌ Erreur vérification code: " + e.getMessage());
            return false;
        }
    }

    /**
     * Met à jour le mot de passe et efface le code de réinitialisation
     */
    public boolean updatePasswordWithReset(String email, String newPassword) {
        String query = "UPDATE user SET password = ?, reset_code = NULL, reset_code_expiry = NULL WHERE email = ?";
        try (PreparedStatement pstmt = cnx.prepareStatement(query)) {
            pstmt.setString(1, newPassword);
            pstmt.setString(2, email);
            return pstmt.executeUpdate() > 0;
        } catch (SQLException e) {
            System.err.println("❌ Erreur mise à jour mot de passe: " + e.getMessage());
            return false;
        }
    }

}