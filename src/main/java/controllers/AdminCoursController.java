package controllers;

import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.ButtonType;
import javafx.scene.control.ComboBox;
import javafx.scene.control.Dialog;
import javafx.scene.control.DialogPane;
import javafx.scene.control.Hyperlink;
import javafx.scene.control.Label;
import javafx.scene.control.Tab;
import javafx.scene.control.TabPane;
import javafx.scene.control.TextArea;
import javafx.scene.control.TextField;
import javafx.scene.layout.FlowPane;
import javafx.scene.layout.GridPane;
import javafx.scene.layout.HBox;
import javafx.scene.layout.Priority;
import javafx.scene.layout.Region;
import javafx.scene.layout.VBox;
import models.Chapitre;
import models.Cours;
import services.ChapitreService;
import services.CoursService;

import java.awt.Desktop;
import java.net.URI;
import java.net.URISyntaxException;
import java.sql.Timestamp;
import java.time.ZoneId;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.Comparator;
import java.util.List;
import java.util.Optional;
import java.util.stream.Collectors;

public class AdminCoursController {
    private static final DateTimeFormatter DATE_FORMAT =
            DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm");

    @FXML private TextField coursSearchField;
    @FXML private ComboBox<String> coursSortComboBox;
    @FXML private VBox coursCardsBox;
    @FXML private Label coursCountLabel;
    @FXML private TabPane adminTabPane;
    @FXML private Tab coursesTab;

    @FXML private Label detailCourseTitle;
    @FXML private Label detailCourseMeta;
    @FXML private Label detailCourseDescription;
    @FXML private Button detailAddChapterBtn;
    @FXML private Button detailEditBtn;
    @FXML private Button detailDeleteBtn;
    @FXML private VBox detailMaterialsBox;
    @FXML private Label detailEmptyLabel;

    @FXML private TextField chapitreSearchField;
    @FXML private ComboBox<Cours> chapitreCoursFilter;
    @FXML private VBox chapitreCardsBox;
    @FXML private Label chapitreCountLabel;

    @FXML private Label statusLabel;

    private final CoursService coursService = new CoursService();
    private final ChapitreService chapitreService = new ChapitreService();
    private final ObservableList<Cours> allCours = FXCollections.observableArrayList();
    private final ObservableList<Chapitre> allChapitres = FXCollections.observableArrayList();
    private final ObservableList<Cours> filteredCours = FXCollections.observableArrayList();
    private final ObservableList<Chapitre> filteredChapitres = FXCollections.observableArrayList();
    private final Cours allCoursesOption = new Cours(0, "All courses", "", null, 0);

    private Cours detailCourse;

    @FXML
    public void initialize() {
        if (coursSortComboBox != null) {
            coursSortComboBox.setItems(FXCollections.observableArrayList(
                    "Newest First", "Oldest First", "Title (A-Z)", "Title (Z-A)"
            ));
            coursSortComboBox.getSelectionModel().select("Newest First");
            coursSortComboBox.valueProperty().addListener((obs, oldVal, newVal) -> applyCoursFilter());
        }

        coursSearchField.textProperty().addListener((obs, oldValue, newValue) -> applyCoursFilter());
        chapitreSearchField.textProperty().addListener((obs, oldValue, newValue) -> applyChapitreFilter());
        chapitreCoursFilter.valueProperty().addListener((obs, oldValue, newValue) -> applyChapitreFilter());

        clearCourseDetails();
        refreshAll();
    }

    @FXML
    public void refreshAll() {
        int detailCourseId = detailCourse == null ? -1 : detailCourse.getId();
        int selectedFilterId = chapitreCoursFilter.getValue() == null ? 0 : chapitreCoursFilter.getValue().getId();

        allCours.setAll(coursService.getAllCours());
        allChapitres.setAll(chapitreService.getAllChapitres());

        rebuildCourseFilter(selectedFilterId);
        applyCoursFilter();
        applyChapitreFilter();
        restoreCourseDetails(detailCourseId);

        status("Loaded " + allCours.size() + " courses and " + allChapitres.size() + " chapters.");
    }

    @FXML
    public void addCours() {
        Cours created = showCoursDialog("Add course", null);
        if (created == null) {
            return;
        }

        coursService.addCours(created);
        refreshAll();
        status("Course added.");
    }

