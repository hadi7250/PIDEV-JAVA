package models;

import java.sql.Timestamp;

public class ForumCategory {
    private int id;
    private String name;
    private String description;
    private String color;
    private Timestamp createdAt;
    private Timestamp updatedAt;
    private int discussionCount;

    public ForumCategory() {
    }

    public ForumCategory(String name, String description, String color) {
        this.name = name;
        this.description = description;
        this.color = color;
    }

    public ForumCategory(int id, String name, String description, String color,
                         Timestamp createdAt, Timestamp updatedAt, int discussionCount) {
        this.id = id;
        this.name = name;
        this.description = description;
        this.color = color;
        this.createdAt = createdAt;
        this.updatedAt = updatedAt;
        this.discussionCount = discussionCount;
    }

    public int getId() { return id; }
    public void setId(int id) { this.id = id; }

    public String getName() { return name; }
    public void setName(String name) { this.name = name; }

    public String getDescription() { return description; }
    public void setDescription(String description) { this.description = description; }

    public String getColor() { return color; }
    public void setColor(String color) { this.color = color; }

    public Timestamp getCreatedAt() { return createdAt; }
    public void setCreatedAt(Timestamp createdAt) { this.createdAt = createdAt; }

    public Timestamp getUpdatedAt() { return updatedAt; }
    public void setUpdatedAt(Timestamp updatedAt) { this.updatedAt = updatedAt; }

    public int getDiscussionCount() { return discussionCount; }
    public void setDiscussionCount(int discussionCount) { this.discussionCount = discussionCount; }

    @Override
    public String toString() {
        if (name == null || name.isBlank()) {
            return "Category #" + id;
        }
        return name;
    }
}
