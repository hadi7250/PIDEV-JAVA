package controllers;

import app.MainFx;
import entities.User;
import models.Category;
import models.Certificat;
import models.Event;
import models.Participation;
import models.Rating;
import services.CertificatService;
import services.CategoryService;
import services.EventService;
import services.ICertificatService;
import services.ICategoryService;
import services.IEventService;
import services.IParticipationService;
import services.IRatingService;
import services.IUserService;
import services.ParticipationService;
import services.RatingService;
import services.UserService;
import utils.CsvExportService;
import utils.FormHelper;
import utils.MailService;
import utils.NotificationService;
import utils.PdfExportService;
import utils.QrCodeService;

import javafx.beans.property.SimpleIntegerProperty;
import javafx.beans.property.SimpleStringProperty;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.collections.transformation.FilteredList;
import javafx.scene.chart.*;

import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.control.*;
import javafx.scene.layout.*;
import javafx.scene.web.WebEngine;
import javafx.scene.web.WebView;
import javafx.stage.FileChooser;
import javafx.stage.Window;
import javafx.util.Duration;
import javafx.scene.canvas.Canvas;
import javafx.scene.canvas.GraphicsContext;
import javafx.scene.image.WritableImage;
import javafx.embed.swing.SwingFXUtils;
import java.awt.image.BufferedImage;


import java.io.IOException;
import java.net.URL;
import java.nio.file.Files;
import java.nio.file.Path;
import java.sql.SQLException;
import java.time.LocalDate;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;
import java.util.ResourceBundle;
import java.util.function.Function;

/**
 * Back-office admin dashboard – manages Events, Categories, Participations, Ratings, Certificats.
 * Uses a sidebar navigation to switch between table views (similar to the Symfony back-office DataTables).
 */
public class AdminDashboardController implements Initializable {

    @FXML private VBox sidebarMenu;
    @FXML private StackPane contentArea;
    @FXML private Label titleLabel;

    private final IEventService eventService = new EventService();
    private final ICategoryService categoryService = new CategoryService();
    private final IUserService userService = new UserService();
    private final IParticipationService participationService = new ParticipationService();
    private final IRatingService ratingService = new RatingService();
    private final ICertificatService certificatService = new CertificatService();
    private final NotificationService notificationService = new NotificationService();
    private final CsvExportService csvExportService = new CsvExportService();

    private final PdfExportService pdfExportService = new PdfExportService();
    private final QrCodeService qrCodeService = new QrCodeService();
    private final MailService mailService = new MailService();


    private static final DateTimeFormatter DTF = DateTimeFormatter.ofPattern("dd/MM/yyyy HH:mm");

    private static String nz(String s) {
        return s == null ? "" : s;
    }

    /** Infobulle sur les boutons / champs (admin). */
    private static void tip(Control c, String text) {
        if (c == null || text == null || text.isEmpty()) {
            return;
        }
        Tooltip t = new Tooltip(text);
        t.setShowDelay(Duration.millis(280));
        c.setTooltip(t);
    }

    private static TextField createAdminSearchField() {
        TextField tf = new TextField();
        tf.setPromptText("Rechercher dans le tableau…");
        tf.setMaxWidth(Double.MAX_VALUE);
        HBox.setHgrow(tf, Priority.ALWAYS);
        tip(tf, "Filtre instantané : tapez pour réduire les lignes affichées.");
        return tf;
    }

    private static <T> void bindLiveTableFilter(TextField search, FilteredList<T> filtered, Function<T, String> rowText) {
        search.textProperty().addListener((obs, o, n) -> {
            String q = n == null ? "" : n.trim().toLowerCase();
            filtered.setPredicate(item -> {
                if (q.isEmpty()) {
                    return true;
                }
                String hay = rowText.apply(item);
                return hay != null && hay.toLowerCase().contains(q);
            });
        });
    }

    @Override
    public void initialize(URL url, ResourceBundle rb) {
        showEvents();
    }

    // ─── SIDEBAR NAVIGATION ─────────────────────────────────────────
    @FXML private void showEvents()         { titleLabel.setText("Gestion des Événements"); loadEventsTable(); }
    @FXML private void showCategories()    { titleLabel.setText("Gestion des Catégories"); loadCategoriesTable(); }
    @FXML private void showUsers()         { titleLabel.setText("Gestion des Utilisateurs"); loadUsersTable(); }
    @FXML private void showParticipations() { titleLabel.setText("Gestion des Participations"); loadParticipationsTable(); }
    @FXML private void showRatings()        { titleLabel.setText("Gestion des Avis"); loadRatingsTable(); }
    @FXML private void showCertificats()    { titleLabel.setText("Gestion des Certificats"); loadCertificatsTable(); }
    @FXML private void showStats()          { titleLabel.setText("Statistiques & Analyse"); loadStatsPage(); }
    @FXML private void goHome()             { MainFx.switchScene("/fxml/Event/main_app.fxml"); }


    // ═══════════════════════════════════════════════════════════════
    //  EVENTS TABLE
    // ═══════════════════════════════════════════════════════════════
    private void loadEventsTable() {
        try {
            var events = eventService.getAll();
            var headers = java.util.List.of("Titre", "Categorie", "Date debut", "Date fin", "Lieu", "Duree", "Max participants");

            TableView<Event> table = new TableView<>();
            table.setColumnResizePolicy(TableView.CONSTRAINED_RESIZE_POLICY);
            table.getStyleClass().add("table-view");

            TableColumn<Event, String> colTitre = new TableColumn<>("Titre");
            colTitre.setCellValueFactory(cd -> new SimpleStringProperty(cd.getValue().getTitre()));

            TableColumn<Event, String> colCat = new TableColumn<>("Catégorie");
            colCat.setCellValueFactory(cd -> new SimpleStringProperty(
                    cd.getValue().getCategory() != null ? cd.getValue().getCategory().getName() : ""));

            TableColumn<Event, String> colDebut = new TableColumn<>("Date début");
            colDebut.setCellValueFactory(cd -> new SimpleStringProperty(
                    cd.getValue().getDateDebut() != null ? cd.getValue().getDateDebut().format(DTF) : ""));

            TableColumn<Event, String> colFin = new TableColumn<>("Date fin");
            colFin.setCellValueFactory(cd -> new SimpleStringProperty(
                    cd.getValue().getDateFin() != null ? cd.getValue().getDateFin().format(DTF) : ""));

            TableColumn<Event, String> colLieu = new TableColumn<>("Lieu");
            colLieu.setCellValueFactory(cd -> new SimpleStringProperty(cd.getValue().getLieu()));

            TableColumn<Event, Integer> colDuree = new TableColumn<>("Durée (min)");
            colDuree.setCellValueFactory(cd -> new SimpleIntegerProperty(cd.getValue().getDuree()).asObject());

            TableColumn<Event, Integer> colMax = new TableColumn<>("Max Participants");
            colMax.setCellValueFactory(cd -> new SimpleIntegerProperty(cd.getValue().getNombreMaxParticipants()).asObject());

            TableColumn<Event, Void> colActions = new TableColumn<>("Actions");
            colActions.setCellFactory(col -> new TableCell<>() {
                private final Button btnEdit = new Button("Modifier");
                private final Button btnDel  = new Button("Supprimer");
                private final HBox box = new HBox(8, btnEdit, btnDel);
                {
                    btnEdit.getStyleClass().addAll("btn", "btn-primary");
                    btnDel.getStyleClass().addAll("btn", "btn-danger");
                    box.setAlignment(Pos.CENTER);
                    tip(btnEdit, "Modifier les informations de cet événement");
                    tip(btnDel, "Supprimer définitivement cet événement");
                    btnEdit.setOnAction(e -> openEventForm(getTableView().getItems().get(getIndex())));
                    btnDel.setOnAction(e -> deleteEvent(getTableView().getItems().get(getIndex())));
                }
                @Override protected void updateItem(Void v, boolean empty) {
                    super.updateItem(v, empty);
                    setGraphic(empty ? null : box);
                }
            });

            table.getColumns().addAll(colTitre, colCat, colDebut, colFin, colLieu, colDuree, colMax, colActions);
            ObservableList<Event> masterEv = FXCollections.observableArrayList(events);
            FilteredList<Event> filteredEv = new FilteredList<>(masterEv, e -> true);
            TextField searchEv = createAdminSearchField();
            bindLiveTableFilter(searchEv, filteredEv, ev -> {
                String cat = ev.getCategory() != null ? ev.getCategory().getName() : "";
                String d1 = ev.getDateDebut() != null ? ev.getDateDebut().format(DTF) : "";
                String d2 = ev.getDateFin() != null ? ev.getDateFin().format(DTF) : "";
                return String.join(" ", nz(ev.getTitre()), cat, d1, d2, nz(ev.getLieu()),
                        String.valueOf(ev.getDuree()), String.valueOf(ev.getNombreMaxParticipants()));
            });
            table.setItems(filteredEv);

            Button btnAdd = new Button("+ Ajouter un Événement");
            btnAdd.getStyleClass().addAll("btn", "btn-success");
            tip(btnAdd, "Créer un nouvel événement (titre, dates, lieu, catégorie…)");
            btnAdd.setOnAction(e -> openEventForm(null));
            Button btnCsvAll = new Button("Exporter CSV");
            btnCsvAll.getStyleClass().addAll("btn", "btn-outline");
            tip(btnCsvAll, "Exporter la liste complète des événements (fichier .csv)");
            btnCsvAll.setOnAction(e -> exportAllCsv("Exporter événements CSV", "events.csv", headers, events.stream().map(this::eventRow).toList()));

            HBox topEv = new HBox(12, btnAdd, btnCsvAll, searchEv);

            topEv.setAlignment(Pos.CENTER_LEFT);
            VBox wrapper = new VBox(12, topEv, table);
            VBox.setVgrow(table, Priority.ALWAYS);
            wrapper.setPadding(new Insets(16));

            contentArea.getChildren().setAll(wrapper);
        } catch (SQLException ex) {
            showError("Erreur chargement événements", ex.getMessage());
        }
    }

