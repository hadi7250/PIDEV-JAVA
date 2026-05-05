package services;
import models.Attempt;
import utils.MyDB;
import java.sql.*;
public class AttemptDAO {
    public void insert(Attempt a) throws SQLException {
        String sql = "INSERT INTO attempt (quiz_id, started_at, completed_at, score, answers) VALUES (?,?,?,?,?)";
        try (PreparedStatement ps = MyDB.getInstance().getConnection().prepareStatement(sql)) {
            ps.setInt(1, a.getQuizId());
            ps.setTimestamp(2, Timestamp.valueOf(a.getStartedAt()));
            ps.setTimestamp(3, Timestamp.valueOf(a.getCompletedAt()));
            ps.setInt(4, a.getScore());
            ps.setString(5, a.getAnswers());
            ps.executeUpdate();
        }
    }
}
