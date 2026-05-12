package utils;

import models.Certificat;
import com.itextpdf.io.image.ImageDataFactory;
import com.itextpdf.kernel.colors.ColorConstants;
import com.itextpdf.kernel.font.PdfFontFactory;
import com.itextpdf.kernel.geom.PageSize;
import com.itextpdf.kernel.pdf.PdfDocument;
import com.itextpdf.kernel.pdf.PdfWriter;
import com.itextpdf.layout.Document;
import com.itextpdf.layout.borders.SolidBorder;
import com.itextpdf.layout.element.Cell;
import com.itextpdf.layout.element.Image;
import com.itextpdf.layout.element.Paragraph;
import com.itextpdf.layout.element.Table;
import com.itextpdf.layout.properties.HorizontalAlignment;
import com.itextpdf.layout.properties.TextAlignment;
import com.itextpdf.layout.properties.UnitValue;

import java.io.IOException;
import java.nio.file.Path;
import java.time.format.DateTimeFormatter;
import java.util.List;

public class PdfExportService {

    private static final DateTimeFormatter DTF = DateTimeFormatter.ofPattern("dd/MM/yyyy HH:mm");

    public void exportTable(Path output, String title, List<String> headers, List<List<String>> rows) throws IOException {
        try (PdfWriter writer = new PdfWriter(output.toFile());
             PdfDocument pdf = new PdfDocument(writer);
             Document doc = new Document(pdf, PageSize.A4.rotate())) {
            doc.setMargins(24, 24, 24, 24);

            doc.add(new Paragraph(title == null ? "Export PDF" : title)
                    .setFont(PdfFontFactory.createFont())
                    .setBold()
                    .setFontSize(18)
                    .setTextAlignment(TextAlignment.CENTER)
                    .setMarginBottom(14));

            Table table = new Table(UnitValue.createPercentArray(headers.size())).useAllAvailableWidth();
            for (String h : headers) {
                table.addHeaderCell(new Cell().add(new Paragraph(h))
                        .setBold()
                        .setBackgroundColor(ColorConstants.LIGHT_GRAY));
            }

            for (List<String> row : rows) {
                for (String col : row) {
                    table.addCell(new Cell().add(new Paragraph(col == null ? "" : col)));
                }
            }
            doc.add(table);
        }
    }

    public void exportCertificate(Path output,
                                  Certificat cert,
                                  String userName,
                                  String eventTitle,
                                  byte[] qrPng,
                                  String verificationUrl,
                                  byte[] signaturePng) throws IOException {

        try (PdfWriter writer = new PdfWriter(output.toFile());
             PdfDocument pdf = new PdfDocument(writer);
             Document doc = new Document(pdf, PageSize.A4.rotate())) {
            doc.setMargins(15, 15, 15, 15);

            com.itextpdf.kernel.colors.DeviceRgb gold = new com.itextpdf.kernel.colors.DeviceRgb(184, 134, 11);
            com.itextpdf.kernel.colors.DeviceRgb navy = new com.itextpdf.kernel.colors.DeviceRgb(15, 23, 42);
            com.itextpdf.kernel.colors.DeviceRgb cream = new com.itextpdf.kernel.colors.DeviceRgb(255, 253, 245);

            // Frame Table
            Table outerTable = new Table(1).useAllAvailableWidth();
            outerTable.setBorder(new SolidBorder(gold, 5f));
            outerTable.setHeight(pdf.getDefaultPageSize().getHeight() - 30);

            Cell innerCell = new Cell();
            innerCell.setBorder(new com.itextpdf.layout.borders.DoubleBorder(navy, 2f));
            innerCell.setBackgroundColor(cream);
            innerCell.setPadding(40);

            // Logo / Header
            innerCell.add(new Paragraph("CERTIFICAT DE RÉUSSITE")
                    .setFontSize(44)
                    .setBold()
                    .setFontColor(gold)
                    .setTextAlignment(TextAlignment.CENTER)
                    .setMarginTop(10));

            innerCell.add(new Paragraph("EduConnect Professional Recognition")
                    .setFontSize(14)
                    .setItalic()
                    .setFontColor(navy)
                    .setTextAlignment(TextAlignment.CENTER)
                    .setMarginBottom(30));

            // Body
            innerCell.add(new Paragraph("Ce document atteste que")
                    .setTextAlignment(TextAlignment.CENTER)
                    .setFontSize(18)
                    .setFontColor(navy));

            innerCell.add(new Paragraph(userName.toUpperCase())
                    .setTextAlignment(TextAlignment.CENTER)
                    .setBold()
                    .setFontSize(36)
                    .setFontColor(navy)
                    .setMarginTop(10)
                    .setMarginBottom(10));

            innerCell.add(new Paragraph("A accompli avec succès les exigences de l'événement")
                    .setTextAlignment(TextAlignment.CENTER)
                    .setFontSize(18)
                    .setFontColor(navy));

            innerCell.add(new Paragraph(eventTitle)
                    .setTextAlignment(TextAlignment.CENTER)
                    .setBold()
                    .setFontSize(26)
                    .setFontColor(new com.itextpdf.kernel.colors.DeviceRgb(30, 58, 138))
                    .setMarginTop(5));

            // Details & QR
            Table footerInfo = new Table(3).useAllAvailableWidth().setMarginTop(40);

            // Left: Date & Code
            String dateStr = cert.getDateObtention() == null ? "N/A" : cert.getDateObtention().format(DTF);
            Cell left = new Cell().add(new Paragraph("Délivré le : " + dateStr + "\nID: " + cert.getCodeUnique())
                    .setFontSize(11).setFontColor(navy)).setBorder(null).setTextAlignment(TextAlignment.LEFT);

            // Middle: QR
            Cell mid = new Cell().setBorder(null);
            if (qrPng != null && qrPng.length > 0) {
                Image qrImage = new Image(ImageDataFactory.create(qrPng)).setWidth(100).setHeight(100).setHorizontalAlignment(HorizontalAlignment.CENTER);
                mid.add(qrImage);
                mid.add(new Paragraph("Vérification Numérique").setFontSize(8).setTextAlignment(TextAlignment.CENTER).setFontColor(gold));
            }

            // Right: Signature
            Cell right = new Cell().setBorder(null).setTextAlignment(TextAlignment.RIGHT).setFontColor(navy);
            if (signaturePng != null && signaturePng.length > 0) {
                Image sigImage = new Image(ImageDataFactory.create(signaturePng)).setWidth(120).setHeight(50).setHorizontalAlignment(HorizontalAlignment.RIGHT);
                right.add(sigImage);
            } else {
                right.add(new Paragraph("___________________________"));
            }
            right.add(new Paragraph("Directeur EduConnect\nSignature Officielle").setFontSize(12).setItalic());


            footerInfo.addCell(left);
            footerInfo.addCell(mid);
            footerInfo.addCell(right);

            innerCell.add(footerInfo);

            if (verificationUrl != null && !verificationUrl.isBlank()) {
                innerCell.add(new Paragraph("\nVérification en ligne : " + verificationUrl)
                        .setTextAlignment(TextAlignment.CENTER).setFontSize(9).setFontColor(com.itextpdf.kernel.colors.ColorConstants.GRAY));
            }

            outerTable.addCell(innerCell);
            doc.add(outerTable);
        }
    }

}