    private void openEventForm(Event existing) {
        boolean isEdit = existing != null;

        Dialog<Event> dialog = new Dialog<>();
        dialog.setTitle(isEdit ? "Modifier l'événement" : "Nouvel événement");
        dialog.setHeaderText(isEdit ? "Modifier : " + existing.getTitre() : "Créer un nouvel événement");

        ButtonType saveBtn = new ButtonType("Enregistrer", ButtonBar.ButtonData.OK_DONE);
        dialog.getDialogPane().getButtonTypes().addAll(saveBtn, ButtonType.CANCEL);
        FormHelper.attachStylesheet(dialog.getDialogPane());

        TextField tfTitre = new TextField(isEdit ? existing.getTitre() : "");
        tfTitre.setPromptText("Titre (min. 3 caractères)");
        TextField tfLieu = new TextField(isEdit ? existing.getLieu() : "");
        tfLieu.setPromptText("Lieu (min. 3 caractères)");
        Button btnPickOnMap = new Button("Choisir sur la carte");
        btnPickOnMap.getStyleClass().addAll("btn", "btn-outline");
        tip(btnPickOnMap, "Carte interactive : cliquez pour enregistrer latitude et longitude dans le lieu");
        btnPickOnMap.setOnAction(e -> {
            String picked = pickLocationOnLeaflet(tfLieu.getText());
            if (picked != null) {
                tfLieu.setText(picked);
            }
        });
        TextArea taDesc = new TextArea(isEdit ? existing.getDescription() : "");
        taDesc.setPromptText("Description (min. 10 caractères)");
        taDesc.setPrefRowCount(3);
        TextField tfDuree = new TextField(isEdit ? String.valueOf(existing.getDuree()) : "");
        tfDuree.setPromptText("Durée en minutes (> 0)");
        TextField tfMax = new TextField(isEdit ? String.valueOf(existing.getNombreMaxParticipants()) : "");
        tfMax.setPromptText("Nombre max. de participants (> 0)");

        DatePicker dpDebut = new DatePicker();
        Spinner<Integer> hDebut = FormHelper.createHourSpinner(isEdit && existing.getDateDebut() != null ? existing.getDateDebut().getHour() : 9);
        Spinner<Integer> mDebut = FormHelper.createMinuteSpinner(isEdit && existing.getDateDebut() != null ? existing.getDateDebut().getMinute() : 0);
        DatePicker dpFin = new DatePicker();
        Spinner<Integer> hFin = FormHelper.createHourSpinner(isEdit && existing.getDateFin() != null ? existing.getDateFin().getHour() : 17);
        Spinner<Integer> mFin = FormHelper.createMinuteSpinner(isEdit && existing.getDateFin() != null ? existing.getDateFin().getMinute() : 0);
        if (isEdit) {
            if (existing.getDateDebut() != null) {
                FormHelper.setDateTime(dpDebut, hDebut, mDebut, existing.getDateDebut());
            }
            if (existing.getDateFin() != null) {
                FormHelper.setDateTime(dpFin, hFin, mFin, existing.getDateFin());
            }
        } else {
            LocalDateTime now = LocalDateTime.now().withSecond(0).withNano(0);
            FormHelper.setDateTime(dpDebut, hDebut, mDebut, now.plusDays(1));
            FormHelper.setDateTime(dpFin, hFin, mFin, now.plusDays(1).plusHours(3));
        }

        ComboBox<Category> cbCat = new ComboBox<>();
        try {
            cbCat.setItems(FXCollections.observableArrayList(categoryService.getAll()));
        } catch (SQLException ignored) {
        }
        if (isEdit && existing.getCategory() != null) {
            cbCat.getItems().stream().filter(c -> c.getId() == existing.getCategoryId()).findFirst().ifPresent(cbCat::setValue);
        }

        GridPane grid = new GridPane();
        grid.setHgap(12);
        grid.setVgap(12);
        grid.setPadding(new Insets(4, 0, 0, 0));
        int row = 0;
        grid.addRow(row++, labelReq("Titre"), tfTitre);
        grid.addRow(row++, labelReq("Catégorie"), cbCat);
        HBox rowDebut = FormHelper.dateTimeRow("Début *", dpDebut, hDebut, mDebut);
        grid.add(rowDebut, 0, row);
        GridPane.setColumnSpan(rowDebut, 2);
        row++;
        HBox rowFin = FormHelper.dateTimeRow("Fin *", dpFin, hFin, mFin);
        grid.add(rowFin, 0, row);
        GridPane.setColumnSpan(rowFin, 2);
        row++;
        HBox lieuRow = new HBox(10, tfLieu, btnPickOnMap);
        HBox.setHgrow(tfLieu, Priority.ALWAYS);
        grid.addRow(row++, labelReq("Lieu"), lieuRow);
        grid.addRow(row++, labelReq("Durée (min)"), tfDuree);
        grid.addRow(row++, labelReq("Max participants"), tfMax);
        grid.addRow(row++, labelReq("Description"), taDesc);
        Label hint = new Label("Les champs marqués * sont obligatoires. Utilisez le calendrier puis l’heure.");
        hint.getStyleClass().add("form-hint");
        grid.add(hint, 0, row);
        GridPane.setColumnSpan(hint, 2);

        dialog.getDialogPane().setContent(FormHelper.wrapFormBody(grid));

        FormHelper.guardDialogSave(dialog, saveBtn, () -> {
            String err = FormHelper.joinErrors(
                    FormHelper.validateMinLength(tfTitre.getText(), 3, "Le titre"),
                    FormHelper.validateMinLength(tfLieu.getText(), 3, "Le lieu"),
                    FormHelper.validateMinLength(taDesc.getText(), 10, "La description"),
                    FormHelper.validatePositiveInt(tfDuree.getText(), "La durée"),
                    FormHelper.validatePositiveInt(tfMax.getText(), "Le nombre max. de participants"),
                    cbCat.getValue() == null ? "Choisissez une catégorie." : null
            );
            if (err != null) {
                return err;
            }
            LocalDateTime dtDebut;
            LocalDateTime dtFin;
            try {
                dtDebut = FormHelper.requireDateTime(dpDebut, hDebut, mDebut, "Date de début");
                dtFin = FormHelper.requireDateTime(dpFin, hFin, mFin, "Date de fin");
            } catch (IllegalArgumentException ex) {
                return ex.getMessage();
            }
            return FormHelper.joinErrors(
                    FormHelper.validateDateFinApresDebut(dtDebut, dtFin),
                    !isEdit ? FormHelper.validateDebutPasDansLePasse(dtDebut) : null
            );
        });

        dialog.setResultConverter(btn -> {
            if (btn != saveBtn) {
                return null;
            }
            LocalDateTime dtDebut = FormHelper.requireDateTime(dpDebut, hDebut, mDebut, "Date de début");
            LocalDateTime dtFin = FormHelper.requireDateTime(dpFin, hFin, mFin, "Date de fin");
            Event ev = isEdit ? existing : new Event();
            ev.setTitre(tfTitre.getText().trim());
            ev.setLieu(tfLieu.getText().trim());
            ev.setDescription(taDesc.getText().trim());
            ev.setDuree(FormHelper.parseRequiredPositiveInt(tfDuree.getText(), "La durée"));
            ev.setNombreMaxParticipants(FormHelper.parseRequiredPositiveInt(tfMax.getText(), "Le nombre max. de participants"));
            ev.setDateDebut(dtDebut);
            ev.setDateFin(dtFin);
            ev.setCategoryId(cbCat.getValue().getId());
            return ev;
        });

        dialog.showAndWait().ifPresent(ev -> {
            try {
                if (isEdit) {
                    eventService.update(ev);
                    notificationService.success("Événement mis à jour", "Modification enregistrée.");
                } else {
                    eventService.add(ev);
                    notificationService.success("Événement ajouté", "Nouveau événement enregistré.");
                    // Notify all users via email
                    try {
                        java.util.List<User> allUsers = userService.getAll();
                        mailService.sendNewEventNotification(ev, allUsers);
                    } catch (Exception ex) {
                        System.err.println("Erreur notification email : " + ex.getMessage());
                    }
                }

                loadEventsTable();
            } catch (SQLException ex) {
                showError("Erreur sauvegarde", ex.getMessage());
            }
        });
    }

