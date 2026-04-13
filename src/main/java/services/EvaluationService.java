package services;

import entities.Evaluation;
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
        String sql = "INSERT INTO evaluation (title, description, type, evaluationDate, weight, competenceId, createdAt) VALUES (?, ?, ?, ?, ?, ?, ?)";
        try (PreparedStatement pst = connection.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
            pst.setString(1, evaluation.getTitle());
            pst.setString(2, evaluation.getDescription());
            pst.setString(3, evaluation.getType());
            pst.setTimestamp(4, Timestamp.valueOf(evaluation.getEvaluationDate()));
            pst.setDouble(5, evaluation.getWeight());
            pst.setLong(6, evaluation.getCompetenceId());
            pst.setTimestamp(7, Timestamp.valueOf(evaluation.getCreatedAt()));
            pst.executeUpdate();

            ResultSet rs = pst.getGeneratedKeys();
            if (rs.next()) {
                evaluation.setId(rs.getLong(1));
            }
        }
    }

    @Override
    public void update(Evaluation evaluation) throws SQLException {
        String sql = "UPDATE evaluation SET title = ?, description = ?, type = ?, evaluationDate = ?, weight = ?, competenceId = ? WHERE id = ?";
        try (PreparedStatement pst = connection.prepareStatement(sql)) {
            pst.setString(1, evaluation.getTitle());
            pst.setString(2, evaluation.getDescription());
            pst.setString(3, evaluation.getType());
            pst.setTimestamp(4, Timestamp.valueOf(evaluation.getEvaluationDate()));
            pst.setDouble(5, evaluation.getWeight());
            pst.setLong(6, evaluation.getCompetenceId());
            pst.setLong(7, evaluation.getId());
            pst.executeUpdate();
        }
    }

    @Override
    public void delete(Evaluation evaluation) throws SQLException {
        String sql = "DELETE FROM evaluation WHERE id = ?";
        try (PreparedStatement pst = connection.prepareStatement(sql)) {
            pst.setLong(1, evaluation.getId());
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
                e.setId(rs.getLong("id"));
                e.setTitle(rs.getString("title"));
                e.setDescription(rs.getString("description"));
                e.setType(rs.getString("type"));
                e.setEvaluationDate(rs.getTimestamp("evaluationDate").toLocalDateTime());
                e.setWeight(rs.getDouble("weight"));
                e.setCompetenceId(rs.getLong("competenceId"));
                e.setCreatedAt(rs.getTimestamp("createdAt").toLocalDateTime());
                list.add(e);
            }
        }
        return list;
    }
}