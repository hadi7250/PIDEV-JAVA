package models;
import java.time.LocalDateTime;
public class Attempt {
    private int id;
    private int quizId;
    private LocalDateTime startedAt;
    private LocalDateTime completedAt;
    private int score;
    private String answers;
    public Attempt() {}
    public Attempt(int quizId, LocalDateTime startedAt, LocalDateTime completedAt, int score, String answers) {
        this.quizId = quizId; this.startedAt = startedAt; this.completedAt = completedAt;
        this.score = score; this.answers = answers;
    }
    public int getId() { return id; } public void setId(int id) { this.id = id; }
    public int getQuizId() { return quizId; } public void setQuizId(int q) { this.quizId = q; }
    public LocalDateTime getStartedAt() { return startedAt; } public void setStartedAt(LocalDateTime s) { this.startedAt = s; }
    public LocalDateTime getCompletedAt() { return completedAt; } public void setCompletedAt(LocalDateTime c) { this.completedAt = c; }
    public int getScore() { return score; } public void setScore(int s) { this.score = s; }
    public String getAnswers() { return answers; } public void setAnswers(String a) { this.answers = a; }
}
