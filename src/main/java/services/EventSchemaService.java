package services;

import utils.MyDB;
import java.sql.Connection;
import java.sql.SQLException;
import java.sql.Statement;

public class EventSchemaService {

    public static void ensureSchema() {
        Connection conn = MyDB.getInstance().getConnection();
        if (conn == null) {
            System.err.println("❌ EventSchemaService: Connection null. Check your MySQL.");
            return;
        }
        try (Statement stmt = conn.createStatement()) {


            System.out.println("Initializing Event module schema...");

            // 1. Create Category Table
            String createCategoryTable = "CREATE TABLE IF NOT EXISTS event_category (" +
                "id INT AUTO_INCREMENT PRIMARY KEY, " +
                "name VARCHAR(100) NOT NULL UNIQUE" +
                ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
            stmt.executeUpdate(createCategoryTable);

            // 2. Insert Default Categories if empty
            String insertDefaults = "INSERT IGNORE INTO event_category (name) VALUES " +
                "('Workshop'), ('Conference'), ('Seminar'), ('Competition'), ('Other')";
            stmt.executeUpdate(insertDefaults);

            // 3. Create Event Table
            String createEventTable = "CREATE TABLE IF NOT EXISTS event (" +
                "id INT AUTO_INCREMENT PRIMARY KEY, " +
                "titre VARCHAR(255) NOT NULL, " +
                "dateDebut DATETIME NOT NULL, " +
                "dateFin DATETIME NOT NULL, " +
                "lieu VARCHAR(255), " +
                "description TEXT, " +
                "duree INT DEFAULT 0, " +
                "nombreMaxParticipants INT DEFAULT 0, " +
                "image VARCHAR(255), " +
                "category_id INT, " +
                "CONSTRAINT fk_event_category FOREIGN KEY (category_id) " +
                "REFERENCES event_category(id) ON DELETE SET NULL" +
                ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
            stmt.executeUpdate(createEventTable);

            // 4. Create Participation Table
            String createParticipationTable = "CREATE TABLE IF NOT EXISTS participation (" +
                "id INT AUTO_INCREMENT PRIMARY KEY, " +
                "user_id INT NOT NULL, " +
                "event_id INT NOT NULL, " +
                "date_inscription DATETIME NOT NULL, " +
                "UNIQUE KEY uq_participation_user_event (user_id, event_id), " +
                "CONSTRAINT fk_part_user FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE, " +
                "CONSTRAINT fk_part_event FOREIGN KEY (event_id) REFERENCES event(id) ON DELETE CASCADE" +
                ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
            stmt.executeUpdate(createParticipationTable);

            // 5. Create Rating Table
            String createRatingTable = "CREATE TABLE IF NOT EXISTS rating (" +
                "id INT AUTO_INCREMENT PRIMARY KEY, " +
                "user_id INT NOT NULL, " +
                "event_id INT NOT NULL, " +
                "note INT NOT NULL, " +
                "commentaire TEXT, " +
                "date_creation DATETIME NOT NULL, " +
                "UNIQUE KEY uq_rating_user_event (user_id, event_id), " +
                "CONSTRAINT fk_rating_user FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE, " +
                "CONSTRAINT fk_rating_event FOREIGN KEY (event_id) REFERENCES event(id) ON DELETE CASCADE" +
                ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
            stmt.executeUpdate(createRatingTable);

            // 6. Create Certificat Table
            String createCertificatTable = "CREATE TABLE IF NOT EXISTS certificat (" +
                "id INT AUTO_INCREMENT PRIMARY KEY, " +
                "user_id INT NOT NULL, " +
                "event_id INT NOT NULL, " +
                "date_obtention DATETIME, " +
                "code_unique VARCHAR(64) NOT NULL UNIQUE, " +
                "CONSTRAINT fk_cert_user FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE, " +
                "CONSTRAINT fk_cert_event FOREIGN KEY (event_id) REFERENCES event(id) ON DELETE CASCADE" +
                ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
            stmt.executeUpdate(createCertificatTable);

            System.out.println("✅ Event module schema initialized successfully!");

        } catch (SQLException e) {
            System.err.println("❌ Error initializing event schema: " + e.getMessage());
        }
    }
}