    private String pickLocationOnLeaflet(String initialLieu) {
        Dialog<String> mapDialog = new Dialog<>();
        mapDialog.setTitle("Choisir une localisation");
        mapDialog.setHeaderText("Cliquez sur la carte pour sélectionner la position de l'événement.");
        ButtonType useLocation = new ButtonType("Utiliser cette position", ButtonBar.ButtonData.OK_DONE);
        mapDialog.getDialogPane().getButtonTypes().addAll(useLocation, ButtonType.CANCEL);
        FormHelper.attachStylesheet(mapDialog.getDialogPane());

        Label selected = new Label("Coordonnées sélectionnées: aucune");
        selected.getStyleClass().add("form-hint");
        selected.setWrapText(true);

        WebView webView = new WebView();
        webView.setPrefSize(720, 420);
        webView.setContextMenuEnabled(false);
        WebEngine engine = webView.getEngine();

        double[] coords = parseCoords(initialLieu);
        double lat = coords != null ? coords[0] : 36.8065;
        double lng = coords != null ? coords[1] : 10.1815;
        int zoom = coords != null ? 14 : 6;

        final String[] selectedCoords = new String[1];
        if (coords != null) {
            selectedCoords[0] = formatCoords(lat, lng);
            selected.setText("Coordonnées sélectionnées: " + selectedCoords[0]);
        }

        engine.setOnAlert(evt -> {
            String data = evt.getData();
            if (data != null && data.startsWith("coords:")) {
                selectedCoords[0] = data.substring("coords:".length());
                selected.setText("Coordonnées sélectionnées: " + selectedCoords[0]);
            }
        });

        String html = "<!DOCTYPE html><html><head>"
                + "<meta charset='UTF-8'/>"
                + "<meta name='viewport' content='width=device-width,initial-scale=1.0'/>"
                + "<link rel='stylesheet' href='https://unpkg.com/leaflet@1.9.4/dist/leaflet.css'/>"
                + "<style>html,body,#map{height:100%;margin:0;}#map{border-radius:12px;}</style>"
                + "</head><body><div id='map'></div>"
                + "<script src='https://unpkg.com/leaflet@1.9.4/dist/leaflet.js'></script>"
                + "<script>"
                + "const map=L.map('map').setView([" + lat + "," + lng + "]," + zoom + ");"
                + "L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{maxZoom:19,attribution:'&copy; OpenStreetMap contributors'}).addTo(map);"
                + "let marker=L.marker([" + lat + "," + lng + "]).addTo(map);"
                + "const send=(a,b)=>{const c=a.toFixed(6)+', '+b.toFixed(6);alert('coords:'+c);marker.setLatLng([a,b]).bindPopup(c).openPopup();};"
                + "map.on('click',e=>send(e.latlng.lat,e.latlng.lng));"
                + "send(" + lat + "," + lng + ");"
                + "</script></body></html>";
        engine.loadContent(html);

        VBox content = new VBox(10, webView, selected);
        content.setPadding(new Insets(8));
        mapDialog.getDialogPane().setContent(content);

        mapDialog.setResultConverter(btn -> btn == useLocation ? selectedCoords[0] : null);
        return mapDialog.showAndWait().orElse(null);
    }

    private static String formatCoords(double lat, double lng) {
        return String.format(java.util.Locale.US, "%.6f, %.6f", lat, lng);
    }

    private static double[] parseCoords(String value) {
        if (value == null) {
            return null;
        }
        String[] parts = value.split(",");
        if (parts.length != 2) {
            return null;
        }
        try {
            double lat = Double.parseDouble(parts[0].trim());
            double lng = Double.parseDouble(parts[1].trim());
            if (lat < -90 || lat > 90 || lng < -180 || lng > 180) {
                return null;
            }
            return new double[]{lat, lng};
        } catch (NumberFormatException ex) {
            return null;
        }
    }

    private static Label labelReq(String text) {
        Label l = new Label(text + " *");
        l.getStyleClass().add("form-field-label");
        return l;
    }

    private void deleteEvent(Event ev) {
        Alert confirm = new Alert(Alert.AlertType.CONFIRMATION, "Supprimer « " + ev.getTitre() + " » ?", ButtonType.YES, ButtonType.NO);
        confirm.showAndWait().filter(b -> b == ButtonType.YES).ifPresent(b -> {
            try {
                eventService.delete(ev.getId());
                loadEventsTable();
                notificationService.success("Événement supprimé", "Suppression effectuée.");
            }
            catch (SQLException ex) { showError("Erreur suppression", ex.getMessage()); }
        });
    }

    // ═══════════════════════════════════════════════════════════════
    //  CATEGORIES TABLE
    // ═══════════════════════════════════════════════════════════════
    private void loadCategoriesTable() {
        try {
            var categories = categoryService.getAll();
            var headers = java.util.List.of("Nom", "Nb evenements");

            TableView<Category> table = new TableView<>();
            table.setColumnResizePolicy(TableView.CONSTRAINED_RESIZE_POLICY);
            table.getStyleClass().add("table-view");

            TableColumn<Category, String> colName = new TableColumn<>("Nom");
            colName.setCellValueFactory(cd -> new SimpleStringProperty(cd.getValue().getName()));

            TableColumn<Category, Integer> colCount = new TableColumn<>("Nb Événements");
            colCount.setCellValueFactory(cd -> {
                try { return new SimpleIntegerProperty(categoryService.countEvents(cd.getValue().getId())).asObject(); }
                catch (SQLException e) { return new SimpleIntegerProperty(0).asObject(); }
            });

            TableColumn<Category, Void> colActions = new TableColumn<>("Actions");
            colActions.setCellFactory(col -> new TableCell<>() {
                private final Button btnEdit = new Button("Modifier");
                private final Button btnDel  = new Button("Supprimer");
                private final HBox box = new HBox(8, btnEdit, btnDel);
                {
                    btnEdit.getStyleClass().addAll("btn", "btn-primary");
                    btnDel.getStyleClass().addAll("btn", "btn-danger");
                    box.setAlignment(Pos.CENTER);
                    tip(btnEdit, "Renommer cette catégorie");
                    tip(btnDel, "Supprimer cette catégorie (si aucune contrainte)");
                    btnEdit.setOnAction(e -> openCategoryForm(getTableView().getItems().get(getIndex())));
                    btnDel.setOnAction(e -> deleteCategory(getTableView().getItems().get(getIndex())));
                }
                @Override protected void updateItem(Void v, boolean empty) {
                    super.updateItem(v, empty);
                    setGraphic(empty ? null : box);
                }
            });

            table.getColumns().addAll(colName, colCount, colActions);
            ObservableList<Category> masterCat = FXCollections.observableArrayList(categories);
            FilteredList<Category> filteredCat = new FilteredList<>(masterCat, c -> true);
            TextField searchCat = createAdminSearchField();
            bindLiveTableFilter(searchCat, filteredCat, c -> {
                try {
                    return c.getName() + " " + categoryService.countEvents(c.getId());
                } catch (SQLException e) {
                    return c.getName();
                }
            });
            table.setItems(filteredCat);

            Button btnAdd = new Button("+ Ajouter une Catégorie");
            btnAdd.getStyleClass().addAll("btn", "btn-success");
            tip(btnAdd, "Créer une nouvelle catégorie d’événements");
            btnAdd.setOnAction(e -> openCategoryForm(null));
            Button btnCsvAll = new Button("Exporter CSV");
            btnCsvAll.getStyleClass().addAll("btn", "btn-outline");
            tip(btnCsvAll, "Exporter toutes les catégories (fichier .csv)");
            btnCsvAll.setOnAction(e -> exportAllCsv("Exporter catégories CSV", "categories.csv", headers, categories.stream().map(this::categoryRow).toList()));

            HBox topCat = new HBox(12, btnAdd, btnCsvAll, searchCat);

            topCat.setAlignment(Pos.CENTER_LEFT);
            VBox wrapper = new VBox(12, topCat, table);
            VBox.setVgrow(table, Priority.ALWAYS);
            wrapper.setPadding(new Insets(16));

            contentArea.getChildren().setAll(wrapper);
        } catch (SQLException ex) {
            showError("Erreur chargement catégories", ex.getMessage());
        }
    }

    private void openCategoryForm(Category existing) {
        boolean isEdit = existing != null;
        Dialog<String> dialog = new Dialog<>();
        dialog.setTitle(isEdit ? "Modifier la catégorie" : "Nouvelle catégorie");
        dialog.setHeaderText(isEdit ? "Modifier le nom de la catégorie" : "Lettres uniquement (a–z, A–Z), sans espaces.");
        ButtonType saveBtn = new ButtonType("Enregistrer", ButtonBar.ButtonData.OK_DONE);
        dialog.getDialogPane().getButtonTypes().addAll(saveBtn, ButtonType.CANCEL);
        FormHelper.attachStylesheet(dialog.getDialogPane());

        TextField tfName = new TextField(isEdit ? existing.getName() : "");
        tfName.setPromptText("Ex. Conference, Atelier…");
        GridPane grid = new GridPane();
        grid.setHgap(12);
        grid.setVgap(12);
        grid.setPadding(new Insets(4, 0, 0, 0));
        grid.addRow(0, labelReq("Nom"), tfName);
        Label hint = new Label("Uniquement des lettres (pas de chiffres ni d’espaces).");
        hint.getStyleClass().add("form-hint");
        grid.add(hint, 0, 1, 2, 1);
        dialog.getDialogPane().setContent(FormHelper.wrapFormBody(grid));

        FormHelper.guardDialogSave(dialog, saveBtn, () -> FormHelper.validateCategoryLetters(tfName.getText().trim()));

        dialog.setResultConverter(btn -> {
            if (btn != saveBtn) {
                return null;
            }
            return tfName.getText().trim();
        });

        dialog.showAndWait().ifPresent(name -> {
            try {
                if (isEdit) {
                    existing.setName(name);
                    categoryService.update(existing);
                    notificationService.success("Catégorie mise à jour", "Modification enregistrée.");
                } else {
                    Category c = new Category();
                    c.setName(name);
                    categoryService.add(c);
                    notificationService.success("Catégorie ajoutée", "Nouvelle catégorie enregistrée.");
                }
                loadCategoriesTable();
            } catch (SQLException ex) {
                showError("Erreur sauvegarde", ex.getMessage());
            }
        });
    }

