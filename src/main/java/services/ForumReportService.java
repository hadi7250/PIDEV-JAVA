package services;

import models.ForumReport;
import utils.MyDB;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

public class ForumReportService {
    private static ForumReportService instance;
    
    private ForumReportService() {
        // Private constructor for singleton
    }
    
    public static synchronized ForumReportService getInstance() {
        if (instance == null) {
            instance = new ForumReportService();
        }
        return instance;
    }
    
    public void addReport(int targetId, String type, int reporterId, String reason) {
        String sql = "INSERT INTO forum_report (type, target_id, reporter_id, reason) VALUES (?, ?, ?, ?)";
        
        try {
            Connection c = MyDB.getInstance().getConnection();
            PreparedStatement ps = c.prepareStatement(sql);
            ps.setString(1, type);
            ps.setInt(2, targetId);
            ps.setInt(3, reporterId);
            ps.setString(4, reason);
            ps.executeUpdate();
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }
    
    public boolean alreadyReported(int targetId, String type, int reporterId) {
        String sql = "SELECT COUNT(*) FROM forum_report WHERE target_id = ? AND type = ? AND reporter_id = ?";
        
        try {
            Connection c = MyDB.getInstance().getConnection();
            PreparedStatement ps = c.prepareStatement(sql);
            ps.setInt(1, targetId);
            ps.setString(2, type);
            ps.setInt(3, reporterId);
            
            ResultSet rs = ps.executeQuery();
            if (rs.next()) {
                return rs.getInt(1) > 0;
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return false;
    }
    
    public List<ForumReport> getAllReports() {
        List<ForumReport> reports = new ArrayList<>();
        String sql = """
            SELECT fr.*, 
                   COALESCE(CONCAT(u.first_name, ' ', u.last_name), 'Unknown') as reporter_name,
                   COALESCE(
                       CASE 
                           WHEN fr.type = 'message' THEN fm.forum_message_content
                           WHEN fr.type = 'discussion' THEN fd.forum_discussion_title
                       END,
                       'Content no longer available'
                   ) as target_content
            FROM forum_report fr
            LEFT JOIN user u ON fr.reporter_id = u.id
            LEFT JOIN forum_message fm ON fr.type = 'message' AND fr.target_id = fm.id_forum_message
            LEFT JOIN forum_discussion fd ON fr.type = 'discussion' AND fr.target_id = fd.id_forum_discussion
            ORDER BY fr.created_at DESC
            """;
        
        try {
            Connection c = MyDB.getInstance().getConnection();
            PreparedStatement ps = c.prepareStatement(sql);
            ResultSet rs = ps.executeQuery();
            
            while (rs.next()) {
                ForumReport report = new ForumReport();
                report.setId(rs.getInt("id"));
                report.setType(rs.getString("type"));
                report.setTargetId(rs.getInt("target_id"));
                report.setReporterId(rs.getInt("reporter_id"));
                report.setReporterName(rs.getString("reporter_name"));
                report.setTargetContent(rs.getString("target_content"));
                report.setReason(rs.getString("reason"));
                report.setStatus(rs.getString("status"));
                report.setCreatedAt(rs.getString("created_at"));
                reports.add(report);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        
        return reports;
    }
    
    public int getPendingCount() {
        String sql = "SELECT COUNT(*) FROM forum_report WHERE status = 'pending'";
        
        try {
            Connection c = MyDB.getInstance().getConnection();
            PreparedStatement ps = c.prepareStatement(sql);
            ResultSet rs = ps.executeQuery();
            
            if (rs.next()) {
                return rs.getInt(1);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        
        return 0;
    }
    
    public void updateStatus(int reportId, String status) {
        String sql = "UPDATE forum_report SET status = ? WHERE id = ?";
        
        try {
            Connection c = MyDB.getInstance().getConnection();
            PreparedStatement ps = c.prepareStatement(sql);
            ps.setString(1, status);
            ps.setInt(2, reportId);
            ps.executeUpdate();
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }
}