    @FXML
    public void addChapitre() {
        if (allCours.isEmpty()) {
            showWarning("Create a course before adding chapters.");
            return;
        }

        Chapitre created = showChapitreDialog("Add chapter", null);
        if (created == null) {
            return;
        }

        int createdId = chapitreService.addChapitre(created);
        if (createdId <= 0) {
            showWarning("The chapter could not be saved. Check the database configuration and try again.");
            return;
        }

        refreshAll();
        showCourseDetails(findCoursById(created.getCoursId()));
        status("Chapter added.");
    }

    @FXML
    public void editSelectedCours() {
        if (detailCourse == null) {
            showWarning("Select a course details card first.");
            return;
        }
        editCours(detailCourse);
    }

    @FXML
    public void deleteSelectedCours() {
        if (detailCourse == null) {
            showWarning("Select a course details card first.");
            return;
        }
        deleteCours(detailCourse);
    }

    @FXML
    public void addChapterForSelectedCourse() {
        if (detailCourse == null) {
            showWarning("Select a course details card first.");
            return;
        }

        Chapitre created = showChapitreDialog("Add chapter", null, detailCourse, true);
        if (created == null) {
            return;
        }

        int createdId = chapitreService.addChapitre(created);
        if (createdId <= 0) {
            showWarning("The chapter could not be saved. Check the database configuration and try again.");
            return;
        }

        refreshAll();
        showCourseDetails(findCoursById(created.getCoursId()));
        status("Chapter added to " + safe(created.getCoursTitre(), "the selected course") + ".");
    }

    private void applyCoursFilter() {
        String query = safe(coursSearchField.getText()).trim().toLowerCase();

        Comparator<Cours> comparator = Comparator.comparing(Cours::getCreatedAt, Comparator.nullsLast(Comparator.reverseOrder()));
        if (coursSortComboBox != null && coursSortComboBox.getValue() != null) {
            switch (coursSortComboBox.getValue()) {
                case "Oldest First" -> comparator = Comparator.comparing(Cours::getCreatedAt, Comparator.nullsLast(Comparator.naturalOrder()));
                case "Title (A-Z)" -> comparator = Comparator.comparing(Cours::getTitre, String.CASE_INSENSITIVE_ORDER);
                case "Title (Z-A)" -> comparator = Comparator.comparing(Cours::getTitre, String.CASE_INSENSITIVE_ORDER).reversed();
            }
        }

        List<Cours> out = allCours.stream()
                .filter(cours -> query.isBlank()
                        || safe(cours.getTitre()).toLowerCase().contains(query)
                        || safe(cours.getDescription()).toLowerCase().contains(query))
                .sorted(comparator)
                .collect(Collectors.toList());

        filteredCours.setAll(out);
        renderCoursCards();

        if (coursCountLabel != null) {
            coursCountLabel.setText(filteredCours.size() + " course cards");
        }
    }

    private void applyChapitreFilter() {
        String query = safe(chapitreSearchField.getText()).trim().toLowerCase();
        Cours selectedCourse = chapitreCoursFilter.getValue();

        List<Chapitre> out = allChapitres.stream()
                .filter(chapitre -> query.isBlank()
                        || safe(chapitre.getTitre()).toLowerCase().contains(query)
                        || safe(chapitre.getContenu()).toLowerCase().contains(query)
                        || safe(chapitre.getResourceUrl()).toLowerCase().contains(query)
                        || safe(chapitre.getCoursTitre()).toLowerCase().contains(query))
                .filter(chapitre -> selectedCourse == null
                        || selectedCourse.getId() == 0
                        || chapitre.getCoursId() == selectedCourse.getId())
                .sorted(Comparator.comparing(Chapitre::getCoursTitre, String.CASE_INSENSITIVE_ORDER)
                        .thenComparing(Chapitre::getTitre, String.CASE_INSENSITIVE_ORDER))
                .collect(Collectors.toList());

        filteredChapitres.setAll(out);
        renderChapitreCards();

        if (chapitreCountLabel != null) {
            chapitreCountLabel.setText(filteredChapitres.size() + " chapter cards");
        }
    }

    private void renderCoursCards() {
        coursCardsBox.getChildren().clear();

        if (filteredCours.isEmpty()) {
            coursCardsBox.getChildren().add(createEmptyCard("No courses match your search."));
            return;
        }

        for (Cours cours : filteredCours) {
            coursCardsBox.getChildren().add(createCoursCard(cours));
        }
    }

