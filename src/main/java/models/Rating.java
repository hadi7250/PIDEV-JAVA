package models;

import entities.User;

import java.time.LocalDateTime;

public class Rating {
    private int id;
    private int userId;
    private int eventId;
    private int note;           // 1-5
    private String commentaire;
    private LocalDateTime dateCreation;

    // Transient
    private User user;
    private Event event;

    public Rating() {
        this.dateCreation = LocalDateTime.now();
    }

    // --- Getters & Setters ---

    public int getId() { return id; }
    public void setId(int id) { this.id = id; }

    public int getUserId() { return userId; }
    public void setUserId(int userId) { this.userId = userId; }

    public int getEventId() { return eventId; }
    public void setEventId(int eventId) { this.eventId = eventId; }

    public int getNote() { return note; }
    public void setNote(int note) { this.note = note; }

    public String getCommentaire() { return commentaire; }
    public void setCommentaire(String commentaire) { this.commentaire = commentaire; }

    public LocalDateTime getDateCreation() { return dateCreation; }
    public void setDateCreation(LocalDateTime dateCreation) { this.dateCreation = dateCreation; }

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
        return note + "/5";
    }
}
