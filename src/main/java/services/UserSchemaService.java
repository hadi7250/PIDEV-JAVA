package services;

import utils.MyDB;

import java.sql.Connection;
import java.sql.Statement;
import java.sql.SQLException;

/**
 * Service class to ensure user-related database tables exist and are properly structured.
 * This should be called during application startup.
 */
public class UserSchemaService {

    /**
     * Creates all user-related tables if they don't exist.
     * Call this method during application initialization.
     */
    public static void ensureSchema() {
        try (Connection conn = MyDB.getInstance().getConnection();
             Statement stmt = conn.createStatement()) {

            System.out.println("Creating user schema tables...");

            // Create user table
            String createUserTable = """
                CREATE TABLE IF NOT EXISTS user (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    first_name VARCHAR(50) NOT NULL,
                    last_name VARCHAR(50) NOT NULL,
                    age INT NOT NULL,
                    email VARCHAR(100) NOT NULL UNIQUE,
                    password VARCHAR(255) NOT NULL,
                    role ENUM('USER', 'ADMIN') NOT NULL DEFAULT 'USER',
                    photo_path VARCHAR(255),
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                )
                """;

            stmt.executeUpdate(createUserTable);
            System.out.println("✓ User table created/verified");

            // Create forum_votes table
            String createForumVotesTable = """
                CREATE TABLE IF NOT EXISTS forum_votes (
                    user_id INT NOT NULL,
                    message_id INT NOT NULL,
                    vote_type ENUM('up', 'down') NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    PRIMARY KEY (user_id, message_id),
                    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE,
                    FOREIGN KEY (message_id) REFERENCES forum_message(id_forum_message) ON DELETE CASCADE
                )
                """;

            stmt.executeUpdate(createForumVotesTable);
            System.out.println("✓ Forum votes table created/verified");

            // Insert default admin user if not exists
            insertDefaultUsers(stmt);

            System.out.println("User schema setup completed successfully!");

        } catch (SQLException e) {
            System.err.println("Error creating user schema: " + e.getMessage());
            e.printStackTrace();
        }
    }

    /**
     * Inserts default users (admin and sample user) if they don't already exist.
     */
    private static void insertDefaultUsers(Statement stmt) throws SQLException {
        try {
            // Insert admin user
            String insertAdmin = """
                INSERT IGNORE INTO user (first_name, last_name, age, email, password, role) 
                VALUES ('Admin', 'User', 25, 'admin@educonnect.com', 'admin123', 'ADMIN')
                """;
            stmt.executeUpdate(insertAdmin);
            System.out.println("✓ Default admin user created/verified");

            // Insert sample regular user
            String insertUser = """
                INSERT IGNORE INTO user (first_name, last_name, age, email, password, role) 
                VALUES ('John', 'Doe', 20, 'john@educonnect.com', 'user123', 'USER')
                """;
            stmt.executeUpdate(insertUser);
            System.out.println("✓ Sample user created/verified");

        } catch (SQLException e) {
            System.err.println("Error inserting default users: " + e.getMessage());
            // Don't rethrow - this is not critical for schema creation
        }
    }

    /**
     * Checks if the user table exists.
     */
    public static boolean userTableExists() {
        try (Connection conn = MyDB.getInstance().getConnection();
             Statement stmt = conn.createStatement()) {

            String query = "SHOW TABLES LIKE 'user'";
            return stmt.executeQuery(query).next();

        } catch (SQLException e) {
            System.err.println("Error checking user table: " + e.getMessage());
            return false;
        }
    }

    /**
     * Checks if the forum_votes table exists.
     */
    public static boolean forumVotesTableExists() {
        try (Connection conn = MyDB.getInstance().getConnection();
             Statement stmt = conn.createStatement()) {

            String query = "SHOW TABLES LIKE 'forum_votes'";
            return stmt.executeQuery(query).next();

        } catch (SQLException e) {
            System.err.println("Error checking forum_votes table: " + e.getMessage());
            return false;
        }
    }
}
