package models;

public class Chapitre {
    private int id;
    private String titre;
    private String contenu;
    private String resourceUrl;
    private int coursId;
    private String coursTitre;
    private String aiSummary;

    public Chapitre() {
    }

    public Chapitre(String titre, String contenu, int coursId) {
        this.titre = titre;
        this.contenu = contenu;
        this.coursId = coursId;
    }

    public Chapitre(int id, String titre, String contenu, int coursId, String coursTitre, String aiSummary) {
        this(id, titre, contenu, null, coursId, coursTitre, aiSummary);
    }

    public Chapitre(int id, String titre, String contenu, String resourceUrl, int coursId, String coursTitre, String aiSummary) {
        this.id = id;
        this.titre = titre;
        this.contenu = contenu;
        this.resourceUrl = resourceUrl;
        this.coursId = coursId;
        this.coursTitre = coursTitre;
        this.aiSummary = aiSummary;
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

    public String getContenu() {
        return contenu;
    }

    public void setContenu(String contenu) {
        this.contenu = contenu;
    }

    public String getResourceUrl() {
        return resourceUrl;
    }

    public void setResourceUrl(String resourceUrl) {
        this.resourceUrl = resourceUrl;
    }

    public int getCoursId() {
        return coursId;
    }

    public void setCoursId(int coursId) {
        this.coursId = coursId;
    }

    public String getCoursTitre() {
        return coursTitre;
    }

    public void setCoursTitre(String coursTitre) {
        this.coursTitre = coursTitre;
    }

    public String getAiSummary() {
        return aiSummary;
    }

    public void setAiSummary(String aiSummary) {
        this.aiSummary = aiSummary;
    }

    @Override
    public String toString() {
        if (titre == null || titre.isBlank()) {
            return "Chapitre #" + id;
        }
        return titre;
    }
}
