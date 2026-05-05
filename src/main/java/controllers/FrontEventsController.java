package controllers;

import app.MainFx;
import models.Certificat;
import models.Event;
import models.Participation;
import models.Rating;
import services.CertificatService;
import services.EventService;
import services.ICertificatService;
import services.IEventService;
import services.IParticipationService;
import services.IRatingService;
import services.ParticipationService;
import services.RatingService;
import utils.BadWordService;
import utils.FormHelper;
import utils.SessionManager;
import utils.GeminiService;
import utils.LocalServerService;
import utils.NotificationStyling;
import utils.QrCodeService;
import utils.VoiceSearchService;
import org.controlsfx.control.Notifications;


import java.net.URLEncoder;

import java.nio.charset.StandardCharsets;
import java.awt.Desktop;
import java.net.URI;

import javafx.animation.ScaleTransition;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.ScrollPane;
import javafx.scene.control.TextField;
import javafx.scene.control.Dialog;
import javafx.scene.control.ButtonType;
import javafx.scene.control.ButtonBar;
import javafx.scene.control.TextArea;

import javafx.scene.layout.FlowPane;
import javafx.scene.layout.GridPane;
import javafx.scene.layout.HBox;

import javafx.scene.layout.Priority;
import javafx.scene.layout.StackPane;
import javafx.scene.layout.VBox;

import javafx.scene.web.WebView;
import javafx.scene.image.ImageView;
import javafx.embed.swing.SwingFXUtils;
import java.awt.image.BufferedImage;

import javafx.util.Duration;

import java.net.URL;
import java.sql.SQLException;
import java.time.format.DateTimeFormatter;
import java.util.List;
import java.util.ResourceBundle;

public class FrontEventsController implements Initializable {

    @FXML private FlowPane eventsContainer;
    @FXML private TextField searchField;
    @FXML private Label titleLabel;
    @FXML private StackPane frontContentStack;
    @FXML private ScrollPane eventsPageScroll;
    @FXML private ScrollPane eventDetailsScroll;
    @FXML private ScrollPane myReviewsScroll;
    @FXML private ScrollPane myCertificatesScroll;
    @FXML private VBox eventDetailsContainer;
    @FXML private VBox myReviewsContainer;
    @FXML private VBox myCertificatesContainer;

    /** Renseigné à la connexion (voir {@link #setCurrentUserId(int)}). Défaut 1 pour exécutions sans login. */
    private int currentUserId = 1;

    public void setCurrentUserId(int currentUserId) {
        this.currentUserId = currentUserId;
    }
    private static final DateTimeFormatter DTF = DateTimeFormatter.ofPattern("dd/MM/yyyy HH:mm");
    private static final double DEFAULT_LAT = 36.8065;
    private static final double DEFAULT_LNG = 10.1815;

    private final IEventService eventService = new EventService();
    private final IParticipationService participationService = new ParticipationService();
    private final IRatingService ratingService = new RatingService();
    private final ICertificatService certificatService = new CertificatService();
    private final VoiceSearchService voiceSearchService = new VoiceSearchService();
    private final GeminiService geminiService = new GeminiService();
    private final BadWordService badWordService = new BadWordService();

    private VBox chatbotContainer;
    private boolean chatbotVisible = false;
    private int badWordAttemptCount = 0;



    @Override
    public void initialize(URL url, ResourceBundle rb) {
        int sid = SessionManager.getInstance().getCurrentUserId();
        if (sid > 0) {
            currentUserId = sid;
        }

        showEventsPage();
        loadEvents(null);
        setupChatbot();

        searchField.textProperty().addListener((obs, oldVal, newVal) -> {
            onSearch();
        });
    }



    @FXML
    private void goHome() {
        MainFx.switchScene("/fxml/Event/main_app.fxml");
    }

    @FXML
    private void onSearch() {
        showEventsPage();
        String keyword = searchField.getText().trim();
        loadEvents(keyword.isEmpty() ? null : keyword);
    }