    private void renderChapitreCards() {
        chapitreCardsBox.getChildren().clear();

        if (filteredChapitres.isEmpty()) {
            chapitreCardsBox.getChildren().add(createEmptyCard("No chapters match the current filters."));
            return;
        }

        for (Chapitre chapitre : filteredChapitres) {
            chapitreCardsBox.getChildren().add(createChapitreCard(chapitre));
        }
    }

    private VBox createCoursCard(Cours cours) {
        VBox card = new VBox(12);
        card.getStyleClass().add("admin-list-card");

        Label title = new Label(safe(cours.getTitre(), "Untitled course"));
        title.getStyleClass().add("admin-card-title");
        title.setWrapText(true);

        Label meta = new Label(buildCourseMeta(cours));
        meta.getStyleClass().add("admin-card-meta");

        Label description = new Label(preview(cours.getDescription(), 180));
        description.getStyleClass().add("admin-card-desc");
        description.setWrapText(true);

        Button detailsBtn = new Button("Details");
        detailsBtn.getStyleClass().add("primary-btn");
        detailsBtn.setOnAction(event -> showCourseDetails(cours));

        Button editBtn = new Button("Edit");
        editBtn.getStyleClass().add("secondary-btn");
        editBtn.setOnAction(event -> editCours(cours));

        Button deleteBtn = new Button("Delete");
        deleteBtn.getStyleClass().add("danger-btn");
        deleteBtn.setOnAction(event -> deleteCours(cours));

        HBox actions = new HBox(10, detailsBtn, editBtn, deleteBtn);
        actions.setAlignment(Pos.CENTER_LEFT);

        if (detailCourse != null && detailCourse.getId() == cours.getId()) {
            card.getStyleClass().add("admin-list-card-active");
        }

        card.getChildren().addAll(title, meta, description, actions);
        return card;
    }

    private VBox createChapitreCard(Chapitre chapitre) {
        VBox card = new VBox(12);
        card.getStyleClass().add("admin-list-card");

        Label title = new Label(safe(chapitre.getTitre(), "Untitled chapter"));
        title.getStyleClass().add("admin-card-title");
        title.setWrapText(true);

        Label course = new Label("Course: " + safe(chapitre.getCoursTitre(), "Unknown"));
        course.getStyleClass().add("admin-card-meta");

        Label content = new Label(preview(chapitre.getContenu(), 180));
        content.getStyleClass().add("admin-card-desc");
        content.setWrapText(true);

        if (!safe(chapitre.getResourceUrl()).isBlank()) {
            Label linkLabel = new Label("Link: " + chapitre.getResourceUrl());
            linkLabel.getStyleClass().add("admin-card-meta");
            linkLabel.setWrapText(true);
            card.getChildren().addAll(title, course, content, linkLabel);
        } else {
            card.getChildren().addAll(title, course, content);
        }

        HBox actions = new HBox(10);
        actions.setAlignment(Pos.CENTER_LEFT);

        Button openCourseBtn = new Button("Open course");
        openCourseBtn.getStyleClass().add("primary-btn");
        openCourseBtn.setOnAction(event -> openCourseFromChapter(chapitre));
        actions.getChildren().add(openCourseBtn);

        if (hasMaterialLink(chapitre)) {
            Button openBtn = new Button("Open material");
            openBtn.getStyleClass().add("primary-btn");
            openBtn.setOnAction(event -> openLink(resolveMaterialLink(chapitre)));
            actions.getChildren().add(openBtn);
        }

        Button editBtn = new Button("Edit");
        editBtn.getStyleClass().add("secondary-btn");
        editBtn.setOnAction(event -> editChapitre(chapitre));

        Button deleteBtn = new Button("Delete");
        deleteBtn.getStyleClass().add("danger-btn");
        deleteBtn.setOnAction(event -> deleteChapitre(chapitre));

        actions.getChildren().addAll(editBtn, deleteBtn);

        if (!safe(chapitre.getAiSummary()).isBlank()) {
            Label summary = new Label("Summary: " + preview(chapitre.getAiSummary(), 140));
            summary.getStyleClass().add("admin-card-summary");
            summary.setWrapText(true);
            card.getChildren().add(summary);
        }

        card.getChildren().add(actions);
        return card;
    }

