package models;

public class ForumReport {
    private int id;
    private String type;
    private int targetId;
    private int reporterId;
    private String reporterName;
    private String targetContent;
    private String reason;
    private String status;
    private String createdAt;

    public ForumReport() {}

    public ForumReport(int id, String type, int targetId, int reporterId, String reporterName, 
                   String targetContent, String reason, String status, String createdAt) {
        this.id = id;
        this.type = type;
        this.targetId = targetId;
        this.reporterId = reporterId;
        this.reporterName = reporterName;
        this.targetContent = targetContent;
        this.reason = reason;
        this.status = status;
        this.createdAt = createdAt;
    }

    // Getters
    public int getId() { return id; }
    public String getType() { return type; }
    public int getTargetId() { return targetId; }
    public int getReporterId() { return reporterId; }
    public String getReporterName() { return reporterName; }
    public String getTargetContent() { return targetContent; }
    public String getReason() { return reason; }
    public String getStatus() { return status; }
    public String getCreatedAt() { return createdAt; }

    // Setters
    public void setId(int id) { this.id = id; }
    public void setType(String type) { this.type = type; }
    public void setTargetId(int targetId) { this.targetId = targetId; }
    public void setReporterId(int reporterId) { this.reporterId = reporterId; }
    public void setReporterName(String reporterName) { this.reporterName = reporterName; }
    public void setTargetContent(String targetContent) { this.targetContent = targetContent; }
    public void setReason(String reason) { this.reason = reason; }
    public void setStatus(String status) { this.status = status; }
    public void setCreatedAt(String createdAt) { this.createdAt = createdAt; }
}
