package controllers;

import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.concurrent.Worker;
import javafx.fxml.FXML;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.control.Accordion;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.ComboBox;
import javafx.scene.control.Label;
import javafx.scene.control.TextArea;
import javafx.scene.control.TextField;
import javafx.scene.control.TitledPane;
import javafx.scene.layout.FlowPane;
import javafx.scene.layout.HBox;
import javafx.scene.layout.Pane;
import javafx.scene.layout.StackPane;
import javafx.scene.layout.VBox;
import javafx.scene.web.WebView;
import models.Chapitre;
import models.Cours;
import services.ChapitreService;
import services.CoursService;

import java.awt.Desktop;
import java.net.URI;
import java.sql.Timestamp;
import java.time.ZoneId;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.Comparator;
import java.util.LinkedHashMap;
import java.util.LinkedHashSet;
import java.util.List;
import java.util.Map;
import java.util.prefs.Preferences;
import java.util.regex.Matcher;
import java.util.regex.Pattern;
import java.util.stream.Collectors;

public class CoursController {
    private static final String FAVORITES_KEY = "favoriteCourseIds";
    private static final Pattern URL_PATTERN = Pattern.compile("(https?://\\S+)");
    private static final DateTimeFormatter DATE_FORMAT =
            DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm");
    private static final String DEFAULT_BROWSER_STATUS =
            "Open a chapter website to start learning inside the app.";
    private static final String DEFAULT_BROWSER_HINT =
            "Pick a chapter resource to preview the website here.";

    @FXML private TextField searchField;
    @FXML private ComboBox<String> sortComboBox;
    @FXML private Label totalLabel;
    @FXML private FlowPane favoritesPane;
    @FXML private VBox coursCardsBox;
    @FXML private Label selectedTitle;
    @FXML private Label selectedMeta;
    @FXML private Label selectedDescription;
    @FXML private Button favoriteToggleBtn;
    @FXML private Label emptyStateLabel;
    @FXML private Accordion chaptersAccordion;
    @FXML private StackPane browserHost;
    @FXML private Label browserPlaceholderLabel;
    @FXML private Label browserStatusLabel;
    @FXML private Button openExternalBtn;
    @FXML private Button expandBrowserBtn;
    @FXML private Button closeBrowserBtn;
    @FXML private StackPane browserOverlay;
    @FXML private StackPane overlayBrowserHost;
    @FXML private Label overlayTitleLabel;
    @FXML private Label overlayMetaLabel;
    @FXML private Label overlayPlaceholderLabel;
    @FXML private Button overlayOpenExternalBtn;

    private final CoursService coursService = new CoursService();
    private final ChapitreService chapitreService = new ChapitreService();
    private final ObservableList<Cours> masterCours = FXCollections.observableArrayList();
    private final ObservableList<Cours> filteredCours = FXCollections.observableArrayList();
    private final Map<Integer, List<Chapitre>> chapterCache = new LinkedHashMap<>();
    private final LinkedHashSet<Integer> favoriteIds = new LinkedHashSet<>();
    private final Preferences preferences = Preferences.userNodeForPackage(CoursController.class);
    private final WebView browserView = new WebView();

    private Cours selectedCourse;
    private String currentResourceUrl = "";
    private String currentResourceSource = "";
    private boolean browserExpanded;

    @FXML
    public void initialize() {
        configureBrowserViewer();
        loadFavorites();

        if (sortComboBox != null) {
            sortComboBox.setItems(FXCollections.observableArrayList(
                    "Newest First", "Oldest First", "Title (A-Z)", "Title (Z-A)"
            ));
            sortComboBox.getSelectionModel().select("Newest First");
            sortComboBox.valueProperty().addListener((obs, oldVal, newVal) -> {
                int selectedId = getSelectedCourseId();
                applyFilter();
                restoreSelection(selectedId);
            });
        }

        if (searchField != null) {
            searchField.textProperty().addListener((obs, oldValue, newValue) -> {
                int selectedId = getSelectedCourseId();
                applyFilter();
                restoreSelection(selectedId);
            });
        }

        refreshData();
    }

    @FXML
    public void onRefresh() {
        refreshData();
    }

