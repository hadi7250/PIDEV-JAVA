package services;

import utils.MyDB;

import java.sql.Connection;
import java.sql.SQLException;
import java.sql.Statement;

public final class ForumSchemaService {
    private static boolean initialized;

    private ForumSchemaService() {
    }

    public static synchronized void ensureSchema() {
        if (initialized) {
            return;
        }

        try {
            Connection connection = MyDB.getInstance().getConnection();
            if (connection == null) {
                throw new SQLException("Database connection is not available.");
            }

            try (Statement st = connection.createStatement()) {
                st.executeUpdate("""
                        CREATE TABLE IF NOT EXISTS forum_category (
                            id_forum_category INT AUTO_INCREMENT PRIMARY KEY,
                            forum_category_name VARCHAR(255) NOT NULL,
                            forum_category_description LONGTEXT NULL,
                            forum_category_color VARCHAR(7) NULL,
                            forum_category_created_at DATETIME NOT NULL,
                            forum_category_updated_at DATETIME NULL
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
                        """);

                st.executeUpdate("""
                        CREATE TABLE IF NOT EXISTS forum_discussion (
                            id_forum_discussion INT AUTO_INCREMENT PRIMARY KEY,
                            forum_discussion_title VARCHAR(255) NOT NULL,
                            forum_discussion_content LONGTEXT NOT NULL,
                            forum_discussion_author_name VARCHAR(255) NOT NULL,
                            forum_discussion_is_pinned TINYINT NOT NULL DEFAULT 0,
                            forum_discussion_is_locked TINYINT NOT NULL DEFAULT 0,
                            forum_discussion_views INT NOT NULL DEFAULT 0,
                            forum_discussion_created_at DATETIME NOT NULL,
                            forum_discussion_updated_at DATETIME NULL,
                            id_forum_category INT NULL,
                            INDEX idx_forum_discussion_category (id_forum_category),
                            CONSTRAINT fk_forum_discussion_category
                                FOREIGN KEY (id_forum_category)
                                REFERENCES forum_category(id_forum_category)
                                ON DELETE SET NULL
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
                        """);

                // Add solved column to forum_discussions table (if not exists)
                try {
                    st.executeUpdate("ALTER TABLE forum_discussion ADD COLUMN IF NOT EXISTS solved BOOLEAN DEFAULT FALSE");
                    System.out.println("✓ Solved column added to forum_discussions table");
                } catch (SQLException e) {
                    // Column might already exist, ignore error
                    System.out.println("ℹ Solved column already exists or could not be added: " + e.getMessage());
                }

                try {
                    st.executeUpdate("ALTER TABLE forum_message ADD COLUMN IF NOT EXISTS parent_message_id INT NULL");
                    System.out.println("✓ Parent message column added to forum_message table");
                } catch (SQLException e) {
                    // Column might already exist, ignore error
                    System.out.println("ℹ Parent message column already exists or could not be added: " + e.getMessage());
                }

                st.executeUpdate("""
                        CREATE TABLE IF NOT EXISTS forum_message (
                            id_forum_message INT AUTO_INCREMENT PRIMARY KEY,
                            content TEXT NOT NULL,
                            author_name VARCHAR(255) NOT NULL,
                            discussion_id INT NOT NULL,
                            parent_message_id INT NULL,
                            created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                            INDEX idx_message_discussion (discussion_id),
                            INDEX idx_message_created (created_at),
                            INDEX idx_message_parent (parent_message_id),
                            CONSTRAINT fk_message_discussion
                                FOREIGN KEY (discussion_id)
                                REFERENCES forum_discussion(id_forum_discussion)
                                ON DELETE CASCADE,
                            CONSTRAINT fk_message_parent
                                FOREIGN KEY (parent_message_id)
                                REFERENCES forum_message(id_forum_message)
                                ON DELETE CASCADE
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
                        """);

                st.executeUpdate("""
                        CREATE TABLE IF NOT EXISTS forum_votes (
                            user_id INT NOT NULL,
                            message_id INT NOT NULL,
                            vote_type ENUM('up', 'down') NOT NULL,
                            created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                            PRIMARY KEY (user_id, message_id),
                            INDEX idx_forum_votes_user (user_id),
                            INDEX idx_forum_votes_message (message_id),
                            CONSTRAINT fk_forum_votes_user
                                FOREIGN KEY (user_id)
                                REFERENCES user(id)
                                ON DELETE CASCADE,
                            CONSTRAINT fk_forum_votes_message
                                FOREIGN KEY (message_id)
                                REFERENCES forum_message(id_forum_message)
                                ON DELETE CASCADE
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
                        """);

                st.executeUpdate("""
                        CREATE TABLE IF NOT EXISTS forum_views (
                            user_id INT NOT NULL,
                            discussion_id INT NOT NULL,
                            viewed_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                            PRIMARY KEY (user_id, discussion_id),
                            INDEX idx_forum_views_user (user_id),
                            INDEX idx_forum_views_discussion (discussion_id),
                            CONSTRAINT fk_forum_views_user
                                FOREIGN KEY (user_id)
                                REFERENCES user(id)
                                ON DELETE CASCADE,
                            CONSTRAINT fk_forum_views_discussion
                                FOREIGN KEY (discussion_id)
                                REFERENCES forum_discussion(id_forum_discussion)
                                ON DELETE CASCADE
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
                        """);

                st.executeUpdate("""
                        CREATE TABLE IF NOT EXISTS notifications (
                            id INT AUTO_INCREMENT PRIMARY KEY,
                            user_id INT NOT NULL,
                            type VARCHAR(50) NOT NULL,
                            message TEXT NOT NULL,
                            discussion_id INT NOT NULL,
                            message_id INT NULL,
                            created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                            is_read BOOLEAN DEFAULT FALSE,
                            INDEX idx_notifications_user (user_id),
                            INDEX idx_notifications_read (is_read),
                            INDEX idx_notifications_created (created_at),
                            CONSTRAINT fk_notifications_user
                                FOREIGN KEY (user_id)
                                REFERENCES user(id)
                                ON DELETE CASCADE,
                            CONSTRAINT fk_notifications_discussion
                                FOREIGN KEY (discussion_id)
                                REFERENCES forum_discussion(id_forum_discussion)
                                ON DELETE CASCADE,
                            CONSTRAINT fk_notifications_message
                                FOREIGN KEY (message_id)
                                REFERENCES forum_message(id_forum_message)
                                ON DELETE CASCADE
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
                        """);

                st.executeUpdate("""
                        CREATE TABLE IF NOT EXISTS forum_report (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          type ENUM('message', 'discussion') NOT NULL,
                          target_id INT NOT NULL,
                          reporter_id INT NOT NULL,
                          reason VARCHAR(255) NOT NULL,
                          status ENUM('pending', 'reviewed', 'dismissed') DEFAULT 'pending',
                          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                          INDEX idx_report_target (target_id, type),
                          INDEX idx_report_reporter (reporter_id),
                          INDEX idx_report_status (status),
                          INDEX idx_report_created (created_at),
                          CONSTRAINT fk_report_reporter
                            FOREIGN KEY (reporter_id)
                            REFERENCES user(id)
                            ON DELETE CASCADE
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
                        """);
            }

            initialized = true;
        } catch (SQLException e) {
            throw new IllegalStateException("Failed to initialize forum schema.", e);
        }
    }
}
