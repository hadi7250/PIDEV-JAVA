package services;

import models.Category;
import models.Event;
import utils.DatabaseConnection;
import utils.DbSchema;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class EventService implements IEventService {

    // ─── CREATE ──────────────────────────────────────────────────────
    public void add(Event e) throws SQLException {
        String sql = "INSERT INTO " + DbSchema.EVENT + " (titre, " + DbSchema.EVT_DATE_DEBUT + ", " + DbSchema.EVT_DATE_FIN
                   + ", lieu, description, duree, " + DbSchema.EVT_NB_MAX_PART + ", image, category_id) "
                   + "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
            mapToStatement(ps, e);
            ps.executeUpdate();
            try (ResultSet rs = ps.getGeneratedKeys()) {
                if (rs.next()) e.setId(rs.getInt(1));
            }
        }
    }

    // ─── READ ALL ────────────────────────────────────────────────────
    public List<Event> getAll() throws SQLException {
        List<Event> list = new ArrayList<>();
        String sql = "SELECT e.*, c.name AS category_name FROM " + DbSchema.EVENT + " e LEFT JOIN " + DbSchema.EVENT_CATEGORY + " c ON e.category_id = c.id ORDER BY e." + DbSchema.EVT_DATE_DEBUT + " DESC";
        try (Connection cn = DatabaseConnection.getConnection();
             Statement st = cn.createStatement();
             ResultSet rs = st.executeQuery(sql)) {
            while (rs.next()) list.add(mapRow(rs));
        }
        return list;
    }

    // ─── READ BY ID ─────────────────────────────────────────────────
    public Event getById(int id) throws SQLException {
        String sql = "SELECT e.*, c.name AS category_name FROM " + DbSchema.EVENT + " e LEFT JOIN " + DbSchema.EVENT_CATEGORY + " c ON e.category_id = c.id WHERE e.id = ?";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql)) {
            ps.setInt(1, id);
            try (ResultSet rs = ps.executeQuery()) {
                return rs.next() ? mapRow(rs) : null;
            }
        }
    }

    // ─── READ BY CATEGORY ───────────────────────────────────────────
    public List<Event> getByCategory(int categoryId) throws SQLException {
        List<Event> list = new ArrayList<>();
        String sql = "SELECT e.*, c.name AS category_name FROM " + DbSchema.EVENT + " e LEFT JOIN " + DbSchema.EVENT_CATEGORY + " c ON e.category_id = c.id WHERE e.category_id = ? ORDER BY e." + DbSchema.EVT_DATE_DEBUT + " DESC";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql)) {
            ps.setInt(1, categoryId);
            try (ResultSet rs = ps.executeQuery()) {
                while (rs.next()) list.add(mapRow(rs));
            }
        }
        return list;
    }

    // ─── SEARCH ─────────────────────────────────────────────────────
    public List<Event> search(String keyword) throws SQLException {
        List<Event> list = new ArrayList<>();
        String sql = "SELECT e.*, c.name AS category_name FROM " + DbSchema.EVENT + " e LEFT JOIN " + DbSchema.EVENT_CATEGORY + " c ON e.category_id = c.id "
                   + "WHERE e.titre LIKE ? OR e.lieu LIKE ? OR e.description LIKE ? OR c.name LIKE ? ORDER BY e." + DbSchema.EVT_DATE_DEBUT + " DESC";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql)) {
            String like = "%" + keyword + "%";
            ps.setString(1, like);
            ps.setString(2, like);
            ps.setString(3, like);
            ps.setString(4, like);
            try (ResultSet rs = ps.executeQuery()) {
                while (rs.next()) list.add(mapRow(rs));
            }
        }
        return list;
    }

    // ─── UPDATE ─────────────────────────────────────────────────────
    public void update(Event e) throws SQLException {
        String sql = "UPDATE " + DbSchema.EVENT + " SET titre=?, " + DbSchema.EVT_DATE_DEBUT + "=?, " + DbSchema.EVT_DATE_FIN
                   + "=?, lieu=?, description=?, duree=?, " + DbSchema.EVT_NB_MAX_PART + "=?, image=?, category_id=? WHERE id=?";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql)) {
            mapToStatement(ps, e);
            ps.setInt(10, e.getId());
            ps.executeUpdate();
        }
    }

    // ─── DELETE ─────────────────────────────────────────────────────
    public void delete(int id) throws SQLException {
        String sql = "DELETE FROM " + DbSchema.EVENT + " WHERE id = ?";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql)) {
            ps.setInt(1, id);
            ps.executeUpdate();
        }
    }

    // ─── Helpers ────────────────────────────────────────────────────
    private void mapToStatement(PreparedStatement ps, Event e) throws SQLException {
        ps.setString(1, e.getTitre());
        ps.setTimestamp(2, e.getDateDebut() != null ? Timestamp.valueOf(e.getDateDebut()) : null);
        ps.setTimestamp(3, e.getDateFin() != null ? Timestamp.valueOf(e.getDateFin()) : null);
        ps.setString(4, e.getLieu());
        ps.setString(5, e.getDescription());
        ps.setInt(6, e.getDuree());
        ps.setInt(7, e.getNombreMaxParticipants());
        ps.setString(8, e.getImage());
        ps.setInt(9, e.getCategoryId());
    }

    private Event mapRow(ResultSet rs) throws SQLException {
        Event e = new Event();
        e.setId(rs.getInt("id"));
        e.setTitre(rs.getString("titre"));
        Timestamp ts1 = rs.getTimestamp("dateDebut");
        if (ts1 != null) e.setDateDebut(ts1.toLocalDateTime());
        Timestamp ts2 = rs.getTimestamp("dateFin");
        if (ts2 != null) e.setDateFin(ts2.toLocalDateTime());
        e.setLieu(rs.getString("lieu"));
        e.setDescription(rs.getString("description"));
        e.setDuree(rs.getInt("duree"));
        e.setNombreMaxParticipants(rs.getInt("nombreMaxParticipants"));
        e.setImage(rs.getString("image"));
        e.setCategoryId(rs.getInt("category_id"));

        // Attach category object
        String catName = rs.getString("category_name");
        if (catName != null) {
            Category cat = new Category(rs.getInt("category_id"), catName);
            e.setCategory(cat);
        }
        return e;
    }
}