    private VBox createMaterialCard(Chapitre chapitre) {
        VBox card = new VBox(10);
        card.getStyleClass().add("material-card");

        Label title = new Label(safe(chapitre.getTitre(), "Untitled chapter"));
        title.getStyleClass().add("material-title");
        title.setWrapText(true);

        Label body = new Label(safe(chapitre.getContenu(), "No material provided."));
        body.getStyleClass().add("admin-card-desc");
        body.setWrapText(true);

        card.getChildren().addAll(title, body);

        if (!safe(chapitre.getResourceUrl()).isBlank()) {
            Label linkLabel = new Label("Material link: " + chapitre.getResourceUrl());
            linkLabel.getStyleClass().add("admin-card-meta");
            linkLabel.setWrapText(true);
            card.getChildren().add(linkLabel);
        }

        if (hasMaterialLink(chapitre)) {
            Hyperlink openMaterial = new Hyperlink("Open material");
            openMaterial.setOnAction(event -> openLink(resolveMaterialLink(chapitre)));
            card.getChildren().add(openMaterial);
        }

        if (!safe(chapitre.getAiSummary()).isBlank()) {
            VBox summaryBox = new VBox(6);
            summaryBox.getStyleClass().add("summary-card");

            Label summaryTitle = new Label("Saved summary");
            summaryTitle.getStyleClass().add("summary-title");

            Label summaryBody = new Label(chapitre.getAiSummary());
            summaryBody.setWrapText(true);

            summaryBox.getChildren().addAll(summaryTitle, summaryBody);
            card.getChildren().add(summaryBox);
        }

        return card;
    }

    private VBox createEmptyCard(String text) {
        VBox box = new VBox();
        box.getStyleClass().add("admin-empty-card");

        Label label = new Label(text);
        label.getStyleClass().add("empty-note");
        label.setWrapText(true);

        box.getChildren().add(label);
        return box;
    }

    private void showCourseDetails(Cours cours) {
        detailCourse = cours;
        renderCoursCards();

        if (cours == null) {
            clearCourseDetails();
            return;
        }

        detailCourseTitle.setText(safe(cours.getTitre(), "Untitled course"));
        detailCourseMeta.setText(buildCourseMeta(cours));
        detailCourseDescription.setText(safe(cours.getDescription(), "No description available."));
        if (detailAddChapterBtn != null) {
            detailAddChapterBtn.setDisable(false);
        }
        if (detailEditBtn != null) {
            detailEditBtn.setDisable(false);
        }
        if (detailDeleteBtn != null) {
            detailDeleteBtn.setDisable(false);
        }

        List<Chapitre> materials = allChapitres.stream()
                .filter(chapitre -> chapitre.getCoursId() == cours.getId())
                .sorted(Comparator.comparing(Chapitre::getTitre, String.CASE_INSENSITIVE_ORDER))
                .collect(Collectors.toList());

        detailMaterialsBox.getChildren().clear();

        if (materials.isEmpty()) {
            detailEmptyLabel.setManaged(true);
            detailEmptyLabel.setVisible(true);
            detailEmptyLabel.setText("This course does not have any materials yet.");
            return;
        }

        detailEmptyLabel.setManaged(false);
        detailEmptyLabel.setVisible(false);

        for (Chapitre chapitre : materials) {
            detailMaterialsBox.getChildren().add(createMaterialCard(chapitre));
        }
    }

    private void clearCourseDetails() {
        detailCourse = null;
        detailCourseTitle.setText("Select a course");
        detailCourseMeta.setText("Use a course card's Details button to inspect materials.");
        detailCourseDescription.setText("");
        detailMaterialsBox.getChildren().clear();
        if (detailAddChapterBtn != null) {
            detailAddChapterBtn.setDisable(true);
        }
        if (detailEditBtn != null) {
            detailEditBtn.setDisable(true);
        }
        if (detailDeleteBtn != null) {
            detailDeleteBtn.setDisable(true);
        }
        detailEmptyLabel.setManaged(true);
        detailEmptyLabel.setVisible(true);
        detailEmptyLabel.setText("No course selected.");
    }

