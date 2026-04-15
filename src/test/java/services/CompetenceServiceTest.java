package services;

import entities.Competence;
import org.junit.jupiter.api.*;
import utils.MyConnection;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.List;

import static org.junit.jupiter.api.Assertions.*;

public class CompetenceServiceTest {
    private static Connection connection;
    private static CompetenceService service;

    @BeforeAll
    static void setup() throws SQLException {
        // Use an in-memory H2 database for testing
        connection = DriverManager.getConnection("jdbc:h2:mem:testdb;MODE=MySQL", "sa", "");
        
        // Setup schema
        try (Statement st = connection.createStatement()) {
            st.execute("CREATE TABLE competence (" +
                    "id INT AUTO_INCREMENT PRIMARY KEY, " +
                    "user_id INT, " +
                    "title VARCHAR(255) UNIQUE NOT NULL, " +
                    "description TEXT, " +
                    "category VARCHAR(100), " +
                    "maxLevel INT DEFAULT 5, " +
                    "certificate VARCHAR(255), " +
                    "createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP, " +
                    "updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");
        }
        
        // Inject this connection into MyConnection singleton
        MyConnection.getInstance().setConnection(connection);
        service = new CompetenceService();
    }

    @AfterAll
    static void tearDown() throws SQLException {
        if (connection != null && !connection.isClosed()) {
            connection.close();
        }
    }

    @BeforeEach
    void clearTable() throws SQLException {
        try (Statement st = connection.createStatement()) {
            st.execute("DELETE FROM competence");
        }
    }

    @Test
    void testCreate() throws SQLException {
        Competence c = new Competence(1, "Test Skill", "Desc", "technique", 5, null);
        service.create(c);
        
        assertTrue(c.getId() > 0, "ID should be generated");
        
        List<Competence> list = service.readAll();
        assertEquals(1, list.size());
        assertEquals("Test Skill", list.get(0).getTitle());
    }

    @Test
    void testUpdate() throws SQLException {
        Competence c = new Competence(1, "Old Title", "Old Desc", "technique", 5, null);
        service.create(c);
        
        c.setTitle("New Title");
        c.setDescription("New Desc");
        service.update(c);
        
        List<Competence> list = service.readAll();
        assertEquals("New Title", list.get(0).getTitle());
        assertEquals("New Desc", list.get(0).getDescription());
    }

    @Test
    void testDelete() throws SQLException {
        Competence c = new Competence(1, "To Delete", "Desc", "technique", 5, null);
        service.create(c);
        
        service.delete(c);
        
        List<Competence> list = service.readAll();
        assertTrue(list.isEmpty());
    }

    @Test
    void testReadAllByUser() throws SQLException {
        service.create(new Competence(100, "Skill 1", "D1", "technique", 5, null));
        service.create(new Competence(100, "Skill 2", "D2", "technique", 5, null));
        service.create(new Competence(200, "Skill 3", "D3", "technique", 5, null));
        
        List<Competence> user100Skills = service.readAllByUser(100);
        assertEquals(2, user100Skills.size());
    }
}
