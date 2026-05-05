package utils;

import org.apache.poi.ss.usermodel.Row;
import org.apache.poi.ss.usermodel.Sheet;
import org.apache.poi.ss.usermodel.Workbook;
import org.apache.poi.xssf.usermodel.XSSFWorkbook;

import java.io.IOException;
import java.io.OutputStream;
import java.nio.file.Files;
import java.nio.file.Path;
import java.util.List;

public class ExcelExportService {

    public void export(Path output, String sheetName, List<String> headers, List<List<String>> rows) throws IOException {
        try (Workbook workbook = new XSSFWorkbook()) {
            Sheet sheet = workbook.createSheet(sheetName == null || sheetName.isBlank() ? "Data" : sheetName);

            int rowIndex = 0;
            Row headerRow = sheet.createRow(rowIndex++);
            for (int i = 0; i < headers.size(); i++) {
                headerRow.createCell(i).setCellValue(headers.get(i));
            }

            for (List<String> data : rows) {
                Row row = sheet.createRow(rowIndex++);
                for (int i = 0; i < data.size(); i++) {
                    row.createCell(i).setCellValue(data.get(i) == null ? "" : data.get(i));
                }
            }

            for (int i = 0; i < headers.size(); i++) {
                sheet.autoSizeColumn(i);
            }

            try (OutputStream os = Files.newOutputStream(output)) {
                workbook.write(os);
            }
        }
    }
}
