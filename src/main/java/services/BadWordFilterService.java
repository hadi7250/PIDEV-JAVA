package services;

import java.util.Set;
import java.util.HashSet;
import java.util.regex.Pattern;
import java.util.regex.Matcher;

/**
 * Singleton service for filtering bad words and inappropriate content.
 * Provides case-insensitive detection and censorship of profanity.
 */
public class BadWordFilterService {
    
    private static BadWordFilterService instance;
    private final Set<String> badWords;
    private final Pattern wordPattern;
    
    private BadWordFilterService() {
        // Initialize hardcoded list of bad words in English and French
        badWords = new HashSet<>();

        // English bad words
        badWords.add("fuck");
        badWords.add("shit");
        badWords.add("asshole");
        badWords.add("bitch");
        badWords.add("bastard");
        badWords.add("crap");
        badWords.add("dick");
        badWords.add("piss");
        badWords.add("cunt");
        badWords.add("whore");
        badWords.add("slut");
        badWords.add("idiot");
        badWords.add("stupid");
        badWords.add("imbecile");

        // French bad words
        badWords.add("putain");
        badWords.add("merde");
        badWords.add("connard");
        badWords.add("salope");
        badWords.add("enculé");
        badWords.add("bordel");
        badWords.add("pute");
        badWords.add("con");
        badWords.add("couille");
        badWords.add("chier");
        badWords.add("fils de pute");
        badWords.add("enculer");
        badWords.add("baiser");
        badWords.add("trou du cul");
        badWords.add("nique");

        // Compound phrases (often used together)
        badWords.add("fuckyou");
        badWords.add("fuckoff");
        badWords.add("shutup");
        badWords.add("bullshit");
        badWords.add("horseshit");
        badWords.add("motherfucker");
        badWords.add("sonofabitch");
        
        // Create regex pattern for word boundaries and case insensitivity
        StringBuilder patternBuilder = new StringBuilder();
        patternBuilder.append("\\b(");
        
        boolean first = true;
        for (String word : badWords) {
            if (!first) {
                patternBuilder.append("|");
            }
            patternBuilder.append(Pattern.quote(word));
            first = false;
        }
        
        patternBuilder.append(")\\b");
        wordPattern = Pattern.compile(patternBuilder.toString(), Pattern.CASE_INSENSITIVE);
    }
    
    /**
     * Gets the singleton instance of BadWordFilterService.
     * 
     * @return The BadWordFilterService instance
     */
    public static BadWordFilterService getInstance() {
        if (instance == null) {
            synchronized (BadWordFilterService.class) {
                if (instance == null) {
                    instance = new BadWordFilterService();
                }
            }
        }
        return instance;
    }
    
    /**
     * Checks if the given text contains any bad words.
     * Uses word boundary matching to avoid Scunthorpe problem (false positives like "hello" containing "hell").
     *
     * @param text The text to check
     * @return true if bad words are found, false otherwise
     */
    public boolean containsBadWord(String text) {
        if (text == null || text.isBlank()) return false;
        
        // Normalize: lowercase, replace number substitutions
        String normalized = text.toLowerCase()
            .replace("0", "o").replace("1", "i").replace("3", "e")
            .replace("4", "a").replace("5", "s").replace("6", "g")
            .replace("7", "t").replace("8", "b").replace("@", "a")
            .replace("$", "s").replace("!", "i");

        for (String word : badWords) {
            String w = word.toLowerCase().trim();
            
            // Use word boundary so "hell" doesn't match "hello" or "helloo"
            // but still matches "hell", "hell!", "hell?", "go to hell"
            String boundaryPattern = "(?<![a-z])" + Pattern.quote(w) + "(?![a-z])";
            if (Pattern.compile(boundaryPattern).matcher(normalized).find()) {
                return true;
            }

            // Also check stretched version with word boundary
            StringBuilder stretched = new StringBuilder("(?<![a-z])");
            for (char c : w.toCharArray()) {
                stretched.append(Pattern.quote(String.valueOf(c))).append("+");
            }
            stretched.append("(?![a-z])");
            if (Pattern.compile(stretched.toString()).matcher(normalized).find()) {
                return true;
            }
        }
        return false;
    }

    /**
     * Censors bad words in the given text by replacing them with ***.
     * Handles stretched words, skipped vowels, and number/symbol substitutions.
     *
     * @param text The text to censor
     * @return The censored text with bad words replaced by ***
     */
    public String censor(String text) {
        if (text == null || text.isBlank()) return text;
        String result = text;

        for (String word : badWords) {
            // Pattern 1: stretched letters
            StringBuilder stretchedPattern = new StringBuilder();
            for (char c : word.toCharArray()) {
                stretchedPattern.append(Pattern.quote(String.valueOf(c))).append("+");
            }
            result = result.replaceAll("(?i)" + stretchedPattern, "***");

            // Pattern 2: skipped vowels
            StringBuilder skippedPattern = new StringBuilder();
            for (char c : word.toCharArray()) {
                String escaped = Pattern.quote(String.valueOf(c));
                if ("aeiou".indexOf(c) >= 0) {
                    skippedPattern.append(escaped).append("*");
                } else {
                    skippedPattern.append(escaped).append("+");
                }
            }
            result = result.replaceAll("(?i)" + skippedPattern, "***");

            // Pattern 3: number/symbol substitutions
            StringBuilder symbolPattern = new StringBuilder();
            for (char c : word.toCharArray()) {
                switch (c) {
                    case 'a': symbolPattern.append("[a4@]"); break;
                    case 'e': symbolPattern.append("[e3]"); break;
                    case 'i': symbolPattern.append("[i1!]"); break;
                    case 'o': symbolPattern.append("[o0]"); break;
                    case 's': symbolPattern.append("[s5$]"); break;
                    case 't': symbolPattern.append("[t+]"); break;
                    case 'b': symbolPattern.append("[b8]"); break;
                    default: symbolPattern.append(Pattern.quote(String.valueOf(c)));
                }
            }
            result = result.replaceAll("(?i)" + symbolPattern, "***");
        }
        return result;
    }
    
    /**
     * Gets the list of all bad words (for debugging purposes).
     * 
     * @return A copy of the bad words set
     */
    public Set<String> getBadWords() {
        return new HashSet<>(badWords);
    }
    
    /**
     * Gets the total count of bad words in the filter.
     * 
     * @return The number of bad words in the filter
     */
    public int getBadWordCount() {
        return badWords.size();
    }
}
