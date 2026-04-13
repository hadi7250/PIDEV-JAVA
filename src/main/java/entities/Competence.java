package entities;

public class Competence {
    private int id;
    private String name;
    private String description;
    private String category;
    private int maxLevel = 5;
    private String certificate; // Path to PDF file

    public Competence() {
    }

    public Competence(String name, String description, String category, int maxLevel, String certificate) {
        this.name = name;
        this.description = description;
        this.category = category;
        this.maxLevel = maxLevel;
        this.certificate = certificate;
    }

    // Getters and Setters
    public int getId() { return id; }
    public void setId(int id) { this.id = id; }

    public String getName() { return name; }
    public void setName(String name) { this.name = name; }

    public String getDescription() { return description; }
    public void setDescription(String description) { this.description = description; }

    public String getCategory() { return category; }
    public void setCategory(String category) { this.category = category; }

    public int getMaxLevel() { return maxLevel; }
    public void setMaxLevel(int maxLevel) { this.maxLevel = maxLevel; }

    public String getCertificate() { return certificate; }
    public void setCertificate(String certificate) { this.certificate = certificate; }

    @Override
    public String toString() {
        return name != null ? name : "Unnamed Competence";
    }
}