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
        badWords.add("damn");
        badWords.add("hell");
        badWords.add("crap");
        badWords.add("dick");
        badWords.add("piss");
        badWords.add("cunt");
        badWords.add("whore");
        badWords.add("slut");
        badWords.add("idiot");
        badWords.add("stupid");
        
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
     * This check is case-insensitive and matches whole words.
     * 
     * @param text The text to check
     * @return true if bad words are found, false otherwise
     */
    public boolean containsBadWord(String text) {
        if (text == null || text.trim().isEmpty()) {
            return false;
        }
        
        Matcher matcher = wordPattern.matcher(text);
        return matcher.find();
    }
    
    /**
     * Censors bad words in the given text by replacing them with ***.
     * Preserves the original text structure and length.
     * 
     * @param text The text to censor
     * @return The censored text with bad words replaced by ***
     */
    public String censor(String text) {
        if (text == null || text.trim().isEmpty()) {
            return text;
        }
        
        Matcher matcher = wordPattern.matcher(text);
        StringBuffer result = new StringBuffer();
        
        while (matcher.find()) {
            String badWord = matcher.group();
            String censored = "*".repeat(badWord.length());
            matcher.appendReplacement(result, censored);
        }
        matcher.appendTail(result);
        
        return result.toString();
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
