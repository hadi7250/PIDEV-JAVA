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
import java.util.stream.Collectors;

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
        Connection c = null;
        try {
            c = conn();
            c.setAutoCommit(false); // Start transaction
            
            // Step 1: Get all discussion IDs in this category
            List<Integer> discussionIds = new ArrayList<>();
            String getDiscussionsSql = "SELECT id_forum_discussion FROM forum_discussions WHERE id_forum_category = ?";
            try (PreparedStatement ps = c.prepareStatement(getDiscussionsSql)) {
                ps.setInt(1, id);
                ResultSet rs = ps.executeQuery();
                while (rs.next()) {
                    discussionIds.add(rs.getInt("id_forum_discussion"));
                }
            }
            
            // Step 2: Delete all votes for all messages in these discussions
            if (!discussionIds.isEmpty()) {
                String getMessageIdsSql = "SELECT id FROM forum_messages WHERE discussion_id IN (" + 
                    String.join(",", discussionIds.stream().map(String::valueOf).collect(Collectors.toList())) + ")";
                List<Integer> messageIds = new ArrayList<>();
                try (PreparedStatement ps2 = c.prepareStatement(getMessageIdsSql)) {
                    ResultSet rs2 = ps2.executeQuery();
                    while (rs2.next()) {
                        messageIds.add(rs2.getInt("id"));
                    }
                }
                
                if (!messageIds.isEmpty()) {
                    String deleteVotesSql = "DELETE FROM forum_votes WHERE message_id IN (" + 
                        String.join(",", messageIds.stream().map(String::valueOf).collect(Collectors.toList())) + ")";
                    try (PreparedStatement ps3 = c.prepareStatement(deleteVotesSql)) {
                        ps3.executeUpdate();
                    }
                }
                
                // Step 3: Delete all messages in these discussions
                String deleteMessagesSql = "DELETE FROM forum_messages WHERE discussion_id IN (" + 
                    String.join(",", discussionIds.stream().map(String::valueOf).collect(Collectors.toList())) + ")";
                try (PreparedStatement ps4 = c.prepareStatement(deleteMessagesSql)) {
                    ps4.executeUpdate();
                }
            }
            
            // Step 4: Delete all discussions in this category
            String deleteDiscussionsSql = "DELETE FROM forum_discussions WHERE id_forum_category = ?";
            try (PreparedStatement ps5 = c.prepareStatement(deleteDiscussionsSql)) {
                ps5.setInt(1, id);
                ps5.executeUpdate();
            }
            
            // Step 5: Delete the category itself
            String deleteCategorySql = "DELETE FROM forum_category WHERE id_forum_category = ?";
            try (PreparedStatement ps6 = c.prepareStatement(deleteCategorySql)) {
                ps6.setInt(1, id);
                ps6.executeUpdate();
            }
            
            c.commit(); // Commit transaction
            
        } catch (Exception e) {
            if (c != null) {
                try {
                    c.rollback(); // Rollback on error
                } catch (SQLException rollbackEx) {
                    rollbackEx.printStackTrace();
                }
            }
            e.printStackTrace();
        } finally {
            if (c != null) {
                try {
                    c.setAutoCommit(true); // Restore auto-commit
                    c.close();
                } catch (SQLException closeEx) {
                    closeEx.printStackTrace();
                }
            }
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
