package services;

import models.ForumDiscussion;
import models.ForumMessage;
import utils.MyDB;

import java.sql.*;
import java.time.LocalDateTime;
import java.util.ArrayList;
import java.util.List;

public class NotificationService {
    private static NotificationService instance;
    
    private NotificationService() {}
    
    public static synchronized NotificationService getInstance() {
        if (instance == null) {
            instance = new NotificationService();
        }
        return instance;
    }
    
    /**
     * Creates a notification for a user when someone replies to their discussion
     */
    public void createDiscussionReplyNotification(int userId, String discussionTitle, int discussionId, String replyAuthor) {
        String message = String.format("New reply to your discussion '%s' from %s", discussionTitle, replyAuthor);
        System.out.println("Creating discussion reply notification for user " + userId + ": " + message);
        createNotification(userId, "discussion_reply", message, discussionId, null);
    }
    
    /**
     * Creates a notification for a user when someone replies to their message
     */
    public void createMessageReplyNotification(int userId, String discussionTitle, int discussionId, String replyAuthor) {
        String message = String.format("New reply to your message in '%s' from %s", discussionTitle, replyAuthor);
        System.out.println("Creating message reply notification for user " + userId + ": " + message);
        createNotification(userId, "message_reply", message, discussionId, null);
    }
    
    /**
     * Creates a notification when a discussion is marked as solved
     */
    public void createDiscussionSolvedNotification(int discussionAuthorId, String discussionTitle, int discussionId) {
        String message = String.format("Your discussion '%s' has been marked as solved", discussionTitle);
        createNotification(discussionAuthorId, "discussion_solved", message, discussionId, null);
    }
    
    /**
     * Creates a general notification
     */
    private void createNotification(int userId, String type, String message, int discussionId, Integer messageId) {
        String query = """
            INSERT INTO notifications (user_id, type, message, discussion_id, message_id, created_at, is_read)
            VALUES (?, ?, ?, ?, ?, ?, FALSE)
        """;
        
        try (Connection conn = MyDB.getInstance().getConnection();
             PreparedStatement stmt = conn.prepareStatement(query)) {
            
            stmt.setInt(1, userId);
            stmt.setString(2, type);
            stmt.setString(3, message);
            stmt.setInt(4, discussionId);
            if (messageId != null) {
                stmt.setInt(5, messageId);
            } else {
                stmt.setNull(5, Types.INTEGER);
            }
            stmt.setTimestamp(6, Timestamp.valueOf(LocalDateTime.now()));
            
            int result = stmt.executeUpdate();
            System.out.println("Notification created successfully for user " + userId + ", result: " + result);
            
        } catch (SQLException e) {
            System.err.println("Error creating notification: " + e.getMessage());
            e.printStackTrace();
        }
    }
    
    /**
     * Gets all unread notifications for a user
     */
    public List<Notification> getUnreadNotifications(int userId) {
        return getNotifications(userId, false);
    }
    
    /**
     * Gets all notifications for a user (read and unread)
     */
    public List<Notification> getAllNotifications(int userId) {
        return getNotifications(userId, null);
    }
    
    private List<Notification> getNotifications(int userId, Boolean unreadOnly) {
        List<Notification> notifications = new ArrayList<>();
        String query = """
            SELECT id, user_id, type, message, discussion_id, message_id, created_at, is_read
            FROM notifications
            WHERE user_id = ?
            """ + (unreadOnly != null ? "AND is_read = " + (unreadOnly ? "TRUE" : "FALSE") : "") + """
            ORDER BY created_at DESC
            LIMIT 50
        """;
        
        try (Connection conn = MyDB.getInstance().getConnection();
             PreparedStatement stmt = conn.prepareStatement(query)) {
            
            stmt.setInt(1, userId);
            ResultSet rs = stmt.executeQuery();
            
            while (rs.next()) {
                Notification notification = new Notification();
                notification.setId(rs.getInt("id"));
                notification.setUserId(rs.getInt("user_id"));
                notification.setType(rs.getString("type"));
                notification.setMessage(rs.getString("message"));
                notification.setDiscussionId(rs.getInt("discussion_id"));
                notification.setMessageId(rs.getInt("message_id"));
                notification.setCreatedAt(rs.getTimestamp("created_at").toLocalDateTime());
                notification.setRead(rs.getBoolean("is_read"));
                notifications.add(notification);
            }
            
        } catch (SQLException e) {
            System.err.println("Error getting notifications: " + e.getMessage());
        }
        
        return notifications;
    }
    
