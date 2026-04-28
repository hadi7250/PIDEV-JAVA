package entities;

import java.time.LocalDateTime;

public class Evaluation {
    private int id;
    private String title;
    private String description;
    private String type;
    private LocalDateTime date; // Renamed from evaluationDate
    private Float score; // Renamed from weight
    private String status;
    private String comment;
    private String codeContent;
    private String language;
    private boolean isCodeEvaluation;
    private Competence competence;
    private Float weight;

    public Evaluation() {
    }

    public Evaluation(String title, String description, String type, LocalDateTime date, Float score, String status, String comment, Competence competence) {
        this.title = title;
        this.description = description;
        this.type = type;
        this.date = date;
        this.score = score;
        this.status = status;
        this.comment = comment;
        this.competence = competence;
    }

    public Evaluation(String title, String description, String type, LocalDateTime date, Float score, String status, String comment, String codeContent, String language, boolean isCodeEvaluation, Competence competence) {
        this.title = title;
        this.description = description;
        this.type = type;
        this.date = date;
        this.score = score;
        this.status = status;
        this.comment = comment;
        this.codeContent = codeContent;
        this.language = language;
        this.isCodeEvaluation = isCodeEvaluation;
        this.competence = competence;
    }

    public Evaluation(String title, String description, String type, LocalDateTime date, Float score, String status, String comment, String codeContent, String language, boolean isCodeEvaluation, Competence competence, Float weight) {
        this.title = title;
        this.description = description;
        this.type = type;
        this.date = date;
        this.score = score;
        this.status = status;
        this.comment = comment;
        this.codeContent = codeContent;
        this.language = language;
        this.isCodeEvaluation = isCodeEvaluation;
        this.competence = competence;
        this.weight = weight;
    }

    // Getters and Setters
    public int getId() { return id; }
    public void setId(int id) { this.id = id; }

    public String getTitle() { return title; }
    public void setTitle(String title) { this.title = title; }

    public String getDescription() { return description; }
    public void setDescription(String description) { this.description = description; }

    public String getType() { return type; }
    public void setType(String type) { this.type = type; }

    public LocalDateTime getDate() { return date; }
    public void setDate(LocalDateTime date) { this.date = date; }

    public Float getScore() { return score; }
    public void setScore(Float score) { this.score = score; }

    public String getStatus() { return status; }
    public void setStatus(String status) { this.status = status; }

    public String getComment() { return comment; }
    public void setComment(String comment) { this.comment = comment; }

    public String getCodeContent() { return codeContent; }
    public void setCodeContent(String codeContent) { this.codeContent = codeContent; }

    public String getLanguage() { return language; }
    public void setLanguage(String language) { this.language = language; }

    public boolean isCodeEvaluation() { return isCodeEvaluation; }
    public void setCodeEvaluation(boolean codeEvaluation) { isCodeEvaluation = codeEvaluation; }

    public Competence getCompetence() { return competence; }
    public void setCompetence(Competence competence) { this.competence = competence; }

    public Float getWeight() { return weight; }
    public void setWeight(Float weight) { this.weight = weight; }

    @Override
    public String toString() {
        return title != null ? title : "Unnamed Evaluation";
    }
}