    private void restoreCourseDetails(int detailCourseId) {
        if (filteredCours.isEmpty()) {
            clearCourseDetails();
            return;
        }

        Cours selected = filteredCours.stream()
                .filter(cours -> cours.getId() == detailCourseId)
                .findFirst()
                .orElse(filteredCours.get(0));

        showCourseDetails(selected);
    }

    private void openCourseFromChapter(Chapitre chapitre) {
        Cours cours = findCoursById(chapitre.getCoursId());
        if (cours == null) {
            showWarning("The related course could not be loaded.");
            return;
        }

        if (coursSearchField != null) {
            coursSearchField.clear();
        }

        applyCoursFilter();
        showCourseDetails(cours);

        if (adminTabPane != null && coursesTab != null) {
            adminTabPane.getSelectionModel().select(coursesTab);
        }

        status("Opened course details for " + safe(cours.getTitre(), "the selected course") + ".");
    }

    private void editCours(Cours selected) {
        if (selected == null) {
            showWarning("Select a course first.");
            return;
        }

        Cours updated = showCoursDialog("Edit course", selected);
        if (updated == null) {
            return;
        }

        selected.setTitre(updated.getTitre());
        selected.setDescription(updated.getDescription());
        coursService.updateCours(selected);
        refreshAll();
        showCourseDetails(findCoursById(selected.getId()));
        status("Course updated.");
    }

    private void deleteCours(Cours selected) {
        if (selected == null) {
            showWarning("Select a course first.");
            return;
        }

        if (!confirm("Delete course", "Delete '" + safe(selected.getTitre(), "Untitled course") + "' and its chapters?")) {
            return;
        }

        coursService.deleteCours(selected.getId());
        refreshAll();
        status("Course deleted.");
    }

    private void editChapitre(Chapitre selected) {
        if (selected == null) {
            showWarning("Select a chapter first.");
            return;
        }

        Chapitre updated = showChapitreDialog("Edit chapter", selected);
        if (updated == null) {
            return;
        }

        selected.setTitre(updated.getTitre());
        selected.setContenu(updated.getContenu());
        selected.setResourceUrl(updated.getResourceUrl());
        selected.setCoursId(updated.getCoursId());
        selected.setCoursTitre(updated.getCoursTitre());
        selected.setAiSummary(updated.getAiSummary());

        chapitreService.updateChapitre(selected);
        refreshAll();
        showCourseDetails(findCoursById(selected.getCoursId()));
        status("Chapter updated.");
    }

    private void deleteChapitre(Chapitre selected) {
        if (selected == null) {
            showWarning("Select a chapter first.");
            return;
        }

        if (!confirm("Delete chapter", "Delete '" + safe(selected.getTitre(), "Untitled chapter") + "'?")) {
            return;
        }

        int parentCourseId = selected.getCoursId();
        chapitreService.deleteChapitre(selected.getId());
        refreshAll();
        showCourseDetails(findCoursById(parentCourseId));
        status("Chapter deleted.");
    }

    private void rebuildCourseFilter(int selectedId) {
        List<Cours> options = new ArrayList<>();
        options.add(allCoursesOption);
        options.addAll(allCours.stream()
                .sorted(Comparator.comparing(Cours::getTitre, String.CASE_INSENSITIVE_ORDER))
                .collect(Collectors.toList()));

        chapitreCoursFilter.setItems(FXCollections.observableArrayList(options));

        for (Cours option : chapitreCoursFilter.getItems()) {
            if (option.getId() == selectedId) {
                chapitreCoursFilter.getSelectionModel().select(option);
                return;
            }
        }

        chapitreCoursFilter.getSelectionModel().select(allCoursesOption);
    }

