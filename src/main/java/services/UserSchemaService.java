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
                INSERT IGNORE INTO user (first_name, last_name, age, email, password, role) 
                VALUES ('Admin', 'User', 25, 'admin@educonnect.com', 'admin123', 'ADMIN')
                """;
            stmt.executeUpdate(insertAdmin);
            System.out.println("Default admin user created/verified");

            String insertUser = """
                INSERT IGNORE INTO user (first_name, last_name, age, email, password, role) 
                VALUES ('John', 'Doe', 20, 'john@educonnect.com', 'user123', 'USER')
                """;
            stmt.executeUpdate(insertUser);
            System.out.println("Sample user created/verified");

        } catch (SQLException e) {
            System.err.println("Error inserting default users: " + e.getMessage());
        }
    }

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
