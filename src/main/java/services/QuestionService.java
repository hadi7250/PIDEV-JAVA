package services;

import services.QuestionDAO;
import models.Question;

import java.sql.SQLException;
import java.util.List;

public class QuestionService {
    private final QuestionDAO dao = new QuestionDAO();

    public void createQuestion(Question q) throws SQLException {
        dao.insert(q);
    }

    public void updateQuestion(Question q) throws SQLException {
        dao.update(q);
    }

    public void deleteQuestion(int id) throws SQLException {
        dao.delete(id);
    }

    public List<Question> getByQuizId(int quizId) throws SQLException {
        return dao.fetchByQuizId(quizId);
    }
}