    @FXML
    public void toggleFavorite() {
        toggleFavorite(selectedCourse);
    }

    @FXML
    public void expandBrowserOverlay() {
        if (currentResourceUrl.isBlank()) {
            return;
        }

        mountBrowserInOverlay();
        browserExpanded = true;
        if (browserOverlay != null) {
            browserOverlay.setVisible(true);
            browserOverlay.setManaged(true);
            browserOverlay.toFront();
        }
        refreshBrowserStatus();
    }

    @FXML
    public void collapseBrowserOverlay() {
        if (!browserExpanded) {
            return;
        }

        mountBrowserInline();
        browserExpanded = false;
        if (browserOverlay != null) {
            browserOverlay.setVisible(false);
            browserOverlay.setManaged(false);
        }
    }

    @FXML
    public void closeBrowserViewer() {
        resetBrowserViewer();
    }

    @FXML
    public void openCurrentUrlExternally() {
        if (currentResourceUrl.isBlank()) {
            return;
        }
        openExternalUrl(currentResourceUrl);
    }

    private void configureBrowserViewer() {
        browserView.getStyleClass().add("browser-webview");
        browserView.setContextMenuEnabled(false);
        browserView.setPrefHeight(420);
        browserView.getEngine().setJavaScriptEnabled(true);

        browserView.getEngine().titleProperty().addListener((obs, oldValue, newValue) -> refreshBrowserStatus());
        browserView.getEngine().locationProperty().addListener((obs, oldValue, newValue) -> {
            if (newValue != null && !newValue.isBlank() && !"about:blank".equalsIgnoreCase(newValue)) {
                currentResourceUrl = newValue;
            }
            refreshBrowserStatus();
        });
        browserView.getEngine().getLoadWorker().stateProperty().addListener((obs, oldValue, newValue) -> {
            if (newValue == Worker.State.RUNNING) {
                updateBrowserLabels("Loading " + safe(currentResourceSource, "website") + "...", currentResourceUrl);
            } else if (newValue == Worker.State.SUCCEEDED) {
                refreshBrowserStatus();
            } else if (newValue == Worker.State.FAILED) {
                updateBrowserLabels("This website could not be displayed inside the app.", currentResourceUrl);
            }
        });

        if (browserHost != null && browserPlaceholderLabel != null) {
            browserHost.getChildren().setAll(browserPlaceholderLabel);
        }
        if (overlayBrowserHost != null && overlayPlaceholderLabel != null) {
            overlayBrowserHost.getChildren().setAll(overlayPlaceholderLabel);
        }
        if (browserOverlay != null) {
            browserOverlay.setVisible(false);
            browserOverlay.setManaged(false);
        }

        updateBrowserButtons(false);
        updateBrowserLabels(DEFAULT_BROWSER_STATUS, DEFAULT_BROWSER_HINT);
    }

    private void refreshData() {
        int selectedId = getSelectedCourseId();

        chapterCache.clear();
        masterCours.setAll(coursService.getAllCours());

        applyFilter();
        renderFavorites();
        restoreSelection(selectedId);
    }

    private void applyFilter() {
        String query = safe(searchField == null ? null : searchField.getText()).trim().toLowerCase();

        Comparator<Cours> comparator = Comparator.comparing(Cours::getCreatedAt, Comparator.nullsLast(Comparator.reverseOrder()));
        if (sortComboBox != null && sortComboBox.getValue() != null) {
            switch (sortComboBox.getValue()) {
                case "Oldest First" -> comparator = Comparator.comparing(Cours::getCreatedAt, Comparator.nullsLast(Comparator.naturalOrder()));
                case "Title (A-Z)" -> comparator = Comparator.comparing(Cours::getTitre, String.CASE_INSENSITIVE_ORDER);
                case "Title (Z-A)" -> comparator = Comparator.comparing(Cours::getTitre, String.CASE_INSENSITIVE_ORDER).reversed();
            }
        }

        List<Cours> out = masterCours.stream()
                .filter(cours -> query.isBlank()
                        || safe(cours.getTitre()).toLowerCase().contains(query)
                        || safe(cours.getDescription()).toLowerCase().contains(query))
                .sorted(comparator)
                .collect(Collectors.toList());

        filteredCours.setAll(out);

        if (totalLabel != null) {
            totalLabel.setText("Showing " + filteredCours.size() + " courses");
        }

        renderCourseCards();
    }

