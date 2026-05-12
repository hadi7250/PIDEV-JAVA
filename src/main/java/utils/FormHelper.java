package utils;

import app.Main;
import javafx.event.ActionEvent;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.ButtonType;
import javafx.scene.control.DatePicker;
import javafx.scene.control.Dialog;
import javafx.scene.control.DialogPane;
import javafx.scene.control.Label;
import javafx.scene.control.Spinner;
import javafx.scene.control.SpinnerValueFactory;
import javafx.scene.layout.HBox;
import javafx.scene.layout.Region;
import javafx.scene.layout.VBox;

import java.time.LocalDateTime;
import java.time.LocalTime;
import java.util.ArrayList;
import java.util.List;
import java.util.function.Supplier;
import java.util.regex.Pattern;

/**
 * Calendrier (DatePicker) + heures, styles de formulaire, et contrôles de saisie.
 */
public final class FormHelper {

    private static final Pattern EMAIL = Pattern.compile("^[A-Za-z0-9+_.-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,}$");

    private FormHelper() {}

    public static void attachStylesheet(DialogPane pane) {
        var url = Main.class.getResource("/styles/modern.css");
        if (url != null) {
            String href = url.toExternalForm();
            if (!pane.getStylesheets().contains(href)) {
                pane.getStylesheets().add(href);
            }
        }
    }

    public static VBox wrapFormBody(Region body) {
        VBox box = new VBox(8);
        box.getStyleClass().add("form-card");
        if (!body.getStyleClass().contains("form-grid")) {
            body.getStyleClass().add("form-grid");
        }
        box.getChildren().add(body);
        VBox.setMargin(body, new Insets(0));
        return box;
    }

    public static Spinner<Integer> createHourSpinner(int initial) {
        int hi = Math.max(0, Math.min(23, initial));
        SpinnerValueFactory.IntegerSpinnerValueFactory f =
                new SpinnerValueFactory.IntegerSpinnerValueFactory(0, 23, hi);
        Spinner<Integer> s = new Spinner<>(f);
        s.setEditable(true);
        s.setPrefWidth(88);
        s.getStyleClass().add("time-spinner");
        return s;
    }

    public static Spinner<Integer> createMinuteSpinner(int initial) {
        int mi = Math.max(0, Math.min(59, initial));
        SpinnerValueFactory.IntegerSpinnerValueFactory f =
                new SpinnerValueFactory.IntegerSpinnerValueFactory(0, 59, mi, 1);
        Spinner<Integer> s = new Spinner<>(f);
        s.setEditable(true);
        s.setPrefWidth(88);
        s.getStyleClass().add("time-spinner");
        return s;
    }

    /**
     * Une ligne : libellé + date (calendrier) + heure + minute.
     */
    public static HBox dateTimeRow(String caption, DatePicker date, Spinner<Integer> hour, Spinner<Integer> minute) {
        Label l = new Label(caption);
        l.getStyleClass().add("form-field-label");
        l.setMinWidth(Region.USE_PREF_SIZE);
        date.setPromptText("Calendrier…");
        date.getStyleClass().add("form-date-picker");
        Label hLab = new Label("h");
        hLab.getStyleClass().add("form-field-muted");
        Label mLab = new Label("min");
        mLab.getStyleClass().add("form-field-muted");
        HBox row = new HBox(10, l, date, hour, hLab, minute, mLab);
        row.setAlignment(Pos.CENTER_LEFT);
        return row;
    }

    public static void setDateTime(DatePicker date, Spinner<Integer> hour, Spinner<Integer> minute, LocalDateTime ldt) {
        if (ldt == null) {
            date.setValue(null);
            return;
        }
        date.setValue(ldt.toLocalDate());
        hour.getValueFactory().setValue(ldt.getHour());
        minute.getValueFactory().setValue(ldt.getMinute());
    }

    public static LocalDateTime requireDateTime(DatePicker date, Spinner<Integer> hour, Spinner<Integer> minute,
                                                String fieldLabel) {
        if (date.getValue() == null) {
            throw new IllegalArgumentException(fieldLabel + " : choisissez une date dans le calendrier.");
        }
        int h = hour.getValue() == null ? 0 : hour.getValue();
        int m = minute.getValue() == null ? 0 : minute.getValue();
        return LocalDateTime.of(date.getValue(), LocalTime.of(h, m));
    }

    /** Si aucune date choisie, retourne {@code null}. */
    public static LocalDateTime optionalDateTime(DatePicker date, Spinner<Integer> hour, Spinner<Integer> minute) {
        if (date.getValue() == null) {
            return null;
        }
        int h = hour.getValue() == null ? 0 : hour.getValue();
        int m = minute.getValue() == null ? 0 : minute.getValue();
        return LocalDateTime.of(date.getValue(), LocalTime.of(h, m));
    }

