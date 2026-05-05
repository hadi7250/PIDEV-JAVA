package utils;

import java.util.Arrays;
import java.util.List;

public class BadWordService {
    private static final List<String> BAD_WORDS = Arrays.asList(
            // English
            "badword1", "badword2", "shit", "fuck", "damn", "hell", "ass", "bastard",
            // French
            "merde", "putain", "con", "salaud", "abruti", "connard", "pute", "salope"
    );

    public int countBadWords(String text) {
        if (text == null || text.isEmpty()) return 0;
        int count = 0;
        String lower = text.toLowerCase();
        for (String word : BAD_WORDS) {
            if (lower.contains(word.toLowerCase())) {
                count++;
            }
        }
        return count;
    }

    public boolean containsBadWords(String text) {
        return countBadWords(text) > 0;
    }
}
