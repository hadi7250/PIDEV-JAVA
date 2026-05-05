package utils;

/**
 * Physical MySQL table names for this project.
 * Align with your phpMyAdmin schema (e.g. {@code event_category} instead of {@code category}).
 */
public final class DbSchema {

    private DbSchema() {}

    /** MySQL reserved word — always use backticks in SQL. */
    public static final String USER = "`user`";

    public static final String EVENT = "event";
    public static final String EVENT_CATEGORY = "event_category";

    /**
     * {@code event} columns in your DB dump (camelCase). Always backtick-quoted in SQL.
     */
    public static final String EVT_DATE_DEBUT = "`dateDebut`";
    public static final String EVT_DATE_FIN = "`dateFin`";
    public static final String EVT_NB_MAX_PART = "`nombreMaxParticipants`";

    /** Display name for SQL: {@code prenom} + {@code nom} (your {@code user} table has no {@code name} column). */
    public static final String USER_DISPLAY_NAME_SQL = "CONCAT_WS(' ', u.prenom, u.nom)";
    public static final String PARTICIPATION = "participation";
    public static final String RATING = "rating";
    public static final String CERTIFICAT = "certificat";
}
