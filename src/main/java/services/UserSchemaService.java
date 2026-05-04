package services;

import utils.MyDB;

import java.sql.Connection;
import java.sql.SQLException;
import java.sql.Statement;

public class UserSchemaService {

    public static void ensureSchema() {
        try (Connection conn = MyDB.getInstance().getConnection();
             Statement stmt = conn.createStatement()) {

            System.out.println("Creating user schema tables...");

            String createUserTable = """
                CREATE TABLE IF NOT EXISTS user (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    firstName VARCHAR(50) NOT NULL,
                    lastName VARCHAR(50) NOT NULL,
                    age INT NOT NULL,
                    email VARCHAR(100) NOT NULL UNIQUE,
                    password VARCHAR(255) NOT NULL,
                    role ENUM('USER', 'ADMIN') NOT NULL DEFAULT 'USER',
                    photo_path VARCHAR(255),
                    reset_code VARCHAR(10) DEFAULT NULL,
                    reset_code_expiry DATETIME DEFAULT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                )
                """;

            stmt.executeUpdate(createUserTable);
            System.out.println("User table created/verified");

            insertDefaultUsers(stmt);

            System.out.println("User schema setup completed successfully!");

        } catch (SQLException e) {
            System.err.println("Error creating user schema: " + e.getMessage());
            e.printStackTrace();
        }
    }

    private static void insertDefaultUsers(Statement stmt) throws SQLException {
        try {
            String insertAdmin = """
                INSERT IGNORE INTO user (firstName, lastName, age, email, password, role) 
                VALUES ('Admin', 'User', 25, 'admin@educonnect.com', 'admin123', 'ADMIN')
                """;
            stmt.executeUpdate(insertAdmin);

            String insertUser = """
                INSERT IGNORE INTO user (firstName, lastName, age, email, password, role) 
                VALUES ('John', 'Doe', 20, 'john@educonnect.com', 'user123', 'USER')
                """;
            stmt.executeUpdate(insertUser);

        } catch (SQLException e) {
            System.err.println("Error inserting default users: " + e.getMessage());
        }
    }

    public static boolean userTableExists() {
        try (Connection conn = MyDB.getInstance().getConnection();
             Statement stmt = conn.createStatement()) {
            return stmt.executeQuery("SHOW TABLES LIKE 'user'").next();
        } catch (SQLException e) {
            return false;
        }
    }

    public static boolean forumVotesTableExists() {
        try (Connection conn = MyDB.getInstance().getConnection();
             Statement stmt = conn.createStatement()) {
            return stmt.executeQuery("SHOW TABLES LIKE 'forum_votes'").next();
        } catch (SQLException e) {
            return false;
        }
    }
}