    private void restoreSelection(int selectedId) {
        if (filteredCours.isEmpty()) {
            showCourse(null);
            return;
        }

        if (!selectCourseById(selectedId)) {
            showCourse(filteredCours.get(0));
        }
    }

    private void renderCourseCards() {
        if (coursCardsBox == null) {
            return;
        }

        coursCardsBox.getChildren().clear();

        if (filteredCours.isEmpty()) {
            coursCardsBox.getChildren().add(createEmptyCard("No courses match your current search."));
            return;
        }

        for (Cours cours : filteredCours) {
            coursCardsBox.getChildren().add(createCourseCard(cours));
        }
    }

    private VBox createCourseCard(Cours cours) {
        VBox card = new VBox(14);
        card.getStyleClass().add("course-browser-card");

        if (selectedCourse != null && selectedCourse.getId() == cours.getId()) {
            card.getStyleClass().add("course-browser-card-active");
        }

        Label title = new Label(safe(cours.getTitre(), "Untitled course"));
        title.getStyleClass().add("course-card-title");
        title.setWrapText(true);

        Label description = new Label(preview(cours.getDescription(), 180));
        description.getStyleClass().add("course-card-desc");
        description.setWrapText(true);

        FlowPane chips = new FlowPane();
        chips.getStyleClass().add("chip-row");
        chips.setHgap(8);
        chips.setVgap(8);
        chips.getChildren().add(createInfoChip(cours.getChapterCount() + " "
                + (cours.getChapterCount() == 1 ? "chapter" : "chapters")));
        chips.getChildren().add(createInfoChip(formatTimestamp(cours.getCreatedAt())));
        if (favoriteIds.contains(cours.getId())) {
            chips.getChildren().add(createInfoChip("Saved", "info-chip-favorite"));
        }

        Button detailsBtn = new Button(selectedCourse != null && selectedCourse.getId() == cours.getId()
                ? "Opened"
                : "Open details");
        detailsBtn.getStyleClass().add(selectedCourse != null && selectedCourse.getId() == cours.getId()
                ? "secondary-btn"
                : "primary-btn");
        detailsBtn.setOnAction(event -> showCourse(cours));

        Button favoriteBtn = new Button(favoriteIds.contains(cours.getId())
                ? "Remove favorite"
                : "Save");
        favoriteBtn.getStyleClass().add("secondary-btn");
        favoriteBtn.setOnAction(event -> toggleFavorite(cours));

        HBox actions = new HBox(10, detailsBtn, favoriteBtn);
        actions.setAlignment(Pos.CENTER_LEFT);

        card.getChildren().addAll(title, description, chips, actions);
        return card;
    }

    private Label createInfoChip(String text) {
        return createInfoChip(text, null);
    }

    private Label createInfoChip(String text, String variantStyleClass) {
        Label chip = new Label(text);
        chip.getStyleClass().add("info-chip");
        if (variantStyleClass != null && !variantStyleClass.isBlank()) {
            chip.getStyleClass().add(variantStyleClass);
        }
        return chip;
    }

    private VBox createEmptyCard(String message) {
        VBox box = new VBox();
        box.getStyleClass().add("admin-empty-card");

        Label label = new Label(message);
        label.getStyleClass().add("empty-note");
        label.setWrapText(true);

        box.getChildren().add(label);
        return box;
    }

    private void toggleFavorite(Cours cours) {
        if (cours == null) {
            return;
        }

        if (favoriteIds.contains(cours.getId())) {
            favoriteIds.remove(cours.getId());
        } else {
            favoriteIds.add(cours.getId());
        }

        persistFavorites();
        renderFavorites();
        renderCourseCards();
        updateFavoriteButton(selectedCourse);
    }

