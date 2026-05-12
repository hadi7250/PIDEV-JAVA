package services;

import models.ForumDiscussion;
import utils.MyDB;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.sql.Timestamp;
import java.util.ArrayList;
import java.util.List;

public class ForumDiscussionService {

    public ForumDiscussionService() {
        ForumSchemaService.ensureSchema();
    }

    private Connection conn() throws SQLException {
        Connection c = MyDB.getInstance().getConnection();
        if (c == null) {
            throw new SQLException("MyDB.getConnection() returned null.");
        }
        return c;
    }

    private static final String BASE_SELECT = """
            SELECT d.id_forum_discussion,
                   d.forum_discussion_title,
                   d.forum_discussion_content,
                   d.forum_discussion_author_name,
                   d.forum_discussion_is_pinned,
                   d.forum_discussion_is_locked,
                   COALESCE((SELECT COUNT(*) FROM forum_views v WHERE v.discussion_id = d.id_forum_discussion), 0) AS forum_discussion_views,
                   d.forum_discussion_created_at,
                   d.forum_discussion_updated_at,
                   d.id_forum_category,
                   c.forum_category_name AS category_name,
                   (SELECT COUNT(*) FROM forum_message m WHERE m.id_forum_discussion = d.id_forum_discussion) AS message_count,
                   d.solved
            FROM forum_discussion d
            LEFT JOIN forum_category c ON c.id_forum_category = d.id_forum_category
            """;

