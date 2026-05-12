package models;

import entities.User;
import entities.User;
import java.time.LocalDateTime;



public class Participation {
    private int id;
    private int userId;
    private int eventId;
    private LocalDateTime dateInscription;

    // Transient – populated by service when needed
    private entities.User user;
    private models.Event event;


    public Participation() {
        this.dateInscription = LocalDateTime.now();
    }

    // --- Getters & Setters ---

    public int getId() { return id; }
    public void setId(int id) { this.id = id; }

    public int getUserId() { return userId; }
    public void setUserId(int userId) { this.userId = userId; }

    public int getEventId() { return eventId; }
    public void setEventId(int eventId) { this.eventId = eventId; }

    public LocalDateTime getDateInscription() { return dateInscription; }
    public void setDateInscription(LocalDateTime dateInscription) { this.dateInscription = dateInscription; }

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

    public String toString() {

        String userStr = user != null ? user.getEmail() : String.valueOf(userId);
        String eventStr = event != null ? event.getTitre() : String.valueOf(eventId);
        return userStr + " - " + eventStr;
    }
}
