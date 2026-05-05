package entities;

import java.time.LocalDate;
import java.time.LocalDateTime;

public class User {
    private int id;
    private String email;
    private String password;
    private String roles; // Stores JSON string like ["ROLE_USER"]
    private String nom;
    private String prenom;
    private LocalDate dateNaissance;
    private boolean isActive;
    private LocalDateTime createdAt;

    public User() {
        this.isActive = true;
        this.createdAt = LocalDateTime.now();
        this.roles = "[\"ROLE_USER\"]";
    }

    public User(int id, String email, String password, String roles, String nom, String prenom, LocalDate dateNaissance) {
        this.id = id;
        this.email = email;
        this.password = password;
        this.roles = roles;
        this.nom = nom;
        this.prenom = prenom;
        this.dateNaissance = dateNaissance;
        this.isActive = true;
        this.createdAt = LocalDateTime.now();
    }

    // Getters and Setters
    public int getId() { return id; }
    public void setId(int id) { this.id = id; }

    public String getEmail() { return email; }
    public void setEmail(String email) { this.email = email; }

    public String getPassword() { return password; }
    public void setPassword(String password) { this.password = password; }

    public String getRoles() { return roles; }
    public void setRoles(String roles) { this.roles = roles; }

    public String getNom() { return nom; }
    public void setNom(String nom) { this.nom = nom; }

    public String getPrenom() { return prenom; }
    public void setPrenom(String prenom) { this.prenom = prenom; }

    public LocalDate getDateNaissance() { return dateNaissance; }
    public void setDateNaissance(LocalDate dateNaissance) { this.dateNaissance = dateNaissance; }

    public boolean isActive() { return isActive; }
    public void setActive(boolean active) { isActive = active; }

    public LocalDateTime getCreatedAt() { return createdAt; }
    public void setCreatedAt(LocalDateTime createdAt) { this.createdAt = createdAt; }

    // Helper for role checking
    public boolean isAdmin() {
        return roles != null && roles.contains("ROLE_ADMIN");
    }
    
    public String getRole() {
        if (roles == null) return "USER";
        if (roles.contains("ROLE_ADMIN")) return "ADMIN";
        if (roles.contains("ROLE_TEACHER")) return "TEACHER";
        if (roles.contains("ROLE_STUDENT")) return "STUDENT";
        return "USER";
    }

    public void setRole(String role) {
        if (role == null) {
            this.roles = "[\"ROLE_USER\"]";
            return;
        }
        switch (role.toUpperCase()) {
            case "ADMIN":
                this.roles = "[\"ROLE_ADMIN\"]";
                break;
            case "TEACHER":
                this.roles = "[\"ROLE_TEACHER\"]";
                break;
            case "STUDENT":
                this.roles = "[\"ROLE_STUDENT\"]";
                break;
            default:
                this.roles = "[\"ROLE_USER\"]";
                break;
        }
    }

    // Compatibility getters for old code if needed
    public String getFirstName() { return prenom; }
    public String getLastName() { return nom; }
    
    public void setFirstName(String firstName) { this.prenom = firstName; }
    public void setLastName(String lastName) { this.nom = lastName; }

    public int getAge() {
        if (dateNaissance == null) return 0;
        return java.time.Period.between(dateNaissance, LocalDate.now()).getYears();
    }

    public void setAge(int age) {
        this.dateNaissance = LocalDate.now().minusYears(age);
    }

    @Override
    public String toString() {
        return "User{" + "email='" + email + '\'' + ", roles='" + roles + '\'' + ", nom='" + nom + '\'' + ", prenom='" + prenom + '\'' + '}';
    }
}
