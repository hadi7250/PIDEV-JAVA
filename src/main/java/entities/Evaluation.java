package entities;

import java.time.LocalDateTime;

public class Evaluation {
    private int id;
    private String title;
    private String description;
    private String type;
    private LocalDateTime evaluationDate;
    private Float weight;
    private Competence competence;

    public Evaluation() {
    }

    public Evaluation(String title, String description, String type, LocalDateTime evaluationDate, Float weight, Competence competence) {
        this.title = title;
        this.description = description;
        this.type = type;
        this.evaluationDate = evaluationDate;
        this.weight = weight;
        this.competence = competence;
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

    public LocalDateTime getEvaluationDate() { return evaluationDate; }
    public void setEvaluationDate(LocalDateTime evaluationDate) { this.evaluationDate = evaluationDate; }

    public Float getWeight() { return weight; }
    public void setWeight(Float weight) { this.weight = weight; }

    public Competence getCompetence() { return competence; }
    public void setCompetence(Competence competence) { this.competence = competence; }

    @Override
    public String toString() {
        return title != null ? title : "Unnamed Evaluation";
    }
}