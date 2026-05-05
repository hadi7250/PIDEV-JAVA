package models;

import entities.User;

import java.time.LocalDateTime;

public class Certificat {
    private int id;
    private int userId;
    private int eventId;
    private LocalDateTime dateObtention;
    private String codeUnique;

    // Transient
    private User user;
    private Event event;

    public Certificat() {}

    // --- Getters & Setters ---

    public int getId() { return id; }
    public void setId(int id) { this.id = id; }

    public int getUserId() { return userId; }
    public void setUserId(int userId) { this.userId = userId; }

    public int getEventId() { return eventId; }
    public void setEventId(int eventId) { this.eventId = eventId; }

    public LocalDateTime getDateObtention() { return dateObtention; }
    public void setDateObtention(LocalDateTime dateObtention) { this.dateObtention = dateObtention; }

    public String getCodeUnique() { return codeUnique; }
    public void setCodeUnique(String codeUnique) { this.codeUnique = codeUnique; }

    public User getUser() { return user; }
    public void setUser(User user) {
        this.user = user;
        if (user != null) this.userId = user.getId();
    }

    public Event getEvent() { return event; }
    public void setEvent(Event event) {
        this.event = event;
        if (event != null) this.eventId = event.getId();
    }

    @Override
    public String toString() {
        return codeUnique != null ? codeUnique : "CERT-" + id;
    }
}
