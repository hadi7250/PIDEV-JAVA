package entities;

import java.time.LocalDateTime;

/**
 * Entité User compatible avec la base educonnect2.
 * Colonnes : firstname, lastname, age, email, password, role, photo_path,
 *            username, status, google_id, bio, created_at, updated_at
 *
 * NOTE: la colonne "roles" (JSON Symfony) a été supprimée de la base.
 *       Le rôle est désormais géré uniquement via la colonne "role" (ENUM USER/ADMIN).
 */
public class User {

    private int    id;
    private int    age;
    private String firstName;   // → colonne DB : firstname
    private String lastName;    // → colonne DB : lastname
    private String email;
    private String password;
    private String role;        // "USER" ou "ADMIN"
    private String photoPath;   // → colonne DB : photo_path

    // ── Colonnes Symfony (sans roles) ────────────────────────────────
    private String        username;
    private String        status;
    private String        googleId;
    private String        bio;
    private LocalDateTime createdAt;
    private LocalDateTime updatedAt;

    // ================================================================
    // CONSTRUCTEURS
    // ================================================================

    /** No-arg constructor for persistence frameworks and legacy code. */
    public User() {}


    /** Nouvel utilisateur (sans ID, sans photo). */
    public User(String firstName, String lastName, int age,
                String email, String password, String role) {
        this.firstName = firstName;
        this.lastName  = lastName;
        this.age       = age;
        this.email     = email;
        this.password  = password;
        this.role      = role;
        this.username  = email != null ? email.toLowerCase() : null;
        this.status    = "active";
    }

    /** Nouvel utilisateur avec photo. */
    public User(String firstName, String lastName, int age,
                String email, String password, String role, String photoPath) {
        this(firstName, lastName, age, email, password, role);
        this.photoPath = photoPath;
    }

    /** Utilisateur existant (avec ID, sans photo). */
    public User(int id, String firstName, String lastName, int age,
                String email, String password, String role) {
        this(firstName, lastName, age, email, password, role);
        this.id = id;
    }

    /** Utilisateur existant avec photo. */
    public User(int id, String firstName, String lastName, int age,
                String email, String password, String role, String photoPath) {
        this(id, firstName, lastName, age, email, password, role);
        this.photoPath = photoPath;
    }

    /**
     * Constructeur complet — utilisé par UserService.mapRow()
     * lors de la lecture depuis la base de données.
     */
    public User(int id, String firstName, String lastName, int age,
                String email, String password, String role, String photoPath,
                String username, String status,
                String googleId, String bio,
                LocalDateTime createdAt, LocalDateTime updatedAt) {
        this.id        = id;
        this.firstName = firstName;
        this.lastName  = lastName;
        this.age       = age;
        this.email     = email;
        this.password  = password;
        this.role      = role;
        this.photoPath = photoPath;
        this.username  = username;
        this.status    = status;
        this.googleId  = googleId;
        this.bio       = bio;
        this.createdAt = createdAt;
        this.updatedAt = updatedAt;
    }

    // ================================================================
    // MÉTHODES UTILITAIRES
    // ================================================================

    public boolean isAdmin() {
        return "ADMIN".equalsIgnoreCase(role);
    }

    public boolean isActive() {
        return status == null || "active".equalsIgnoreCase(status);
    }

    // ================================================================
    // GETTERS & SETTERS
    // ================================================================

    public int    getId()                          { return id; }
    public void   setId(int id)                    { this.id = id; }

    public int    getAge()                         { return age; }
    public void   setAge(int age)                  { this.age = age; }

    public String getFirstName()                   { return firstName; }
    public void   setFirstName(String firstName)   { this.firstName = firstName; }

    public String getLastName()                    { return lastName; }
    public void   setLastName(String lastName)     { this.lastName = lastName; }
    
    /** Compatibility helper for migration from models.User */
    public void setName(String fullName) {
        if (fullName == null || fullName.trim().isEmpty()) {
            this.firstName = "";
            this.lastName = "";
            return;
        }
        String[] parts = fullName.split(" ", 2);
        this.firstName = parts[0];
        this.lastName = parts.length > 1 ? parts[1] : "";
    }


    public String getEmail()                       { return email; }
    public void   setEmail(String email)           { this.email = email; }

    public String getPassword()                    { return password; }
    public void   setPassword(String password)     { this.password = password; }

    public String getRole()                        { return role; }
    public void   setRole(String role)             { this.role = role; }

    public String getPhotoPath()                   { return photoPath; }
    public void   setPhotoPath(String photoPath)   { this.photoPath = photoPath; }

    public String getUsername()                    { return username; }
    public void   setUsername(String u)            { this.username = u; }

    public String getStatus()                      { return status; }
    public void   setStatus(String s)              { this.status = s; }

    public String getGoogleId()                    { return googleId; }
    public void   setGoogleId(String g)            { this.googleId = g; }

    public String getBio()                         { return bio; }
    public void   setBio(String bio)               { this.bio = bio; }

    public LocalDateTime getCreatedAt()            { return createdAt; }
    public void setCreatedAt(LocalDateTime t)      { this.createdAt = t; }

    public LocalDateTime getUpdatedAt()            { return updatedAt; }
    public void setUpdatedAt(LocalDateTime t)      { this.updatedAt = t; }

    @Override
    public String toString() {
        return "User{id=" + id
                + ", firstName='" + firstName + '\''
                + ", lastName='"  + lastName  + '\''
                + ", email='"     + email     + '\''
                + ", username='"  + username  + '\''
                + ", role='"      + role      + '\''
                + ", status='"    + status    + "'}";
    }
}