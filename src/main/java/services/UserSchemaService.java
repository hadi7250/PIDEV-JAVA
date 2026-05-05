package services;

import utils.MyDB;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;
import java.util.Locale;

public class UserSchemaService {

    public static synchronized void ensureSchema() {
        try (Connection conn = MyDB.getInstance().getConnection();
             Statement stmt = conn.createStatement()) {

            System.out.println("Creating user schema tables...");

            String createUserTable = """
                CREATE TABLE IF NOT EXISTS `user` (
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

            migrateLegacyUserNameColumns(conn);
            reconcileLegacyRolesColumn(stmt);
            ensureRequiredUserColumns(stmt);

            insertDefaultUsers(stmt);

            System.out.println("User schema setup completed successfully!");

        } catch (SQLException e) {
            System.err.println("Error creating user schema: " + e.getMessage());
            e.printStackTrace();
        }
    }

    /**
     * Aligne les colonnes sur celles attendues par {@code UserService} (firstName / lastName).
     * Utilise {@code SHOW COLUMNS} pour obtenir les noms exacts (casse MySQL / variantes).
     */
    private static void migrateLegacyUserNameColumns(Connection conn) {
        try (Statement st = conn.createStatement()) {
            List<String> fields = readColumnNames(st);
            if (fields.isEmpty()) {
                return;
            }

            renameFirstLastUsingDiscovery(st, fields, "firstName", List.of("first_name", "firstname", "prenom"));
            fields = readColumnNames(st);
            renameFirstLastUsingDiscovery(st, fields, "lastName", List.of("last_name", "lastname", "nom"));

            fields = readColumnNames(st);
            if (!containsIgnoreCase(fields, "firstName")) {
                repairMissingNameColumn(st, fields, "firstName", "first_name", "firstname", "prenom");
            }
            fields = readColumnNames(st);
            if (!containsIgnoreCase(fields, "lastName")) {
                repairMissingNameColumn(st, fields, "lastName", "last_name", "lastname", "nom");
            }
        } catch (SQLException e) {
            System.err.println("[User schema] Migration colonnes `user`: " + e.getMessage());
            e.printStackTrace();
        }
    }

    private static List<String> readColumnNames(Statement st) throws SQLException {
        List<String> out = new ArrayList<>();
        try (ResultSet rs = st.executeQuery("SHOW COLUMNS FROM `user`")) {
            while (rs.next()) {
                out.add(rs.getString("Field"));
            }
        }
        return out;
    }

    private static boolean containsIgnoreCase(List<String> fields, String name) {
        String n = name.toLowerCase(Locale.ROOT);
        for (String f : fields) {
            if (f != null && f.toLowerCase(Locale.ROOT).equals(n)) {
                return true;
            }
        }
        return false;
    }

    private static String findExactColumn(List<String> fields, String... candidates) {
        for (String want : candidates) {
            String wl = want.toLowerCase(Locale.ROOT);
            for (String f : fields) {
                if (f != null && f.toLowerCase(Locale.ROOT).equals(wl)) {
                    return f;
                }
            }
        }
        return null;
    }

    private static void renameFirstLastUsingDiscovery(Statement st, List<String> fields, String target, List<String> legacyNames) {
        if (containsIgnoreCase(fields, target)) {
            return;
        }
        String from = findExactColumn(fields, legacyNames.toArray(new String[0]));
        if (from == null) {
            return;
        }
        String sql = "ALTER TABLE `user` CHANGE COLUMN `" + quoteIdent(from) + "` `" + quoteIdent(target) + "` VARCHAR(50) NOT NULL";
        try {
            st.executeUpdate(sql);
            System.out.println("[User schema] Colonne renommée: `" + from + "` → `" + target + "`");
        } catch (SQLException e) {
            System.err.println("[User schema] Échec renommage `" + from + "` → `" + target + "`: " + e.getMessage());
        }
    }

    /**
     * Si aucune colonne cible : ajoute {@code target} et recopie depuis la première source legacy présente.
     */
    private static void repairMissingNameColumn(Statement st, List<String> fields, String target, String... legacySources) {
        if (containsIgnoreCase(fields, target)) {
            return;
        }
        String copyFrom = findExactColumn(fields, legacySources);
        String qTarget = quoteIdent(target);
        try {
            st.executeUpdate("ALTER TABLE `user` ADD COLUMN `" + qTarget + "` VARCHAR(50) NOT NULL DEFAULT ''");
            System.out.println("[User schema] Colonne ajoutée: `" + target + "`");
        } catch (SQLException e) {
            if (e.getMessage() != null && e.getMessage().contains("Duplicate column name")) {
                return;
            }
            System.err.println("[User schema] ADD `" + target + "`: " + e.getMessage());
            return;
        }
        if (copyFrom != null) {
            String qFrom = quoteIdent(copyFrom);
            try {
                st.executeUpdate("UPDATE `user` SET `" + qTarget + "` = `" + qFrom + "` WHERE `" + qFrom + "` IS NOT NULL AND `" + qFrom + "` <> ''");
                System.out.println("[User schema] Données copiées: `" + copyFrom + "` → `" + target + "`");
            } catch (SQLException e) {
                System.err.println("[User schema] Copie `" + copyFrom + "` → `" + target + "`: " + e.getMessage());
            }
        }
        try {
            if ("firstName".equals(target)) {
                st.executeUpdate("UPDATE `user` SET `" + qTarget + "` = 'User' WHERE `" + qTarget + "` = '' OR `" + qTarget + "` IS NULL");
            } else {
                st.executeUpdate("UPDATE `user` SET `" + qTarget + "` = '' WHERE `" + qTarget + "` IS NULL");
            }
        } catch (SQLException e) {
            System.err.println("[User schema] Valeurs par défaut `" + target + "`: " + e.getMessage());
        }
    }

    private static String quoteIdent(String ident) {
        return ident.replace("`", "``");
    }

    /**
     * Schémas Symfony / anciens : colonne {@code roles} + CHECK (ex. ROLE_USER). Le code utilise {@code role}
     * avec les valeurs {@code USER}/{@code ADMIN}. On supprime les CHECK, on fusionne puis on retire {@code roles}.
     */
    private static void reconcileLegacyRolesColumn(Statement st) {
        try {
            dropAllCheckConstraintsOnUser(st);

            List<String> fields = readColumnNames(st);
            boolean hasRole = containsIgnoreCase(fields, "role");
            boolean hasRoles = containsIgnoreCase(fields, "roles");
            if (!hasRoles) {
                return;
            }

            String qRoles = findExactColumn(fields, "roles");
            if (qRoles == null) {
                return;
            }
            String qr = quoteIdent(qRoles);

            if (hasRole) {
                String qRole = findExactColumn(fields, "role");
                if (qRole != null) {
                    String qRoleQ = quoteIdent(qRole);
                    st.executeUpdate("""
                            UPDATE `user` SET `%s` = CASE
                              WHEN `%s` IS NOT NULL AND (
                                   LOWER(CAST(`%s` AS CHAR(128))) LIKE '%%admin%%'
                                OR LOWER(CAST(`%s` AS CHAR(128))) LIKE '%%super%%'
                                OR `%s` IN ('ROLE_ADMIN','ADMIN','admin','ROLE_SUPER_ADMIN','SUPER_ADMIN')
                              ) THEN 'ADMIN'
                              ELSE COALESCE(NULLIF(TRIM(`%s`), ''), 'USER')
                            END
                            """.formatted(qRoleQ, qr, qr, qr, qr, qRoleQ));
                    st.executeUpdate("ALTER TABLE `user` DROP COLUMN `" + qr + "`");
                    System.out.println("[User schema] Colonne `roles` supprimée (valeurs fusionnées dans `role`).");
                }
            } else {
                st.executeUpdate("ALTER TABLE `user` CHANGE COLUMN `" + qr + "` `role` VARCHAR(32) NOT NULL DEFAULT 'USER'");
                st.executeUpdate("""
                        UPDATE `user` SET `role` = CASE
                          WHEN LOWER(CAST(`role` AS CHAR(128))) LIKE '%admin%'
                            OR LOWER(CAST(`role` AS CHAR(128))) LIKE '%super%'
                            OR `role` IN ('ROLE_ADMIN','ADMIN','ROLE_SUPER_ADMIN','ROLE_ALLOWED_TO_SWITCH')
                          THEN 'ADMIN'
                          ELSE 'USER'
                        END
                        """);
                System.out.println("[User schema] Colonne `roles` renommée en `role` (valeurs normalisées USER/ADMIN).");
            }
        } catch (SQLException e) {
            System.err.println("[User schema] Fusion role/roles: " + e.getMessage());
        }
    }

    private static void dropAllCheckConstraintsOnUser(Statement st) {
        List<String> names = new ArrayList<>();
        try (ResultSet rs = st.executeQuery(
                "SELECT CONSTRAINT_NAME FROM information_schema.TABLE_CONSTRAINTS "
                        + "WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'user' AND CONSTRAINT_TYPE = 'CHECK'")) {
            while (rs.next()) {
                names.add(rs.getString(1));
            }
        } catch (SQLException e) {
            return;
        }
        for (String name : names) {
            try {
                st.executeUpdate("ALTER TABLE `user` DROP CHECK `" + quoteIdent(name) + "`");
                System.out.println("[User schema] Contrainte CHECK supprimée: `" + name + "`");
            } catch (SQLException e) {
                System.err.println("[User schema] DROP CHECK `" + name + "`: " + e.getMessage());
            }
        }
    }

    /**
     * Tables héritées : souvent {@code firstName}/{@code lastName} ajoutés sans {@code age}, etc.
     * Renommages courants puis {@code ADD COLUMN} pour tout ce qui manque encore.
     */
    private static void ensureRequiredUserColumns(Statement st) throws SQLException {
        List<String> fields = readColumnNames(st);
        if (fields.isEmpty()) {
            return;
        }

        renameColumnTyped(st, fields, "email", List.of("mail", "user_email", "e_mail"), "VARCHAR(100) NULL");
        fields = readColumnNames(st);
        renameColumnTyped(st, fields, "password", List.of("passwd", "pwd", "mot_de_passe", "pass"), "VARCHAR(255) NULL");
        fields = readColumnNames(st);
        renameColumnTyped(st, fields, "age", List.of("user_age", "ages"), "INT NULL");
        fields = readColumnNames(st);

        tryAddColumn(st, fields, "age", "INT NOT NULL DEFAULT 18");
        fields = readColumnNames(st);
        tryAddColumn(st, fields, "email", "VARCHAR(100) NULL");
        fields = readColumnNames(st);
        tryAddColumn(st, fields, "password", "VARCHAR(255) NULL");
        fields = readColumnNames(st);
        tryAddColumn(st, fields, "role", "VARCHAR(32) NOT NULL DEFAULT 'USER'");
        fields = readColumnNames(st);
        tryAddColumn(st, fields, "photo_path", "VARCHAR(255) NULL");
        fields = readColumnNames(st);
        tryAddColumn(st, fields, "reset_code", "VARCHAR(10) NULL");
        fields = readColumnNames(st);
        tryAddColumn(st, fields, "reset_code_expiry", "DATETIME NULL");
        fields = readColumnNames(st);
        tryAddColumn(st, fields, "created_at", "TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP");
        fields = readColumnNames(st);
        tryAddColumn(st, fields, "updated_at", "TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");

        backfillNullableEmailsAndPasswords(st);
        normalizeAgeAndRole(st);
    }

    private static void renameColumnTyped(Statement st, List<String> fields, String target, List<String> legacyNames, String sqlType) {
        if (containsIgnoreCase(fields, target)) {
            return;
        }
        String from = findExactColumn(fields, legacyNames.toArray(new String[0]));
        if (from == null) {
            return;
        }
        String sql = "ALTER TABLE `user` CHANGE COLUMN `" + quoteIdent(from) + "` `" + quoteIdent(target) + "` " + sqlType;
        try {
            st.executeUpdate(sql);
            System.out.println("[User schema] Colonne renommée: `" + from + "` → `" + target + "`");
        } catch (SQLException e) {
            System.err.println("[User schema] Renommage `" + from + "` → `" + target + "`: " + e.getMessage());
        }
    }

    private static void tryAddColumn(Statement st, List<String> fields, String col, String ddlSuffix) {
        if (containsIgnoreCase(fields, col)) {
            return;
        }
        try {
            st.executeUpdate("ALTER TABLE `user` ADD COLUMN `" + quoteIdent(col) + "` " + ddlSuffix);
            System.out.println("[User schema] Colonne ajoutée: `" + col + "`");
        } catch (SQLException e) {
            if (e.getMessage() != null && e.getMessage().contains("Duplicate column name")) {
                return;
            }
            System.err.println("[User schema] ADD `" + col + "`: " + e.getMessage());
        }
    }

    private static void backfillNullableEmailsAndPasswords(Statement st) {
        try {
            st.executeUpdate("UPDATE `user` SET email = CONCAT('user_', id, '@migrated.local') WHERE email IS NULL OR TRIM(COALESCE(email,'')) = ''");
        } catch (SQLException e) {
            System.err.println("[User schema] Remplissage email: " + e.getMessage());
        }
        try {
            st.executeUpdate("UPDATE `user` SET password = '' WHERE password IS NULL");
        } catch (SQLException ignored) {
        }
    }

    private static void normalizeAgeAndRole(Statement st) {
        try {
            st.executeUpdate("UPDATE `user` SET age = 18 WHERE age IS NULL OR age < 1 OR age > 150");
        } catch (SQLException e) {
            System.err.println("[User schema] Normalisation age: " + e.getMessage());
        }
        try {
            st.executeUpdate("UPDATE `user` SET role = 'USER' WHERE role IS NULL OR TRIM(COALESCE(role,'')) = ''");
        } catch (SQLException e) {
            System.err.println("[User schema] Normalisation role: " + e.getMessage());
        }
    }

    private static void insertDefaultUsers(Statement stmt) throws SQLException {
        try {
            String insertAdmin = """
                INSERT IGNORE INTO `user` (firstName, lastName, age, email, password, role) 
                VALUES ('Admin', 'User', 25, 'admin@educonnect.com', 'admin123', 'ADMIN')
                """;
            stmt.executeUpdate(insertAdmin);

            String insertUser = """
                INSERT IGNORE INTO `user` (firstName, lastName, age, email, password, role) 
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