    @FXML
    private void onVoiceSearch() {
        new Thread(() -> {
            try {
                javafx.application.Platform.runLater(() -> {
                    toastNotification("🎙️ Recherche Vocale", "Écoute en cours... Parlez maintenant (4s)", false);
                });

                // Records for 4 seconds and transcribes
                String text = voiceSearchService.recordAndTranscribe(4);

                javafx.application.Platform.runLater(() -> {
                    if (text == null || text.isBlank() || text.startsWith("Note:")) {
                        toastNotification("Recherche Vocale", text != null && text.startsWith("Note:") ? text : "Aucune parole détectée.", true);
                    } else {
                        searchField.setText(text);
                        onSearch();
                        toastNotification("Recherche Vocale", "Recherche lancée pour : \"" + text + "\"", false);
                    }
                });
            } catch (Exception ex) {
                javafx.application.Platform.runLater(() -> showError("Erreur Vocal", ex.getMessage()));
            }
        }).start();
    }


    @FXML
    private void showEventsPage() {
        showPage(eventsPageScroll, "🎭 Tous les Événements");
    }

    @FXML
    private void showMyReviewsPage() {
        showPage(myReviewsScroll, "📝 Mes avis");
        loadMyReviews();
    }

    @FXML
    private void showMyCertificatesPage() {
        showPage(myCertificatesScroll, "🏆 Mes certificats");
        loadMyCertificates();
    }

    private void showPage(ScrollPane target, String title) {
        titleLabel.setText(title);
        eventsPageScroll.setVisible(false); eventsPageScroll.setManaged(false);
        eventDetailsScroll.setVisible(false); eventDetailsScroll.setManaged(false);
        myReviewsScroll.setVisible(false); myReviewsScroll.setManaged(false);
        myCertificatesScroll.setVisible(false); myCertificatesScroll.setManaged(false);
        target.setVisible(true); target.setManaged(true);
    }

    private void loadEvents(String keyword) {
        try {
            List<Event> events = keyword != null ? eventService.search(keyword) : eventService.getAll();
            eventsContainer.getChildren().clear();
            if (events.isEmpty()) {
                Label empty = new Label("Aucun événement trouvé.");
                empty.getStyleClass().add("empty-label");
                eventsContainer.getChildren().add(empty);
                return;
            }
            for (Event ev : events) {
                eventsContainer.getChildren().add(createEventCard(ev));
            }
        } catch (SQLException ex) {
            showError("Erreur", ex.getMessage());
        }
    }

    private VBox createEventCard(Event ev) {
        VBox card = new VBox(10);
        card.getStyleClass().add("event-card");
        card.setPrefWidth(320);
        card.setPadding(new Insets(20));
        addCardHoverAnimation(card);

        Label title = new Label(ev.getTitre());
        title.getStyleClass().add("card-title");
        title.setWrapText(true);
        Label cat = new Label(ev.getCategory() != null ? ev.getCategory().getName() : "Sans catégorie");
        cat.getStyleClass().add("card-badge");
        Label lieu = new Label("📍 " + ev.getLieu()); lieu.getStyleClass().add("card-info");
        Label date = new Label("📅 " + (ev.getDateDebut() != null ? ev.getDateDebut().format(DTF) : "N/A")); date.getStyleClass().add("card-info");
        Label duree = new Label("⏱ " + ev.getDuree() + " min"); duree.getStyleClass().add("card-info");

        int participantCount = 0;
        double avgRating = 0;
        try {
            participantCount = participationService.countByEvent(ev.getId());
            avgRating = ratingService.getAverageRating(ev.getId());
        } catch (SQLException ignored) {}
        Label participants = new Label("👥 " + participantCount + " / " + ev.getNombreMaxParticipants()); participants.getStyleClass().add("card-info");
        Label rating = new Label("⭐ " + String.format("%.1f", avgRating) + " / 5"); rating.getStyleClass().add("card-info");

        Label reviewPreview = new Label("Aucun avis pour le moment.");
        reviewPreview.getStyleClass().add("card-review-preview");
        reviewPreview.setWrapText(true);
        try {
            List<Rating> ratings = ratingService.getByEvent(ev.getId());
            if (!ratings.isEmpty()) {
                Rating top = ratings.get(0);
                String comment = top.getCommentaire() == null || top.getCommentaire().isBlank() ? "Sans commentaire." : top.getCommentaire();
                reviewPreview.setText("Dernier avis (" + top.getNote() + "/5): " + comment);
            }
        } catch (SQLException ignored) {}

        Button details = new Button("Voir détails");
        details.getStyleClass().addAll("btn", "btn-primary");
        details.setOnAction(e -> showEventDetailsPage(ev));
        Button avis = new Button("Avis");
        avis.getStyleClass().addAll("btn", "btn-outline");
        avis.setOnAction(e -> openRatingDialog(ev));
        HBox actions = new HBox(10, details, avis);
        HBox.setHgrow(details, Priority.ALWAYS);
        HBox.setHgrow(avis, Priority.ALWAYS);
        details.setMaxWidth(Double.MAX_VALUE);
        avis.setMaxWidth(Double.MAX_VALUE);

        card.getChildren().addAll(title, cat, lieu, date, duree, participants, rating, reviewPreview, actions);
        return card;
    }

