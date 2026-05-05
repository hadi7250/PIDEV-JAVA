package services;

import models.Quiz;
import utils.MyDB;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class QuizDAO {

    public void insert(Quiz entity) throws SQLException {
        String sql = "INSERT INTO quiz (title, description, time_limit, total_score) VALUES (?, ?, ?, ?)";
        Connection conn = MyDB.getInstance().getConnection();
        try (PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setString(1, entity.getTitle());
            ps.setString(2, entity.getDescription());
            ps.setInt(3, entity.getTimeLimit());
            ps.setInt(4, entity.getTotalScore());
            ps.executeUpdate();
        }
    }

    public void update(Quiz entity) throws SQLException {
        String sql = "UPDATE quiz SET title=?, description=?, time_limit=?, total_score=? WHERE id=?";
        Connection conn = MyDB.getInstance().getConnection();
        try (PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setString(1, entity.getTitle());
            ps.setString(2, entity.getDescription());
            ps.setInt(3, entity.getTimeLimit());
            ps.setInt(4, entity.getTotalScore());
            ps.setInt(5, entity.getId());
            ps.executeUpdate();
        }
    }

    public void delete(int id) throws SQLException {
        Connection conn = MyDB.getInstance().getConnection();
        // Delete attempts first
        try (PreparedStatement ps = conn.prepareStatement("DELETE FROM attempt WHERE quiz_id=?")) {
            ps.setInt(1, id);
            ps.executeUpdate();
        }
        // Delete questions
        try (PreparedStatement ps = conn.prepareStatement("DELETE FROM question WHERE quiz_id=?")) {
            ps.setInt(1, id);
            ps.executeUpdate();
        }
        // Delete the quiz
        try (PreparedStatement ps = conn.prepareStatement("DELETE FROM quiz WHERE id=?")) {
            ps.setInt(1, id);
            ps.executeUpdate();
        }
    }

    public List<Quiz> fetchAll() throws SQLException {
        List<Quiz> list = new ArrayList<>();
        String sql = "SELECT * FROM quiz";
        Connection conn = MyDB.getInstance().getConnection();
        try (Statement st = conn.createStatement();
             ResultSet rs = st.executeQuery(sql)) {
            while (rs.next()) {
                list.add(new Quiz(
                        rs.getInt("id"),
                        rs.getString("title"),
                        rs.getString("description"),
                        rs.getInt("time_limit"),
                        rs.getInt("total_score")
                ));
            }
        }
        return list;
    }
}