    private void deleteCategory(Category c) {
        Alert confirm = new Alert(Alert.AlertType.CONFIRMATION, "Supprimer « " + c.getName() + " » ?", ButtonType.YES, ButtonType.NO);
        confirm.showAndWait().filter(b -> b == ButtonType.YES).ifPresent(b -> {
            try {
                categoryService.delete(c.getId());
                loadCategoriesTable();
                notificationService.success("Catégorie supprimée", "Suppression effectuée.");
            }
            catch (SQLException ex) { showError("Erreur suppression", ex.getMessage()); }
        });
    }

    // ═══════════════════════════════════════════════════════════════
    //  USERS TABLE
    // ═══════════════════════════════════════════════════════════════
    private void loadUsersTable() {
        try {
            var users = userService.getAll();
            var headers = java.util.List.of("Email", "Nom", "Statut");
            TableView<User> table = new TableView<>();
            table.setColumnResizePolicy(TableView.CONSTRAINED_RESIZE_POLICY);
            table.getStyleClass().add("table-view");

            TableColumn<User, String> colEmail = new TableColumn<>("Email");
            colEmail.setCellValueFactory(cd -> new SimpleStringProperty(cd.getValue().getEmail()));
            TableColumn<User, String> colName = new TableColumn<>("Nom");
            colName.setCellValueFactory(cd -> new SimpleStringProperty(cd.getValue().getName()));
            TableColumn<User, String> colStatus = new TableColumn<>("Statut");
            colStatus.setCellValueFactory(cd -> new SimpleStringProperty(cd.getValue().getStatus()));

            TableColumn<User, Void> colActions = new TableColumn<>("Actions");
            colActions.setCellFactory(col -> new TableCell<>() {
                private final Button btnEdit = new Button("Modifier");
                private final Button btnDel = new Button("Supprimer");
                private final HBox box = new HBox(8, btnEdit, btnDel);
                {
                    btnEdit.getStyleClass().addAll("btn", "btn-primary");
                    btnDel.getStyleClass().addAll("btn", "btn-danger");
                    box.setAlignment(Pos.CENTER);
                    tip(btnEdit, "Modifier cet utilisateur (email, mot de passe, rôles…)");
                    tip(btnDel, "Supprimer cet utilisateur");
                    btnEdit.setOnAction(e -> openUserForm(getTableView().getItems().get(getIndex())));
                    btnDel.setOnAction(e -> deleteUser(getTableView().getItems().get(getIndex())));
                }
                @Override protected void updateItem(Void v, boolean empty) {
                    super.updateItem(v, empty);
                    setGraphic(empty ? null : box);
                }
            });

            table.getColumns().addAll(colEmail, colName, colStatus, colActions);
            ObservableList<User> masterUs = FXCollections.observableArrayList(users);
            FilteredList<User> filteredUs = new FilteredList<>(masterUs, u -> true);
            TextField searchUs = createAdminSearchField();
            bindLiveTableFilter(searchUs, filteredUs, u ->
                    String.join(" ", nz(u.getEmail()), nz(u.getName()), nz(u.getStatus())));
            table.setItems(filteredUs);

            Button btnAdd = new Button("+ Ajouter un utilisateur");
            btnAdd.getStyleClass().addAll("btn", "btn-success");
            tip(btnAdd, "Créer un nouveau compte utilisateur");
            btnAdd.setOnAction(e -> openUserForm(null));
            Button btnCsvAll = new Button("Exporter CSV");
            btnCsvAll.getStyleClass().addAll("btn", "btn-outline");
            tip(btnCsvAll, "Exporter la liste des utilisateurs (fichier .csv)");
            btnCsvAll.setOnAction(e -> exportAllCsv("Exporter utilisateurs CSV", "users.csv", headers, users.stream().map(this::userRow).toList()));

            HBox topUs = new HBox(12, btnAdd, btnCsvAll, searchUs);

            topUs.setAlignment(Pos.CENTER_LEFT);
            VBox wrapper = new VBox(12, topUs, table);
            VBox.setVgrow(table, Priority.ALWAYS);
            wrapper.setPadding(new Insets(16));
            contentArea.getChildren().setAll(wrapper);
        } catch (SQLException ex) {
            showError("Erreur chargement utilisateurs", ex.getMessage());
        }
    }

    private void openUserForm(User existing) {
        boolean isEdit = existing != null;
        Dialog<User> dialog = new Dialog<>();
        dialog.setTitle(isEdit ? "Modifier l'utilisateur" : "Nouvel utilisateur");
        dialog.setHeaderText("Contrôle des champs : email valide, nom (2 caractères min.), mot de passe (6 min. si nouveau).");
        ButtonType saveBtn = new ButtonType("Enregistrer", ButtonBar.ButtonData.OK_DONE);
        dialog.getDialogPane().getButtonTypes().addAll(saveBtn, ButtonType.CANCEL);
        FormHelper.attachStylesheet(dialog.getDialogPane());

        TextField tfEmail = new TextField(isEdit ? existing.getEmail() : "");
        tfEmail.setPromptText("exemple@domaine.com");
        TextField tfName = new TextField(isEdit ? existing.getName() : "");
        tfName.setPromptText("Nom affiché (min. 2 caractères)");
        PasswordField tfPass = new PasswordField();
        tfPass.setPromptText(isEdit ? "Laisser vide pour garder l’ancien mot de passe" : "Au moins 6 caractères");
        TextField tfNsc = new TextField(isEdit && existing.getNsc() != null ? String.valueOf(existing.getNsc()) : "");
        tfNsc.setPromptText("NSC (optionnel — non enregistré dans la BD actuelle)");
        ComboBox<String> cbStatus = new ComboBox<>(FXCollections.observableArrayList("active", "inactive", "pending"));
        cbStatus.setValue(isEdit ? existing.getStatus() : "active");
        TextField tfRoles = new TextField(isEdit && existing.getRoles() != null ? existing.getRoles() : "[\"ROLE_USER\"]");
        tfRoles.setPromptText("JSON, ex. [\"ROLE_USER\"]");

        GridPane grid = new GridPane();
        grid.setHgap(12);
        grid.setVgap(12);
        grid.setPadding(new Insets(4, 0, 0, 0));
        grid.addRow(0, labelReq("Email"), tfEmail);
        grid.addRow(1, labelReq("Nom"), tfName);
        grid.addRow(2, new Label("Mot de passe"), tfPass);
        grid.addRow(3, new Label("NSC (info)"), tfNsc);
        grid.addRow(4, labelReq("Statut"), cbStatus);
        grid.addRow(5, new Label("Rôles (JSON)"), tfRoles);
        Label hint = new Label("Le NSC n’est pas une colonne de votre table `user` : il n’est pas sauvegardé.");
        hint.getStyleClass().add("form-hint");
        grid.add(hint, 0, 6, 2, 1);
        dialog.getDialogPane().setContent(FormHelper.wrapFormBody(grid));

        FormHelper.guardDialogSave(dialog, saveBtn, () -> {
            String pwdErr = !isEdit ? FormHelper.validatePasswordNew(tfPass.getText())
                    : (!tfPass.getText().isBlank() ? FormHelper.validatePasswordNew(tfPass.getText()) : null);
            String err = FormHelper.joinErrors(
                    FormHelper.validateEmail(tfEmail.getText()),
                    FormHelper.validateMinLength(tfName.getText(), 2, "Le nom"),
                    FormHelper.validateJsonRoles(tfRoles.getText()),
                    pwdErr
            );
            if (err != null) {
                return err;
            }
            if (!isEdit && tfPass.getText().isBlank()) {
                return "Le mot de passe est obligatoire pour un nouvel utilisateur.";
            }
            if (!tfNsc.getText().isBlank()) {
                try {
                    Integer.parseInt(tfNsc.getText().trim());
                } catch (NumberFormatException ex) {
                    return "NSC invalide (nombre entier attendu).";
                }
            }
            return null;
        });

        dialog.setResultConverter(btn -> {
            if (btn != saveBtn) {
                return null;
            }
            User u = isEdit ? existing : new User();
            u.setEmail(tfEmail.getText().trim());
            u.setName(tfName.getText().trim());
            if (!tfPass.getText().isBlank()) {
                u.setPassword(tfPass.getText());
            } else if (isEdit) {
                u.setPassword(existing.getPassword());
            }
            if (tfNsc.getText().isBlank()) {
                u.setNsc(null);
            } else {
                u.setNsc(Integer.parseInt(tfNsc.getText().trim()));
            }
            u.setStatus(cbStatus.getValue());
            u.setRoles(tfRoles.getText().trim().isBlank() ? "[\"ROLE_USER\"]" : tfRoles.getText().trim());
            if (!isEdit) {
                u.setAvatar("01.png");
            }
            return u;
        });

        dialog.showAndWait().ifPresent(u -> {
            try {
                if (isEdit) {
                    userService.update(u);
                    notificationService.success("Utilisateur mis à jour", "Modification enregistrée.");
                } else {
                    userService.add(u);
                    notificationService.success("Utilisateur ajouté", "Nouvel utilisateur enregistré.");
                }
                loadUsersTable();
            } catch (SQLException ex) {
                showError("Erreur sauvegarde", ex.getMessage());
            }
        });
    }

