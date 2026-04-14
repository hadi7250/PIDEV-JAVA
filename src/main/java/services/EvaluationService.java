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
    }

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
        String sql = "SELECT e.*, c.title as comp_title, c.description as comp_desc, c.category as comp_cat, c.maxLevel as comp_level, c.certificate as comp_cert, c.user_id as comp_user_id, c.createdAt as comp_created, c.updatedAt as comp_updated " +
                    "FROM evaluation e JOIN competence c ON e.competence_id = c.id";
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
                c.setUserId(rs.getInt("comp_user_id"));
                c.setTitle(rs.getString("comp_title"));
                c.setDescription(rs.getString("comp_desc"));
                c.setCategory(rs.getString("comp_cat"));
                c.setMaxLevel(rs.getInt("comp_level"));
                c.setCertificate(rs.getString("comp_cert"));
                c.setCreatedAt(rs.getTimestamp("comp_created").toLocalDateTime());
                c.setUpdatedAt(rs.getTimestamp("comp_updated").toLocalDateTime());
                e.setCompetence(c);
                
                list.add(e);
            }
        }
        return list;
    }

    public List<Evaluation> readByStudent(int studentId) throws SQLException {
        List<Evaluation> list = new ArrayList<>();
        String sql = "SELECT e.*, c.title as comp_title, c.description as comp_desc, c.category as comp_cat, c.maxLevel as comp_level, c.certificate as comp_cert, c.user_id as comp_user_id, c.createdAt as comp_created, c.updatedAt as comp_updated " +
                    "FROM evaluation e JOIN competence c ON e.competence_id = c.id " +
                    "WHERE c.user_id = ?";
        try (PreparedStatement pst = connection.prepareStatement(sql)) {
            pst.setInt(1, studentId);
            try (ResultSet rs = pst.executeQuery()) {
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
                    c.setUserId(rs.getInt("comp_user_id"));
                    c.setTitle(rs.getString("comp_title"));
                    c.setDescription(rs.getString("comp_desc"));
                    c.setCategory(rs.getString("comp_cat"));
                    c.setMaxLevel(rs.getInt("comp_level"));
                    c.setCertificate(rs.getString("comp_cert"));
                    c.setCreatedAt(rs.getTimestamp("comp_created").toLocalDateTime());
                    c.setUpdatedAt(rs.getTimestamp("comp_updated").toLocalDateTime());
                    e.setCompetence(c);

                    list.add(e);
                }
            }
        }
        return list;
    }
    }