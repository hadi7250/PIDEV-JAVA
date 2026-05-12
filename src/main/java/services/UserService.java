package services;

import entities.User;
import utils.DatabaseConnection;
import utils.DbSchema;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

/**
 * Maps the Java {@link User} model to the physical {@code user} table:
 * {@code email}, {@code password}, {@code roles}, {@code nom}, {@code prenom},
 * {@code dateNaissance}, {@code isActive}, {@code classe_id} (see your MariaDB dump).
 */
public class UserService implements IUserService {

    @Override
    public void add(User u) throws SQLException {
        String sql = "INSERT INTO " + DbSchema.USER + " (email, password, roles, nom, prenom, dateNaissance, isActive, classe_id) "
                   + "VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
            mapModelToUserColumns(ps, u);
            ps.executeUpdate();
            try (ResultSet rs = ps.getGeneratedKeys()) {
                if (rs.next()) u.setId(rs.getInt(1));
            }
        }
    }

    @Override
    public List<User> getAll() throws SQLException {
        List<User> list = new ArrayList<>();
        String sql = "SELECT * FROM " + DbSchema.USER + " ORDER BY id DESC";
        try (Connection cn = DatabaseConnection.getConnection();
             Statement st = cn.createStatement();
             ResultSet rs = st.executeQuery(sql)) {
            while (rs.next()) list.add(mapRow(rs));
        }
        return list;
    }

    @Override
    public User getById(int id) throws SQLException {
        String sql = "SELECT * FROM " + DbSchema.USER + " WHERE id = ?";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql)) {
            ps.setInt(1, id);
            try (ResultSet rs = ps.executeQuery()) {
                return rs.next() ? mapRow(rs) : null;
            }
        }
    }

    @Override
    public User getByEmail(String email) throws SQLException {
        String sql = "SELECT * FROM " + DbSchema.USER + " WHERE email = ?";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql)) {
            ps.setString(1, email);
            try (ResultSet rs = ps.executeQuery()) {
                return rs.next() ? mapRow(rs) : null;
            }
        }
    }

    @Override
    public void update(User u) throws SQLException {
        String sql = "UPDATE " + DbSchema.USER + " SET email=?, password=?, roles=?, nom=?, prenom=?, dateNaissance=?, isActive=?, classe_id=? WHERE id=?";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql)) {
            mapModelToUserColumns(ps, u);
            ps.setInt(9, u.getId());
            ps.executeUpdate();
        }
    }

    @Override
    public void delete(int id) throws SQLException {
        String sql = "DELETE FROM " + DbSchema.USER + " WHERE id = ?";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql)) {
            ps.setInt(1, id);
            ps.executeUpdate();
        }
    }

    private void mapModelToUserColumns(PreparedStatement ps, User u) throws SQLException {
        ps.setString(1, u.getEmail());
        ps.setString(2, u.getPassword() != null ? u.getPassword() : "");
        String role = u.getRole() != null ? u.getRole() : "USER";
        ps.setString(3, "[\"ROLE_" + role + "\"]");
        String firstName = u.getFirstName() != null ? u.getFirstName().trim() : "";
        String lastName  = u.getLastName()  != null ? u.getLastName().trim()  : "";
        ps.setString(4, firstName + " " + lastName);
        ps.setNull(5, Types.VARCHAR);
        ps.setNull(6, Types.DATE);
        int active = "inactive".equalsIgnoreCase(u.getStatus()) ? 0 : 1;
        ps.setInt(7, active);
        ps.setNull(8, Types.INTEGER);
    }

    private User mapRow(ResultSet rs) throws SQLException {
        String nom    = rs.getString("nom");
        String prenom  = rs.getString("prenom");
        String email   = rs.getString("email");
        String pwd     = rs.getString("password");
        String status  = parseIsActive(rs.getObject("isActive")) ? "active" : "inactive";
        User u = new User(
            rs.getInt("id"),
            prenom != null ? prenom : "",   // firstName
            nom    != null ? nom    : "",   // lastName
            0,                              // age (not stored in this table)
            email,
            pwd != null ? pwd : "",
            "USER"                          // default role
        );
        u.setStatus(status);
        return u;
    }

    /**
     * MySQL/MariaDB {@code TINYINT(1)} is often returned as {@link Boolean} by the JDBC driver, not {@link Number}.
     */
    private static boolean parseIsActive(Object raw) {
        if (raw == null) {
            return true;
        }
        if (raw instanceof Boolean b) {
            return b;
        }
        if (raw instanceof Number n) {
            return n.intValue() != 0;
        }
        if (raw instanceof byte[] bytes && bytes.length > 0) {
            return bytes[0] != 0;
        }
        String s = raw.toString().trim();
        if ("1".equals(s) || "true".equalsIgnoreCase(s)) {
            return true;
        }
        if ("0".equals(s) || "false".equalsIgnoreCase(s)) {
            return false;
        }
        return true;
    }
    @Override
    public boolean emailExists(String email) {
        try {
            return getByEmail(email) != null;
        } catch (SQLException e) {
            e.printStackTrace();
            return false;
        }
    }


    @Override
    public User login(String email, String password) {
        try {
            User u = getByEmail(email);
            if (u != null && u.getPassword().equals(password)) {
                return u;
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return null;
    }

    // Legacy Aliases
    @Override public List<User> getAllUsers() throws SQLException { return getAll(); }
    @Override public boolean deleteUser(int id) { try { delete(id); return true; } catch (SQLException e) { e.printStackTrace(); return false; } }
    @Override public boolean register(User u) { try { add(u); return true; } catch (SQLException e) { e.printStackTrace(); return false; } }
    @Override public boolean updateProfile(User u) { try { update(u); return true; } catch (SQLException e) { e.printStackTrace(); return false; } }


    @Override
    public String getUserPhotoPath(int id) {
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement("SELECT photo_path FROM " + DbSchema.USER + " WHERE id = ?")) {
            ps.setInt(1, id);
            try (ResultSet rs = ps.executeQuery()) {
                return rs.next() ? rs.getString(1) : "";
            }
        } catch (SQLException e) { return ""; }
    }

    @Override
    public boolean updateUserPhoto(int id, String path) {
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement("UPDATE " + DbSchema.USER + " SET photo_path = ? WHERE id = ?")) {
            ps.setString(1, path);
            ps.setInt(2, id);
            return ps.executeUpdate() > 0;
        } catch (SQLException e) { return false; }
    }

    @Override
    public User getUserById(int id) {
        try { return getById(id); } catch(Exception e) { return null; }
    }

    @Override
    public void saveResetCode(String email, String code) {
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement("UPDATE " + DbSchema.USER + " SET reset_code = ?, reset_code_expiry = TIMESTAMPADD(HOUR, 1, NOW()) WHERE email = ?")) {
            ps.setString(1, code);
            ps.setString(2, email);
            ps.executeUpdate();
        } catch (SQLException e) { e.printStackTrace(); }
    }

    @Override
    public boolean verifyResetCode(String email, String code) {
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement("SELECT 1 FROM " + DbSchema.USER + " WHERE email = ? AND reset_code = ? AND reset_code_expiry > NOW()")) {
            ps.setString(1, email);
            ps.setString(2, code);
            try (ResultSet rs = ps.executeQuery()) {
                return rs.next();
            }
        } catch (SQLException e) { return false; }
    }

    @Override
    public boolean updatePasswordWithReset(String email, String newPassword) {
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement("UPDATE " + DbSchema.USER + " SET password = ?, reset_code = NULL, reset_code_expiry = NULL WHERE email = ?")) {
            ps.setString(1, newPassword);
            ps.setString(2, email);
            return ps.executeUpdate() > 0;
        } catch (SQLException e) { return false; }
    }

    @Override
    public User getUserByEmail(String email) {
        try { return getByEmail(email); } catch(Exception e) { return null; }
    }
}