    public List<ForumDiscussion> getAllDiscussions() {
        List<ForumDiscussion> list = new ArrayList<>();
        String sql = BASE_SELECT +
                " ORDER BY d.forum_discussion_is_pinned DESC, d.forum_discussion_created_at DESC, d.id_forum_discussion DESC";

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

    public List<ForumDiscussion> getDiscussionsByCategory(int categoryId) {
        List<ForumDiscussion> list = new ArrayList<>();
        String sql = BASE_SELECT +
                " WHERE d.id_forum_category = ?" +
                " ORDER BY d.forum_discussion_is_pinned DESC, d.forum_discussion_created_at DESC";

        try {
            Connection c = conn();
            try (PreparedStatement ps = c.prepareStatement(sql)) {
                ps.setInt(1, categoryId);
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

    public ForumDiscussion getDiscussionById(int id) {
        String sql = BASE_SELECT + " WHERE d.id_forum_discussion = ? LIMIT 1";

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

    public int addDiscussion(ForumDiscussion discussion) {
        String sql = """
                INSERT INTO forum_discussion
                    (forum_discussion_title, forum_discussion_content, forum_discussion_author_name,
                     forum_discussion_is_pinned, forum_discussion_is_locked, forum_discussion_views,
                     forum_discussion_created_at, id_forum_category, solved)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
                """;

        try {
            Connection c = conn();
            try (PreparedStatement ps = c.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
                ps.setString(1, discussion.getTitle());
                ps.setString(2, discussion.getContent());
                ps.setString(3, discussion.getAuthorName());
                ps.setInt(4, discussion.isPinned() ? 1 : 0);
                ps.setInt(5, discussion.isLocked() ? 1 : 0);
                ps.setInt(6, discussion.getViews());
                ps.setTimestamp(7, discussion.getCreatedAt() == null
                        ? new Timestamp(System.currentTimeMillis())
                        : discussion.getCreatedAt());
                if (discussion.getCategoryId() > 0) {
                    ps.setInt(8, discussion.getCategoryId());
                } else {
                    ps.setNull(8, java.sql.Types.INTEGER);
                }
                ps.setBoolean(9, discussion.isSolved());
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

    public void updateDiscussion(ForumDiscussion discussion) {
        String sql = """
                UPDATE forum_discussion
                SET forum_discussion_title = ?,
                    forum_discussion_content = ?,
                    forum_discussion_author_name = ?,
                    forum_discussion_is_pinned = ?,
                    forum_discussion_is_locked = ?,
                    forum_discussion_updated_at = ?,
                    id_forum_category = ?,
                    solved = ?
                WHERE id_forum_discussion = ?
                """;

        try {
            Connection c = conn();
            try (PreparedStatement ps = c.prepareStatement(sql)) {
                ps.setString(1, discussion.getTitle());
                ps.setString(2, discussion.getContent());
                ps.setString(3, discussion.getAuthorName());
                ps.setInt(4, discussion.isPinned() ? 1 : 0);
                ps.setInt(5, discussion.isLocked() ? 1 : 0);
                ps.setTimestamp(6, new Timestamp(System.currentTimeMillis()));
                if (discussion.getCategoryId() > 0) {
                    ps.setInt(7, discussion.getCategoryId());
                } else {
                    ps.setNull(7, java.sql.Types.INTEGER);
                }
                ps.setBoolean(8, discussion.isSolved());
                ps.setInt(9, discussion.getId());
                ps.executeUpdate();
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public void deleteDiscussion(int id) {
        String sql = "DELETE FROM forum_discussion WHERE id_forum_discussion = ?";

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

    public void incrementViews(int id) {
        String sql = "UPDATE forum_discussion SET forum_discussion_views = forum_discussion_views + 1 WHERE id_forum_discussion = ?";

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

    public void togglePinned(int discussionId, boolean pinned) {
        String sql = "UPDATE forum_discussion SET forum_discussion_is_pinned = ? WHERE id_forum_discussion = ?";

        try {
            Connection c = conn();
            try (PreparedStatement ps = c.prepareStatement(sql)) {
                ps.setInt(1, pinned ? 1 : 0);
                ps.setInt(2, discussionId);
                ps.executeUpdate();
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public void toggleSolved(int discussionId, boolean solved) {
        String sql = "UPDATE forum_discussion SET solved = ? WHERE id_forum_discussion = ?";

        try {
            Connection c = conn();
            try (PreparedStatement ps = c.prepareStatement(sql)) {
                ps.setBoolean(1, solved);
                ps.setInt(2, discussionId);
                ps.executeUpdate();
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public List<ForumDiscussion> getFilteredDiscussions(int categoryId, String sortBy, String searchText) {
        List<ForumDiscussion> list = new ArrayList<>();
        
        StringBuilder sql = new StringBuilder(BASE_SELECT);
        
        // Add LEFT JOIN for message count if needed for replies sorting
        if ("replies".equals(sortBy)) {
            sql = new StringBuilder("""
                    SELECT d.id_forum_discussion,
                           d.forum_discussion_title,
                           d.forum_discussion_content,
                           d.forum_discussion_author_name,
                           d.forum_discussion_is_pinned,
                           d.forum_discussion_is_locked,
                           COALESCE((SELECT COUNT(*) FROM forum_views v WHERE v.discussion_id = d.id_forum_discussion), 0) AS forum_discussion_views,
                           d.forum_discussion_created_at,
                           d.forum_discussion_updated_at,
                           d.id_forum_category,
                           c.forum_category_name AS category_name,
                           COUNT(m.id_forum_message) AS message_count,
                           d.solved
                    FROM forum_discussion d
                    LEFT JOIN forum_category c ON c.id_forum_category = d.id_forum_category
                    LEFT JOIN forum_message m ON m.id_forum_discussion = d.id_forum_discussion
                    """);
        }
        
        // Add WHERE clauses
        List<String> whereClauses = new ArrayList<>();
        
        if (categoryId > 0) {
            whereClauses.add("d.id_forum_category = ?");
        }
        
        if (searchText != null && !searchText.trim().isEmpty()) {
            whereClauses.add("(LOWER(d.forum_discussion_title) LIKE LOWER(?) OR LOWER(d.forum_discussion_content) LIKE LOWER(?) OR LOWER(d.forum_discussion_author_name) LIKE LOWER(?))");
        }
        
        if ("pinned".equals(sortBy)) {
            whereClauses.add("d.forum_discussion_is_pinned = 1");
        }
        
        if ("solved".equals(sortBy)) {
            whereClauses.add("d.solved = true");
        }
        
        if (!whereClauses.isEmpty()) {
            sql.append(" WHERE ").append(String.join(" AND ", whereClauses));
        }
        
        // Add GROUP BY for replies sorting
        if ("replies".equals(sortBy)) {
            sql.append(" GROUP BY d.id_forum_discussion");
        }
        
        // Add ORDER BY
        switch (sortBy) {
            case "views":
                sql.append(" ORDER BY d.forum_discussion_views DESC, d.forum_discussion_created_at DESC");
                break;
            case "replies":
                sql.append(" ORDER BY message_count DESC, d.forum_discussion_created_at DESC");
                break;
            case "newest":
                sql.append(" ORDER BY d.forum_discussion_created_at DESC");
                break;
            case "pinned":
                sql.append(" ORDER BY d.forum_discussion_is_pinned DESC, d.forum_discussion_created_at DESC");
                break;
            case "solved":
                sql.append(" ORDER BY d.solved DESC, d.forum_discussion_created_at DESC");
                break;
            default:
                sql.append(" ORDER BY d.forum_discussion_is_pinned DESC, d.forum_discussion_created_at DESC");
                break;
        }

        try {
            Connection c = conn();
            try (PreparedStatement ps = c.prepareStatement(sql.toString())) {
                int paramIndex = 1;
                
                if (categoryId > 0) {
                    ps.setInt(paramIndex++, categoryId);
                }
                
                if (searchText != null && !searchText.trim().isEmpty()) {
                    String searchPattern = "%" + searchText.trim() + "%";
                    ps.setString(paramIndex++, searchPattern);
                    ps.setString(paramIndex++, searchPattern);
                    ps.setString(paramIndex++, searchPattern);
                }
                
                ResultSet rs = ps.executeQuery();
                while (rs.next()) {
                    list.add(map(rs));
                }
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
        
        return list;
    }

    private ForumDiscussion map(ResultSet rs) throws SQLException {
        return new ForumDiscussion(
                rs.getInt("id_forum_discussion"),
                rs.getString("forum_discussion_title"),
                rs.getString("forum_discussion_content"),
                rs.getString("forum_discussion_author_name"),
                rs.getInt("forum_discussion_is_pinned") == 1,
                rs.getInt("forum_discussion_is_locked") == 1,
                rs.getInt("forum_discussion_views"),
                rs.getTimestamp("forum_discussion_created_at"),
                rs.getTimestamp("forum_discussion_updated_at"),
                rs.getInt("id_forum_category"),
                rs.getString("category_name"),
                rs.getInt("message_count"),
                rs.getBoolean("solved")
        );
    }
}
