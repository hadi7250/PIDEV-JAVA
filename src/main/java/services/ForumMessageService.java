package services;

import models.ForumMessage;
import utils.MyDB;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.sql.Timestamp;
import java.util.ArrayList;
import java.util.List;

public class ForumMessageService {

    public ForumMessageService() {
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
            SELECT m.id_forum_message,
                   m.forum_message_content,
                   m.forum_message_author_name,
                   m.forum_message_is_author,
                   COALESCE((SELECT COUNT(*) FROM forum_votes v WHERE v.message_id = m.id_forum_message AND v.vote_type = 'up'), 0) AS forum_message_upvotes,
                   COALESCE((SELECT COUNT(*) FROM forum_votes v WHERE v.message_id = m.id_forum_message AND v.vote_type = 'down'), 0) AS forum_message_downvotes,
                   m.forum_message_created_at,
                   m.forum_message_updated_at,
                   m.id_forum_discussion,
                   d.forum_discussion_title AS discussion_title,
                   m.parent_message_id
            FROM forum_message m
            LEFT JOIN forum_discussion d ON d.id_forum_discussion = m.id_forum_discussion
            """;

    public List<ForumMessage> getAllMessages() {
        List<ForumMessage> list = new ArrayList<>();
        String sql = BASE_SELECT + " ORDER BY m.forum_message_created_at ASC, m.id_forum_message ASC";

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

    public List<ForumMessage> getMessagesByDiscussion(int discussionId) {
        List<ForumMessage> list = new ArrayList<>();
        String sql = BASE_SELECT +
                " WHERE m.id_forum_discussion = ?" +
                " ORDER BY m.forum_message_created_at ASC, m.id_forum_message ASC";

        try {
            Connection c = conn();
            try (PreparedStatement ps = c.prepareStatement(sql)) {
                ps.setInt(1, discussionId);
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

    public int addMessage(ForumMessage message) {
        String sql = """
                INSERT INTO forum_message
                    (forum_message_content, forum_message_author_name, forum_message_is_author,
                     forum_message_upvotes, forum_message_downvotes,
                     forum_message_created_at, id_forum_discussion, parent_message_id)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)
                """;

        try {
            Connection c = conn();
            try (PreparedStatement ps = c.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
                ps.setString(1, message.getContent());
                ps.setString(2, message.getAuthorName() == null ? "" : message.getAuthorName());
                ps.setInt(3, message.isAuthor() ? 1 : 0);
                ps.setInt(4, message.getUpvotes());
                ps.setInt(5, message.getDownvotes());
                ps.setTimestamp(6, message.getCreatedAt() == null
                        ? new Timestamp(System.currentTimeMillis())
                        : message.getCreatedAt());
                ps.setInt(7, message.getDiscussionId());
                if (message.getParentMessageId() != null) {
                    ps.setInt(8, message.getParentMessageId());
                } else {
                    ps.setNull(8, java.sql.Types.INTEGER);
                }
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

    public void updateMessage(ForumMessage message) {
        String sql = """
                UPDATE forum_message
                SET forum_message_content = ?,
                    forum_message_author_name = ?,
                    forum_message_is_author = ?,
                    forum_message_updated_at = ?
                WHERE id_forum_message = ?
                """;

        try {
            Connection c = conn();
            try (PreparedStatement ps = c.prepareStatement(sql)) {
                ps.setString(1, message.getContent());
                ps.setString(2, message.getAuthorName() == null ? "" : message.getAuthorName());
                ps.setInt(3, message.isAuthor() ? 1 : 0);
                ps.setTimestamp(4, new Timestamp(System.currentTimeMillis()));
                ps.setInt(5, message.getId());
                ps.executeUpdate();
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public void deleteMessage(int id) {
        String sql = "DELETE FROM forum_message WHERE id_forum_message = ?";

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

    
    private ForumMessage map(ResultSet rs) throws SQLException {
        Integer parentMessageId = rs.getObject("parent_message_id", Integer.class);
        return new ForumMessage(
                rs.getInt("id_forum_message"),
                rs.getString("forum_message_content"),
                rs.getString("forum_message_author_name"),
                rs.getInt("forum_message_is_author") == 1,
                rs.getInt("forum_message_upvotes"),
                rs.getInt("forum_message_downvotes"),
                rs.getTimestamp("forum_message_created_at"),
                rs.getTimestamp("forum_message_updated_at"),
                rs.getInt("id_forum_discussion"),
                rs.getString("discussion_title"),
                parentMessageId
        );
    }
}