    /**
     * Marks a notification as read
     */
    public void markAsRead(int notificationId) {
        String query = "UPDATE notifications SET is_read = TRUE WHERE id = ?";
        
        try (Connection conn = MyDB.getInstance().getConnection();
             PreparedStatement stmt = conn.prepareStatement(query)) {
            
            stmt.setInt(1, notificationId);
            stmt.executeUpdate();
            
        } catch (SQLException e) {
            System.err.println("Error marking notification as read: " + e.getMessage());
        }
    }
    
    /**
     * Marks all notifications for a user as read
     */
    public void markAllAsRead(int userId) {
        String query = "UPDATE notifications SET is_read = TRUE WHERE user_id = ?";
        
        try (Connection conn = MyDB.getInstance().getConnection();
             PreparedStatement stmt = conn.prepareStatement(query)) {
            
            stmt.setInt(1, userId);
            stmt.executeUpdate();
            
        } catch (SQLException e) {
            System.err.println("Error marking all notifications as read: " + e.getMessage());
        }
    }
    
    /**
     * Gets the count of unread notifications for a user
     */
    public int getUnreadCount(int userId) {
        String query = "SELECT COUNT(*) FROM notifications WHERE user_id = ? AND is_read = FALSE";
        
        try (Connection conn = MyDB.getInstance().getConnection();
             PreparedStatement stmt = conn.prepareStatement(query)) {
            
            stmt.setInt(1, userId);
            ResultSet rs = stmt.executeQuery();
            if (rs.next()) {
                int count = rs.getInt(1);
                System.out.println("Unread notification count for user " + userId + ": " + count);
                return count;
            }
            
        } catch (SQLException e) {
            System.err.println("Error getting unread count: " + e.getMessage());
            e.printStackTrace();
        }
        
        System.out.println("No unread notifications found for user " + userId);
        return 0;
    }
    
    /**
     * Deletes old notifications (older than 30 days)
     */
    public void cleanupOldNotifications() {
        String query = "DELETE FROM notifications WHERE created_at < DATE_SUB(NOW(), INTERVAL 30 DAY)";
        
        try (Connection conn = MyDB.getInstance().getConnection();
             PreparedStatement stmt = conn.prepareStatement(query)) {
            
            int deleted = stmt.executeUpdate();
            if (deleted > 0) {
                System.out.println("Cleaned up " + deleted + " old notifications");
            }
            
        } catch (SQLException e) {
            System.err.println("Error cleaning up old notifications: " + e.getMessage());
        }
    }
    
    /**
     * Notification model class
     */
    public static class Notification {
        private int id;
        private int userId;
        private String type;
        private String message;
        private int discussionId;
        private int messageId;
        private LocalDateTime createdAt;
        private boolean isRead;
        
        // Getters and setters
        public int getId() { return id; }
        public void setId(int id) { this.id = id; }
        
        public int getUserId() { return userId; }
        public void setUserId(int userId) { this.userId = userId; }
        
        public String getType() { return type; }
        public void setType(String type) { this.type = type; }
        
        public String getMessage() { return message; }
        public void setMessage(String message) { this.message = message; }
        
        public int getDiscussionId() { return discussionId; }
        public void setDiscussionId(int discussionId) { this.discussionId = discussionId; }
        
        public int getMessageId() { return messageId; }
        public void setMessageId(int messageId) { this.messageId = messageId; }
        
        public LocalDateTime getCreatedAt() { return createdAt; }
        public void setCreatedAt(LocalDateTime createdAt) { this.createdAt = createdAt; }
        
        public boolean isRead() { return isRead; }
        public void setRead(boolean read) { isRead = read; }
    }
}