    private void showCourse(Cours cours) {
        Cours previousSelection = selectedCourse;
        selectedCourse = cours;
        renderCourseCards();

        boolean courseChanged = previousSelection == null
                ? cours != null
                : cours == null || previousSelection.getId() != cours.getId();
        if (courseChanged) {
            resetBrowserViewer();
        }

        boolean noSelection = cours == null;

        if (selectedTitle != null) {
            selectedTitle.setText(noSelection ? "Select a course" : safe(cours.getTitre(), "Untitled course"));
        }
        if (selectedMeta != null) {
            selectedMeta.setText(noSelection
                    ? "Open a course card to load its chapters."
                    : buildMeta(cours));
        }
        if (selectedDescription != null) {
            selectedDescription.setText(noSelection ? "" : safe(cours.getDescription(), "No description available."));
        }
        if (favoriteToggleBtn != null) {
            favoriteToggleBtn.setDisable(noSelection);
        }
        if (chaptersAccordion != null) {
            chaptersAccordion.getPanes().clear();
        }

        if (noSelection) {
            setEmptyState(true, filteredCours.isEmpty()
                    ? "No courses available right now."
                    : "No course selected.");
            if (favoriteToggleBtn != null) {
                favoriteToggleBtn.setText("Save course");
            }
            return;
        }

        updateFavoriteButton(cours);

        List<Chapitre> chapitres = chapterCache.computeIfAbsent(
                cours.getId(),
                chapitreService::getChapitresByCoursId
        );

        if (chapitres.isEmpty()) {
            setEmptyState(true, "No chapters available for this course yet.");
            return;
        }

        setEmptyState(false, "");

        List<TitledPane> panes = new ArrayList<>();
        for (Chapitre chapitre : chapitres) {
            panes.add(createChapterPane(chapitre));
        }
        chaptersAccordion.getPanes().setAll(panes);
        chaptersAccordion.setExpandedPane(panes.get(0));
    }

    private void renderFavorites() {
        favoritesPane.getChildren().clear();

        LinkedHashSet<Integer> cleanedFavorites = new LinkedHashSet<>();

        for (Integer id : favoriteIds) {
            Cours cours = findCourseById(id);
            if (cours == null) {
                continue;
            }

            cleanedFavorites.add(id);

            Button chip = new Button(cours.getTitre());
            chip.getStyleClass().add("favorite-chip");
            chip.setOnAction(event -> {
                if (searchField != null) {
                    searchField.clear();
                }
                applyFilter();
                if (!selectCourseById(cours.getId())) {
                    showCourse(cours);
                }
            });
            favoritesPane.getChildren().add(chip);
        }

        if (!cleanedFavorites.equals(favoriteIds)) {
            favoriteIds.clear();
            favoriteIds.addAll(cleanedFavorites);
            persistFavorites();
        }

        if (favoritesPane.getChildren().isEmpty()) {
            Label none = new Label("No favorites saved yet.");
            none.getStyleClass().add("empty-note");
            favoritesPane.getChildren().add(none);
        }
    }

    private TitledPane createChapterPane(Chapitre chapitre) {
        VBox content = new VBox(12);
        content.setPadding(new Insets(10, 0, 0, 0));

        Label contentLabel = new Label("Content");
        contentLabel.getStyleClass().add("chapter-section-title");

        TextArea contentArea = new TextArea(safe(chapitre.getContenu()));
        contentArea.setWrapText(true);
        contentArea.setEditable(false);
        contentArea.setFocusTraversable(false);
        contentArea.setPrefRowCount(Math.max(5, Math.min(12, safe(chapitre.getContenu()).length() / 70 + 1)));
        contentArea.getStyleClass().add("chapter-text");

        content.getChildren().addAll(contentLabel, contentArea);

        List<String> links = extractLinks(chapitre);
        if (!links.isEmpty()) {
            Label linksLabel = new Label("Website resources");
            linksLabel.getStyleClass().add("chapter-section-title");

            VBox linksBox = new VBox(10);
            linksBox.getStyleClass().add("resource-links-box");

            for (int i = 0; i < links.size(); i++) {
                String url = links.get(i);
                linksBox.getChildren().add(createResourceCard(url, chapitre.getTitre(), i));
            }

            content.getChildren().addAll(linksLabel, linksBox);
        }

        if (!safe(chapitre.getAiSummary()).isBlank()) {
            VBox summaryBox = new VBox(6);
            summaryBox.getStyleClass().add("summary-card");

            Label summaryTitle = new Label("Saved summary");
            summaryTitle.getStyleClass().add("summary-title");

            Label summaryBody = new Label(chapitre.getAiSummary());
            summaryBody.setWrapText(true);

            summaryBox.getChildren().addAll(summaryTitle, summaryBody);
            content.getChildren().add(summaryBox);
        }

        TitledPane pane = new TitledPane(safe(chapitre.getTitre(), "Untitled chapter"), content);
        pane.setAnimated(true);
        return pane;
    }

