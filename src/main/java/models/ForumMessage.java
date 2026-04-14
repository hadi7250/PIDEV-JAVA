package models;

import java.sql.Timestamp;

public class ForumMessage {
    private int id;
    private String content;
    private String authorName;
    private boolean isAuthor;
    private int upvotes;
    private int downvotes;
    private Timestamp createdAt;
    private Timestamp updatedAt;
    private int discussionId;
    private String discussionTitle;

    public ForumMessage() {
    }

    public ForumMessage(String content, String authorName, int discussionId) {
        this.content = content;
        this.authorName = authorName;
        this.discussionId = discussionId;
    }

    public ForumMessage(int id, String content, String authorName, boolean isAuthor,
                        int upvotes, int downvotes,
                        Timestamp createdAt, Timestamp updatedAt,
                        int discussionId, String discussionTitle) {
        this.id = id;
        this.content = content;
        this.authorName = authorName;
        this.isAuthor = isAuthor;
        this.upvotes = upvotes;
        this.downvotes = downvotes;
        this.createdAt = createdAt;
        this.updatedAt = updatedAt;
        this.discussionId = discussionId;
        this.discussionTitle = discussionTitle;
    }

    public int getId() { return id; }
    public void setId(int id) { this.id = id; }

    public String getContent() { return content; }
    public void setContent(String content) { this.content = content; }

    public String getAuthorName() { return authorName; }
    public void setAuthorName(String authorName) { this.authorName = authorName; }

    public boolean isAuthor() { return isAuthor; }
    public void setAuthor(boolean author) { isAuthor = author; }

    public int getUpvotes() { return upvotes; }
    public void setUpvotes(int upvotes) { this.upvotes = upvotes; }

    public int getDownvotes() { return downvotes; }
    public void setDownvotes(int downvotes) { this.downvotes = downvotes; }

    public Timestamp getCreatedAt() { return createdAt; }
    public void setCreatedAt(Timestamp createdAt) { this.createdAt = createdAt; }

    public Timestamp getUpdatedAt() { return updatedAt; }
    public void setUpdatedAt(Timestamp updatedAt) { this.updatedAt = updatedAt; }

    public int getDiscussionId() { return discussionId; }
    public void setDiscussionId(int discussionId) { this.discussionId = discussionId; }

    public String getDiscussionTitle() { return discussionTitle; }
    public void setDiscussionTitle(String discussionTitle) { this.discussionTitle = discussionTitle; }

    @Override
    public String toString() {
        return "Message #" + id;
    }
}
