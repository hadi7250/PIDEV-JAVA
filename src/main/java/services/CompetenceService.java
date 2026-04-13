package services;

import entities.Competence;
import utils.MyConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class CompetenceService implements IService<Competence> {
    private Connection connection;

    public CompetenceService() {
        connection = MyConnection.getInstance().getConnection();
    }

    @Override
    public void create(Competence competence) throws SQLException {
        String sql = "INSERT INTO competence (name, description, category, maxLevel, createdAt, updatedAt) VALUES (?, ?, ?, ?, ?, ?)";
        try (PreparedStatement pst = connection.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
            pst.setString(1, competence.getName());
            pst.setString(2, competence.getDescription());
            pst.setString(3, competence.getCategory());
            pst.setInt(4, competence.getMaxLevel());
            pst.setTimestamp(5, Timestamp.valueOf(competence.getCreatedAt()));
            pst.setTimestamp(6, Timestamp.valueOf(competence.getUpdatedAt()));
            pst.executeUpdate();
            
            ResultSet rs = pst.getGeneratedKeys();
            if (rs.next()) {
                competence.setId(rs.getLong(1));
            }
        }
    }

    @Override
    public void update(Competence competence) throws SQLException {
        // Placeholder for now
    }

    @Override
    public void delete(Competence competence) throws SQLException {
        // Placeholder for now
    }

    @Override
    public List<Competence> readAll() throws SQLException {
        return new ArrayList<>();
    }
}