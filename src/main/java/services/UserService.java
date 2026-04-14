package services;

import entities.User;
import utils.MyConnection;
import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class UserService {

    private Connection cnx;

    public UserService() {
        cnx = MyConnection.getInstance().getConnection();
    }

    // CREATE - Register a new user
    public boolean register(User user) {
        String query = "INSERT INTO user (email, password, roles, nom, prenom, dateNaissance, isActive, createdAt) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        try (PreparedStatement pstmt = cnx.prepareStatement(query)) {
            pstmt.setString(1, user.getEmail());
            pstmt.setString(2, user.getPassword());
            pstmt.setString(3, user.getRoles() != null ? user.getRoles() : "[\"ROLE_USER\"]");
            pstmt.setString(4, user.getNom());
            pstmt.setString(5, user.getPrenom());
            pstmt.setDate(6, Date.valueOf(user.getDateNaissance()));
            pstmt.setBoolean(7, user.isActive());
            pstmt.setTimestamp(8, Timestamp.valueOf(user.getCreatedAt()));
            pstmt.executeUpdate();
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
                User user = new User();
                user.setId(rs.getInt("id"));
                user.setEmail(rs.getString("email"));
                user.setPassword(rs.getString("password"));
                user.setRoles(rs.getString("roles"));
                user.setNom(rs.getString("nom"));
                user.setPrenom(rs.getString("prenom"));
                user.setDateNaissance(rs.getDate("dateNaissance").toLocalDate());
                user.setActive(rs.getBoolean("isActive"));
                user.setCreatedAt(rs.getTimestamp("createdAt").toLocalDateTime());
                return user;
            }
        } catch (SQLException e) {
            System.err.println("❌ Login error: " + e.getMessage());
        }
        return null;
    }

    // READ - Get all users (for admin)
    public List<User> getAllUsers() {
        List<User> users = new ArrayList<>();
        String query = "SELECT * FROM user";
        try (Statement stmt = cnx.createStatement();
             ResultSet rs = stmt.executeQuery(query)) {

            while (rs.next()) {
                User user = new User();
                user.setId(rs.getInt("id"));
                user.setEmail(rs.getString("email"));
                user.setPassword(rs.getString("password"));
                user.setRoles(rs.getString("roles"));
                user.setNom(rs.getString("nom"));
                user.setPrenom(rs.getString("prenom"));
                user.setDateNaissance(rs.getDate("dateNaissance") != null ? rs.getDate("dateNaissance").toLocalDate() : null);
                user.setActive(rs.getBoolean("isActive"));
                user.setCreatedAt(rs.getTimestamp("createdAt").toLocalDateTime());
                users.add(user);
            }
        } catch (SQLException e) {
            System.err.println("❌ Error getting users: " + e.getMessage());
        }
        return users;
    }

    // UPDATE - Edit user profile (including role)
    public boolean updateProfile(User user) {
        String query = "UPDATE user SET email = ?, password = ?, roles = ?, nom = ?, prenom = ?, dateNaissance = ? WHERE id = ?";
        try (PreparedStatement pstmt = cnx.prepareStatement(query)) {
            pstmt.setString(1, user.getEmail());
            pstmt.setString(2, user.getPassword());
            pstmt.setString(3, user.getRoles());
            pstmt.setString(4, user.getNom());
            pstmt.setString(5, user.getPrenom());
            pstmt.setDate(6, Date.valueOf(user.getDateNaissance()));
            pstmt.setInt(7, user.getId());
            pstmt.executeUpdate();
            return true;
        } catch (SQLException e) {
            System.err.println("❌ Update failed: " + e.getMessage());
            return false;
        }
    }

    // DELETE - Remove user (admin only)
    public boolean deleteUser(int id) {
        String query = "DELETE FROM user WHERE id = ?";
        try (PreparedStatement pstmt = cnx.prepareStatement(query)) {
            pstmt.setInt(1, id);
            pstmt.executeUpdate();
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
}
