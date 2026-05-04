package services;
import services.AttemptDAO;
import models.Attempt;
import java.sql.SQLException;
public class AttemptService {
    private final AttemptDAO dao = new AttemptDAO();
    public void saveAttempt(Attempt a) throws SQLException { dao.insert(a); }
}
