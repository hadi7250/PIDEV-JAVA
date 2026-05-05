package services;

import utils.MyDB;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;

/**
 * Singleton service for retrieving forum statistics.
 * All methods are backed by real SQL queries on existing forum tables.
 */
public class ForumStatsService {
    
    private static ForumStatsService instance;
    
    private ForumStatsService() {
        // Private constructor for singleton
    }
    
    /**
     * Gets the singleton instance of ForumStatsService.
     * 
     * @return The ForumStatsService instance
     */
    public static ForumStatsService getInstance() {
        if (instance == null) {
            synchronized (ForumStatsService.class) {
                if (instance == null) {
                    instance = new ForumStatsService();
                }
            }
        }
        return instance;
    }
    
    /**
     * Gets the total number of discussions in the forum.
     * 
     * @return Total count of discussions
     */
    public int getTotalDiscussions() {
        String query = "SELECT COUNT(*) FROM forum_discussion";
        
        try (Connection conn = MyDB.getInstance().getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(query)) {
            
            if (rs.next()) {
                return rs.getInt(1);
            }
        } catch (SQLException e) {
            System.err.println("Error getting total discussions: " + e.getMessage());
        }
        return 0;
    }
    
    /**
     * Gets the total number of messages in the forum.
     * 
     * @return Total count of messages
     */
    public int getTotalMessages() {
        String query = "SELECT COUNT(*) FROM forum_message";
        
        try (Connection conn = MyDB.getInstance().getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(query)) {
            
            if (rs.next()) {
                return rs.getInt(1);
            }
        } catch (SQLException e) {
            System.err.println("Error getting total messages: " + e.getMessage());
        }
        return 0;
    }
    
    /**
     * Gets the name of the category with the most discussions.
     * 
     * @return Category name with most discussions, or "None" if no categories exist
     */
    public String getMostActiveCategory() {
        String query = """
            SELECT c.forum_category_name 
            FROM forum_category c
            LEFT JOIN forum_discussion d ON c.id_forum_category = d.id_forum_category
            GROUP BY c.id_forum_category, c.forum_category_name
            ORDER BY COUNT(d.id_forum_discussion) DESC, c.forum_category_name
            LIMIT 1
            """;
        
        try (Connection conn = MyDB.getInstance().getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(query)) {
            
            if (rs.next()) {
                String categoryName = rs.getString("forum_category_name");
                return categoryName != null ? categoryName : "None";
            }
        } catch (SQLException e) {
            System.err.println("Error getting most active category: " + e.getMessage());
        }
        return "None";
    }
    
    /**
     * Gets the author name who has posted the most messages.
     * 
     * @return Author name with most messages, or "None" if no messages exist
     */
    public String getTopAuthor() {
        String query = """
            SELECT forum_message_author_name 
            FROM forum_message
            GROUP BY forum_message_author_name
            ORDER BY COUNT(*) DESC, forum_message_author_name
            LIMIT 1
            """;
        
        try (Connection conn = MyDB.getInstance().getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(query)) {
            
            if (rs.next()) {
                String authorName = rs.getString("forum_message_author_name");
                return authorName != null ? authorName : "None";
            }
        } catch (SQLException e) {
            System.err.println("Error getting top author: " + e.getMessage());
        }
        return "None";
    }
    
    /**
     * Gets the total number of upvotes across all messages.
     * 
     * @return Sum of all upvotes
     */
    public int getTotalVotes() {
        String query = "SELECT SUM(forum_message_upvotes) FROM forum_message";
        
        try (Connection conn = MyDB.getInstance().getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(query)) {
            
            if (rs.next()) {
                return rs.getInt(1);
            }
        } catch (SQLException e) {
            System.err.println("Error getting total votes: " + e.getMessage());
        }
        return 0;
    }
    
    /**
     * Gets a list of the most recent discussion titles.
     * 
     * @param limit Maximum number of discussions to return
     * @return List of discussion titles ordered by creation date descending
     */
    public List<String> getRecentActivityLog(int limit) {
        List<String> recentDiscussions = new ArrayList<>();
        String query = """
            SELECT forum_discussion_title 
            FROM forum_discussion 
            ORDER BY forum_discussion_created_at DESC 
            LIMIT ?
            """;
        
        try (Connection conn = MyDB.getInstance().getConnection();
             PreparedStatement pstmt = conn.prepareStatement(query)) {
            
            pstmt.setInt(1, limit);
            
            try (ResultSet rs = pstmt.executeQuery()) {
                while (rs.next()) {
                    String title = rs.getString("forum_discussion_title");
                    if (title != null) {
                        recentDiscussions.add(title);
                    }
                }
            }
        } catch (SQLException e) {
            System.err.println("Error getting recent activity: " + e.getMessage());
        }
        
        return recentDiscussions;
    }
    
    /**
     * Gets the total number of categories in the forum.
     * 
     * @return Total count of categories
     */
    public int getTotalCategories() {
        String query = "SELECT COUNT(*) FROM forum_category";
        
        try (Connection conn = MyDB.getInstance().getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(query)) {
            
            if (rs.next()) {
                return rs.getInt(1);
            }
        } catch (SQLException e) {
            System.err.println("Error getting total categories: " + e.getMessage());
        }
        return 0;
    }
    
    /**
     * Gets the total number of solved discussions.
     * 
     * @return Count of discussions marked as solved
     */
    public int getSolvedDiscussions() {
        String query = "SELECT COUNT(*) FROM forum_discussion WHERE solved = TRUE";
        
        try (Connection conn = MyDB.getInstance().getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(query)) {
            
            if (rs.next()) {
                return rs.getInt(1);
            }
        } catch (SQLException e) {
            System.err.println("Error getting solved discussions: " + e.getMessage());
        }
        return 0;
    }
    
    /**
     * Gets the average number of messages per discussion.
     * 
     * @return Average messages per discussion (rounded to 2 decimal places)
     */
    public double getAverageMessagesPerDiscussion() {
        String query = """
            SELECT AVG(message_count) as avg_messages
            FROM (
                SELECT COUNT(m.id_forum_message) as message_count
                FROM forum_discussion d
                LEFT JOIN forum_message m ON d.id_forum_discussion = m.id_forum_discussion
                GROUP BY d.id_forum_discussion
            ) AS counts
            """;
        
        try (Connection conn = MyDB.getInstance().getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(query)) {
            
            if (rs.next()) {
                double avg = rs.getDouble("avg_messages");
                return Math.round(avg * 100.0) / 100.0; // Round to 2 decimal places
            }
        } catch (SQLException e) {
            System.err.println("Error getting average messages: " + e.getMessage());
        }
        return 0.0;
    }
}