    private VBox createResourceCard(String url, String chapterTitle, int index) {
        VBox card = new VBox(8);
        card.getStyleClass().add("resource-link-card");

        Label urlLabel = new Label(url);
        urlLabel.getStyleClass().add("resource-link-label");
        urlLabel.setWrapText(true);

        Button openBtn = new Button(index == 0 ? "Open website" : "Open website " + (index + 1));
        openBtn.getStyleClass().add("secondary-btn");
        openBtn.setOnAction(event -> openWebsiteInViewer(url, safe(chapterTitle, "Website resource")));

        card.getChildren().addAll(urlLabel, openBtn);
        return card;
    }

    private void openWebsiteInViewer(String url, String sourceTitle) {
        currentResourceUrl = safe(url).trim();
        currentResourceSource = safe(sourceTitle, "Website resource");

        if (currentResourceUrl.isBlank()) {
            return;
        }

        if (browserExpanded) {
            collapseBrowserOverlay();
        }

        mountBrowserInline();
        updateBrowserButtons(true);
        updateBrowserLabels("Loading " + currentResourceSource + "...", currentResourceUrl);
        browserView.getEngine().load(currentResourceUrl);
    }

    private void updateFavoriteButton(Cours cours) {
        if (favoriteToggleBtn == null) {
            return;
        }

        if (cours == null) {
            favoriteToggleBtn.setText("Save course");
            return;
        }

        favoriteToggleBtn.setText(favoriteIds.contains(cours.getId()) ? "Remove favorite" : "Save course");
    }

    private void setEmptyState(boolean visible, String text) {
        if (emptyStateLabel == null) {
            return;
        }

        emptyStateLabel.setText(text);
        emptyStateLabel.setVisible(visible);
        emptyStateLabel.setManaged(visible);
    }

    private boolean selectCourseById(int selectedId) {
        if (selectedId <= 0) {
            return false;
        }

        for (Cours cours : filteredCours) {
            if (cours.getId() == selectedId) {
                showCourse(cours);
                return true;
            }
        }

        return false;
    }

    private int getSelectedCourseId() {
        return selectedCourse == null ? -1 : selectedCourse.getId();
    }

    private Cours findCourseById(int id) {
        for (Cours cours : masterCours) {
            if (cours.getId() == id) {
                return cours;
            }
        }
        return null;
    }

    private void loadFavorites() {
        favoriteIds.clear();

        String stored = preferences.get(FAVORITES_KEY, "");
        if (stored == null || stored.isBlank()) {
            return;
        }

        for (String token : stored.split(",")) {
            String cleaned = token == null ? "" : token.trim();
            if (cleaned.isBlank()) {
                continue;
            }
            try {
                favoriteIds.add(Integer.parseInt(cleaned));
            } catch (NumberFormatException ignored) {
            }
        }
    }

    private void persistFavorites() {
        String value = favoriteIds.stream()
                .map(String::valueOf)
                .collect(Collectors.joining(","));
        preferences.put(FAVORITES_KEY, value);
    }

    private List<String> extractLinks(Chapitre chapitre) {
        LinkedHashSet<String> links = new LinkedHashSet<>();

        String directLink = safe(chapitre.getResourceUrl()).trim();
        if (!directLink.isBlank()) {
            links.add(directLink);
        }

        String text = chapitre.getContenu();
        if (text == null || text.isBlank()) {
            return new ArrayList<>(links);
        }

        Matcher matcher = URL_PATTERN.matcher(text);
        while (matcher.find()) {
            links.add(matcher.group(1));
        }
        return new ArrayList<>(links);
    }