    private void showEventDetailsPage(Event ev) {
        showPage(eventDetailsScroll, "📖 Détail événement");
        eventDetailsContainer.getChildren().clear();
        eventDetailsContainer.setPadding(new Insets(30));
        eventDetailsContainer.setSpacing(30);

        boolean hasJoined = false;
        boolean hasRated = false;
        int joinedCount = 0;
        try {
            hasJoined = participationService.userHasJoined(currentUserId, ev.getId());
            hasRated = ratingService.userHasRated(currentUserId, ev.getId());
            joinedCount = participationService.countByEvent(ev.getId());
        } catch (SQLException ignored) {}

        // --- Navigation ---
        Button back = new Button("← Retour aux événements");
        back.getStyleClass().addAll("btn", "btn-outline");
        back.setOnAction(e -> showEventsPage());
        eventDetailsContainer.getChildren().add(back);

        // --- Header Section ---
        VBox header = new VBox(8);
        Label catBadge = new Label(ev.getCategory() != null ? ev.getCategory().getName().toUpperCase() : "ÉVÉNEMENT");
        catBadge.getStyleClass().add("card-badge");
        Label title = new Label(ev.getTitre());
        title.setStyle("-fx-font-size: 38px; -fx-font-weight: 900; -fx-text-fill: white;");
        title.setWrapText(true);
        header.getChildren().addAll(catBadge, title);
        eventDetailsContainer.getChildren().add(header);

        // --- Main content area: Left (Info) | Right (Interactive) ---
        HBox mainLayout = new HBox(40);
        mainLayout.setAlignment(Pos.TOP_LEFT);

        // Left Column: Detailed Info
        VBox leftCol = new VBox(25);
        HBox.setHgrow(leftCol, Priority.ALWAYS);

        // Info Grid
        GridPane infoGrid = new GridPane();
        infoGrid.setHgap(30);
        infoGrid.setVgap(25);
        infoGrid.add(createDetailItem("📍 Lieu", ev.getLieu()), 0, 0);
        infoGrid.add(createDetailItem("📅 Date & Heure", (ev.getDateDebut() != null ? ev.getDateDebut().format(DTF) : "N/A")), 1, 0);
        infoGrid.add(createDetailItem("⏱ Durée", ev.getDuree() + " minutes"), 0, 1);
        infoGrid.add(createDetailItem("👥 Capacité", joinedCount + " / " + ev.getNombreMaxParticipants() + " participants"), 1, 1);

        // Description Section
        VBox descSection = new VBox(12);
        Label descTitle = new Label("À propos de cet événement");
        descTitle.setStyle("-fx-font-size: 18px; -fx-font-weight: bold; -fx-text-fill: #6366f1;");
        Label descText = new Label(ev.getDescription() != null ? ev.getDescription() : "Aucune description fournie.");
        descText.setWrapText(true);
        descText.setStyle("-fx-font-size: 16px; -fx-text-fill: #cbd5e1; -fx-line-spacing: 1.5;");
        descSection.getChildren().addAll(descTitle, descText);

        leftCol.getChildren().addAll(infoGrid, descSection);

        // Right Column: Map, QR & Actions
        VBox rightCol = new VBox(25);
        rightCol.setPrefWidth(450);

        // Map
        WebView map = createLocationMapView(ev.getLieu(), 450, 300);
        map.setStyle("-fx-background-radius: 15; -fx-border-radius: 15; -fx-border-color: rgba(255,255,255,0.1); -fx-border-width: 1;");

        // Action Card
        VBox actionCard = new VBox(15);
        actionCard.getStyleClass().add("form-card");
        actionCard.setPadding(new Insets(20));
        actionCard.setStyle("-fx-background-color: rgba(30, 41, 59, 0.7); -fx-background-radius: 20;");

        Button joinBtn = new Button(hasJoined ? "✓ Inscrit" : "S'inscrire maintenant");
        joinBtn.getStyleClass().addAll("btn", hasJoined ? "btn-outline" : "btn-success");
        joinBtn.setDisable(hasJoined || joinedCount >= ev.getNombreMaxParticipants());
        joinBtn.setMaxWidth(Double.MAX_VALUE);
        joinBtn.setOnAction(e -> {
            try {
                Participation p = new Participation();
                p.setUserId(currentUserId);
                p.setEventId(ev.getId());
                participationService.add(p);
                loadEvents(null);
                showEventDetailsPage(ev);
                showInfo("Félicitations", "Votre inscription a été enregistrée avec succès !");
            } catch (SQLException ex) { showError("Erreur", ex.getMessage()); }
        });

        Button avisBtn = new Button("⭐ " + (hasRated ? "Gérer mes avis" : "Laisser un avis"));
        avisBtn.getStyleClass().addAll("btn", "btn-primary");
        avisBtn.setMaxWidth(Double.MAX_VALUE);
        avisBtn.setOnAction(e -> openRatingDialog(ev));

        Button calendarBtn = new Button("📅 Google Calendar");
        calendarBtn.getStyleClass().addAll("btn", "btn-outline");
        calendarBtn.setMaxWidth(Double.MAX_VALUE);
        calendarBtn.setOnAction(e -> openGoogleCalendar(ev));

        actionCard.getChildren().addAll(joinBtn, avisBtn, calendarBtn);

        // QR Code Box
        VBox qrBox = new VBox(10);
        qrBox.setAlignment(Pos.CENTER);
        qrBox.setStyle("-fx-background-color: white; -fx-padding: 15; -fx-background-radius: 20;");
        try {
            String eventUrl = LocalServerService.getInstance().getEventUrl(ev.getId());
            if (eventUrl != null) {
                BufferedImage qrBI = new QrCodeService().generateImage(eventUrl, 150);
                ImageView qrView = new ImageView(SwingFXUtils.toFXImage(qrBI, null));
                Label qrLabel = new Label("📲 Scannez pour mobile");
                qrLabel.setStyle("-fx-text-fill: #1e293b; -fx-font-weight: bold; -fx-font-size: 13px;");
                qrBox.getChildren().addAll(qrView, qrLabel);
            }
        } catch (Exception ignored) {}

        rightCol.getChildren().addAll(map, actionCard, qrBox);

        mainLayout.getChildren().addAll(leftCol, rightCol);
        eventDetailsContainer.getChildren().add(mainLayout);

        addRecommendations(ev);
    }

