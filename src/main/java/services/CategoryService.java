package services;

import models.Category;
import utils.DatabaseConnection;
import utils.DbSchema;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class CategoryService implements ICategoryService {

    // ─── CREATE ──────────────────────────────────────────────────────
    public void add(Category c) throws SQLException {
        String sql = "INSERT INTO " + DbSchema.EVENT_CATEGORY + " (name) VALUES (?)";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
            ps.setString(1, c.getName());
            ps.executeUpdate();
            try (ResultSet rs = ps.getGeneratedKeys()) {
                if (rs.next()) c.setId(rs.getInt(1));
            }
        }
    }

    // ─── READ ALL ────────────────────────────────────────────────────
    public List<Category> getAll() throws SQLException {
        List<Category> list = new ArrayList<>();
        String sql = "SELECT * FROM " + DbSchema.EVENT_CATEGORY + " ORDER BY name ASC";
        try (Connection cn = DatabaseConnection.getConnection();
             Statement st = cn.createStatement();
             ResultSet rs = st.executeQuery(sql)) {
            while (rs.next()) list.add(mapRow(rs));
        }
        return list;
    }

    // ─── READ BY ID ─────────────────────────────────────────────────
    public Category getById(int id) throws SQLException {
        String sql = "SELECT * FROM " + DbSchema.EVENT_CATEGORY + " WHERE id = ?";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql)) {
            ps.setInt(1, id);
            try (ResultSet rs = ps.executeQuery()) {
                return rs.next() ? mapRow(rs) : null;
            }
        }
    }

    // ─── UPDATE ─────────────────────────────────────────────────────
    public void update(Category c) throws SQLException {
        String sql = "UPDATE " + DbSchema.EVENT_CATEGORY + " SET name=? WHERE id=?";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql)) {
            ps.setString(1, c.getName());
            ps.setInt(2, c.getId());
            ps.executeUpdate();
        }
    }

    // ─── DELETE ─────────────────────────────────────────────────────
    public void delete(int id) throws SQLException {
        String sql = "DELETE FROM " + DbSchema.EVENT_CATEGORY + " WHERE id = ?";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql)) {
            ps.setInt(1, id);
            ps.executeUpdate();
        }
    }

    // ─── COUNT EVENTS ───────────────────────────────────────────────
    public int countEvents(int categoryId) throws SQLException {
        String sql = "SELECT COUNT(*) FROM " + DbSchema.EVENT + " WHERE category_id = ?";
        try (Connection cn = DatabaseConnection.getConnection();
             PreparedStatement ps = cn.prepareStatement(sql)) {
            ps.setInt(1, categoryId);
            try (ResultSet rs = ps.executeQuery()) {
                return rs.next() ? rs.getInt(1) : 0;
            }
        }
    }

    // ─── Helper ─────────────────────────────────────────────────────
    private Category mapRow(ResultSet rs) throws SQLException {
        Category c = new Category();
        c.setId(rs.getInt("id"));
        c.setName(rs.getString("name"));
        return c;
    }
}
