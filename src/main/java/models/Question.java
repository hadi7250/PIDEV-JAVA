package models;

public class Question {
    private int id;
    private String questionText;
    private String options;       // stored as comma-separated, e.g. "A;B;C;D"
    private String correctAnswer;
    private int points;
    private int quizId;

    public Question() {}

    public Question(int id, String questionText, String options, String correctAnswer, int points, int quizId) {
        this.id = id;
        this.questionText = questionText;
        this.options = options;
        this.correctAnswer = correctAnswer;
        this.points = points;
        this.quizId = quizId;
    }

    public int getId() { return id; }
    public void setId(int id) { this.id = id; }
    public String getQuestionText() { return questionText; }
    public void setQuestionText(String questionText) { this.questionText = questionText; }
    public String getOptions() { return options; }
    public void setOptions(String options) { this.options = options; }
    public String getCorrectAnswer() { return correctAnswer; }
    public void setCorrectAnswer(String correctAnswer) { this.correctAnswer = correctAnswer; }
    public int getPoints() { return points; }
    public void setPoints(int points) { this.points = points; }
    public int getQuizId() { return quizId; }
    public void setQuizId(int quizId) { this.quizId = quizId; }
}