    private void deleteUser(User u) {
        Alert confirm = new Alert(Alert.AlertType.CONFIRMATION, "Supprimer l'utilisateur « " + u.getEmail() + " » ?", ButtonType.YES, ButtonType.NO);
        confirm.showAndWait().filter(b -> b == ButtonType.YES).ifPresent(b -> {
            try {
                userService.delete(u.getId());
                loadUsersTable();
                notificationService.success("Utilisateur supprimé", "Suppression effectuée.");
            } catch (SQLException ex) {
                showError("Erreur suppression", ex.getMessage());
            }
        });
    }

    // ═══════════════════════════════════════════════════════════════
    //  PARTICIPATIONS TABLE
    // ═══════════════════════════════════════════════════════════════
    private void loadParticipationsTable() {
        try {
            var rows = participationService.getAllWithDetails();
            var headers = java.util.List.of("Utilisateur", "Evenement", "Inscription");
            TableView<Participation> table = new TableView<>();
            table.setColumnResizePolicy(TableView.CONSTRAINED_RESIZE_POLICY);
            table.getStyleClass().add("table-view");

            TableColumn<Participation, String> colUser = new TableColumn<>("Utilisateur");
            colUser.setCellValueFactory(cd -> {
                User us = cd.getValue().getUser();
                return new SimpleStringProperty(us != null ? us.getEmail() : String.valueOf(cd.getValue().getUserId()));
            });
            TableColumn<Participation, String> colEvent = new TableColumn<>("Événement");
            colEvent.setCellValueFactory(cd -> {
                Event ev = cd.getValue().getEvent();
                return new SimpleStringProperty(ev != null ? ev.getTitre() : String.valueOf(cd.getValue().getEventId()));
            });
            TableColumn<Participation, String> colDate = new TableColumn<>("Inscription");
            colDate.setCellValueFactory(cd -> new SimpleStringProperty(
                    cd.getValue().getDateInscription() != null ? cd.getValue().getDateInscription().format(DTF) : ""));

            TableColumn<Participation, Void> colActions = new TableColumn<>("Actions");
            colActions.setCellFactory(col -> new TableCell<>() {
                private final Button btnDel = new Button("Supprimer");
                {
                    btnDel.getStyleClass().addAll("btn", "btn-danger");
                    tip(btnDel, "Retirer cette inscription à l’événement");
                    btnDel.setOnAction(e -> deleteParticipation(getTableView().getItems().get(getIndex())));
                }
                @Override protected void updateItem(Void v, boolean empty) {
                    super.updateItem(v, empty);
                    setGraphic(empty ? null : btnDel);
                }
            });

            table.getColumns().addAll(colUser, colEvent, colDate, colActions);
            ObservableList<Participation> masterPart = FXCollections.observableArrayList(rows);
            FilteredList<Participation> filteredPart = new FilteredList<>(masterPart, p -> true);
            TextField searchPart = createAdminSearchField();
            bindLiveTableFilter(searchPart, filteredPart, p -> {
                User us = p.getUser();
                Event ev = p.getEvent();
                String u = us != null ? us.getEmail() : String.valueOf(p.getUserId());
                String evs = ev != null ? ev.getTitre() : String.valueOf(p.getEventId());
                String dt = p.getDateInscription() != null ? p.getDateInscription().format(DTF) : "";
                return String.join(" ", u, evs, dt);
            });
            table.setItems(filteredPart);

            Button btnAdd = new Button("+ Ajouter une participation");
            btnAdd.getStyleClass().addAll("btn", "btn-success");
            tip(btnAdd, "Inscrire un utilisateur à un événement (manuellement)");
            btnAdd.setOnAction(e -> openParticipationForm());
            Button btnCsvAll = new Button("Exporter CSV");
            btnCsvAll.getStyleClass().addAll("btn", "btn-outline");
            tip(btnCsvAll, "Exporter toutes les participations (fichier .csv)");
            btnCsvAll.setOnAction(e -> exportAllCsv("Exporter participations CSV", "participations.csv", headers, rows.stream().map(this::participationRow).toList()));

            HBox topPart = new HBox(12, btnAdd, btnCsvAll, searchPart);

            topPart.setAlignment(Pos.CENTER_LEFT);
            VBox wrapper = new VBox(12, topPart, table);
            VBox.setVgrow(table, Priority.ALWAYS);
            wrapper.setPadding(new Insets(16));
            contentArea.getChildren().setAll(wrapper);
        } catch (SQLException ex) {
            showError("Erreur chargement participations", ex.getMessage());
        }
    }

    private void openParticipationForm() {
        Dialog<Participation> dialog = new Dialog<>();
        dialog.setTitle("Nouvelle participation");
        dialog.setHeaderText("Utilisateur, événement et date d’inscription (calendrier + heure).");
        ButtonType saveBtn = new ButtonType("Enregistrer", ButtonBar.ButtonData.OK_DONE);
        dialog.getDialogPane().getButtonTypes().addAll(saveBtn, ButtonType.CANCEL);
        FormHelper.attachStylesheet(dialog.getDialogPane());

        ComboBox<User> cbUser = new ComboBox<>();
        ComboBox<Event> cbEvent = new ComboBox<>();
        DatePicker dpInsc = new DatePicker(LocalDate.now());
        Spinner<Integer> hInsc = FormHelper.createHourSpinner(LocalDateTime.now().getHour());
        Spinner<Integer> mInsc = FormHelper.createMinuteSpinner(LocalDateTime.now().getMinute());
        try {
            cbUser.setItems(FXCollections.observableArrayList(userService.getAll()));
            cbEvent.setItems(FXCollections.observableArrayList(eventService.getAll()));
        } catch (SQLException ignored) {
        }

        GridPane grid = new GridPane();
        grid.setHgap(12);
        grid.setVgap(12);
        grid.setPadding(new Insets(4, 0, 0, 0));
        grid.addRow(0, labelReq("Utilisateur"), cbUser);
        grid.addRow(1, labelReq("Événement"), cbEvent);
        HBox rowDt = FormHelper.dateTimeRow("Inscription *", dpInsc, hInsc, mInsc);
        grid.add(rowDt, 0, 2);
        GridPane.setColumnSpan(rowDt, 2);
        dialog.getDialogPane().setContent(FormHelper.wrapFormBody(grid));

        dialog.setResultConverter(btn -> {
            if (btn != saveBtn) {
                return null;
            }
            if (cbUser.getValue() == null || cbEvent.getValue() == null) {
                showError("Validation", "Choisissez un utilisateur et un événement.");
                return null;
            }
            LocalDateTime dtInsc;
            try {
                dtInsc = FormHelper.requireDateTime(dpInsc, hInsc, mInsc, "Date d’inscription");
            } catch (IllegalArgumentException ex) {
                showError("Validation", ex.getMessage());
                return null;
            }
            Participation p = new Participation();
            p.setUserId(cbUser.getValue().getId());
            p.setEventId(cbEvent.getValue().getId());
            p.setDateInscription(dtInsc);
            return p;
        });

        dialog.showAndWait().ifPresent(p -> {
            try {
                if (participationService.userHasJoined(p.getUserId(), p.getEventId())) {
                    showError("Conflit", "Cet utilisateur participe déjà à cet événement.");
                    return;
                }
                Event ev = eventService.getById(p.getEventId());
                int count = participationService.countByEvent(p.getEventId());
                if (ev != null && count >= ev.getNombreMaxParticipants()) {
                    showError("Complet", "Le nombre maximal de participants est atteint.");
                    return;
                }
                participationService.add(p);
                loadParticipationsTable();
                notificationService.success("Participation ajoutée", "Participation enregistrée.");
            } catch (SQLException ex) {
                showError("Erreur sauvegarde", ex.getMessage());
            }
        });
    }

    private void deleteParticipation(Participation p) {
        Alert confirm = new Alert(Alert.AlertType.CONFIRMATION, "Supprimer cette participation ?", ButtonType.YES, ButtonType.NO);
        confirm.showAndWait().filter(b -> b == ButtonType.YES).ifPresent(b -> {
            try {
                participationService.delete(p.getId());
                loadParticipationsTable();
                notificationService.success("Participation supprimée", "Suppression effectuée.");
            } catch (SQLException ex) {
                showError("Erreur suppression", ex.getMessage());
            }
        });
    }