    private Cours showCoursDialog(String title, Cours existing) {
        Dialog<Cours> dialog = new Dialog<>();
        dialog.setTitle(title);

        DialogPane pane = dialog.getDialogPane();
        pane.getButtonTypes().addAll(ButtonType.CANCEL, ButtonType.OK);

        TextField tfTitle = new TextField(existing == null ? "" : safe(existing.getTitre()));
        TextArea taDescription = new TextArea(existing == null ? "" : safe(existing.getDescription()));
        taDescription.setWrapText(true);
        taDescription.setPrefRowCount(5);

        GridPane grid = new GridPane();
        grid.setHgap(12);
        grid.setVgap(10);
        grid.setPadding(new Insets(16));
        grid.add(new Label("Title"), 0, 0);
        grid.add(tfTitle, 1, 0);
        grid.add(new Label("Description"), 0, 1);
        grid.add(taDescription, 1, 1);

        tfTitle.setPrefWidth(420);

        pane.setContent(grid);

        Button ok = (Button) pane.lookupButton(ButtonType.OK);
        ok.addEventFilter(javafx.event.ActionEvent.ACTION, event -> {
            String errors = validateCours(tfTitle.getText(), taDescription.getText());
            if (!errors.isBlank()) {
                event.consume();
                showWarning(errors);
            }
        });

        dialog.setResultConverter(buttonType -> {
            if (buttonType != ButtonType.OK) {
                return null;
            }

            Cours cours = new Cours();
            cours.setId(existing == null ? 0 : existing.getId());
            cours.setTitre(tfTitle.getText().trim());
            cours.setDescription(taDescription.getText().trim());
            cours.setCreatedAt(existing == null
                    ? new Timestamp(System.currentTimeMillis())
                    : existing.getCreatedAt());
            cours.setChapterCount(existing == null ? 0 : existing.getChapterCount());
            return cours;
        });

        return dialog.showAndWait().orElse(null);
    }

    private Chapitre showChapitreDialog(String title, Chapitre existing) {
        return showChapitreDialog(title, existing, null, false);
    }

    private Chapitre showChapitreDialog(String title, Chapitre existing, Cours preferredCourse, boolean lockCourseSelection) {
        Dialog<Chapitre> dialog = new Dialog<>();
        dialog.setTitle(title);

        DialogPane pane = dialog.getDialogPane();
        pane.getButtonTypes().addAll(ButtonType.CANCEL, ButtonType.OK);

        TextField tfTitle = new TextField(existing == null ? "" : safe(existing.getTitre()));
        TextArea taContent = new TextArea(existing == null ? "" : safe(existing.getContenu()));
        taContent.setWrapText(true);
        taContent.setPrefRowCount(7);
        TextField tfLink = new TextField(existing == null ? "" : safe(existing.getResourceUrl()));
        tfLink.setPromptText("https://example.com/material");

        ComboBox<Cours> courseBox = new ComboBox<>(FXCollections.observableArrayList(
                allCours.stream()
                        .sorted(Comparator.comparing(Cours::getTitre, String.CASE_INSENSITIVE_ORDER))
                        .collect(Collectors.toList())
        ));

        if (preferredCourse != null) {
            for (Cours cours : courseBox.getItems()) {
                if (cours.getId() == preferredCourse.getId()) {
                    courseBox.getSelectionModel().select(cours);
                    break;
                }
            }
        } else if (existing == null) {
            if (!courseBox.getItems().isEmpty()) {
                courseBox.getSelectionModel().selectFirst();
            }
        } else {
            for (Cours cours : courseBox.getItems()) {
                if (cours.getId() == existing.getCoursId()) {
                    courseBox.getSelectionModel().select(cours);
                    break;
                }
            }
        }
        courseBox.setDisable(lockCourseSelection);

        TextArea taSummary = new TextArea(existing == null ? "" : safe(existing.getAiSummary()));
        taSummary.setWrapText(true);
        taSummary.setPrefRowCount(4);

        GridPane grid = new GridPane();
        grid.setHgap(12);
        grid.setVgap(10);
        grid.setPadding(new Insets(16));
        grid.add(new Label("Course"), 0, 1);
        grid.add(courseBox, 1, 1);
        grid.add(new Label("Content"), 0, 2);
        grid.add(taContent, 1, 2);
        grid.add(new Label("Material link"), 0, 3);
        grid.add(tfLink, 1, 3);
        grid.add(taSummary, 1, 4);

        courseBox.setPrefWidth(420);
        tfLink.setPrefWidth(420);

        pane.setContent(grid);

        Button ok = (Button) pane.lookupButton(ButtonType.OK);
        ok.addEventFilter(javafx.event.ActionEvent.ACTION, event -> {
            String errors = validateChapitre(tfTitle.getText(), taContent.getText(), tfLink.getText(), courseBox.getValue());
            if (!errors.isBlank()) {
                event.consume();
                showWarning(errors);
            }
        });

        dialog.setResultConverter(buttonType -> {
            if (buttonType != ButtonType.OK) {
                return null;
            }

            Cours selectedCourse = courseBox.getValue();
            Chapitre chapitre = new Chapitre();
            chapitre.setId(existing == null ? 0 : existing.getId());
            chapitre.setTitre(tfTitle.getText().trim());
            chapitre.setContenu(taContent.getText().trim());
            chapitre.setResourceUrl(normalizeUrl(tfLink.getText()));
            chapitre.setCoursId(selectedCourse.getId());
            chapitre.setCoursTitre(selectedCourse.getTitre());
            chapitre.setAiSummary(taSummary.getText().trim());
            return chapitre;
        });

        return dialog.showAndWait().orElse(null);
    }