    private void mountBrowserInline() {
        detachBrowserView();
        if (browserHost != null) {
            browserHost.getChildren().setAll(browserView);
        }
    }

    private void mountBrowserInOverlay() {
        detachBrowserView();
        if (overlayBrowserHost != null) {
            overlayBrowserHost.getChildren().setAll(browserView);
        }
    }

    private void detachBrowserView() {
        if (browserView.getParent() instanceof Pane pane) {
            pane.getChildren().remove(browserView);
        }
    }

    private void resetBrowserViewer() {
        currentResourceUrl = "";
        currentResourceSource = "";
        browserExpanded = false;

        browserView.getEngine().load("about:blank");
        detachBrowserView();

        if (browserHost != null && browserPlaceholderLabel != null) {
            browserHost.getChildren().setAll(browserPlaceholderLabel);
        }
        if (overlayBrowserHost != null && overlayPlaceholderLabel != null) {
            overlayBrowserHost.getChildren().setAll(overlayPlaceholderLabel);
        }
        if (browserOverlay != null) {
            browserOverlay.setVisible(false);
            browserOverlay.setManaged(false);
        }

        updateBrowserButtons(false);
        updateBrowserLabels(DEFAULT_BROWSER_STATUS, DEFAULT_BROWSER_HINT);
    }

    private void refreshBrowserStatus() {
        if (currentResourceUrl.isBlank()) {
            updateBrowserLabels(DEFAULT_BROWSER_STATUS, DEFAULT_BROWSER_HINT);
            return;
        }

        String title = safe(browserView.getEngine().getTitle(), currentResourceSource);
        updateBrowserLabels(title, currentResourceUrl);
    }

    private void updateBrowserLabels(String title, String meta) {
        if (browserStatusLabel != null) {
            browserStatusLabel.setText(safe(title, DEFAULT_BROWSER_STATUS));
        }
        if (overlayTitleLabel != null) {
            overlayTitleLabel.setText(safe(title, "Website viewer"));
        }
        if (overlayMetaLabel != null) {
            overlayMetaLabel.setText(safe(meta, currentResourceUrl));
        }
    }

    private void updateBrowserButtons(boolean hasUrl) {
        if (openExternalBtn != null) {
            openExternalBtn.setDisable(!hasUrl);
        }
        if (expandBrowserBtn != null) {
            expandBrowserBtn.setDisable(!hasUrl);
        }
        if (closeBrowserBtn != null) {
            closeBrowserBtn.setDisable(!hasUrl);
        }
        if (overlayOpenExternalBtn != null) {
            overlayOpenExternalBtn.setDisable(!hasUrl);
        }
    }

    private void openExternalUrl(String url) {
        try {
            if (!Desktop.isDesktopSupported()) {
                throw new IllegalStateException("Desktop browsing is not supported on this machine.");
            }
            Desktop.getDesktop().browse(new URI(url));
        } catch (Exception e) {
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setTitle("Link error");
            alert.setHeaderText(null);
            alert.setContentText("Could not open link: " + url);
            alert.showAndWait();
        }
    }

    private String buildMeta(Cours cours) {
        return formatTimestamp(cours.getCreatedAt()) + " | " + cours.getChapterCount() + " related "
                + (cours.getChapterCount() == 1 ? "chapter" : "chapters");
    }

    private String formatTimestamp(Timestamp timestamp) {
        if (timestamp == null) {
            return "Created date unavailable";
        }
        return DATE_FORMAT.format(timestamp.toInstant().atZone(ZoneId.systemDefault()).toLocalDateTime());
    }

    private String preview(String value, int max) {
        String safeValue = safe(value);
        if (safeValue.length() <= max) {
            return safeValue;
        }
        return safeValue.substring(0, Math.max(0, max - 3)) + "...";
    }

    private String safe(String value) {
        return value == null ? "" : value;
    }

    private String safe(String value, String fallback) {
        return value == null || value.isBlank() ? fallback : value;
    }
}