    // ═══════════════════════════════════════════════════════════════
    //  RATINGS TABLE
    // ═══════════════════════════════════════════════════════════════
    private void loadRatingsTable() {
        try {
            var rows = ratingService.getAllWithDetails();
            var headers = java.util.List.of("Utilisateur", "Evenement", "Note", "Commentaire", "Date");
            TableView<Rating> table = new TableView<>();
            table.setColumnResizePolicy(TableView.CONSTRAINED_RESIZE_POLICY);
            table.getStyleClass().add("table-view");

            TableColumn<Rating, String> colUser = new TableColumn<>("Utilisateur");
            colUser.setCellValueFactory(cd -> {
                User us = cd.getValue().getUser();
                return new SimpleStringProperty(us != null ? us.getEmail() : String.valueOf(cd.getValue().getUserId()));
            });
            TableColumn<Rating, String> colEvent = new TableColumn<>("Événement");
            colEvent.setCellValueFactory(cd -> {
                Event ev = cd.getValue().getEvent();
                return new SimpleStringProperty(ev != null ? ev.getTitre() : String.valueOf(cd.getValue().getEventId()));
            });
            TableColumn<Rating, Integer> colNote = new TableColumn<>("Note");
            colNote.setCellValueFactory(cd -> new SimpleIntegerProperty(cd.getValue().getNote()).asObject());
            TableColumn<Rating, String> colCom = new TableColumn<>("Commentaire");
            colCom.setCellValueFactory(cd -> new SimpleStringProperty(
                    cd.getValue().getCommentaire() != null ? cd.getValue().getCommentaire() : ""));
            TableColumn<Rating, String> colDate = new TableColumn<>("Date");
            colDate.setCellValueFactory(cd -> new SimpleStringProperty(
                    cd.getValue().getDateCreation() != null ? cd.getValue().getDateCreation().format(DTF) : ""));

            TableColumn<Rating, Void> colActions = new TableColumn<>("Actions");
            colActions.setCellFactory(col -> new TableCell<>() {
                private final Button btnEdit = new Button("Modifier");
                private final Button btnDel = new Button("Supprimer");
                private final HBox box = new HBox(8, btnEdit, btnDel);
                {
                    btnEdit.getStyleClass().addAll("btn", "btn-primary");
                    btnDel.getStyleClass().addAll("btn", "btn-danger");
                    box.setAlignment(Pos.CENTER);
                    tip(btnEdit, "Modifier la note ou le commentaire de cet avis");
                    tip(btnDel, "Supprimer cet avis");
                    btnEdit.setOnAction(e -> openRatingForm(getTableView().getItems().get(getIndex())));
                    btnDel.setOnAction(e -> deleteRating(getTableView().getItems().get(getIndex())));
                }
                @Override protected void updateItem(Void v, boolean empty) {
                    super.updateItem(v, empty);
                    setGraphic(empty ? null : box);
                }
            });

            table.getColumns().addAll(colUser, colEvent, colNote, colCom, colDate, colActions);
            ObservableList<Rating> masterRat = FXCollections.observableArrayList(rows);
            FilteredList<Rating> filteredRat = new FilteredList<>(masterRat, r -> true);
            TextField searchRat = createAdminSearchField();
            bindLiveTableFilter(searchRat, filteredRat, r -> {
                User us = r.getUser();
                Event ev = r.getEvent();
                String u = us != null ? us.getEmail() : String.valueOf(r.getUserId());
                String evs = ev != null ? ev.getTitre() : String.valueOf(r.getEventId());
                String com = r.getCommentaire() != null ? r.getCommentaire() : "";
                String dt = r.getDateCreation() != null ? r.getDateCreation().format(DTF) : "";
                return String.join(" ", u, evs, String.valueOf(r.getNote()), com, dt);
            });
            table.setItems(filteredRat);

            Button btnAdd = new Button("+ Ajouter un avis");
            btnAdd.getStyleClass().addAll("btn", "btn-success");
            tip(btnAdd, "Ajouter un avis (note) pour un utilisateur et un événement");
            btnAdd.setOnAction(e -> openRatingForm(null));
            Button btnCsvAll = new Button("Exporter CSV");
            btnCsvAll.getStyleClass().addAll("btn", "btn-outline");
            tip(btnCsvAll, "Exporter tous les avis (fichier .csv)");
            btnCsvAll.setOnAction(e -> exportAllCsv("Exporter avis CSV", "ratings.csv", headers, rows.stream().map(this::ratingRow).toList()));

            HBox topRat = new HBox(12, btnAdd, btnCsvAll, searchRat);

            topRat.setAlignment(Pos.CENTER_LEFT);
            VBox wrapper = new VBox(12, topRat, table);
            VBox.setVgrow(table, Priority.ALWAYS);
            wrapper.setPadding(new Insets(16));
            contentArea.getChildren().setAll(wrapper);
        } catch (SQLException ex) {
            showError("Erreur chargement avis", ex.getMessage());
        }
    }

    private void openRatingForm(Rating existing) {
        boolean isEdit = existing != null;
        Dialog<Rating> dialog = new Dialog<>();
        dialog.setTitle(isEdit ? "Modifier l'avis" : "Nouvel avis");
        dialog.setHeaderText(isEdit ? "Modifier la note et le commentaire." : "Note obligatoire ; la date d’enregistrement est mise automatiquement.");
        ButtonType saveBtn = new ButtonType("Enregistrer", ButtonBar.ButtonData.OK_DONE);
        dialog.getDialogPane().getButtonTypes().addAll(saveBtn, ButtonType.CANCEL);
        FormHelper.attachStylesheet(dialog.getDialogPane());

        ComboBox<User> cbUser = new ComboBox<>();
        ComboBox<Event> cbEvent = new ComboBox<>();
        ComboBox<Integer> cbNote = new ComboBox<>(FXCollections.observableArrayList(1, 2, 3, 4, 5));
        cbNote.setValue(5);
        TextField tfCom = new TextField();
        tfCom.setPromptText("Optionnel (max. 500 caractères)");

        try {
            cbUser.setItems(FXCollections.observableArrayList(userService.getAll()));
            cbEvent.setItems(FXCollections.observableArrayList(eventService.getAll()));
        } catch (SQLException ignored) {
        }

        GridPane grid = new GridPane();
        grid.setHgap(12);
        grid.setVgap(12);
        grid.setPadding(new Insets(4, 0, 0, 0));
        if (isEdit) {
            cbNote.setValue(existing.getNote());
            tfCom.setText(existing.getCommentaire() != null ? existing.getCommentaire() : "");
            grid.addRow(0, labelReq("Note (1–5)"), cbNote);
            grid.addRow(1, new Label("Commentaire"), tfCom);
        } else {
            grid.addRow(0, labelReq("Utilisateur"), cbUser);
            grid.addRow(1, labelReq("Événement"), cbEvent);
            grid.addRow(2, labelReq("Note (1–5)"), cbNote);
            grid.addRow(3, new Label("Commentaire"), tfCom);
        }
        dialog.getDialogPane().setContent(FormHelper.wrapFormBody(grid));

        FormHelper.guardDialogSave(dialog, saveBtn, () -> {
            if (!isEdit && (cbUser.getValue() == null || cbEvent.getValue() == null)) {
                return "Choisissez un utilisateur et un événement.";
            }
            Integer noteVal = cbNote.getValue();
            if (noteVal == null) {
                return "Choisissez une note.";
            }
            return FormHelper.joinErrors(
                    FormHelper.validateNote(noteVal),
                    FormHelper.validateCommentMax(tfCom.getText(), 500)
            );
        });

        dialog.setResultConverter(btn -> {
            if (btn != saveBtn) {
                return null;
            }
            Rating r = isEdit ? existing : new Rating();
            if (!isEdit) {
                r.setUserId(cbUser.getValue().getId());
                r.setEventId(cbEvent.getValue().getId());
                r.setDateCreation(LocalDateTime.now());
            }
            r.setNote(cbNote.getValue());
            r.setCommentaire(tfCom.getText().isBlank() ? null : tfCom.getText().trim());
            return r;
        });

        dialog.showAndWait().ifPresent(r -> {
            try {
                if (!isEdit) {
                    if (ratingService.userHasRated(r.getUserId(), r.getEventId())) {
                        showError("Conflit", "Cet utilisateur a déjà noté cet événement.");
                        return;
                    }
                    ratingService.add(r);
                    notificationService.success("Avis ajouté", "Avis enregistré.");
                } else {
                    ratingService.update(r);
                    notificationService.success("Avis mis à jour", "Modification enregistrée.");
                }
                loadRatingsTable();
            } catch (SQLException ex) {
                showError("Erreur sauvegarde", ex.getMessage());
            }
        });
    }

    private void deleteRating(Rating r) {
        Alert confirm = new Alert(Alert.AlertType.CONFIRMATION, "Supprimer cet avis ?", ButtonType.YES, ButtonType.NO);
        confirm.showAndWait().filter(b -> b == ButtonType.YES).ifPresent(b -> {
            try {
                ratingService.delete(r.getId());
                loadRatingsTable();
                notificationService.success("Avis supprimé", "Suppression effectuée.");
            } catch (SQLException ex) {
                showError("Erreur suppression", ex.getMessage());
            }
        });
    }

