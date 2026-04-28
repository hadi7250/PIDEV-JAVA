package services;

import entities.Competence;
import entities.User;
import net.sf.jasperreports.engine.*;
import net.sf.jasperreports.engine.data.JRBeanCollectionDataSource;

import java.io.InputStream;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class CVGeneratorService {

    public String generateCV(User user, List<Competence> competences) throws JRException {
        // 1. Prepare data source
        JRBeanCollectionDataSource dataSource = new JRBeanCollectionDataSource(competences);

        // 2. Prepare parameters
        Map<String, Object> parameters = new HashMap<>();
        String fullName = user.getPrenom() + " " + user.getNom();
        parameters.put("studentName", fullName);
        parameters.put("studentEmail", user.getEmail());

        // 3. Load and compile template
        InputStream templateStream = getClass().getResourceAsStream("/reports/cv_template.jrxml");
        if (templateStream == null) {
            throw new JRException("Template file not found: /reports/cv_template.jrxml");
        }
        JasperReport jasperReport = JasperCompileManager.compileReport(templateStream);

        // 4. Fill report
        JasperPrint jasperPrint = JasperFillManager.fillReport(jasperReport, parameters, dataSource);

        // 5. Export to PDF
        String userHome = System.getProperty("user.home");
        String fileName = "CV_" + user.getPrenom() + "_" + user.getNom() + ".pdf";
        Path outputPath = Paths.get(userHome, fileName);
        
        JasperExportManager.exportReportToPdfFile(jasperPrint, outputPath.toString());

        return outputPath.toString();
    }
}
