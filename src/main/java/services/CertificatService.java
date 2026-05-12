package services;

import models.Certificat;
import models.Event;
import entities.User;
import utils.DatabaseConnection;
import utils.DbSchema;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;
import java.util.UUID;

public class CertificatService implements ICertificatService {

    // ─── CREATE ──────────────────────────────────────────────────────
    public void add(Certificat c) throws SQLException {
        if (c.getCodeUnique() == null || c.getCodeUnique().isBlank()) {
            c.setCodeUnique("CERT-" + UUID.randomUUID().toString().substring(0, 8).toUpperCase());
        }
        String sql = "INSERT INTO " + DbSchema.CERTIFICAT + " (user_id, event_id, date_obtention, code_unique) VALUES (?, ?, ?, ?)";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
            ps.setInt(1, c.getUserId());
            ps.setInt(2, c.getEventId());
            ps.setTimestamp(3, c.getDateObtention() != null ? Timestamp.valueOf(c.getDateObtention()) : null);
            ps.setString(4, c.getCodeUnique());
            ps.executeUpdate();
            try (ResultSet rs = ps.getGeneratedKeys()) {
                if (rs.next()) c.setId(rs.getInt(1));
            }
        }
    }

    // ─── READ ALL ────────────────────────────────────────────────────
    public List<Certificat> getAll() throws SQLException {
        List<Certificat> list = new ArrayList<>();
        String sql = "SELECT * FROM " + DbSchema.CERTIFICAT + " ORDER BY date_obtention DESC";
        try (Connection cn = DatabaseConnection.getConnection();
             Statement st = cn.createStatement();
             ResultSet rs = st.executeQuery(sql)) {
            while (rs.next()) list.add(mapRow(rs));
        }
        return list;
    }

    @Override
    public List<Certificat> getAllWithDetails() throws SQLException {
        List<Certificat> list = new ArrayList<>();
        String sql = "SELECT c.*, u.email AS user_email, " + DbSchema.USER_DISPLAY_NAME_SQL + " AS user_name, e.titre AS event_titre "
                   + "FROM " + DbSchema.CERTIFICAT + " c "
                   + "LEFT JOIN " + DbSchema.USER + " u ON c.user_id = u.id "
                   + "LEFT JOIN " + DbSchema.EVENT + " e ON c.event_id = e.id "
                   + "ORDER BY c.date_obtention DESC";
        try (Connection cn = DatabaseConnection.getConnection();
             Statement st = cn.createStatement();
             ResultSet rs = st.executeQuery(sql)) {
            while (rs.next()) {
                Certificat c = mapRow(rs);
                String email = rs.getString("user_email");
                if (email != null) {
                    User u = new User();
                    u.setId(c.getUserId());
                    u.setEmail(email);
                    u.setName(rs.getString("user_name"));
                    c.setUser(u);
                }
                String titre = rs.getString("event_titre");
                if (titre != null) {
                    Event ev = new Event();
                    ev.setId(c.getEventId());
                    ev.setTitre(titre);
                    c.setEvent(ev);
                }
                list.add(c);
            }
        }
        return list;
    }

    // ─── READ BY ID ─────────────────────────────────────────────────
    public Certificat getById(int id) throws SQLException {
        String sql = "SELECT * FROM " + DbSchema.CERTIFICAT + " WHERE id = ?";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql)) {
            ps.setInt(1, id);
            try (ResultSet rs = ps.executeQuery()) {
                return rs.next() ? mapRow(rs) : null;
            }
        }
    }

    // ─── READ BY CODE ───────────────────────────────────────────────
    public Certificat getByCode(String code) throws SQLException {
        String sql = "SELECT * FROM " + DbSchema.CERTIFICAT + " WHERE code_unique = ?";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql)) {
            ps.setString(1, code);
            try (ResultSet rs = ps.executeQuery()) {
                return rs.next() ? mapRow(rs) : null;
            }
        }
    }

    // ─── GET BY USER ────────────────────────────────────────────────
    public List<Certificat> getByUser(int userId) throws SQLException {
        List<Certificat> list = new ArrayList<>();
        String sql = "SELECT * FROM " + DbSchema.CERTIFICAT + " WHERE user_id = ? ORDER BY date_obtention DESC";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql)) {
            ps.setInt(1, userId);
            try (ResultSet rs = ps.executeQuery()) {
                while (rs.next()) list.add(mapRow(rs));
            }
        }
        return list;
    }

    // ─── UPDATE ─────────────────────────────────────────────────────
    public void update(Certificat c) throws SQLException {
        String sql = "UPDATE " + DbSchema.CERTIFICAT + " SET user_id=?, event_id=?, date_obtention=?, code_unique=? WHERE id=?";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql)) {
            ps.setInt(1, c.getUserId());
            ps.setInt(2, c.getEventId());
            ps.setTimestamp(3, c.getDateObtention() != null ? Timestamp.valueOf(c.getDateObtention()) : null);
            ps.setString(4, c.getCodeUnique());
            ps.setInt(5, c.getId());
            ps.executeUpdate();
        }
    }

    // ─── DELETE ─────────────────────────────────────────────────────
    public void delete(int id) throws SQLException {
        String sql = "DELETE FROM " + DbSchema.CERTIFICAT + " WHERE id = ?";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql)) {
            ps.setInt(1, id);
            ps.executeUpdate();
        }
    }

    // ─── Helper ─────────────────────────────────────────────────────
    private Certificat mapRow(ResultSet rs) throws SQLException {
        Certificat c = new Certificat();
        c.setId(rs.getInt("id"));
        c.setUserId(rs.getInt("user_id"));
        c.setEventId(rs.getInt("event_id"));
        Timestamp ts = rs.getTimestamp("date_obtention");
        if (ts != null) c.setDateObtention(ts.toLocalDateTime());
        c.setCodeUnique(rs.getString("code_unique"));
        return c;
    }
}
