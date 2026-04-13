package services;

import entities.Evaluation;
import entities.Competence;
import utils.MyConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class EvaluationService implements IService<Evaluation> {
    private Connection connection;

    public EvaluationService() {
        connection = MyConnection.getInstance().getConnection();
    }

    @Override
    public void create(Evaluation evaluation) throws SQLException {
        String sql = "INSERT INTO evaluation (title, description, type, date, score, status, comment, competence_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        try (PreparedStatement pst = connection.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
            pst.setString(1, evaluation.getTitle());
            pst.setString(2, evaluation.getDescription());
            pst.setString(3, evaluation.getType());
            pst.setTimestamp(4, Timestamp.valueOf(evaluation.getDate()));
            pst.setFloat(5, evaluation.getScore());
            pst.setString(6, evaluation.getStatus());
            pst.setString(7, evaluation.getComment());
            pst.setInt(8, evaluation.getCompetence().getId());
            pst.executeUpdate();

            ResultSet rs = pst.getGeneratedKeys();
            if (rs.next()) {
                evaluation.setId(rs.getInt(1));
            }
        }
    }`n
    @Override
    public void update(Evaluation evaluation) throws SQLException {
        String sql = "UPDATE evaluation SET title = ?, description = ?, type = ?, date = ?, score = ?, status = ?, comment = ?, competence_id = ? WHERE id = ?";
        try (PreparedStatement pst = connection.prepareStatement(sql)) {
            pst.setString(1, evaluation.getTitle());
            pst.setString(2, evaluation.getDescription());
            pst.setString(3, evaluation.getType());
            pst.setTimestamp(4, Timestamp.valueOf(evaluation.getDate()));
            pst.setFloat(5, evaluation.getScore());
            pst.setString(6, evaluation.getStatus());
            pst.setString(7, evaluation.getComment());
            pst.setInt(8, evaluation.getCompetence().getId());
            pst.setInt(9, evaluation.getId());
            pst.executeUpdate();
        }
    }

    @Override
    public void delete(Evaluation evaluation) throws SQLException {
        String sql = "DELETE FROM evaluation WHERE id = ?";
        try (PreparedStatement pst = connection.prepareStatement(sql)) {
            pst.setInt(1, evaluation.getId());
            pst.executeUpdate();
        }
    }

    @Override
    public List<Evaluation> readAll() throws SQLException {
        List<Evaluation> list = new ArrayList<>();
        String sql = "SELECT * FROM evaluation";
        try (Statement st = connection.createStatement();
             ResultSet rs = st.executeQuery(sql)) {
            while (rs.next()) {
                Evaluation e = new Evaluation();
                e.setId(rs.getInt("id"));
                e.setTitle(rs.getString("title"));
                e.setDescription(rs.getString("description"));
                e.setType(rs.getString("type"));
                e.setDate(rs.getTimestamp("date").toLocalDateTime());
                e.setScore(rs.getFloat("score"));
                e.setStatus(rs.getString("status"));
                e.setComment(rs.getString("comment"));
                
                Competence c = new Competence();
                c.setId(rs.getInt("competence_id"));
                e.setCompetence(c);
                
                list.add(e);
            }
        }
        return list;
    }
}