package models;

import java.time.LocalDateTime;

public class Event {
    private int id;
    private String titre;
    private LocalDateTime dateDebut;
    private LocalDateTime dateFin;
    private String lieu;
    private String description;
    private int duree;
    private int nombreMaxParticipants;
    private String image;
    private int categoryId;

    // Transient – populated by service when needed
    private Category category;

    public Event() {}

    // --- Getters & Setters ---

    public int getId() { return id; }
    public void setId(int id) { this.id = id; }

    public String getTitre() { return titre; }
    public void setTitre(String titre) { this.titre = titre; }

    public LocalDateTime getDateDebut() { return dateDebut; }
    public void setDateDebut(LocalDateTime dateDebut) { this.dateDebut = dateDebut; }

    public LocalDateTime getDateFin() { return dateFin; }
    public void setDateFin(LocalDateTime dateFin) { this.dateFin = dateFin; }

    public String getLieu() { return lieu; }
    public void setLieu(String lieu) { this.lieu = lieu; }

    public String getDescription() { return description; }
    public void setDescription(String description) { this.description = description; }

    public int getDuree() { return duree; }
    public void setDuree(int duree) { this.duree = duree; }

    public int getNombreMaxParticipants() { return nombreMaxParticipants; }
    public void setNombreMaxParticipants(int nombreMaxParticipants) { this.nombreMaxParticipants = nombreMaxParticipants; }

    public String getImage() { return image; }
    public void setImage(String image) { this.image = image; }

    public int getCategoryId() { return categoryId; }
    public void setCategoryId(int categoryId) { this.categoryId = categoryId; }

    public Category getCategory() { return category; }
    public void setCategory(Category category) {
        this.category = category;
        if (category != null) this.categoryId = category.getId();
    }

    @Override
    public String toString() {
        return titre;
    }
}
