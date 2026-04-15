package services;

import entities.Competence;
import entities.Evaluation;
import org.junit.jupiter.api.*;
import utils.MyConnection;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.sql.Statement;
import java.time.LocalDateTime;
import java.util.List;

import static org.junit.jupiter.api.Assertions.*;

public class EvaluationServiceTest {
    private static Connection connection;
    private static EvaluationService service;
    private static Competence competence;

    @BeforeAll
    static void setup() throws SQLException {
        connection = DriverManager.getConnection("jdbc:h2:mem:evaldb;MODE=MySQL", "sa", "");
        
        try (Statement st = connection.createStatement()) {
            st.execute("CREATE TABLE `competence` (" +
                    "id INT AUTO_INCREMENT PRIMARY KEY, " +
                    "user_id INT, " +
                    "title VARCHAR(255) UNIQUE NOT NULL, " +
                    "description TEXT, " +
                    "category VARCHAR(100), " +
                    "maxLevel INT DEFAULT 5, " +
                    "certificate VARCHAR(255), " +
                    "createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP, " +
                    "updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");

            st.execute("CREATE TABLE `evaluation` (" +
                    "id INT AUTO_INCREMENT PRIMARY KEY, " +
                    "title VARCHAR(255) NOT NULL, " +
                    "description TEXT, " +
                    "type VARCHAR(50), " +
                    "date DATETIME, " +
                    "score FLOAT, " +
                    "status VARCHAR(50), " +
                    "comment TEXT, " +
                    "competence_id INT NOT NULL, " +
                    "FOREIGN KEY (competence_id) REFERENCES competence(id))");
        }
        
        MyConnection.getInstance().setConnection(connection);
        service = new EvaluationService();
        
        // Create a dummy competence for evaluations
        CompetenceService compService = new CompetenceService();
        competence = new Competence(1, "Java", "Desc", "technique", 5, null);
        compService.create(competence);
    }

    @AfterAll
    static void tearDown() throws SQLException {
        if (connection != null) connection.close();
    }

    @Test
    void testCreateAndRead() throws SQLException {
        Evaluation e = new Evaluation("Exam 1", "D1", "exam", LocalDateTime.now(), 15.5f, "pending", "", competence);
        service.create(e);
        
        assertTrue(e.getId() > 0);
        
        List<Evaluation> all = service.readAll();
        assertFalse(all.isEmpty());
        assertEquals("Exam 1", all.get(0).getTitle());
    }
}
