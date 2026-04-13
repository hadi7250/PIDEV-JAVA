package entities;

import java.time.LocalDateTime;

public class Evaluation {
    private Long id;
    private String title;
    private String description;
    private String type;
    private LocalDateTime evaluationDate;
    private Double weight;
    private Long competenceId;
    private LocalDateTime createdAt;

    public Evaluation() {
    }

    public Evaluation(String title, String description, String type, LocalDateTime evaluationDate, Double weight, Long competenceId) {
        this.title = title;
        this.description = description;
        this.type = type;
        this.evaluationDate = evaluationDate;
        this.weight = weight;
        this.competenceId = competenceId;
        this.createdAt = LocalDateTime.now();
    }

    // Getters and Setters
    public Long getId() { return id; }
    public void setId(Long id) { this.id = id; }

    public String getTitle() { return title; }
    public void setTitle(String title) { this.title = title; }

    public String getDescription() { return description; }
    public void setDescription(String description) { this.description = description; }

    public String getType() { return type; }
    public void setType(String type) { this.type = type; }

    public LocalDateTime getEvaluationDate() { return evaluationDate; }
    public void setEvaluationDate(LocalDateTime evaluationDate) { this.evaluationDate = evaluationDate; }

    public Double getWeight() { return weight; }
    public void setWeight(Double weight) { this.weight = weight; }

    public Long getCompetenceId() { return competenceId; }
    public void setCompetenceId(Long competenceId) { this.competenceId = competenceId; }

    public LocalDateTime getCreatedAt() { return createdAt; }
    public void setCreatedAt(LocalDateTime createdAt) { this.createdAt = createdAt; }

    @Override
    public String toString() {
        return "Evaluation{" +
                "id=" + id +
                ", title='" + title + '\'' +
                ", type='" + type + '\'' +
                ", weight=" + weight +
                ", competenceId=" + competenceId +
                '}';
    }
}