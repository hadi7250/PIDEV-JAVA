package services;

import models.ForumCategory;
import utils.MyDB;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.sql.Timestamp;
import java.util.ArrayList;
import java.util.List;

public class ForumCategoryService {

    public ForumCategoryService() {
        ForumSchemaService.ensureSchema();
    }

    private Connection conn() throws SQLException {
        Connection c = MyDB.getInstance().getConnection();
        if (c == null) {
            throw new SQLException("MyDB.getConnection() returned null.");
        }
        return c;
    }

    public List<ForumCategory> getAllCategories() {
        List<ForumCategory> list = new ArrayList<>();
        String sql = """
                SELECT c.id_forum_category,
                       c.forum_category_name,
                       c.forum_category_description,
                       c.forum_category_color,
                       c.forum_category_created_at,
                       c.forum_category_updated_at,
                       COUNT(d.id_forum_discussion) AS discussion_count
                FROM forum_category c
                LEFT JOIN forum_discussion d ON d.id_forum_category = c.id_forum_category
                GROUP BY c.id_forum_category, c.forum_category_name, c.forum_category_description,
                         c.forum_category_color, c.forum_category_created_at, c.forum_category_updated_at
                ORDER BY c.forum_category_created_at DESC, c.id_forum_category DESC
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

    public ForumCategory getCategoryById(int id) {
        String sql = """
                SELECT c.id_forum_category,
                       c.forum_category_name,
                       c.forum_category_description,
                       c.forum_category_color,
                       c.forum_category_created_at,
                       c.forum_category_updated_at,
                       COUNT(d.id_forum_discussion) AS discussion_count
                FROM forum_category c
                LEFT JOIN forum_discussion d ON d.id_forum_category = c.id_forum_category
                WHERE c.id_forum_category = ?
                GROUP BY c.id_forum_category, c.forum_category_name, c.forum_category_description,
                         c.forum_category_color, c.forum_category_created_at, c.forum_category_updated_at
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

    public int addCategory(ForumCategory category) {
        String sql = """
                INSERT INTO forum_category
                    (forum_category_name, forum_category_description, forum_category_color, forum_category_created_at)
                VALUES (?, ?, ?, ?)
                """;

        try {
            Connection c = conn();
            try (PreparedStatement ps = c.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
                ps.setString(1, category.getName());
                ps.setString(2, emptyToNull(category.getDescription()));
                ps.setString(3, emptyToNull(category.getColor()));
                ps.setTimestamp(4, category.getCreatedAt() == null
                        ? new Timestamp(System.currentTimeMillis())
                        : category.getCreatedAt());
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

    public void updateCategory(ForumCategory category) {
        String sql = """
                UPDATE forum_category
                SET forum_category_name = ?,
                    forum_category_description = ?,
                    forum_category_color = ?,
                    forum_category_updated_at = ?
                WHERE id_forum_category = ?
                """;

        try {
            Connection c = conn();
            try (PreparedStatement ps = c.prepareStatement(sql)) {
                ps.setString(1, category.getName());
                ps.setString(2, emptyToNull(category.getDescription()));
                ps.setString(3, emptyToNull(category.getColor()));
                ps.setTimestamp(4, new Timestamp(System.currentTimeMillis()));
                ps.setInt(5, category.getId());
                ps.executeUpdate();
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public void deleteCategory(int id) {
        String sql = "DELETE FROM forum_category WHERE id_forum_category = ?";

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

    private ForumCategory map(ResultSet rs) throws SQLException {
        return new ForumCategory(
                rs.getInt("id_forum_category"),
                rs.getString("forum_category_name"),
                rs.getString("forum_category_description"),
                rs.getString("forum_category_color"),
                rs.getTimestamp("forum_category_created_at"),
                rs.getTimestamp("forum_category_updated_at"),
                rs.getInt("discussion_count")
        );
    }
}
