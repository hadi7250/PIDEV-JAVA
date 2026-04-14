package models;

import java.sql.Timestamp;

public class ForumDiscussion {
    private int id;
    private String title;
    private String content;
    private String authorName;
    private boolean pinned;
    private boolean locked;
    private int views;
    private Timestamp createdAt;
    private Timestamp updatedAt;
    private int categoryId;
    private String categoryName;
    private int messageCount;

    public ForumDiscussion() {
    }

    public ForumDiscussion(String title, String content, String authorName, int categoryId) {
        this.title = title;
        this.content = content;
        this.authorName = authorName;
        this.categoryId = categoryId;
    }

    public ForumDiscussion(int id, String title, String content, String authorName,
                           boolean pinned, boolean locked, int views,
                           Timestamp createdAt, Timestamp updatedAt,
                           int categoryId, String categoryName, int messageCount) {
        this.id = id;
        this.title = title;
        this.content = content;
        this.authorName = authorName;
        this.pinned = pinned;
        this.locked = locked;
        this.views = views;
        this.createdAt = createdAt;
        this.updatedAt = updatedAt;
        this.categoryId = categoryId;
        this.categoryName = categoryName;
        this.messageCount = messageCount;
    }

    public int getId() { return id; }
    public void setId(int id) { this.id = id; }

    public String getTitle() { return title; }
    public void setTitle(String title) { this.title = title; }

    public String getContent() { return content; }
    public void setContent(String content) { this.content = content; }

    public String getAuthorName() { return authorName; }
    public void setAuthorName(String authorName) { this.authorName = authorName; }

    public boolean isPinned() { return pinned; }
    public void setPinned(boolean pinned) { this.pinned = pinned; }

    public boolean isLocked() { return locked; }
    public void setLocked(boolean locked) { this.locked = locked; }

    public int getViews() { return views; }
    public void setViews(int views) { this.views = views; }

    public Timestamp getCreatedAt() { return createdAt; }
    public void setCreatedAt(Timestamp createdAt) { this.createdAt = createdAt; }

    public Timestamp getUpdatedAt() { return updatedAt; }
    public void setUpdatedAt(Timestamp updatedAt) { this.updatedAt = updatedAt; }

    public int getCategoryId() { return categoryId; }
    public void setCategoryId(int categoryId) { this.categoryId = categoryId; }

    public String getCategoryName() { return categoryName; }
    public void setCategoryName(String categoryName) { this.categoryName = categoryName; }

    public int getMessageCount() { return messageCount; }
    public void setMessageCount(int messageCount) { this.messageCount = messageCount; }

    @Override
    public String toString() {
        if (title == null || title.isBlank()) {
            return "Discussion #" + id;
        }
        return title;
    }
}