    private String validateCours(String title, String description) {
        StringBuilder sb = new StringBuilder();

        if (title == null || title.trim().isEmpty()) {
            sb.append("Course title is required.\n");
        } else if (title.trim().length() < 5) {
            sb.append("Course title must be at least 5 characters.\n");
        }

        if (description == null || description.trim().isEmpty()) {
            sb.append("Course description is required.\n");
        }

        return sb.toString().trim();
    }

    private String validateChapitre(String title, String content, String resourceUrl, Cours selectedCourse) {
        StringBuilder sb = new StringBuilder();

        if (title == null || title.trim().isEmpty()) {
            sb.append("Chapter title is required.\n");
        } else if (title.trim().length() < 3) {
            sb.append("Chapter title must be at least 3 characters.\n");
        }

        if (content == null || content.trim().isEmpty()) {
            sb.append("Chapter content is required.\n");
        }

        if (resourceUrl != null && !resourceUrl.trim().isEmpty() && !isUrl(resourceUrl)) {
            sb.append("Material link must start with http:// or https:// and be valid.\n");
        }

        if (selectedCourse == null) {
            sb.append("Choose a parent course.\n");
        }

        return sb.toString().trim();
    }

    private boolean confirm(String title, String message) {
        Alert alert = new Alert(Alert.AlertType.CONFIRMATION, message, ButtonType.OK, ButtonType.CANCEL);
        alert.setTitle(title);
        alert.setHeaderText(null);
        Optional<ButtonType> result = alert.showAndWait();
        return result.isPresent() && result.get() == ButtonType.OK;
    }

    private void showWarning(String message) {
        Alert alert = new Alert(Alert.AlertType.WARNING, message, ButtonType.OK);
        alert.setTitle("Validation");
        alert.setHeaderText(null);
        alert.showAndWait();
    }

    private void openLink(String url) {
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

    private Cours findCoursById(int id) {
        return allCours.stream()
                .filter(cours -> cours.getId() == id)
                .findFirst()
                .orElse(null);
    }

    private boolean isUrl(String value) {
        String text = safe(value).trim();
        if (text.isBlank()) {
            return false;
        }
        try {
            URI uri = new URI(text);
            String scheme = uri.getScheme();
            return ("http".equalsIgnoreCase(scheme) || "https".equalsIgnoreCase(scheme))
                    && uri.getHost() != null;
        } catch (URISyntaxException e) {
            return false;
        }
    }

    private boolean hasMaterialLink(Chapitre chapitre) {
        return !resolveMaterialLink(chapitre).isBlank();
    }

    private String resolveMaterialLink(Chapitre chapitre) {
        String directLink = safe(chapitre.getResourceUrl()).trim();
        if (isUrl(directLink)) {
            return directLink;
        }

        String contentValue = safe(chapitre.getContenu()).trim();
        if (isUrl(contentValue)) {
            return contentValue;
        }

        return "";
    }

    private String normalizeUrl(String value) {
        String text = safe(value).trim();
        return text.isBlank() ? "" : text;
    }

    private String buildCourseMeta(Cours cours) {
        return formatTimestamp(cours.getCreatedAt()) + " | " + cours.getChapterCount() + " materials";
    }

    private void status(String message) {
        if (statusLabel != null) {
            statusLabel.setText(message == null ? "" : message);
        }
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

    private String formatTimestamp(Timestamp timestamp) {
        if (timestamp == null) {
            return "Date unavailable";
        }
        return DATE_FORMAT.format(timestamp.toInstant().atZone(ZoneId.systemDefault()).toLocalDateTime());
    }
}