    private VBox createDetailItem(String iconTitle, String value) {
        VBox box = new VBox(4);
        Label title = new Label(iconTitle);
        title.setStyle("-fx-text-fill: #94a3b8; -fx-font-size: 13px; -fx-text-transform: uppercase; -fx-letter-spacing: 1px;");
        Label val = new Label(value != null ? value : "N/A");
        val.setStyle("-fx-text-fill: white; -fx-font-size: 16px; -fx-font-weight: bold;");
        val.setWrapText(true);
        box.getChildren().addAll(title, val);
        return box;
    }


    private void openGoogleCalendar(Event ev) {
        try {
            String baseUrl = "https://www.google.com/calendar/render?action=TEMPLATE";
            String title = URLEncoder.encode(ev.getTitre(), StandardCharsets.UTF_8);

            DateTimeFormatter formatter = DateTimeFormatter.ofPattern("yyyyMMdd'T'HHmmss'Z'");
            String start = ev.getDateDebut() != null ? ev.getDateDebut().format(formatter) : "";
            String end = ev.getDateFin() != null ? ev.getDateFin().format(formatter) : start;

            String details = URLEncoder.encode(ev.getDescription() != null ? ev.getDescription() : "", StandardCharsets.UTF_8);
            String location = URLEncoder.encode(ev.getLieu() != null ? ev.getLieu() : "", StandardCharsets.UTF_8);

            String url = String.format("%s&text=%s&dates=%s/%s&details=%s&location=%s",
                    baseUrl, title, start, end, details, location);

            if (Desktop.isDesktopSupported()) {
                Desktop.getDesktop().browse(new URI(url));
            } else {
                Runtime.getRuntime().exec("rundll32 url.dll,FileProtocolHandler " + url);
            }
        } catch (Exception ex) {
            showError("Erreur Calendrier", "Impossible d'ouvrir Google Calendar : " + ex.getMessage());
        }
    }

