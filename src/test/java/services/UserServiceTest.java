package services;

import entities.User;
import org.junit.jupiter.api.*;
import utils.MyConnection;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.sql.Statement;
import java.time.LocalDate;

import static org.junit.jupiter.api.Assertions.*;

public class UserServiceTest {
    private static Connection connection;
    private static UserService service;

    @BeforeAll
    static void setup() throws SQLException {
        // Use H2 in-memory database
        connection = DriverManager.getConnection("jdbc:h2:mem:userdb;MODE=MySQL", "sa", "");
        
        try (Statement st = connection.createStatement()) {
            // "user" is a reserved keyword in some H2 modes, must be escaped or renamed
            st.execute("CREATE TABLE `user` (" +
                    "id INT AUTO_INCREMENT PRIMARY KEY, " +
                    "email VARCHAR(180) UNIQUE NOT NULL, " +
                    "password VARCHAR(255) NOT NULL, " +
                    "roles TEXT, " +
                    "nom VARCHAR(100), " +
                    "prenom VARCHAR(100), " +
                    "dateNaissance DATE, " +
                    "isActive TINYINT(1) DEFAULT 1, " +
                    "createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");
        }
        
        MyConnection.getInstance().setConnection(connection);
        service = new UserService();
    }

    @AfterAll
    static void tearDown() throws SQLException {
        if (connection != null) connection.close();
    }

    @BeforeEach
    void clearTable() throws SQLException {
        try (Statement st = connection.createStatement()) {
            st.execute("DELETE FROM `user` ");
        }
    }

    @Test
    void testRegisterAndLogin() {
        User user = new User();
        user.setEmail("test@test.com");
        user.setPassword("secret");
        user.setNom("Doe");
        user.setPrenom("John");
        user.setDateNaissance(LocalDate.of(1990, 1, 1));
        
        boolean registered = service.register(user);
        assertTrue(registered);
        
        User loggedIn = service.login("test@test.com", "secret");
        assertNotNull(loggedIn);
        assertEquals("Doe", loggedIn.getNom());
    }

    @Test
    void testEmailExists() {
        User user = new User();
        user.setEmail("exists@test.com");
        user.setPassword("pass");
        user.setDateNaissance(LocalDate.now());
        service.register(user);
        
        assertTrue(service.emailExists("exists@test.com"));
        assertFalse(service.emailExists("notfound@test.com"));
    }
}
