package services;

import models.Chapitre;
import utils.MyDB;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;

public class ChapitreService {

    public ChapitreService() {
        CourseModuleSchemaService.ensureSchema();
    }

    private Connection conn() throws SQLException {
        Connection c = MyDB.getInstance().getConnection();
        if (c == null) {
            throw new SQLException("MyDB.getConnection() returned null.");
        }
        return c;
    }

    public List<Chapitre> getAllChapitres() {
        List<Chapitre> list = new ArrayList<>();
        String sql = """
                SELECT ch.id_chapitre,
                       ch.titre,
                       ch.contenu,
                       ch.resource_url,
                       ch.id_cours,
                       ch.ai_summary,
                       c.titre AS cours_titre
                FROM chapitre ch
                JOIN cours c ON c.id_cours = ch.id_cours
                ORDER BY c.titre ASC, ch.id_chapitre ASC
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

    public List<Chapitre> getChapitresByCoursId(int coursId) {
        List<Chapitre> list = new ArrayList<>();
        String sql = """
                SELECT ch.id_chapitre,
                       ch.titre,
                       ch.contenu,
                       ch.resource_url,
                       ch.id_cours,
                       ch.ai_summary,
                       c.titre AS cours_titre
                FROM chapitre ch
                JOIN cours c ON c.id_cours = ch.id_cours
                WHERE ch.id_cours = ?
                ORDER BY ch.id_chapitre ASC
                """;

        try {
            Connection c = conn();
            try (PreparedStatement ps = c.prepareStatement(sql)) {
                ps.setInt(1, coursId);
                try (ResultSet rs = ps.executeQuery()) {
                    while (rs.next()) {
                        list.add(map(rs));
                    }
                }
            }
        } catch (Exception e) {
            e.printStackTrace();
        }

        return list;
    }

    public int addChapitre(Chapitre chapitre) {
        String sql = "INSERT INTO chapitre (titre, contenu, resource_url, id_cours, ai_summary) VALUES (?, ?, ?, ?, ?)";

        try {
            Connection c = conn();
            try (PreparedStatement ps = c.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
                ps.setString(1, chapitre.getTitre());
                ps.setString(2, chapitre.getContenu());
                ps.setString(3, emptyToNull(chapitre.getResourceUrl()));
                ps.setInt(4, chapitre.getCoursId());
                ps.setString(5, emptyToNull(chapitre.getAiSummary()));
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

    public void updateChapitre(Chapitre chapitre) {
        String sql = """
                UPDATE chapitre
                SET titre = ?, contenu = ?, resource_url = ?, id_cours = ?, ai_summary = ?
                WHERE id_chapitre = ?
                """;

        try {
            Connection c = conn();
            try (PreparedStatement ps = c.prepareStatement(sql)) {
                ps.setString(1, chapitre.getTitre());
                ps.setString(2, chapitre.getContenu());
                ps.setString(3, emptyToNull(chapitre.getResourceUrl()));
                ps.setInt(4, chapitre.getCoursId());
                ps.setString(5, emptyToNull(chapitre.getAiSummary()));
                ps.setInt(6, chapitre.getId());
                ps.executeUpdate();
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public void deleteChapitre(int id) {
        String sql = "DELETE FROM chapitre WHERE id_chapitre = ?";

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

    private String emptyToNull(String value) {
        if (value == null || value.isBlank()) {
            return null;
        }
        return value.trim();
    }

    private Chapitre map(ResultSet rs) throws SQLException {
        return new Chapitre(
                rs.getInt("id_chapitre"),
                rs.getString("titre"),
                rs.getString("contenu"),
                rs.getString("resource_url"),
                rs.getInt("id_cours"),
                rs.getString("cours_titre"),
                rs.getString("ai_summary")
        );
    }
}