    private void addRecommendations(Event currentEv) {

        try {
            List<Event> related = eventService.getByCategory(currentEv.getCategoryId())
                    .stream()
                    .filter(e -> e.getId() != currentEv.getId())
                    .limit(3)
                    .toList();

            if (related.isEmpty()) return;

            Label recTitle = new Label("🌟 Événements recommandés");
            recTitle.setStyle("-fx-font-size: 20px; -fx-font-weight: bold; -fx-padding: 20 0 10 0;");

            HBox recContainer = new HBox(15);
            recContainer.setAlignment(Pos.CENTER_LEFT);

            for (Event re : related) {
                VBox recCard = new VBox(8);
                recCard.getStyleClass().add("event-card");
                recCard.setPrefWidth(250);
                recCard.setPadding(new Insets(15));
                addCardHoverAnimation(recCard);

                Label t = new Label(re.getTitre());
                t.getStyleClass().add("card-title");
                t.setStyle("-fx-font-size: 14px;");
                t.setWrapText(true);

                Label l = new Label("📍 " + re.getLieu());
                l.getStyleClass().add("card-info");

                Button view = new Button("Voir");
                view.getStyleClass().addAll("btn", "btn-outline");
                view.setOnAction(e -> showEventDetailsPage(re));

                recCard.getChildren().addAll(t, l, view);
                recContainer.getChildren().add(recCard);
            }

            eventDetailsContainer.getChildren().addAll(recTitle, recContainer);
        } catch (SQLException ignored) {}
    }

    private void setupChatbot() {
        chatbotContainer = new VBox(10);
        chatbotContainer.setMaxSize(350, 500);
        StackPane.setAlignment(chatbotContainer, Pos.BOTTOM_RIGHT);
        StackPane.setMargin(chatbotContainer, new Insets(0, 20, 80, 0));
        chatbotContainer.setVisible(false);
        chatbotContainer.setManaged(false);

        Label chatTitle = new Label("🤖 Assistant Événements");
        chatTitle.setStyle("-fx-font-weight: bold; -fx-text-fill: white;");

        VBox chatBox = new VBox(10);
        chatBox.setStyle("-fx-background-color: transparent; -fx-padding: 10;");
        ScrollPane chatScroll = new ScrollPane(chatBox);
        chatScroll.setFitToWidth(true);
        chatScroll.setPrefHeight(350);
        chatScroll.setStyle("-fx-background: transparent; -fx-background-color: transparent;");

        TextField chatInput = new TextField();
        chatInput.setPromptText("Posez une question...");
        Button sendBtn = new Button("Envoyer");
        sendBtn.getStyleClass().addAll("btn", "btn-primary");

        sendBtn.setOnAction(e -> {
            String msg = chatInput.getText().trim();
            if (msg.isEmpty()) return;

            Label userLabel = new Label(msg);
            userLabel.setWrapText(true);
            userLabel.getStyleClass().add("chatbot-msg-user");
            HBox userWrapper = new HBox(userLabel);
            userWrapper.setAlignment(Pos.CENTER_RIGHT);
            chatBox.getChildren().add(userWrapper);
            chatInput.clear();

            new Thread(() -> {
                try {
                    String response = geminiService.askChatbot(msg);
                    javafx.application.Platform.runLater(() -> {
                        Label botMsg = new Label(response);
                        botMsg.setWrapText(true);
                        botMsg.getStyleClass().add("chatbot-msg-bot");
                        HBox botWrapper = new HBox(botMsg);
                        botWrapper.setAlignment(Pos.CENTER_LEFT);
                        chatBox.getChildren().add(botWrapper);
                        chatScroll.setVvalue(1.0);
                    });
                } catch (Exception ex) {
                    javafx.application.Platform.runLater(() -> {
                        chatBox.getChildren().add(new Label("Erreur: " + ex.getMessage()));
                    });
                }
            }).start();
        });

        HBox inputArea = new HBox(5, chatInput, sendBtn);
        HBox.setHgrow(chatInput, Priority.ALWAYS);

        chatbotContainer.getChildren().addAll(chatTitle, chatScroll, inputArea);
        chatbotContainer.setStyle("-fx-background-color: #2c3e50; -fx-padding: 15; -fx-background-radius: 15;");


        Button toggleBtn = new Button("💬");
        toggleBtn.getStyleClass().addAll("btn", "btn-primary");
        toggleBtn.setStyle("-fx-font-size: 24px; -fx-background-radius: 30; -fx-min-width: 60px; -fx-min-height: 60px;");
        StackPane.setAlignment(toggleBtn, Pos.BOTTOM_RIGHT);
        StackPane.setMargin(toggleBtn, new Insets(0, 20, 10, 0));

        toggleBtn.setOnAction(e -> {
            chatbotVisible = !chatbotVisible;
            chatbotContainer.setVisible(chatbotVisible);
            chatbotContainer.setManaged(chatbotVisible);
        });

        frontContentStack.getChildren().addAll(chatbotContainer, toggleBtn);
    }


