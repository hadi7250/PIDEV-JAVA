package services;

import utils.MyDB;
import java.sql.Connection;
import java.sql.Statement;

/**
 * Creates quiz tables in the same DB as the rest of the app.
 */
public class QuizSchemaService {
    public static void ensureSchema() {
        try {
            Connection c = MyDB.getInstance().getConnection();
            Statement st = c.createStatement();

            st.execute("""
                CREATE TABLE IF NOT EXISTS quiz (
                    id          INT AUTO_INCREMENT PRIMARY KEY,
                    title       VARCHAR(255) NOT NULL,
                    description TEXT,
                    time_limit  INT DEFAULT 30,
                    total_score INT DEFAULT 100
                )
            """);

            st.execute("""
                CREATE TABLE IF NOT EXISTS question (
                    id             INT AUTO_INCREMENT PRIMARY KEY,
                    question_text  TEXT NOT NULL,
                    options        VARCHAR(500),
                    correct_answer VARCHAR(255),
                    points         INT DEFAULT 10,
                    quiz_id        INT NOT NULL,
                    FOREIGN KEY (quiz_id) REFERENCES quiz(id) ON DELETE CASCADE
                )
            """);

            st.execute("""
                CREATE TABLE IF NOT EXISTS attempt (
                    id           INT AUTO_INCREMENT PRIMARY KEY,
                    quiz_id      INT NOT NULL,
                    started_at   DATETIME,
                    completed_at DATETIME,
                    score        INT,
                    answers      TEXT,
                    FOREIGN KEY (quiz_id) REFERENCES quiz(id) ON DELETE CASCADE
                )
            """);

            st.close();
            System.out.println("[Quiz] Schema ready");
        } catch (Exception e) {
            System.err.println("[Quiz] Schema error: " + e.getMessage());
        }
    }
}
