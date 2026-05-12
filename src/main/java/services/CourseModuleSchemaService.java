package services;

import utils.MyDB;

import java.sql.Connection;
import java.sql.SQLException;
import java.sql.Statement;

public final class CourseModuleSchemaService {
    private static boolean initialized;

    private CourseModuleSchemaService() {
    }

    public static synchronized void ensureSchema() {
        if (initialized) {
            return;
        }

        try {
            Connection connection = MyDB.getInstance().getConnection();
            if (connection == null) {
                System.err.println("❌ CourseModuleSchemaService: Connection null. Check your MySQL.");
                return;
            }
            try (Statement st = connection.createStatement()) {

                st.executeUpdate("""
                        CREATE TABLE IF NOT EXISTS cours (
                            id_cours INT AUTO_INCREMENT PRIMARY KEY,
                            titre VARCHAR(100) NOT NULL,
                            description VARCHAR(255) NOT NULL,
                            created_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
                        """);

                st.executeUpdate("""
                        CREATE TABLE IF NOT EXISTS chapitre (
                            id_chapitre INT AUTO_INCREMENT PRIMARY KEY,
                            titre VARCHAR(100) NOT NULL,
                            contenu LONGTEXT NOT NULL,
                            resource_url TEXT NULL,
                            id_cours INT NOT NULL,
                            ai_summary TEXT NULL,
                            INDEX idx_chapitre_cours (id_cours),
                            CONSTRAINT fk_chapitre_cours
                                FOREIGN KEY (id_cours)
                                REFERENCES cours(id_cours)
                                ON DELETE CASCADE
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
                        """);

                st.executeUpdate("""
                        ALTER TABLE chapitre
                        ADD COLUMN IF NOT EXISTS resource_url TEXT NULL AFTER contenu
                        """);

                st.executeUpdate("""
                        ALTER TABLE chapitre
                        MODIFY COLUMN contenu LONGTEXT NOT NULL
                        """);

                st.executeUpdate("""
                        ALTER TABLE chapitre
                        MODIFY COLUMN resource_url TEXT NULL
                        """);
            }

            initialized = true;
        } catch (SQLException e) {
            throw new IllegalStateException("Failed to initialize cours/chapitre schema.", e);
        }
    }
}
