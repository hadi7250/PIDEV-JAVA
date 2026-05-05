package services;

import entities.Evaluation;
import entities.User;
import net.sf.jasperreports.engine.*;
import net.sf.jasperreports.engine.design.JasperDesign;
import net.sf.jasperreports.engine.xml.JRXmlLoader;

import java.awt.Desktop;
import java.io.IOException;
import java.io.InputStream;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;
import java.util.HashMap;
import java.util.Map;

public class CertificationService {

    // Passing threshold - can be modified
    private static final double PASSING_SCORE = 60.0;

    /**
     * Generates a certificate for a student if they passed the evaluation
     * @param user The student
     * @param evaluation The evaluation with score
     * @return Path to the generated PDF certificate
     * @throws JRException if report generation fails
     */
    public String generateCertificate(User user, Evaluation evaluation) throws JRException {

        // 1. VALIDATION: Check if score exists
        if (evaluation.getScore() == null) {
            throw new JRException("Cannot generate certificate: Evaluation has no score yet.");
        }

        // 2. VALIDATION: Check if student passed
        if (evaluation.getScore() < PASSING_SCORE) {
            throw new JRException("Cannot generate certificate: Student failed the evaluation.\n"
                    + "Score: " + evaluation.getScore() + " (Required: " + PASSING_SCORE + ")");
        }

        // 3. Prepare report parameters
        Map<String, Object> parameters = new HashMap<>();
        parameters.put("studentName", user.getPrenom() + " " + user.getNom());
        parameters.put("evaluationTitle", evaluation.getTitle());
        parameters.put("competenceTitle", evaluation.getCompetence() != null ? evaluation.getCompetence().getTitle() : "N/A");
        parameters.put("date", java.time.LocalDate.now().toString());
        parameters.put("score", evaluation.getScore().toString());
        parameters.put("percentage", evaluation.getScore() + "%");
        parameters.put("certificateId", generateCertificateId(user, evaluation));
        parameters.put("generatedDate", LocalDateTime.now().format(DateTimeFormatter.ofPattern("dd/MM/yyyy HH:mm:ss")));

        // 4. Load and compile the Jasper template
        InputStream templateStream = getClass().getResourceAsStream("/reports/certificate_template.jrxml");
        if (templateStream == null) {
            throw new JRException("Certificate template not found at: /reports/certificate_template.jrxml");
        }

        JasperReport jasperReport = JasperCompileManager.compileReport(templateStream);

        // 5. Fill the report with data
        JasperPrint jasperPrint = JasperFillManager.fillReport(jasperReport, parameters, new JREmptyDataSource());

        // 6. Generate unique filename and create directory
        String userHome = System.getProperty("user.home");
        String timestamp = LocalDateTime.now().format(DateTimeFormatter.ofPattern("yyyyMMdd_HHmmss"));
        String fileName = "Certificate_" + user.getPrenom() + "_" + user.getNom()
                + "_" + evaluation.getTitle().replaceAll("\\s+", "_")
                + "_" + timestamp + ".pdf";
        Path outputPath = Paths.get(userHome, "EduConnect_Certificates", fileName);

        // Create directory if it doesn't exist (no checked exception)
        java.io.File certDir = outputPath.getParent().toFile();
        if (!certDir.exists()) {
            boolean created = certDir.mkdirs();
            if (!created) {
                throw new JRException("Failed to create certificates directory: " + certDir.getPath());
            }
        }

        // 7. Export to PDF
        JasperExportManager.exportReportToPdfFile(jasperPrint, outputPath.toString());

        // Automatically open the generated PDF file in a background thread to avoid freezing the UI
        new Thread(() -> {
            try {
                Desktop.getDesktop().open(outputPath.toFile());
            } catch (Exception e) {
                // Log or ignore if opening fails
                System.err.println("Could not open generated certificate PDF: " + e.getMessage());
            }
        }).start();

        System.out.println("Certificate generated successfully at: " + outputPath.toString());
        return outputPath.toString();
    }

    /**
     * Generates a unique certificate ID
     */
    private String generateCertificateId(User user, Evaluation evaluation) {
        String date = LocalDateTime.now().format(DateTimeFormatter.ofPattern("yyyyMMdd"));
        String userId = String.valueOf(user.getId());
        String evalId = String.valueOf(evaluation.getId());
        return "CERT-" + date + "-" + userId + "-" + evalId;
    }

    /**
     * Checks if a student is eligible to receive a certificate
     * @param evaluation The evaluation to check
     * @return true if score >= passing threshold
     */
    public boolean canGenerateCertificate(Evaluation evaluation) {
        return evaluation.getScore() != null && evaluation.getScore() >= PASSING_SCORE;
    }

    /**
     * Get the current passing score threshold
     */
    public double getPassingScore() {
        return PASSING_SCORE;
    }

    /**
     * Generates certificate with a custom passing threshold
     * @param user The student
     * @param evaluation The evaluation
     * @param customThreshold Custom passing score (e.g., 75.0 for 75%)
     * @return Path to the generated certificate
     */
    public String generateCertificateWithCustomThreshold(User user, Evaluation evaluation, double customThreshold) throws JRException {
        if (evaluation.getScore() == null || evaluation.getScore() < customThreshold) {
            throw new JRException("Cannot generate certificate: Score " + evaluation.getScore()
                    + " below custom threshold " + customThreshold);
        }
        return generateCertificate(user, evaluation);
    }
}