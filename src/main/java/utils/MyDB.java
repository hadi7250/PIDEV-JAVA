package utils;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class MyDB {
    private static final String HOST = System.getProperty("educonnect.db.host", "localhost");
    private static final String PORT = System.getProperty("educonnect.db.port", "3306");
    private static final String DATABASE = firstNonBlank(
            System.getProperty("educonnect.db.name"),
            System.getenv("EDUCONNECT_DB_NAME"),
            "educonnect"
    );
    private static final String USERNAME = firstNonBlank(
            System.getProperty("educonnect.db.user"),
            System.getenv("EDUCONNECT_DB_USER"),
            "root"
    );
    private static final String PASSWORD = firstNonBlank(
            System.getProperty("educonnect.db.password"),
            System.getenv("EDUCONNECT_DB_PASSWORD"),
            ""
    );
    private static final String URL = "jdbc:mysql://" + HOST + ":" + PORT + "/" + DATABASE
            + "?useSSL=false"
            + "&serverTimezone=UTC"
            + "&allowPublicKeyRetrieval=true"
            + "&autoReconnect=true"
            + "&failOverReadOnly=false";

    private Connection connection;
    private static MyDB instance;

    private MyDB() {
        connect();
    }

    private void connect() {
        try {
            Class.forName("com.mysql.cj.jdbc.Driver");
            connection = DriverManager.getConnection(URL, USERNAME, PASSWORD);
            System.out.println("Connected to database " + DATABASE);
        } catch (ClassNotFoundException e) {
            System.err.println("MySQL Driver not found");
            e.printStackTrace();
        } catch (SQLException e) {
            System.err.println("Database connection failed");
            e.printStackTrace();
        }
    }

    public static MyDB getInstance() {
        if (instance == null) {
            instance = new MyDB();
        }
        return instance;
    }

    public Connection getConnection() {
        try {
            if (connection == null || connection.isClosed() || !connection.isValid(3)) {
                System.out.println("[DB] Connection was closed - reconnecting...");
                connect();
            }
        } catch (SQLException e) {
            System.err.println("[DB] Could not validate connection, trying to reconnect: " + e.getMessage());
            connect();
        }
        return connection;
    }

    private static String firstNonBlank(String... values) {
        for (String value : values) {
            if (value != null && !value.isBlank()) {
                return value;
            }
        }
        return "";
    }
}