    // ═══════════════════════════════════════════════════════════════
    //  CERTIFICATS TABLE
    // ═══════════════════════════════════════════════════════════════
    private void loadCertificatsTable() {
        try {
            var rows = certificatService.getAllWithDetails();
            var headers = java.util.List.of("Utilisateur", "Evenement", "Code", "Obtention");
            TableView<Certificat> table = new TableView<>();
            table.setColumnResizePolicy(TableView.CONSTRAINED_RESIZE_POLICY);
            table.getStyleClass().add("table-view");

            TableColumn<Certificat, String> colUser = new TableColumn<>("Utilisateur");
            colUser.setCellValueFactory(cd -> {
                User us = cd.getValue().getUser();
                return new SimpleStringProperty(us != null ? us.getEmail() : String.valueOf(cd.getValue().getUserId()));
            });
            TableColumn<Certificat, String> colEvent = new TableColumn<>("Événement");
            colEvent.setCellValueFactory(cd -> {
                Event ev = cd.getValue().getEvent();
                return new SimpleStringProperty(ev != null ? ev.getTitre() : String.valueOf(cd.getValue().getEventId()));
            });
            TableColumn<Certificat, String> colCode = new TableColumn<>("Code");
            colCode.setCellValueFactory(cd -> new SimpleStringProperty(cd.getValue().getCodeUnique()));
            TableColumn<Certificat, String> colDate = new TableColumn<>("Obtention");
            colDate.setCellValueFactory(cd -> new SimpleStringProperty(
                    cd.getValue().getDateObtention() != null ? cd.getValue().getDateObtention().format(DTF) : ""));

            TableColumn<Certificat, Void> colActions = new TableColumn<>("Actions");
            colActions.setCellFactory(col -> new TableCell<>() {
                private final Button btnDel = new Button("Supprimer");
                private final Button btnPdfCert = new Button("Certif PDF");
                private final Button btnQr = new Button("QR PNG");
                {
                    btnDel.getStyleClass().addAll("btn", "btn-danger");
                    btnPdfCert.getStyleClass().addAll("btn", "btn-primary");
                    btnQr.getStyleClass().addAll("btn", "btn-outline");
                    tip(btnPdfCert, "Générer un PDF du certificat (sans QR)");
                    tip(btnQr, "Exporter le code certificat en image QR (PNG), indépendant du PDF");
                    tip(btnDel, "Supprimer ce certificat de la base");
                    btnDel.setOnAction(e -> deleteCertificat(getTableView().getItems().get(getIndex())));
                    btnPdfCert.setOnAction(e -> generateCertificatePdf(getTableView().getItems().get(getIndex())));
                    btnQr.setOnAction(e -> exportCertificateQrPng(getTableView().getItems().get(getIndex())));
                }
                @Override protected void updateItem(Void v, boolean empty) {
                    super.updateItem(v, empty);
                    setGraphic(empty ? null : new HBox(8, btnPdfCert, btnQr, btnDel));
                }
            });

            table.getColumns().addAll(colUser, colEvent, colCode, colDate, colActions);
            ObservableList<Certificat> masterCert = FXCollections.observableArrayList(rows);
            FilteredList<Certificat> filteredCert = new FilteredList<>(masterCert, c -> true);
            TextField searchCert = createAdminSearchField();
            bindLiveTableFilter(searchCert, filteredCert, c -> {
                User us = c.getUser();
                Event ev = c.getEvent();
                String u = us != null ? us.getEmail() : String.valueOf(c.getUserId());
                String evs = ev != null ? ev.getTitre() : String.valueOf(c.getEventId());
                String dt = c.getDateObtention() != null ? c.getDateObtention().format(DTF) : "";
                return String.join(" ", u, evs, nz(c.getCodeUnique()), dt);
            });
            table.setItems(filteredCert);

            Button btnAdd = new Button("+ Ajouter un certificat");
            btnAdd.getStyleClass().addAll("btn", "btn-success");
            tip(btnAdd, "Attribuer un certificat à un utilisateur pour un événement (code généré automatiquement)");
            btnAdd.setOnAction(e -> openCertificatForm());
            Button btnCsvAll = new Button("Exporter CSV");
            btnCsvAll.getStyleClass().addAll("btn", "btn-outline");
            tip(btnCsvAll, "Exporter la liste des certificats (fichier .csv)");
            btnCsvAll.setOnAction(e -> exportAllCsv("Exporter certificats CSV", "certificats.csv", headers, rows.stream().map(this::certificatRow).toList()));

            HBox topCert = new HBox(12, btnAdd, btnCsvAll, searchCert);

            topCert.setAlignment(Pos.CENTER_LEFT);
            VBox wrapper = new VBox(12, topCert, table);
            VBox.setVgrow(table, Priority.ALWAYS);
            wrapper.setPadding(new Insets(16));
            contentArea.getChildren().setAll(wrapper);
        } catch (SQLException ex) {
            showError("Erreur chargement certificats", ex.getMessage());
        }
    }

    private void openCertificatForm() {
        Dialog<Certificat> dialog = new Dialog<>();
        dialog.setTitle("Nouveau certificat");
        dialog.setHeaderText("Si vous ne choisissez pas de date, la date d’obtention sera la date et l’heure actuelles.");
        ButtonType saveBtn = new ButtonType("Enregistrer", ButtonBar.ButtonData.OK_DONE);
        dialog.getDialogPane().getButtonTypes().addAll(saveBtn, ButtonType.CANCEL);
        FormHelper.attachStylesheet(dialog.getDialogPane());

        ComboBox<User> cbUser = new ComboBox<>();
        ComboBox<Event> cbEvent = new ComboBox<>();
        DatePicker dpOb = new DatePicker();
        Spinner<Integer> hOb = FormHelper.createHourSpinner(LocalDateTime.now().getHour());
        Spinner<Integer> mOb = FormHelper.createMinuteSpinner(LocalDateTime.now().getMinute());
        CheckBox chkUseDate = new CheckBox("Définir une date d’obtention précise (calendrier)");
        chkUseDate.setSelected(false);
        dpOb.setDisable(true);
        hOb.setDisable(true);
        mOb.setDisable(true);
        chkUseDate.selectedProperty().addListener((obs, o, n) -> {
            dpOb.setDisable(!n);
            hOb.setDisable(!n);
            mOb.setDisable(!n);
        });
        try {
            cbUser.setItems(FXCollections.observableArrayList(userService.getAll()));
            cbEvent.setItems(FXCollections.observableArrayList(eventService.getAll()));
        } catch (SQLException ignored) {
        }

        GridPane grid = new GridPane();
        grid.setHgap(12);
        grid.setVgap(12);
        grid.setPadding(new Insets(4, 0, 0, 0));
        grid.addRow(0, labelReq("Utilisateur"), cbUser);
        grid.addRow(1, labelReq("Événement"), cbEvent);
        grid.add(chkUseDate, 0, 2, 2, 1);
        HBox rowOb = FormHelper.dateTimeRow("Obtention", dpOb, hOb, mOb);
        grid.add(rowOb, 0, 3);
        GridPane.setColumnSpan(rowOb, 2);
        dialog.getDialogPane().setContent(FormHelper.wrapFormBody(grid));

        FormHelper.guardDialogSave(dialog, saveBtn, () -> {
            if (cbUser.getValue() == null || cbEvent.getValue() == null) {
                return "Choisissez un utilisateur et un événement.";
            }
            if (chkUseDate.isSelected()) {
                try {
                    FormHelper.requireDateTime(dpOb, hOb, mOb, "Date d’obtention");
                } catch (IllegalArgumentException ex) {
                    return ex.getMessage();
                }
            }
            return null;
        });

        dialog.setResultConverter(btn -> {
            if (btn != saveBtn) {
                return null;
            }
            Certificat c = new Certificat();
            c.setUserId(cbUser.getValue().getId());
            c.setEventId(cbEvent.getValue().getId());
            if (!chkUseDate.isSelected()) {
                c.setDateObtention(LocalDateTime.now());
            } else {
                c.setDateObtention(FormHelper.requireDateTime(dpOb, hOb, mOb, "Date d’obtention"));
            }
            return c;
        });

        dialog.showAndWait().ifPresent(c -> {
            try {
                certificatService.add(c);
                loadCertificatsTable();
                notificationService.success("Certificat ajouté", "Certificat enregistré.");
            } catch (SQLException ex) {
                showError("Erreur sauvegarde", ex.getMessage());
            }
        });
    }

    private void deleteCertificat(Certificat c) {
        Alert confirm = new Alert(Alert.AlertType.CONFIRMATION, "Supprimer le certificat « " + c.getCodeUnique() + " » ?", ButtonType.YES, ButtonType.NO);
        confirm.showAndWait().filter(b -> b == ButtonType.YES).ifPresent(b -> {
            try {
                certificatService.delete(c.getId());
                loadCertificatsTable();
                notificationService.success("Certificat supprimé", "Le certificat a été supprimé avec succès.");
            } catch (SQLException ex) {
                showError("Erreur suppression", ex.getMessage());
            }
        });
    }

    private Path chooseSavePath(String title, String filename, FileChooser.ExtensionFilter filter) {
        FileChooser chooser = new FileChooser();
        chooser.setTitle(title);
        chooser.setInitialFileName(filename);
        chooser.getExtensionFilters().add(filter);
        Window window = contentArea.getScene() != null ? contentArea.getScene().getWindow() : null;
        var file = chooser.showSaveDialog(window);
        return file == null ? null : file.toPath();
    }

    private void exportAllCsv(String title, String fileName, java.util.List<String> headers, java.util.List<java.util.List<String>> rows) {
        try {
            Path path = chooseSavePath(title, fileName, new FileChooser.ExtensionFilter("CSV (*.csv)", "*.csv"));
            if (path == null) return;
            csvExportService.export(path, headers, rows);
            notificationService.success("Export CSV", "Fichier exporté: " + path.getFileName());
        } catch (IOException ex) {
            notificationService.error("Export CSV échoué", ex.getMessage());
        }
    }



    private java.util.List<String> eventRow(Event ev) {
        return java.util.List.of(
                nz(ev.getTitre()),
                ev.getCategory() != null ? nz(ev.getCategory().getName()) : "",
                ev.getDateDebut() != null ? ev.getDateDebut().format(DTF) : "",
                ev.getDateFin() != null ? ev.getDateFin().format(DTF) : "",
                nz(ev.getLieu()),
                String.valueOf(ev.getDuree()),
                String.valueOf(ev.getNombreMaxParticipants())
        );
    }

