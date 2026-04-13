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
        String sql = "INSERT INTO competence (name, description, category, maxLevel, certificate) VALUES (?, ?, ?, ?, ?)";
        try (PreparedStatement pst = connection.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
            pst.setString(1, competence.getName());
            pst.setString(2, competence.getDescription());
            pst.setString(3, competence.getCategory());
            pst.setInt(4, competence.getMaxLevel());
            pst.setString(5, competence.getCertificate());
            pst.executeUpdate();

            ResultSet rs = pst.getGeneratedKeys();
            if (rs.next()) {
                competence.setId(rs.getInt(1));
            }
        }
    }
        }
    }

    @Override
    public void update(Competence competence) throws SQLException {
        String sql = "UPDATE competence SET name = ?, description = ?, category = ?, maxLevel = ? WHERE id = ?";
        try (PreparedStatement pst = connection.prepareStatement(sql)) {
            pst.setString(1, competence.getName());
            pst.setString(2, competence.getDescription());
            pst.setString(3, competence.getCategory());
            pst.setInt(4, competence.getMaxLevel());
            pst.setInt(5, competence.getId());
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
                c.setName(rs.getString("name"));
                c.setDescription(rs.getString("description"));
                c.setCategory(rs.getString("category"));
                c.setMaxLevel(rs.getInt("maxLevel"));
                list.add(c);
            }
        }
        return list;
    }
}