    private void openRatingDialog(Event ev) {
        try {
            if (ratingService.userHasRated(currentUserId, ev.getId())) {
                showInfo("Avis", "Vous avez déjà laissé un avis pour cet événement.");
                return;
            }

            Dialog<Rating> dialog = new Dialog<>();
            dialog.setTitle("Avis - " + ev.getTitre());
            dialog.setHeaderText("Partagez votre expérience sur cet événement");

            ButtonType submitBtn = new ButtonType("Publier", ButtonBar.ButtonData.OK_DONE);
            dialog.getDialogPane().getButtonTypes().addAll(submitBtn, ButtonType.CANCEL);

            org.controlsfx.control.Rating starRating = new org.controlsfx.control.Rating(5);
            starRating.setPartialRating(false);
            starRating.setUpdateOnHover(true);
            starRating.setRating(5); // Default to 5 stars

            TextArea commentArea = new TextArea();
            commentArea.setPromptText("Votre commentaire (optionnel)...");
            commentArea.setPrefRowCount(3);
            commentArea.setWrapText(true);

            VBox box = new VBox(12, new Label("Note (étoiles) :"), starRating, new Label("Commentaire :"), commentArea);
            box.setPadding(new Insets(20));
            box.setPrefWidth(450);

            dialog.getDialogPane().setContent(box);
            FormHelper.attachStylesheet(dialog.getDialogPane());

            dialog.setResultConverter(btn -> {
                if (btn == submitBtn) {
                    Rating r = new Rating();
                    r.setUserId(currentUserId);
                    r.setEventId(ev.getId());
                    r.setNote((int) starRating.getRating());
                    r.setCommentaire(commentArea.getText().trim().isEmpty() ? null : commentArea.getText().trim());
                    return r;
                }
                return null;
            });

            dialog.showAndWait().ifPresent(r -> {
                try {
                    if (r.getCommentaire() != null && badWordService.containsBadWords(r.getCommentaire())) {
                        badWordAttemptCount++;
                        toastNotification("Avertissement Modération", "Votre commentaire contient des mots inappropriés. Tentative n°" + badWordAttemptCount, true);
                        return;
                    }

                    ratingService.add(r);
                    loadEvents(null);
                    showInfo("Merci", "Votre avis de " + r.getNote() + " étoiles a été enregistré.");
                } catch (SQLException ex) {
                    showError("Erreur", ex.getMessage());
                }
            });
        } catch (SQLException ex) {
            showError("Erreur", ex.getMessage());
        }
    }


    private void loadMyReviews() {
        myReviewsContainer.getChildren().clear();
        VBox card = new VBox(10);
        card.getStyleClass().add("form-card");
        card.setPadding(new Insets(18));
        try {
            List<Rating> all = ratingService.getAllWithDetails();
            List<Rating> mine = all.stream().filter(r -> r.getUserId() == currentUserId).toList();
            if (mine.isEmpty()) {
                card.getChildren().add(new Label("Vous n'avez pas encore publié d'avis."));
            } else {
                for (Rating r : mine) {
                    Label row = new Label((r.getEvent() != null ? r.getEvent().getTitre() : "Événement") + " - "
                            + r.getNote() + "/5 - "
                            + (r.getCommentaire() == null ? "Sans commentaire" : r.getCommentaire()));
                    row.setWrapText(true);
                    row.getStyleClass().add("card-info");
                    card.getChildren().add(row);
                }
            }
        } catch (SQLException ex) {
            card.getChildren().add(new Label("Erreur: " + ex.getMessage()));
        }
        myReviewsContainer.getChildren().add(card);
    }

