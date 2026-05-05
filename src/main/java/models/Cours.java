package models;

import java.sql.Timestamp;

public class Cours {
    private int id;
    private String titre;
    private String description;
    private Timestamp createdAt;
    private int chapterCount;

    public Cours() {
    }

    public Cours(String titre, String description) {
        this.titre = titre;
        this.description = description;
    }

    public Cours(int id, String titre, String description, Timestamp createdAt, int chapterCount) {
        this.id = id;
        this.titre = titre;
        this.description = description;
        this.createdAt = createdAt;
        this.chapterCount = chapterCount;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getTitre() {
        return titre;
    }

    public void setTitre(String titre) {
        this.titre = titre;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public Timestamp getCreatedAt() {
        return createdAt;
    }

    public void setCreatedAt(Timestamp createdAt) {
        this.createdAt = createdAt;
    }

    public int getChapterCount() {
        return chapterCount;
    }

    public void setChapterCount(int chapterCount) {
        this.chapterCount = chapterCount;
    }

    @Override
    public String toString() {
        if (titre == null || titre.isBlank()) {
            return "Cours #" + id;
        }
        return titre;
    }
}