    public static String validateRequired(String value, String label) {
        if (value == null || value.isBlank()) {
            return label + " est obligatoire.";
        }
        return null;
    }

    public static String validateEmail(String email) {
        if (email == null || email.isBlank()) {
            return "L'email est obligatoire.";
        }
        if (!EMAIL.matcher(email.trim()).matches()) {
            return "L'email n'est pas valide.";
        }
        return null;
    }

    public static String validateMinLength(String value, int min, String label) {
        if (value == null || value.trim().length() < min) {
            return label + " doit contenir au moins " + min + " caractères.";
        }
        return null;
    }

    public static String validatePositiveInt(String raw, String label) {
        if (raw == null || raw.isBlank()) {
            return label + " est obligatoire.";
        }
        try {
            int v = Integer.parseInt(raw.trim());
            if (v <= 0) {
                return label + " doit être un entier strictement positif.";
            }
        } catch (NumberFormatException e) {
            return label + " doit être un nombre entier valide.";
        }
        return null;
    }

    public static int parseRequiredPositiveInt(String raw, String label) {
        String err = validatePositiveInt(raw, label);
        if (err != null) {
            throw new IllegalArgumentException(err);
        }
        return Integer.parseInt(raw.trim());
    }

    public static String validateCategoryLetters(String name) {
        if (name == null || name.isBlank()) {
            return "Le nom de la catégorie est obligatoire.";
        }
        if (!name.matches("[a-zA-Z]+")) {
            return "Le nom ne doit contenir que des lettres (a–z, A–Z), sans chiffres ni espaces.";
        }
        return null;
    }

    public static String validateDateFinApresDebut(LocalDateTime debut, LocalDateTime fin) {
        if (fin.isBefore(debut) || fin.isEqual(debut)) {
            return "La date et l'heure de fin doivent être strictement après la date et l'heure de début.";
        }
        return null;
    }

    public static String validateDebutPasDansLePasse(LocalDateTime debut) {
        if (debut.isBefore(LocalDateTime.now())) {
            return "La date et l'heure de début ne peuvent pas être dans le passé.";
        }
        return null;
    }

    public static String validateJsonRoles(String roles) {
        if (roles == null || roles.isBlank()) {
            return null;
        }
        String t = roles.trim();
        if (!(t.startsWith("[") && t.endsWith("]"))) {
            return "Les rôles doivent être un tableau JSON, ex. [\"ROLE_USER\"].";
        }
        return null;
    }

    public static String validatePasswordNew(String password) {
        if (password == null || password.length() < 6) {
            return "Le mot de passe doit contenir au moins 6 caractères.";
        }
        return null;
    }

    public static String validateNote(int note) {
        if (note < 1 || note > 5) {
            return "La note doit être entre 1 et 5.";
        }
        return null;
    }

    public static String validateCommentMax(String comment, int maxLen) {
        if (comment != null && comment.length() > maxLen) {
            return "Le commentaire ne peut pas dépasser " + maxLen + " caractères.";
        }
        return null;
    }

    public static String joinErrors(String... messages) {
        List<String> parts = new ArrayList<>();
        for (String m : messages) {
            if (m != null && !m.isBlank()) {
                parts.add(m);
            }
        }
        return parts.isEmpty() ? null : String.join("\n", parts);
    }

    /**
     * Bloque la fermeture du dialogue quand la validation échoue : le clic « Enregistrer » est consommé
     * et l’erreur est affichée. Utiliser avec {@link Dialog#setResultConverter} qui ne construit l’objet
     * que lorsque cette validation a déjà réussi (sinon le convertisseur ne doit pas être appelé).
     */
    public static void guardDialogSave(Dialog<?> dialog, ButtonType saveBtn, Supplier<String> firstValidationErrorOrNull) {
        javafx.scene.Node node = dialog.getDialogPane().lookupButton(saveBtn);
        if (!(node instanceof Button okButton)) {
            return;
        }
        okButton.addEventFilter(ActionEvent.ACTION, e -> {
            String err = firstValidationErrorOrNull.get();
            if (err != null && !err.isBlank()) {
                e.consume();
                Alert alert = new Alert(Alert.AlertType.ERROR);
                alert.setTitle("Validation");
                alert.setHeaderText(null);
                alert.setContentText(err);
                attachStylesheet(alert.getDialogPane());
                alert.showAndWait();
            }
        });
    }
}
