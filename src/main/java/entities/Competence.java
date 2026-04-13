package entities;

import java.time.LocalDateTime;

public class Competence {
    private Long id;
    private String name;
    private String description;
    private String category;
    private int maxLevel;
    private LocalDateTime createdAt;
    private LocalDateTime updatedAt;

    public Competence() {
    }

    public Competence(String name, String description, String category, int maxLevel) {
        this.name = name;
        this.description = description;
        this.category = category;
        this.maxLevel = maxLevel;
        this.createdAt = LocalDateTime.now();
        this.updatedAt = LocalDateTime.now();
    }

    // Getters and Setters
    public Long getId() { return id; }
    public void setId(Long id) { this.id = id; }

    public String getName() { return name; }
    public void setName(String name) { this.name = name; }

    public String getDescription() { return description; }
    public void setDescription(String description) { this.description = description; }

    public String getCategory() { return category; }
    public void setCategory(String category) { this.category = category; }

    public int getMaxLevel() { return maxLevel; }
    public void setMaxLevel(int maxLevel) { this.maxLevel = maxLevel; }

    public LocalDateTime getCreatedAt() { return createdAt; }
    public void setCreatedAt(LocalDateTime createdAt) { this.createdAt = createdAt; }

    public LocalDateTime getUpdatedAt() { return updatedAt; }
    public void setUpdatedAt(LocalDateTime updatedAt) { this.updatedAt = updatedAt; }

    @Override
    public String toString() {
        return "Competence{" +
                "id=" + id +
                ", name='" + name + '\'' +
                ", category='" + category + '\'' +
                ", maxLevel=" + maxLevel +
                '}';
    }
}