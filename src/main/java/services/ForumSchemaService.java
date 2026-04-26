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

                st.executeUpdate("""
                        CREATE TABLE IF NOT EXISTS forum_message (
                            id_forum_message INT AUTO_INCREMENT PRIMARY KEY,
                            forum_message_content LONGTEXT NOT NULL,
                            forum_message_author_name VARCHAR(255) NOT NULL,
                            forum_message_is_author TINYINT NOT NULL DEFAULT 0,
                            forum_message_upvotes INT NOT NULL DEFAULT 0,
                            forum_message_downvotes INT NOT NULL DEFAULT 0,
                            forum_message_created_at DATETIME NOT NULL,
                            forum_message_updated_at DATETIME NULL,
                            id_forum_discussion INT NOT NULL,
                            INDEX idx_forum_message_discussion (id_forum_discussion),
                            CONSTRAINT fk_forum_message_discussion
                                FOREIGN KEY (id_forum_discussion)
                                REFERENCES forum_discussion(id_forum_discussion)
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
            }

            initialized = true;
        } catch (SQLException e) {
            throw new IllegalStateException("Failed to initialize forum schema.", e);
        }
    }
}
