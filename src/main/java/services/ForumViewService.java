package services;

import utils.MyDB;

import java.sql.*;
import java.util.HashMap;
import java.util.Map;

public class ForumViewService {
    private static ForumViewService instance;
    
    private ForumViewService() {}
    
    public static synchronized ForumViewService getInstance() {
        if (instance == null) {
            instance = new ForumViewService();
        }
        return instance;
    }
    
    /**
     * Records a view for a discussion by a user (only once per user)
     * @param userId the user ID
     * @param discussionId the discussion ID
     * @return true if this is a new view, false if user already viewed
     */
    public boolean recordView(int userId, int discussionId) {
        if (userId <= 0 || discussionId <= 0) {
            return false;
        }
        
        String checkQuery = "SELECT COUNT(*) FROM forum_views WHERE user_id = ? AND discussion_id = ?";
        String insertQuery = "INSERT INTO forum_views (user_id, discussion_id) VALUES (?, ?)";
        
        try (Connection conn = MyDB.getInstance().getConnection()) {
            // Check if user already viewed this discussion
            try (PreparedStatement checkStmt = conn.prepareStatement(checkQuery)) {
                checkStmt.setInt(1, userId);
                checkStmt.setInt(2, discussionId);
                ResultSet rs = checkStmt.executeQuery();
                if (rs.next() && rs.getInt(1) > 0) {
                    return false; // Already viewed
                }
            }
            
            // Record new view
            try (PreparedStatement insertStmt = conn.prepareStatement(insertQuery)) {
                insertStmt.setInt(1, userId);
                insertStmt.setInt(2, discussionId);
                int result = insertStmt.executeUpdate();
                return result > 0;
            }
            
        } catch (SQLException e) {
            System.err.println("Error recording forum view: " + e.getMessage());
            return false;
        }
    }
    
    /**
     * Gets the total number of unique views for a discussion
     * @param discussionId the discussion ID
     * @return number of unique views
     */
    public int getUniqueViewCount(int discussionId) {
        if (discussionId <= 0) {
            return 0;
        }
        
        String query = "SELECT COUNT(*) FROM forum_views WHERE discussion_id = ?";
        
        try (Connection conn = MyDB.getInstance().getConnection();
             PreparedStatement stmt = conn.prepareStatement(query)) {
            
            stmt.setInt(1, discussionId);
            ResultSet rs = stmt.executeQuery();
            if (rs.next()) {
                return rs.getInt(1);
            }
            
        } catch (SQLException e) {
            System.err.println("Error getting view count: " + e.getMessage());
        }
        
        return 0;
    }
    
    /**
     * Checks if a user has viewed a specific discussion
     * @param userId the user ID
     * @param discussionId the discussion ID
     * @return true if user has viewed, false otherwise
     */
    public boolean hasUserViewed(int userId, int discussionId) {
        if (userId <= 0 || discussionId <= 0) {
            return false;
        }
        
        String query = "SELECT COUNT(*) FROM forum_views WHERE user_id = ? AND discussion_id = ?";
        
        try (Connection conn = MyDB.getInstance().getConnection();
             PreparedStatement stmt = conn.prepareStatement(query)) {
            
            stmt.setInt(1, userId);
            stmt.setInt(2, discussionId);
            ResultSet rs = stmt.executeQuery();
            if (rs.next()) {
                return rs.getInt(1) > 0;
            }
            
        } catch (SQLException e) {
            System.err.println("Error checking if user viewed: " + e.getMessage());
        }
        
        return false;
    }
    
    /**
     * Gets view statistics for all discussions
     * @return Map of discussion ID to view count
     */
    public Map<Integer, Integer> getAllDiscussionViewCounts() {
        Map<Integer, Integer> viewCounts = new HashMap<>();
        String query = "SELECT discussion_id, COUNT(*) as view_count FROM forum_views GROUP BY discussion_id";
        
        try (Connection conn = MyDB.getInstance().getConnection();
             PreparedStatement stmt = conn.prepareStatement(query);
             ResultSet rs = stmt.executeQuery()) {
            
            while (rs.next()) {
                viewCounts.put(rs.getInt("discussion_id"), rs.getInt("view_count"));
            }
            
        } catch (SQLException e) {
            System.err.println("Error getting all view counts: " + e.getMessage());
        }
        
        return viewCounts;
    }
    
    /**
     * Gets the most viewed discussions
     * @param limit maximum number of results
     * @return Map of discussion ID to view count
     */
    public Map<Integer, Integer> getMostViewedDiscussions(int limit) {
        Map<Integer, Integer> viewCounts = new HashMap<>();
        String query = "SELECT discussion_id, COUNT(*) as view_count FROM forum_views " +
                     "GROUP BY discussion_id ORDER BY view_count DESC LIMIT ?";
        
        try (Connection conn = MyDB.getInstance().getConnection();
             PreparedStatement stmt = conn.prepareStatement(query)) {
            
            stmt.setInt(1, limit);
            ResultSet rs = stmt.executeQuery();
            
            while (rs.next()) {
                viewCounts.put(rs.getInt("discussion_id"), rs.getInt("view_count"));
            }
            
        } catch (SQLException e) {
            System.err.println("Error getting most viewed discussions: " + e.getMessage());
        }
        
        return viewCounts;
    }
}