    private void loadMyCertificates() {
        myCertificatesContainer.getChildren().clear();
        VBox card = new VBox(10);
        card.getStyleClass().add("form-card");
        card.setPadding(new Insets(18));
        try {
            List<Certificat> certs = certificatService.getByUser(currentUserId);
            if (certs.isEmpty()) {
                card.getChildren().add(new Label("Aucun certificat pour le moment."));
            } else {
                for (Certificat c : certs) {
                    Label row = new Label("Code: " + c.getCodeUnique() + " | Date: "
                            + (c.getDateObtention() != null ? c.getDateObtention().format(DTF) : "N/A"));
                    row.getStyleClass().add("card-info");
                    card.getChildren().add(row);
                }
            }
        } catch (SQLException ex) {
            card.getChildren().add(new Label("Erreur: " + ex.getMessage()));
        }
        myCertificatesContainer.getChildren().add(card);
    }

    private void addCardHoverAnimation(VBox card) {
        ScaleTransition up = new ScaleTransition(Duration.millis(180), card);
        up.setToX(1.02); up.setToY(1.02);
        ScaleTransition down = new ScaleTransition(Duration.millis(180), card);
        down.setToX(1.0); down.setToY(1.0);
        card.setOnMouseEntered(e -> up.playFromStart());
        card.setOnMouseExited(e -> down.playFromStart());
    }

    private WebView createLocationMapView(String lieu, int width, int height) {
        WebView webView = new WebView();
        webView.setPrefSize(width, height);
        webView.setMinHeight(height);
        webView.setContextMenuEnabled(false);
        double[] coords = extractCoordinates(lieu);
        double lat = coords != null ? coords[0] : DEFAULT_LAT;
        double lng = coords != null ? coords[1] : DEFAULT_LNG;
        int zoom = coords != null ? 14 : 6;
        String safeLieu = lieu == null ? "Position non précisée" : lieu.replace("'", "\\'");
        String html = "<!DOCTYPE html><html><head>"
                + "<meta charset='UTF-8'/><meta name='viewport' content='width=device-width,initial-scale=1.0'/>"
                + "<link rel='stylesheet' href='https://unpkg.com/leaflet@1.9.4/dist/leaflet.css'/>"
                + "<style>html,body,#map{height:100%;margin:0;}#map{border-radius:12px;}</style></head>"
                + "<body><div id='map'></div><script src='https://unpkg.com/leaflet@1.9.4/dist/leaflet.js'></script><script>"
                + "const map=L.map('map').setView([" + lat + "," + lng + "]," + zoom + ");"
                + "L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{maxZoom:19,attribution:'&copy; OpenStreetMap'}).addTo(map);"
                + "L.marker([" + lat + "," + lng + "]).addTo(map).bindPopup('" + safeLieu + "').openPopup();"
                + "</script></body></html>";
        webView.getEngine().loadContent(html);
        return webView;
    }

    private double[] extractCoordinates(String locationText) {
        if (locationText == null) return null;
        String[] parts = locationText.split(",");
        if (parts.length != 2) return null;
        try {
            double lat = Double.parseDouble(parts[0].trim());
            double lng = Double.parseDouble(parts[1].trim());
            if (lat < -90 || lat > 90 || lng < -180 || lng > 180) return null;
            return new double[]{lat, lng};
        } catch (NumberFormatException ex) {
            return null;
        }
    }

    /** Toasts attachés à la fenêtre principale pour que {@code modern.css} s’applique (texte bleu lisible). */
    private void toastNotification(String title, String text, boolean warning) {
        Notifications n = Notifications.create()
                .title(title)
                .text(text)
                .position(Pos.TOP_RIGHT);
        if (MainFx.getPrimaryStage() != null) {
            n.owner(MainFx.getPrimaryStage());
        }
        if (warning) {
            n.showWarning();
        } else {
            n.showInformation();
        }
        NotificationStyling.afterControlsFxShow();
    }

    private void showError(String title, String msg) {
        Alert a = new Alert(Alert.AlertType.ERROR);
        a.setTitle(title); a.setContentText(msg); a.showAndWait();
    }

    private void showInfo(String title, String msg) {
        Alert a = new Alert(Alert.AlertType.INFORMATION);
        a.setTitle(title); a.setContentText(msg); a.showAndWait();
    }
}