    private java.util.List<String> categoryRow(Category c) {
        int count = 0;
        try { count = categoryService.countEvents(c.getId()); } catch (SQLException ignored) {}
        return java.util.List.of(nz(c.getName()), String.valueOf(count));
    }

    private java.util.List<String> userRow(User u) {
        return java.util.List.of(nz(u.getEmail()), nz(u.getName()), nz(u.getStatus()));
    }

    private java.util.List<String> participationRow(Participation p) {
        String user = p.getUser() != null ? nz(p.getUser().getEmail()) : String.valueOf(p.getUserId());
        String event = p.getEvent() != null ? nz(p.getEvent().getTitre()) : String.valueOf(p.getEventId());
        String date = p.getDateInscription() != null ? p.getDateInscription().format(DTF) : "";
        return java.util.List.of(user, event, date);
    }

    private java.util.List<String> ratingRow(Rating r) {
        String user = r.getUser() != null ? nz(r.getUser().getEmail()) : String.valueOf(r.getUserId());
        String event = r.getEvent() != null ? nz(r.getEvent().getTitre()) : String.valueOf(r.getEventId());
        String date = r.getDateCreation() != null ? r.getDateCreation().format(DTF) : "";
        return java.util.List.of(user, event, String.valueOf(r.getNote()), nz(r.getCommentaire()), date);
    }

    private java.util.List<String> certificatRow(Certificat c) {
        String user = c.getUser() != null ? nz(c.getUser().getEmail()) : String.valueOf(c.getUserId());
        String event = c.getEvent() != null ? nz(c.getEvent().getTitre()) : String.valueOf(c.getEventId());
        String date = c.getDateObtention() != null ? c.getDateObtention().format(DTF) : "";
        return java.util.List.of(user, event, nz(c.getCodeUnique()), date);
    }

    /** PDF certificat uniquement (sans QR, sans serveur, sans URL). */
    private void generateCertificatePdf(Certificat c) {
        try {
            String userName = "Utilisateur " + c.getUserId();
            String eventTitle = "Evenement " + c.getEventId();
            try {
                User u = userService.getById(c.getUserId());
                if (u != null && u.getName() != null && !u.getName().isBlank()) userName = u.getName();
                Event e = eventService.getById(c.getEventId());
                if (e != null && e.getTitre() != null && !e.getTitre().isBlank()) eventTitle = e.getTitre();
            } catch (SQLException ignored) {}

            byte[] signature = showSignaturePad();
            if (signature == null) return;

            Path path = chooseSavePath(
                    "Exporter certificat PDF",
                    "certificat-" + c.getCodeUnique() + ".pdf",
                    new FileChooser.ExtensionFilter("PDF (*.pdf)", "*.pdf")
            );
            if (path == null) return;

            pdfExportService.exportCertificate(path, c, userName, eventTitle, null, null, signature);
            notificationService.success("Certificat", "PDF enregistré avec votre signature.");
        } catch (Exception ex) {
            notificationService.error("Certificat", ex.getMessage());
        }
    }

    private byte[] showSignaturePad() {
        Dialog<byte[]> dialog = new Dialog<>();
        dialog.setTitle("Signature Officielle");
        dialog.setHeaderText("Signez ci-dessous à l'aide de votre souris :");

        ButtonType confirmBtn = new ButtonType("Valider Signature", ButtonBar.ButtonData.OK_DONE);
        dialog.getDialogPane().getButtonTypes().addAll(confirmBtn, ButtonType.CANCEL);

        Canvas canvas = new Canvas(400, 200);
        GraphicsContext gc = canvas.getGraphicsContext2D();
        gc.setStroke(javafx.scene.paint.Color.BLACK);
        gc.setLineWidth(3);

        canvas.setOnMousePressed(e -> {
            gc.beginPath();
            gc.moveTo(e.getX(), e.getY());
            gc.stroke();
        });
        canvas.setOnMouseDragged(e -> {
            gc.lineTo(e.getX(), e.getY());
            gc.stroke();
        });

        VBox box = new VBox(10, canvas);
        box.setStyle("-fx-border-color: #6366f1; -fx-border-width: 2; -fx-background-color: white; -fx-padding: 1;");
        dialog.getDialogPane().setContent(box);

        dialog.setResultConverter(btn -> {
            if (btn != confirmBtn) return null;
            try {
                WritableImage wi = new WritableImage(400, 200);
                canvas.snapshot(null, wi);
                BufferedImage bi = SwingFXUtils.fromFXImage(wi, null);
                java.io.ByteArrayOutputStream baos = new java.io.ByteArrayOutputStream();
                javax.imageio.ImageIO.write(bi, "png", baos);
                return baos.toByteArray();
            } catch (Exception ex) { return null; }
        });

        return dialog.showAndWait().orElse(null);
    }


    /** QR séparé : contient uniquement le code certificat (pas d’URL ni de serveur). */
    private void exportCertificateQrPng(Certificat c) {
        try {
            String code = c.getCodeUnique() != null && !c.getCodeUnique().isBlank()
                    ? c.getCodeUnique()
                    : "CERT-" + c.getId();
            Path path = chooseSavePath(
                    "Exporter QR (code seul)",
                    "qr-" + code.replace(':', '-').replace(' ', '_') + ".png",
                    new FileChooser.ExtensionFilter("PNG (*.png)", "*.png")
            );
            if (path == null) return;
            byte[] bytes = qrCodeService.generatePngBytes(code, 300);
            Files.write(path, bytes);
            notificationService.success("QR", "Image enregistrée.");
        } catch (Exception ex) {
            notificationService.error("QR", ex.getMessage());
        }
    }


    // ═══════════════════════════════════════════════════════════════
    //  STATISTICS PAGE
    // ═══════════════════════════════════════════════════════════════
    private void loadStatsPage() {
        try {
            var events = eventService.getAll();
            var categories = categoryService.getAll();
            var participations = participationService.getAll();
            var certs = certificatService.getAll();

            GridPane grid = new GridPane();
            grid.setHgap(24);
            grid.setVgap(24);
            grid.setPadding(new Insets(24));

            ColumnConstraints col1 = new ColumnConstraints();
            col1.setPercentWidth(50);
            ColumnConstraints col2 = new ColumnConstraints();
            col2.setPercentWidth(50);
            grid.getColumnConstraints().addAll(col1, col2);

            // PIE: Events per Category
            PieChart pieChart = new PieChart();
            pieChart.setTitle("Événements par Catégorie");
            for (var cat : categories) {
                long count = events.stream().filter(e -> e.getCategoryId() == cat.getId()).count();
                if (count > 0) {
                    pieChart.getData().add(new PieChart.Data(cat.getName(), count));
                }
            }
            grid.add(wrapChart(pieChart), 0, 0);

            // BAR: Top 5 Events by Participants
            CategoryAxis xAxis = new CategoryAxis();
            NumberAxis yAxis = new NumberAxis();
            BarChart<String, Number> barChart = new BarChart<>(xAxis, yAxis);
            barChart.setTitle("Top 5 Événements (Participants)");
            XYChart.Series<String, Number> series = new XYChart.Series<>();
            series.setName("Participants");
            events.stream()
                .sorted((e1, e2) -> Long.compare(
                    participations.stream().filter(p -> p.getEventId() == e2.getId()).count(),
                    participations.stream().filter(p -> p.getEventId() == e1.getId()).count()
                ))
                .limit(5)
                .forEach(e -> {
                    long count = participations.stream().filter(p -> p.getEventId() == e.getId()).count();
                    series.getData().add(new XYChart.Data<>(e.getTitre(), count));
                });
            barChart.getData().add(series);
            grid.add(wrapChart(barChart), 1, 0);

            // LINE: Certificate Trends
            CategoryAxis lxAxis = new CategoryAxis();
            NumberAxis lyAxis = new NumberAxis();
            LineChart<String, Number> lineChart = new LineChart<>(lxAxis, lyAxis);
            lineChart.setTitle("Tendance des Certificats (Derniers 7 Jours)");
            XYChart.Series<String, Number> lseries = new XYChart.Series<>();
            lseries.setName("Certificats");
            LocalDate today = LocalDate.now();
            for (int i = 6; i >= 0; i--) {
                LocalDate d = today.minusDays(i);
                String label = d.format(DateTimeFormatter.ofPattern("dd/MM"));
                long count = certs.stream().filter(c -> c.getDateObtention() != null && c.getDateObtention().toLocalDate().equals(d)).count();
                lseries.getData().add(new XYChart.Data<>(label, count));
            }
            lineChart.getData().add(lseries);
            grid.add(wrapChart(lineChart), 0, 1, 2, 1);

            ScrollPane scroll = new ScrollPane(grid);
            scroll.setFitToWidth(true);
            scroll.setStyle("-fx-background-color: transparent; -fx-background: transparent;");
            contentArea.getChildren().setAll(scroll);

        } catch (SQLException ex) {
            showError("Erreur Stats", ex.getMessage());
        }
    }

    private VBox wrapChart(Chart chart) {
        VBox box = new VBox(chart);
        box.setStyle("-fx-background-color: white; -fx-background-radius: 12; -fx-effect: dropshadow(gaussian, rgba(0,0,0,0.1), 10, 0, 0, 4);");
        box.setPadding(new Insets(16));
        VBox.setVgrow(chart, Priority.ALWAYS);
        return box;
    }

    private void showError(String title, String msg) {

        Alert alert = new Alert(Alert.AlertType.ERROR);
        alert.setTitle(title);
        alert.setContentText(msg);
        alert.showAndWait();
    }
}
