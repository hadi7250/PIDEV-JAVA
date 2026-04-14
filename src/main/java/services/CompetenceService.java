package services;

import entities.Competence;
import utils.MyConnection;

import java.sql.*;
import java.time.LocalDateTime;
import java.util.ArrayList;
import java.util.List;

public class CompetenceService implements IService<Competence> {
    private Connection connection;

    public CompetenceService() {
        connection = MyConnection.getInstance().getConnection();
    }

    @Override
    public void create(Competence competence) throws SQLException {
        String sql = "INSERT INTO competence (user_id, title, description, category, maxLevel, certificate, createdAt, updatedAt) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        try (PreparedStatement pst = connection.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
            pst.setInt(1, competence.getUserId());
            pst.setString(2, competence.getTitle());
            pst.setString(3, competence.getDescription());
            pst.setString(4, competence.getCategory());
            pst.setInt(5, competence.getMaxLevel());
            pst.setString(6, competence.getCertificate());
            pst.setTimestamp(7, Timestamp.valueOf(competence.getCreatedAt()));
            pst.setTimestamp(8, Timestamp.valueOf(competence.getUpdatedAt()));
            pst.executeUpdate();

            ResultSet rs = pst.getGeneratedKeys();
            if (rs.next()) {
                competence.setId(rs.getInt(1));
            }
        }
    }

    @Override
    public void update(Competence competence) throws SQLException {
        String sql = "UPDATE competence SET title = ?, description = ?, category = ?, maxLevel = ?, certificate = ?, updatedAt = ?, user_id = ? WHERE id = ?";
        try (PreparedStatement pst = connection.prepareStatement(sql)) {
            pst.setString(1, competence.getTitle());
            pst.setString(2, competence.getDescription());
            pst.setString(3, competence.getCategory());
            pst.setInt(4, competence.getMaxLevel());
            pst.setString(5, competence.getCertificate());
            pst.setTimestamp(6, Timestamp.valueOf(LocalDateTime.now()));
            pst.setInt(7, competence.getUserId());
            pst.setInt(8, competence.getId());
            pst.executeUpdate();
        }
    }

    @Override
    public void delete(Competence competence) throws SQLException {
        String sql = "DELETE FROM competence WHERE id = ?";
        try (PreparedStatement pst = connection.prepareStatement(sql)) {
            pst.setInt(1, competence.getId());
            pst.executeUpdate();
        }
    }

    @Override
    public List<Competence> readAll() throws SQLException {
        List<Competence> list = new ArrayList<>();
        String sql = "SELECT * FROM competence";
        try (Statement st = connection.createStatement();
             ResultSet rs = st.executeQuery(sql)) {
            while (rs.next()) {
                Competence c = new Competence();
                c.setId(rs.getInt("id"));
                c.setUserId(rs.getInt("user_id"));
                c.setTitle(rs.getString("title"));
                c.setDescription(rs.getString("description"));
                c.setCategory(rs.getString("category"));
                c.setMaxLevel(rs.getInt("maxLevel"));
                c.setCertificate(rs.getString("certificate"));
                c.setCreatedAt(rs.getTimestamp("createdAt").toLocalDateTime());
                c.setUpdatedAt(rs.getTimestamp("updatedAt").toLocalDateTime());
                list.add(c);
            }
        }
        return list;
    }

    public List<Competence> readAllByUser(int userId) throws SQLException {
        List<Competence> list = new ArrayList<>();
        String sql = "SELECT * FROM competence WHERE user_id = ?";
        try (PreparedStatement pst = connection.prepareStatement(sql)) {
            pst.setInt(1, userId);
            try (ResultSet rs = pst.executeQuery()) {
                while (rs.next()) {
                    Competence c = new Competence();
                    c.setId(rs.getInt("id"));
                    c.setUserId(rs.getInt("user_id"));
                    c.setTitle(rs.getString("title"));
                    c.setDescription(rs.getString("description"));
                    c.setCategory(rs.getString("category"));
                    c.setMaxLevel(rs.getInt("maxLevel"));
                    c.setCertificate(rs.getString("certificate"));
                    c.setCreatedAt(rs.getTimestamp("createdAt").toLocalDateTime());
                    c.setUpdatedAt(rs.getTimestamp("updatedAt").toLocalDateTime());
                    list.add(c);
                }
            }
        }
        return list;
    }
}