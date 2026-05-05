package utils;

import java.io.IOException;
import java.nio.charset.StandardCharsets;
import java.nio.file.Files;
import java.nio.file.Path;
import java.util.ArrayList;
import java.util.List;

public class CsvExportService {

    public void export(Path output, List<String> headers, List<List<String>> rows) throws IOException {
        List<String> lines = new ArrayList<>();
        lines.add(toCsvLine(headers));
        for (List<String> row : rows) {
            lines.add(toCsvLine(row));
        }
        Files.write(output, lines, StandardCharsets.UTF_8);
    }

    public void exportSingleRow(Path output, List<String> headers, List<String> row) throws IOException {
        export(output, headers, List.of(row));
    }

    private String toCsvLine(List<String> values) {
        List<String> escaped = new ArrayList<>(values.size());
        for (String v : values) {
            String s = v == null ? "" : v;
            if (s.contains("\"") || s.contains(",") || s.contains("\n")) {
                s = "\"" + s.replace("\"", "\"\"") + "\"";
            }
            escaped.add(s);
        }
        return String.join(",", escaped);
    }
}
