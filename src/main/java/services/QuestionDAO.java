package services;

import models.Question;
import utils.MyDB;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class QuestionDAO {

    public void insert(Question q) throws SQLException {
        String sql = "INSERT INTO question (question_text, options, correct_answer, points, quiz_id) VALUES (?, ?, ?, ?, ?)";
        Connection conn = MyDB.getInstance().getConnection();
        try (PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setString(1, q.getQuestionText());
            ps.setString(2, q.getOptions());
            ps.setString(3, q.getCorrectAnswer());
            ps.setInt(4, q.getPoints());
            ps.setInt(5, q.getQuizId());
            ps.executeUpdate();
        }
    }

    public void update(Question q) throws SQLException {
        String sql = "UPDATE question SET question_text=?, options=?, correct_answer=?, points=? WHERE id=?";
        Connection conn = MyDB.getInstance().getConnection();
        try (PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setString(1, q.getQuestionText());
            ps.setString(2, q.getOptions());
            ps.setString(3, q.getCorrectAnswer());
            ps.setInt(4, q.getPoints());
            ps.setInt(5, q.getId());
            ps.executeUpdate();
        }
    }

    public void delete(int id) throws SQLException {
        String sql = "DELETE FROM question WHERE id=?";
        Connection conn = MyDB.getInstance().getConnection();
        try (PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, id);
            ps.executeUpdate();
        }
    }

    public List<Question> fetchByQuizId(int quizId) throws SQLException {
        List<Question> list = new ArrayList<>();
        String sql = "SELECT * FROM question WHERE quiz_id=?";
        Connection conn = MyDB.getInstance().getConnection();
        try (PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, quizId);
            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                list.add(new Question(
                        rs.getInt("id"),
                        rs.getString("question_text"),
                        rs.getString("options"),
                        rs.getString("correct_answer"),
                        rs.getInt("points"),
                        rs.getInt("quiz_id")
                ));
            }
        }
        return list;
    }
}
