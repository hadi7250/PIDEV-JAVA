package services;

import models.Cours;
import utils.MyDB;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.sql.Timestamp;
import java.util.ArrayList;
import java.util.List;

public class CoursService {

    public CoursService() {
        CourseModuleSchemaService.ensureSchema();
    }

    private Connection conn() throws SQLException {
        Connection c = MyDB.getInstance().getConnection();
        if (c == null) {
            throw new SQLException("MyDB.getConnection() returned null.");
        }
        return c;
    }

    public List<Cours> getAllCours() {
        List<Cours> list = new ArrayList<>();
        String sql = """
                SELECT c.id_cours,
                       c.titre,
                       c.description,
                       c.created_at,
                       COUNT(ch.id_chapitre) AS chapter_count
                FROM cours c
                LEFT JOIN chapitre ch ON ch.id_cours = c.id_cours
                GROUP BY c.id_cours, c.titre, c.description, c.created_at
                ORDER BY c.created_at DESC, c.id_cours DESC
                """;

        try {
            Connection c = conn();
            try (PreparedStatement ps = c.prepareStatement(sql);
                 ResultSet rs = ps.executeQuery()) {

                while (rs.next()) {
                    list.add(map(rs));
                }
            }
        } catch (Exception e) {
            e.printStackTrace();
        }

        return list;
    }

    public Cours getCoursById(int id) {
        String sql = """
                SELECT c.id_cours,
                       c.titre,
                       c.description,
                       c.created_at,
                       COUNT(ch.id_chapitre) AS chapter_count
                FROM cours c
                LEFT JOIN chapitre ch ON ch.id_cours = c.id_cours
                WHERE c.id_cours = ?
                GROUP BY c.id_cours, c.titre, c.description, c.created_at
                LIMIT 1
                """;

        try {
            Connection c = conn();
            try (PreparedStatement ps = c.prepareStatement(sql)) {
                ps.setInt(1, id);
                try (ResultSet rs = ps.executeQuery()) {
                    if (rs.next()) {
                        return map(rs);
                    }
                }
            }
        } catch (Exception e) {
            e.printStackTrace();
        }

        return null;
    }

    public int addCours(Cours cours) {
        String sql = "INSERT INTO cours (titre, description, created_at) VALUES (?, ?, ?)";

        try {
            Connection c = conn();
            try (PreparedStatement ps = c.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
                ps.setString(1, cours.getTitre());
                ps.setString(2, cours.getDescription());
                ps.setTimestamp(3, cours.getCreatedAt() == null
                        ? new Timestamp(System.currentTimeMillis())
                        : cours.getCreatedAt());
                ps.executeUpdate();

                try (ResultSet keys = ps.getGeneratedKeys()) {
                    if (keys.next()) {
                        return keys.getInt(1);
                    }
                }
            }
        } catch (Exception e) {
            e.printStackTrace();
        }

        return -1;
    }

    public void updateCours(Cours cours) {
        String sql = "UPDATE cours SET titre = ?, description = ? WHERE id_cours = ?";

        try {
            Connection c = conn();
            try (PreparedStatement ps = c.prepareStatement(sql)) {
                ps.setString(1, cours.getTitre());
                ps.setString(2, cours.getDescription());
                ps.setInt(3, cours.getId());
                ps.executeUpdate();
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public void deleteCours(int id) {
        String sql = "DELETE FROM cours WHERE id_cours = ?";

        try {
            Connection c = conn();
            try (PreparedStatement ps = c.prepareStatement(sql)) {
                ps.setInt(1, id);
                ps.executeUpdate();
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private Cours map(ResultSet rs) throws SQLException {
        return new Cours(
                rs.getInt("id_cours"),
                rs.getString("titre"),
                rs.getString("description"),
                rs.getTimestamp("created_at"),
                rs.getInt("chapter_count")
        );
    }
}
