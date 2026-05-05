package entities;

public class User {
    private int id;
    private int age;
    private String firstName;
    private String lastName;
    private String email;
    private String password;
    private String role;
    private String photoPath;  // ← NEW: Store photo file path

    /** Statut affiché admin (non persisté si absent de la table). */
    private String status = "active";
    /** Champ formulaire admin (non persisté). */
    private Integer nsc;
    /** JSON rôles affiché dans le formulaire admin. */
    private String rolesJson;

    public User() {
    }

    // Constructor for new user (without ID)
    public User(String firstName, String lastName, int age, String email, String password, String role) {
        this.firstName = firstName;
        this.lastName = lastName;
        this.age = age;
        this.email = email;
        this.password = password;
        this.role = role;
        this.photoPath = null;  // Default no photo
    }

    // Constructor for new user with photo
    public User(String firstName, String lastName, int age, String email, String password, String role, String photoPath) {
        this.firstName = firstName;
        this.lastName = lastName;
        this.age = age;
        this.email = email;
        this.password = password;
        this.role = role;
        this.photoPath = photoPath;
    }

    // Constructor for existing user (with ID)
    public User(int id, String firstName, String lastName, int age, String email, String password, String role) {
        this.id = id;
        this.firstName = firstName;
        this.lastName = lastName;
        this.age = age;
        this.email = email;
        this.password = password;
        this.role = role;
    }

    // Constructor for existing user with photo
    public User(int id, String firstName, String lastName, int age, String email, String password, String role, String photoPath) {
        this.id = id;
        this.firstName = firstName;
        this.lastName = lastName;
        this.age = age;
        this.email = email;
        this.password = password;
        this.role = role;
        this.photoPath = photoPath;
    }

    // Getters and Setters
    public int getId() { return id; }
    public void setId(int id) { this.id = id; }

    public int getAge() { return age; }
    public void setAge(int age) { this.age = age; }

    public String getFirstName() { return firstName; }
    public void setFirstName(String firstName) { this.firstName = firstName; }

    public String getLastName() { return lastName; }
    public void setLastName(String lastName) { this.lastName = lastName; }

    public String getEmail() { return email; }
    public void setEmail(String email) { this.email = email; }

    public String getPassword() { return password; }
    public void setPassword(String password) { this.password = password; }

    public String getRole() { return role; }
    public void setRole(String role) { this.role = role; }

    public String getPhotoPath() { return photoPath; }
    public void setPhotoPath(String photoPath) { this.photoPath = photoPath; }

    /** Nom affiché (prénom + nom) pour l’UI admin événements. */
    public String getName() {
        String f = firstName != null ? firstName : "";
        String l = lastName != null ? lastName : "";
        String s = (f + " " + l).trim();
        return s.isEmpty() && email != null ? email : s;
    }

    public void setName(String displayName) {
        if (displayName == null || displayName.isBlank()) {
            firstName = "";
            lastName = "";
            return;
        }
        String t = displayName.trim();
        int sp = t.indexOf(' ');
        if (sp < 0) {
            firstName = t;
            lastName = "";
        } else {
            firstName = t.substring(0, sp).trim();
            lastName = t.substring(sp + 1).trim();
        }
    }

    public String getStatus() {
        return status != null ? status : "active";
    }

    public void setStatus(String status) {
        this.status = status != null ? status : "active";
    }

    public Integer getNsc() {
        return nsc;
    }

    public void setNsc(Integer nsc) {
        this.nsc = nsc;
    }

    public String getRoles() {
        if (rolesJson != null && !rolesJson.isBlank()) {
            return rolesJson;
        }
        return role != null ? "[\"" + role + "\"]" : "[\"USER\"]";
    }

    public void setRoles(String rolesJson) {
        this.rolesJson = (rolesJson == null || rolesJson.isBlank()) ? null : rolesJson;
    }

    /** Alias formulaire admin → {@link #photoPath}. */
    public String getAvatar() {
        return photoPath;
    }

    public void setAvatar(String avatar) {
        this.photoPath = avatar;
    }

    // Check if user is admin
    public boolean isAdmin() {
        return "ADMIN".equalsIgnoreCase(role);
    }

    @Override
    public String toString() {
        return "User{" +
                "id=" + id +
                ", firstName='" + firstName + '\'' +
                ", lastName='" + lastName + '\'' +
                ", age=" + age +
                ", email='" + email + '\'' +
                ", role='" + role + '\'' +
                ", photoPath='" + photoPath + '\'' +
                '}';
    }
}
