package services;

import entities.User;
import models.Event;
import models.Rating;
import utils.DatabaseConnection;
import utils.DbSchema;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class RatingService implements IRatingService {

    // ─── CREATE ──────────────────────────────────────────────────────
    public void add(Rating r) throws SQLException {
        String sql = "INSERT INTO " + DbSchema.RATING + " (user_id, event_id, note, commentaire, date_creation) VALUES (?, ?, ?, ?, ?)";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
            ps.setInt(1, r.getUserId());
            ps.setInt(2, r.getEventId());
            ps.setInt(3, r.getNote());
            ps.setString(4, r.getCommentaire());
            ps.setTimestamp(5, Timestamp.valueOf(r.getDateCreation()));
            ps.executeUpdate();
            try (ResultSet rs = ps.getGeneratedKeys()) {
                if (rs.next()) r.setId(rs.getInt(1));
            }
        }
    }

    // ─── READ ALL ────────────────────────────────────────────────────
    public List<Rating> getAll() throws SQLException {
        List<Rating> list = new ArrayList<>();
        String sql = "SELECT * FROM " + DbSchema.RATING + " ORDER BY date_creation DESC";
        try (Connection cn = DatabaseConnection.getConnection();
             Statement st = cn.createStatement();
             ResultSet rs = st.executeQuery(sql)) {
            while (rs.next()) list.add(mapRow(rs));
        }
        return list;
    }

    @Override
    public List<Rating> getAllWithDetails() throws SQLException {
        List<Rating> list = new ArrayList<>();
        String sql = "SELECT r.*, u.email AS user_email, " + DbSchema.USER_DISPLAY_NAME_SQL + " AS user_name, e.titre AS event_titre "
                   + "FROM " + DbSchema.RATING + " r "
                   + "LEFT JOIN " + DbSchema.USER + " u ON r.user_id = u.id "
                   + "LEFT JOIN " + DbSchema.EVENT + " e ON r.event_id = e.id "
                   + "ORDER BY r.date_creation DESC";
        try (Connection cn = DatabaseConnection.getConnection();
             Statement st = cn.createStatement();
             ResultSet rs = st.executeQuery(sql)) {
            while (rs.next()) {
                Rating r = mapRow(rs);
                String email = rs.getString("user_email");
                if (email != null) {
                    User u = new User();
                    u.setId(r.getUserId());
                    u.setEmail(email);
                    u.setName(rs.getString("user_name"));
                    r.setUser(u);
                }
                String titre = rs.getString("event_titre");
                if (titre != null) {
                    Event ev = new Event();
                    ev.setId(r.getEventId());
                    ev.setTitre(titre);
                    r.setEvent(ev);
                }
                list.add(r);
            }
        }
        return list;
    }

    // ─── READ BY ID ─────────────────────────────────────────────────
    public Rating getById(int id) throws SQLException {
        String sql = "SELECT * FROM " + DbSchema.RATING + " WHERE id = ?";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql)) {
            ps.setInt(1, id);
            try (ResultSet rs = ps.executeQuery()) {
                return rs.next() ? mapRow(rs) : null;
            }
        }
    }

    // ─── GET BY EVENT ───────────────────────────────────────────────
    public List<Rating> getByEvent(int eventId) throws SQLException {
        List<Rating> list = new ArrayList<>();
        String sql = "SELECT * FROM " + DbSchema.RATING + " WHERE event_id = ? ORDER BY date_creation DESC";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql)) {
            ps.setInt(1, eventId);
            try (ResultSet rs = ps.executeQuery()) {
                while (rs.next()) list.add(mapRow(rs));
            }
        }
        return list;
    }

    // ─── CHECK IF USER RATED EVENT ──────────────────────────────────
    public boolean userHasRated(int userId, int eventId) throws SQLException {
        String sql = "SELECT COUNT(*) FROM " + DbSchema.RATING + " WHERE user_id = ? AND event_id = ?";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql)) {
            ps.setInt(1, userId);
            ps.setInt(2, eventId);
            try (ResultSet rs = ps.executeQuery()) {
                return rs.next() && rs.getInt(1) > 0;
            }
        }
    }

    // ─── AVERAGE RATING FOR EVENT ───────────────────────────────────
    public double getAverageRating(int eventId) throws SQLException {
        String sql = "SELECT AVG(note) FROM " + DbSchema.RATING + " WHERE event_id = ?";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql)) {
            ps.setInt(1, eventId);
            try (ResultSet rs = ps.executeQuery()) {
                return rs.next() ? rs.getDouble(1) : 0.0;
            }
        }
    }

    // ─── UPDATE ─────────────────────────────────────────────────────
    public void update(Rating r) throws SQLException {
        String sql = "UPDATE " + DbSchema.RATING + " SET user_id=?, event_id=?, note=?, commentaire=?, date_creation=? WHERE id=?";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql)) {
            ps.setInt(1, r.getUserId());
            ps.setInt(2, r.getEventId());
            ps.setInt(3, r.getNote());
            ps.setString(4, r.getCommentaire());
            ps.setTimestamp(5, Timestamp.valueOf(r.getDateCreation()));
            ps.setInt(6, r.getId());
            ps.executeUpdate();
        }
    }

    // ─── DELETE ─────────────────────────────────────────────────────
    public void delete(int id) throws SQLException {
        String sql = "DELETE FROM " + DbSchema.RATING + " WHERE id = ?";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql)) {
            ps.setInt(1, id);
            ps.executeUpdate();
        }
    }

    // ─── Helper ─────────────────────────────────────────────────────
    private Rating mapRow(ResultSet rs) throws SQLException {
        Rating r = new Rating();
        r.setId(rs.getInt("id"));
        r.setUserId(rs.getInt("user_id"));
        r.setEventId(rs.getInt("event_id"));
        r.setNote(rs.getInt("note"));
        r.setCommentaire(rs.getString("commentaire"));
        Timestamp ts = rs.getTimestamp("date_creation");
        if (ts != null) r.setDateCreation(ts.toLocalDateTime());
        return r;
    }
}
