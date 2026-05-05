package services;

import services.QuizDAO;
import models.Quiz;

import java.sql.SQLException;
import java.util.List;

public class QuizService {
    private final QuizDAO dao = new QuizDAO();

    public void createQuiz(Quiz entity) throws SQLException {
        dao.insert(entity);
    }

    public void updateQuiz(Quiz entity) throws SQLException {
        dao.update(entity);
    }

    public void deleteQuiz(int id) throws SQLException {
        dao.delete(id);
    }

    public List<Quiz> getAll() throws SQLException {
        return dao.fetchAll();
    }
}
