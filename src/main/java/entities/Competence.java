package entities;

import java.time.LocalDateTime;

public class Competence {
    private int id;
    private String title; // Renamed from name
    private String description;
    private String category;
    private int maxLevel = 5;
    private String certificate;
    private LocalDateTime createdAt;
    private LocalDateTime updatedAt;

    public Competence() {
        this.createdAt = LocalDateTime.now();
        this.updatedAt = LocalDateTime.now();
    }

    public Competence(String title, String description, String category, int maxLevel, String certificate) {
        this.title = title;
        this.description = description;
        this.category = category;
        this.maxLevel = maxLevel;
        this.certificate = certificate;
        this.createdAt = LocalDateTime.now();
        this.updatedAt = LocalDateTime.now();
    }

    // Getters and Setters
    public int getId() { return id; }
    public void setId(int id) { this.id = id; }

    public String getTitle() { return title; }
    public void setTitle(String title) { this.title = title; }

    public String getDescription() { return description; }
    public void setDescription(String description) { this.description = description; }

    public String getCategory() { return category; }
    public void setCategory(String category) { this.category = category; }

    public int getMaxLevel() { return maxLevel; }
    public void setMaxLevel(int maxLevel) { this.maxLevel = maxLevel; }

    public String getCertificate() { return certificate; }
    public void setCertificate(String certificate) { this.certificate = certificate; }

    public LocalDateTime getCreatedAt() { return createdAt; }
    public void setCreatedAt(LocalDateTime createdAt) { this.createdAt = createdAt; }

    public LocalDateTime getUpdatedAt() { return updatedAt; }
    public void setUpdatedAt(LocalDateTime updatedAt) { this.updatedAt = updatedAt; }

    @Override
    public String toString() {
        return title != null ? title : "Unnamed Competence";
    }
}