package services;

import entities.User;
import models.Event;
import models.Participation;
import utils.DatabaseConnection;
import utils.DbSchema;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class ParticipationService implements IParticipationService {

    // ─── CREATE ──────────────────────────────────────────────────────
    public void add(Participation p) throws SQLException {
        String sql = "INSERT INTO " + DbSchema.PARTICIPATION + " (user_id, event_id, date_inscription) VALUES (?, ?, ?)";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
            ps.setInt(1, p.getUserId());
            ps.setInt(2, p.getEventId());
            ps.setTimestamp(3, Timestamp.valueOf(p.getDateInscription()));
            ps.executeUpdate();
            try (ResultSet rs = ps.getGeneratedKeys()) {
                if (rs.next()) p.setId(rs.getInt(1));
            }
        }
    }

    // ─── READ ALL ────────────────────────────────────────────────────
    public List<Participation> getAll() throws SQLException {
        List<Participation> list = new ArrayList<>();
        String sql = "SELECT * FROM " + DbSchema.PARTICIPATION + " ORDER BY date_inscription DESC";
        try (Connection cn = DatabaseConnection.getConnection();
             Statement st = cn.createStatement();
             ResultSet rs = st.executeQuery(sql)) {
            while (rs.next()) list.add(mapRow(rs));
        }
        return list;
    }

    @Override
    public List<Participation> getAllWithDetails() throws SQLException {
        List<Participation> list = new ArrayList<>();
        String sql = "SELECT p.*, u.email AS user_email, " + DbSchema.USER_DISPLAY_NAME_SQL + " AS user_name, e.titre AS event_titre "
                   + "FROM " + DbSchema.PARTICIPATION + " p "
                   + "LEFT JOIN " + DbSchema.USER + " u ON p.user_id = u.id "
                   + "LEFT JOIN " + DbSchema.EVENT + " e ON p.event_id = e.id "
                   + "ORDER BY p.date_inscription DESC";
        try (Connection cn = DatabaseConnection.getConnection();
             Statement st = cn.createStatement();
             ResultSet rs = st.executeQuery(sql)) {
            while (rs.next()) {
                Participation p = mapRow(rs);
                String email = rs.getString("user_email");
                if (email != null) {
                    User u = new User();
                    u.setId(p.getUserId());
                    u.setEmail(email);
                    u.setName(rs.getString("user_name"));
                    p.setUser(u);
                }
                String titre = rs.getString("event_titre");
                if (titre != null) {
                    Event ev = new Event();
                    ev.setId(p.getEventId());
                    ev.setTitre(titre);
                    p.setEvent(ev);
                }
                list.add(p);
            }
        }
        return list;
    }

    // ─── READ BY ID ─────────────────────────────────────────────────
    public Participation getById(int id) throws SQLException {
        String sql = "SELECT * FROM " + DbSchema.PARTICIPATION + " WHERE id = ?";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql)) {
            ps.setInt(1, id);
            try (ResultSet rs = ps.executeQuery()) {
                return rs.next() ? mapRow(rs) : null;
            }
        }
    }

    // ─── CHECK IF USER JOINED EVENT ─────────────────────────────────
    public boolean userHasJoined(int userId, int eventId) throws SQLException {
        String sql = "SELECT COUNT(*) FROM " + DbSchema.PARTICIPATION + " WHERE user_id = ? AND event_id = ?";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql)) {
            ps.setInt(1, userId);
            ps.setInt(2, eventId);
            try (ResultSet rs = ps.executeQuery()) {
                return rs.next() && rs.getInt(1) > 0;
            }
        }
    }

    // ─── GET BY USER ────────────────────────────────────────────────
    public List<Participation> getByUser(int userId) throws SQLException {
        List<Participation> list = new ArrayList<>();
        String sql = "SELECT * FROM " + DbSchema.PARTICIPATION + " WHERE user_id = ? ORDER BY date_inscription DESC";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql)) {
            ps.setInt(1, userId);
            try (ResultSet rs = ps.executeQuery()) {
                while (rs.next()) list.add(mapRow(rs));
            }
        }
        return list;
    }

    // ─── GET BY EVENT ───────────────────────────────────────────────
    public List<Participation> getByEvent(int eventId) throws SQLException {
        List<Participation> list = new ArrayList<>();
        String sql = "SELECT * FROM " + DbSchema.PARTICIPATION + " WHERE event_id = ? ORDER BY date_inscription DESC";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql)) {
            ps.setInt(1, eventId);
            try (ResultSet rs = ps.executeQuery()) {
                while (rs.next()) list.add(mapRow(rs));
            }
        }
        return list;
    }

    // ─── UPDATE ─────────────────────────────────────────────────────
    public void update(Participation p) throws SQLException {
        String sql = "UPDATE " + DbSchema.PARTICIPATION + " SET user_id=?, event_id=?, date_inscription=? WHERE id=?";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql)) {
            ps.setInt(1, p.getUserId());
            ps.setInt(2, p.getEventId());
            ps.setTimestamp(3, Timestamp.valueOf(p.getDateInscription()));
            ps.setInt(4, p.getId());
            ps.executeUpdate();
        }
    }

    // ─── DELETE ─────────────────────────────────────────────────────
    public void delete(int id) throws SQLException {
        String sql = "DELETE FROM " + DbSchema.PARTICIPATION + " WHERE id = ?";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql)) {
            ps.setInt(1, id);
            ps.executeUpdate();
        }
    }

    // ─── COUNT BY EVENT ─────────────────────────────────────────────
    public int countByEvent(int eventId) throws SQLException {
        String sql = "SELECT COUNT(*) FROM " + DbSchema.PARTICIPATION + " WHERE event_id = ?";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql)) {
            ps.setInt(1, eventId);
            try (ResultSet rs = ps.executeQuery()) {
                return rs.next() ? rs.getInt(1) : 0;
            }
        }
    }

    // ─── Helper ─────────────────────────────────────────────────────
    private Participation mapRow(ResultSet rs) throws SQLException {
        Participation p = new Participation();
        p.setId(rs.getInt("id"));
        p.setUserId(rs.getInt("user_id"));
        p.setEventId(rs.getInt("event_id"));
        Timestamp ts = rs.getTimestamp("date_inscription");
        if (ts != null) p.setDateInscription(ts.toLocalDateTime());
        return p;
    }
}
