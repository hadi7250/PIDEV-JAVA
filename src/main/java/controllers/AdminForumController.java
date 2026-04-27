package controllers;

import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.ButtonType;
import javafx.scene.control.CheckBox;
import javafx.scene.control.ColorPicker;
import javafx.scene.control.ComboBox;
import javafx.scene.control.Dialog;
import javafx.scene.control.DialogPane;
import javafx.scene.control.Label;
import javafx.scene.control.ListView;
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
import javafx.scene.paint.Color;
import models.ForumCategory;
import models.ForumDiscussion;
import models.ForumMessage;
import services.ForumCategoryService;
import services.ForumDiscussionService;
import services.ForumMessageService;
import services.ForumStatsService;

import java.sql.Timestamp;
import java.time.ZoneId;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.Comparator;
import java.util.List;
import java.util.Optional;
import java.util.stream.Collectors;

public class AdminForumController {
    private static final DateTimeFormatter DATE_FORMAT =
            DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm");

    // --- Categories tab ---
    @FXML private TextField categorySearchField;
    @FXML private ComboBox<String> categorySortComboBox;
    @FXML private VBox categoryCardsBox;
    @FXML private Label categoryCountLabel;
    @FXML private TabPane adminTabPane;
    @FXML private Tab categoriesTab;

    @FXML private Label detailCategoryTitle;
    @FXML private Label detailCategoryMeta;
    @FXML private Label detailCategoryDescription;
    @FXML private Button detailAddDiscussionBtn;
    @FXML private Button detailEditBtn;
    @FXML private Button detailDeleteBtn;
    @FXML private VBox detailDiscussionsBox;
    @FXML private Label detailEmptyLabel;

    // --- Discussions tab ---
    @FXML private TextField discussionSearchField;
    @FXML private ComboBox<ForumCategory> discussionCategoryFilter;
    @FXML private VBox discussionCardsBox;
    @FXML private Label discussionCountLabel;

    // --- Messages tab ---
    @FXML private TextField messageSearchField;
    @FXML private ComboBox<ForumDiscussion> messageDiscussionFilter;
    @FXML private VBox messageCardsBox;
    @FXML private Label messageCountLabel;

    // --- Stats tab ---
    @FXML private FlowPane statsFlowPane;

    @FXML private Label statusLabel;

    private final ForumCategoryService categoryService = new ForumCategoryService();
    private final ForumDiscussionService discussionService = new ForumDiscussionService();
    private final ForumMessageService messageService = new ForumMessageService();

    private final ObservableList<ForumCategory> allCategories = FXCollections.observableArrayList();
    private final ObservableList<ForumDiscussion> allDiscussions = FXCollections.observableArrayList();
    private final ObservableList<ForumMessage> allMessages = FXCollections.observableArrayList();
    private final ObservableList<ForumCategory> filteredCategories = FXCollections.observableArrayList();
    private final ObservableList<ForumDiscussion> filteredDiscussions = FXCollections.observableArrayList();
    private final ObservableList<ForumMessage> filteredMessages = FXCollections.observableArrayList();

    private final ForumCategory allCategoriesOption = new ForumCategory(0, "All categories", "", null, null, null, 0);
    private final ForumDiscussion allDiscussionsOption = buildAllDiscussionsOption();

    private ForumCategory detailCategory;

    @FXML
    public void initialize() {
        if (categorySortComboBox != null) {
            categorySortComboBox.setItems(FXCollections.observableArrayList(
                    "Newest First", "Oldest First", "Name (A-Z)", "Name (Z-A)"
            ));
            categorySortComboBox.getSelectionModel().select("Newest First");
            categorySortComboBox.valueProperty().addListener((obs, oldVal, newVal) -> applyCategoryFilter());
        }

        categorySearchField.textProperty().addListener((obs, oldV, newV) -> applyCategoryFilter());
        discussionSearchField.textProperty().addListener((obs, oldV, newV) -> applyDiscussionFilter());
        discussionCategoryFilter.valueProperty().addListener((obs, oldV, newV) -> applyDiscussionFilter());
        messageSearchField.textProperty().addListener((obs, oldV, newV) -> applyMessageFilter());
        messageDiscussionFilter.valueProperty().addListener((obs, oldV, newV) -> applyMessageFilter());

        clearCategoryDetails();
        initStatsTab();
        refreshAll();
    }

    @FXML
    public void refreshAll() {
        int detailId = detailCategory == null ? -1 : detailCategory.getId();
        int selectedCatFilterId = discussionCategoryFilter.getValue() == null ? 0 : discussionCategoryFilter.getValue().getId();
        int selectedDiscFilterId = messageDiscussionFilter.getValue() == null ? 0 : messageDiscussionFilter.getValue().getId();

        allCategories.setAll(categoryService.getAllCategories());
        allDiscussions.setAll(discussionService.getAllDiscussions());
        allMessages.setAll(messageService.getAllMessages());

        rebuildCategoryFilter(selectedCatFilterId);
        rebuildDiscussionFilter(selectedDiscFilterId);
        applyCategoryFilter();
        applyDiscussionFilter();
        applyMessageFilter();
        restoreCategoryDetails(detailId);

        status("Loaded " + allCategories.size() + " categories, " + allDiscussions.size()
                + " discussions, " + allMessages.size() + " messages.");
    }

    // ============================================================
    // CREATE actions
    // ============================================================

    @FXML
    public void addCategory() {
        ForumCategory created = showCategoryDialog("Add category", null);
        if (created == null) return;

        categoryService.addCategory(created);
        refreshAll();
        status("Category added.");
    }

    @FXML
    public void addDiscussion() {
        if (allCategories.isEmpty()) {
            showWarning("Create a category before adding discussions.");
            return;
        }

        ForumDiscussion created = showDiscussionDialog("Add discussion", null);
        if (created == null) return;

        int id = discussionService.addDiscussion(created);
        if (id <= 0) {
            showWarning("The discussion could not be saved.");
            return;
        }
        refreshAll();
        status("Discussion added.");
    }

    @FXML
    public void editSelectedCategory() {
        if (detailCategory == null) {
            showWarning("Select a category first.");
            return;
        }
        editCategory(detailCategory);
    }

    @FXML
    public void deleteSelectedCategory() {
        if (detailCategory == null) {
            showWarning("Select a category first.");
            return;
        }
        deleteCategory(detailCategory);
    }

    @FXML
    public void addDiscussionForSelectedCategory() {
        if (detailCategory == null) {
            showWarning("Select a category first.");
            return;
        }

        ForumDiscussion created = showDiscussionDialog("Add discussion", null, detailCategory, true);
        if (created == null) return;

        int id = discussionService.addDiscussion(created);
        if (id <= 0) {
            showWarning("The discussion could not be saved.");
            return;
        }
        refreshAll();
        showCategoryDetails(findCategoryById(created.getCategoryId()));
        status("Discussion added to " + safe(created.getCategoryName(), "the category") + ".");
    }

    // ============================================================
    // FILTERS
    // ============================================================

    private void applyCategoryFilter() {
        String query = safe(categorySearchField.getText()).trim().toLowerCase();

        Comparator<ForumCategory> comparator = Comparator.comparing(
                ForumCategory::getCreatedAt, Comparator.nullsLast(Comparator.reverseOrder()));
        if (categorySortComboBox != null && categorySortComboBox.getValue() != null) {
            switch (categorySortComboBox.getValue()) {
                case "Oldest First" -> comparator = Comparator.comparing(
                        ForumCategory::getCreatedAt, Comparator.nullsLast(Comparator.naturalOrder()));
                case "Name (A-Z)" -> comparator = Comparator.comparing(
                        ForumCategory::getName, String.CASE_INSENSITIVE_ORDER);
                case "Name (Z-A)" -> comparator = Comparator.comparing(
                        ForumCategory::getName, String.CASE_INSENSITIVE_ORDER).reversed();
            }
        }

        List<ForumCategory> out = allCategories.stream()
                .filter(c -> query.isBlank()
                        || safe(c.getName()).toLowerCase().contains(query)
                        || safe(c.getDescription()).toLowerCase().contains(query))
                .sorted(comparator)
                .collect(Collectors.toList());

        filteredCategories.setAll(out);
        renderCategoryCards();

        if (categoryCountLabel != null) {
            categoryCountLabel.setText(filteredCategories.size() + " category cards");
        }
    }

    private void applyDiscussionFilter() {
        String query = safe(discussionSearchField.getText()).trim().toLowerCase();
        ForumCategory selectedCat = discussionCategoryFilter.getValue();

        List<ForumDiscussion> out = allDiscussions.stream()
                .filter(d -> query.isBlank()
                        || safe(d.getTitle()).toLowerCase().contains(query)
                        || safe(d.getContent()).toLowerCase().contains(query)
                        || safe(d.getAuthorName()).toLowerCase().contains(query)
                        || safe(d.getCategoryName()).toLowerCase().contains(query))
                .filter(d -> selectedCat == null
                        || selectedCat.getId() == 0
                        || d.getCategoryId() == selectedCat.getId())
                .sorted(Comparator.comparing(ForumDiscussion::isPinned).reversed()
                        .thenComparing(ForumDiscussion::getCreatedAt,
                                Comparator.nullsLast(Comparator.reverseOrder())))
                .collect(Collectors.toList());

        filteredDiscussions.setAll(out);
        renderDiscussionCards();

        if (discussionCountLabel != null) {
            discussionCountLabel.setText(filteredDiscussions.size() + " discussion cards");
        }
    }

    private void applyMessageFilter() {
        String query = safe(messageSearchField.getText()).trim().toLowerCase();
        ForumDiscussion selectedDisc = messageDiscussionFilter.getValue();

        List<ForumMessage> out = allMessages.stream()
                .filter(m -> query.isBlank()
                        || safe(m.getContent()).toLowerCase().contains(query)
                        || safe(m.getAuthorName()).toLowerCase().contains(query)
                        || safe(m.getDiscussionTitle()).toLowerCase().contains(query))
                .filter(m -> selectedDisc == null
                        || selectedDisc.getId() == 0
                        || m.getDiscussionId() == selectedDisc.getId())
                .sorted(Comparator.comparing(ForumMessage::getDiscussionTitle,
                                Comparator.nullsLast(String.CASE_INSENSITIVE_ORDER))
                        .thenComparing(ForumMessage::getCreatedAt,
                                Comparator.nullsLast(Comparator.naturalOrder())))
                .collect(Collectors.toList());

        filteredMessages.setAll(out);
        renderMessageCards();

        if (messageCountLabel != null) {
            messageCountLabel.setText(filteredMessages.size() + " message cards");
        }
    }

    // ============================================================
    // CARD RENDERING
    // ============================================================

    private void renderCategoryCards() {
        categoryCardsBox.getChildren().clear();
        if (filteredCategories.isEmpty()) {
            categoryCardsBox.getChildren().add(createEmptyCard("No categories match your search."));
            return;
        }
        for (ForumCategory c : filteredCategories) {
            categoryCardsBox.getChildren().add(createCategoryCard(c));
        }
    }

    private void renderDiscussionCards() {
        discussionCardsBox.getChildren().clear();
        if (filteredDiscussions.isEmpty()) {
            discussionCardsBox.getChildren().add(createEmptyCard("No discussions match the current filters."));
            return;
        }
        for (ForumDiscussion d : filteredDiscussions) {
            discussionCardsBox.getChildren().add(createDiscussionCard(d));
        }
    }

    private void renderMessageCards() {
        messageCardsBox.getChildren().clear();
        if (filteredMessages.isEmpty()) {
            messageCardsBox.getChildren().add(createEmptyCard("No messages match the current filters."));
            return;
        }
        for (ForumMessage m : filteredMessages) {
            messageCardsBox.getChildren().add(createMessageCard(m));
        }
    }

    private VBox createCategoryCard(ForumCategory c) {
        VBox card = new VBox(12);
        card.getStyleClass().add("admin-list-card");
        if (c.getColor() != null && !c.getColor().isBlank()) {
            card.setStyle("-fx-border-color:" + c.getColor() + "; -fx-border-width:0 0 0 4;");
        }

        Label title = new Label(safe(c.getName(), "Untitled category"));
        title.getStyleClass().add("admin-card-title");
        title.setWrapText(true);

        Label meta = new Label(buildCategoryMeta(c));
        meta.getStyleClass().add("admin-card-meta");

        Label desc = new Label(preview(c.getDescription(), 180));
        desc.getStyleClass().add("admin-card-desc");
        desc.setWrapText(true);

        Button detailsBtn = new Button("Details");
        detailsBtn.getStyleClass().add("primary-btn");
        detailsBtn.setOnAction(e -> showCategoryDetails(c));

        Button editBtn = new Button("Edit");
        editBtn.getStyleClass().add("secondary-btn");
        editBtn.setOnAction(e -> editCategory(c));

        Button deleteBtn = new Button("Delete");
        deleteBtn.getStyleClass().add("danger-btn");
        deleteBtn.setOnAction(e -> deleteCategory(c));

        HBox actions = new HBox(10, detailsBtn, editBtn, deleteBtn);
        actions.setAlignment(Pos.CENTER_LEFT);

        if (detailCategory != null && detailCategory.getId() == c.getId()) {
            card.getStyleClass().add("admin-list-card-active");
        }

        card.getChildren().addAll(title, meta, desc, actions);
        return card;
    }

    private VBox createDiscussionCard(ForumDiscussion d) {
        VBox card = new VBox(12);
        card.getStyleClass().add("admin-list-card");

        String prefix = (d.isPinned() ? "\uD83D\uDCCC " : "") + (d.isLocked() ? "\uD83D\uDD12 " : "");
        String solvedIndicator = d.isSolved() ? " ✔ Solved" : "";
        Label title = new Label(prefix + safe(d.getTitle(), "Untitled discussion") + solvedIndicator);
        title.getStyleClass().add("admin-card-title");
        title.setWrapText(true);

        Label meta = new Label("By " + safe(d.getAuthorName(), "Anonymous")
                + " | " + safe(d.getCategoryName(), "No category")
                + " | " + formatTimestamp(d.getCreatedAt())
                + " | " + d.getViews() + " views | " + d.getMessageCount() + " replies");
        meta.getStyleClass().add("admin-card-meta");

        Label content = new Label(preview(d.getContent(), 180));
        content.getStyleClass().add("admin-card-desc");
        content.setWrapText(true);

        HBox actions = new HBox(10);
        actions.setAlignment(Pos.CENTER_LEFT);

        Button openCategoryBtn = new Button("Open category");
        openCategoryBtn.getStyleClass().add("primary-btn");
        openCategoryBtn.setOnAction(e -> openCategoryFromDiscussion(d));
        actions.getChildren().add(openCategoryBtn);

        Button editBtn = new Button("Edit");
        editBtn.getStyleClass().add("secondary-btn");
        editBtn.setOnAction(e -> editDiscussion(d));

        Button deleteBtn = new Button("Delete");
        deleteBtn.getStyleClass().add("danger-btn");
        deleteBtn.setOnAction(e -> deleteDiscussion(d));

        // Add Pin/Unpin button
        Button pinBtn = new Button(d.isPinned() ? "📌 Unpin" : "📌 Pin");
        pinBtn.getStyleClass().add("secondary-btn");
        pinBtn.setOnAction(e -> togglePin(d));

        // Add Solve/Unsolve button
        Button solveBtn = new Button(d.isSolved() ? "✅ Unsolved" : "✅ Solve");
        solveBtn.getStyleClass().add("secondary-btn");
        solveBtn.setOnAction(e -> toggleSolved(d));

        actions.getChildren().addAll(editBtn, deleteBtn, pinBtn, solveBtn);

        card.getChildren().addAll(title, meta, content, actions);
        return card;
    }

    private void togglePin(ForumDiscussion discussion) {
        boolean newPinnedState = !discussion.isPinned();
        discussionService.togglePinned(discussion.getId(), newPinnedState);
        discussion.setPinned(newPinnedState);
        
        // Refresh the discussion cards to show updated state
        renderDiscussionCards();
    }

    private void toggleSolved(ForumDiscussion discussion) {
        boolean newSolvedState = !discussion.isSolved();
        discussionService.toggleSolved(discussion.getId(), newSolvedState);
        discussion.setSolved(newSolvedState);
        
        // Refresh the discussion cards to show updated state
        renderDiscussionCards();
    }

    private VBox createMessageCard(ForumMessage m) {
        VBox card = new VBox(10);
        card.getStyleClass().add("admin-list-card");

        Label author = new Label(safe(m.getAuthorName(), "Anonymous")
                + (m.isAuthor() ? " (author)" : "")
                + " | " + formatTimestamp(m.getCreatedAt()));
        author.getStyleClass().add("admin-card-meta");

        Label in = new Label("In: " + safe(m.getDiscussionTitle(), "Unknown discussion"));
        in.getStyleClass().add("admin-card-meta");

        Label body = new Label(safe(m.getContent(), ""));
        body.getStyleClass().add("admin-card-desc");
        body.setWrapText(true);

        Label votes = new Label("\u25B2 " + m.getUpvotes() + "   \u25BC " + m.getDownvotes());
        votes.getStyleClass().add("admin-card-meta");

        HBox actions = new HBox(10);
        actions.setAlignment(Pos.CENTER_LEFT);

        Button editBtn = new Button("Edit");
        editBtn.getStyleClass().add("secondary-btn");
        editBtn.setOnAction(e -> editMessage(m));

        Button deleteBtn = new Button("Delete");
        deleteBtn.getStyleClass().add("danger-btn");
        deleteBtn.setOnAction(e -> deleteMessage(m));

        actions.getChildren().addAll(editBtn, deleteBtn);

        card.getChildren().addAll(author, in, body, votes, actions);
        return card;
    }

    private VBox createDiscussionMaterialCard(ForumDiscussion d) {
        VBox card = new VBox(10);
        card.getStyleClass().add("material-card");

        String prefix = (d.isPinned() ? "\uD83D\uDCCC " : "") + (d.isLocked() ? "\uD83D\uDD12 " : "");
        Label title = new Label(prefix + safe(d.getTitle(), "Untitled discussion"));
        title.getStyleClass().add("material-title");
        title.setWrapText(true);

        Label meta = new Label("By " + safe(d.getAuthorName(), "Anonymous")
                + " | " + formatTimestamp(d.getCreatedAt())
                + " | " + d.getViews() + " views | " + d.getMessageCount() + " replies");
        meta.getStyleClass().add("admin-card-meta");

        Label body = new Label(preview(d.getContent(), 240));
        body.getStyleClass().add("admin-card-desc");
        body.setWrapText(true);

        HBox actions = new HBox(10);
        actions.setAlignment(Pos.CENTER_LEFT);

        Button editBtn = new Button("Edit");
        editBtn.getStyleClass().add("secondary-btn");
        editBtn.setOnAction(e -> editDiscussion(d));

        Button deleteBtn = new Button("Delete");
        deleteBtn.getStyleClass().add("danger-btn");
        deleteBtn.setOnAction(e -> deleteDiscussion(d));

        actions.getChildren().addAll(editBtn, deleteBtn);

        card.getChildren().addAll(title, meta, body, actions);
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

    // ============================================================
    // Detail panel (category)
    // ============================================================

    private void showCategoryDetails(ForumCategory c) {
        detailCategory = c;
        renderCategoryCards();

        if (c == null) {
            clearCategoryDetails();
            return;
        }

        detailCategoryTitle.setText(safe(c.getName(), "Untitled category"));
        detailCategoryMeta.setText(buildCategoryMeta(c));
        detailCategoryDescription.setText(safe(c.getDescription(), "No description available."));
        if (detailAddDiscussionBtn != null) detailAddDiscussionBtn.setDisable(false);
        if (detailEditBtn != null) detailEditBtn.setDisable(false);
        if (detailDeleteBtn != null) detailDeleteBtn.setDisable(false);

        List<ForumDiscussion> items = allDiscussions.stream()
                .filter(d -> d.getCategoryId() == c.getId())
                .sorted(Comparator.comparing(ForumDiscussion::isPinned).reversed()
                        .thenComparing(ForumDiscussion::getCreatedAt,
                                Comparator.nullsLast(Comparator.reverseOrder())))
                .collect(Collectors.toList());

        detailDiscussionsBox.getChildren().clear();

        if (items.isEmpty()) {
            detailEmptyLabel.setManaged(true);
            detailEmptyLabel.setVisible(true);
            detailEmptyLabel.setText("This category has no discussions yet.");
            return;
        }

        detailEmptyLabel.setManaged(false);
        detailEmptyLabel.setVisible(false);

        for (ForumDiscussion d : items) {
            detailDiscussionsBox.getChildren().add(createDiscussionMaterialCard(d));
        }
    }

    private void clearCategoryDetails() {
        detailCategory = null;
        detailCategoryTitle.setText("Select a category");
        detailCategoryMeta.setText("Use a category card's Details button to inspect discussions.");
        detailCategoryDescription.setText("");
        detailDiscussionsBox.getChildren().clear();
        if (detailAddDiscussionBtn != null) detailAddDiscussionBtn.setDisable(true);
        if (detailEditBtn != null) detailEditBtn.setDisable(true);
        if (detailDeleteBtn != null) detailDeleteBtn.setDisable(true);
        detailEmptyLabel.setManaged(true);
        detailEmptyLabel.setVisible(true);
        detailEmptyLabel.setText("No category selected.");
    }

    private void restoreCategoryDetails(int id) {
        if (filteredCategories.isEmpty()) {
            clearCategoryDetails();
            return;
        }
        ForumCategory selected = filteredCategories.stream()
                .filter(c -> c.getId() == id)
                .findFirst()
                .orElse(filteredCategories.get(0));
        showCategoryDetails(selected);
    }

    private void openCategoryFromDiscussion(ForumDiscussion d) {
        ForumCategory c = findCategoryById(d.getCategoryId());
        if (c == null) {
            showWarning("The related category could not be loaded.");
            return;
        }
        if (categorySearchField != null) categorySearchField.clear();
        applyCategoryFilter();
        showCategoryDetails(c);
        if (adminTabPane != null && categoriesTab != null) {
            adminTabPane.getSelectionModel().select(categoriesTab);
        }
        status("Opened category details for " + safe(c.getName(), "the selected category") + ".");
    }

    // ============================================================
    // EDIT / DELETE
    // ============================================================

    private void editCategory(ForumCategory selected) {
        if (selected == null) return;
        ForumCategory updated = showCategoryDialog("Edit category", selected);
        if (updated == null) return;

        selected.setName(updated.getName());
        selected.setDescription(updated.getDescription());
        selected.setColor(updated.getColor());
        categoryService.updateCategory(selected);
        refreshAll();
        showCategoryDetails(findCategoryById(selected.getId()));
        status("Category updated.");
    }

    private void deleteCategory(ForumCategory selected) {
        if (selected == null) return;
        if (!confirm("Delete category", "Delete '" + safe(selected.getName(), "Untitled")
                + "'? Discussions in it will be kept but unlinked.")) return;

        categoryService.deleteCategory(selected.getId());
        refreshAll();
        status("Category deleted.");
    }

    private void editDiscussion(ForumDiscussion selected) {
        if (selected == null) return;
        ForumDiscussion updated = showDiscussionDialog("Edit discussion", selected);
        if (updated == null) return;

        selected.setTitle(updated.getTitle());
        selected.setContent(updated.getContent());
        selected.setAuthorName(updated.getAuthorName());
        selected.setPinned(updated.isPinned());
        selected.setLocked(updated.isLocked());
        selected.setCategoryId(updated.getCategoryId());
        selected.setCategoryName(updated.getCategoryName());

        discussionService.updateDiscussion(selected);
        refreshAll();
        showCategoryDetails(findCategoryById(selected.getCategoryId()));
        status("Discussion updated.");
    }

    private void deleteDiscussion(ForumDiscussion selected) {
        if (selected == null) return;
        if (!confirm("Delete discussion", "Delete '" + safe(selected.getTitle(), "Untitled")
                + "' and all its messages?")) return;

        int parentCategoryId = selected.getCategoryId();
        discussionService.deleteDiscussion(selected.getId());
        refreshAll();
        showCategoryDetails(findCategoryById(parentCategoryId));
        status("Discussion deleted.");
    }

    private void editMessage(ForumMessage selected) {
        if (selected == null) return;
        ForumMessage updated = showMessageDialog("Edit message", selected);
        if (updated == null) return;

        selected.setContent(updated.getContent());
        selected.setAuthorName(updated.getAuthorName());
        selected.setAuthor(updated.isAuthor());
        messageService.updateMessage(selected);
        refreshAll();
        status("Message updated.");
    }

    private void deleteMessage(ForumMessage selected) {
        if (selected == null) return;
        if (!confirm("Delete message", "Delete this message permanently?")) return;
        messageService.deleteMessage(selected.getId());
        refreshAll();
        status("Message deleted.");
    }

    // ============================================================
    // Combo rebuild
    // ============================================================

    private void rebuildCategoryFilter(int selectedId) {
        List<ForumCategory> options = new ArrayList<>();
        options.add(allCategoriesOption);
        options.addAll(allCategories.stream()
                .sorted(Comparator.comparing(ForumCategory::getName, String.CASE_INSENSITIVE_ORDER))
                .collect(Collectors.toList()));

        discussionCategoryFilter.setItems(FXCollections.observableArrayList(options));

        for (ForumCategory o : discussionCategoryFilter.getItems()) {
            if (o.getId() == selectedId) {
                discussionCategoryFilter.getSelectionModel().select(o);
                return;
            }
        }
        discussionCategoryFilter.getSelectionModel().select(allCategoriesOption);
    }

    private void rebuildDiscussionFilter(int selectedId) {
        List<ForumDiscussion> options = new ArrayList<>();
        options.add(allDiscussionsOption);
        options.addAll(allDiscussions.stream()
                .sorted(Comparator.comparing(ForumDiscussion::getTitle, String.CASE_INSENSITIVE_ORDER))
                .collect(Collectors.toList()));

        messageDiscussionFilter.setItems(FXCollections.observableArrayList(options));

        for (ForumDiscussion o : messageDiscussionFilter.getItems()) {
            if (o.getId() == selectedId) {
                messageDiscussionFilter.getSelectionModel().select(o);
                return;
            }
        }
        messageDiscussionFilter.getSelectionModel().select(allDiscussionsOption);
    }

    // ============================================================
    // DIALOGS
    // ============================================================

    private ForumCategory showCategoryDialog(String title, ForumCategory existing) {
        Dialog<ForumCategory> dialog = new Dialog<>();
        dialog.setTitle(title);

        DialogPane pane = dialog.getDialogPane();
        pane.getButtonTypes().addAll(ButtonType.CANCEL, ButtonType.OK);

        TextField tfName = new TextField(existing == null ? "" : safe(existing.getName()));
        TextArea taDesc = new TextArea(existing == null ? "" : safe(existing.getDescription()));
        taDesc.setWrapText(true);
        taDesc.setPrefRowCount(5);

        ColorPicker colorPicker = new ColorPicker();
        if (existing != null && existing.getColor() != null && !existing.getColor().isBlank()) {
            try { colorPicker.setValue(Color.web(existing.getColor())); }
            catch (Exception ignored) { colorPicker.setValue(Color.web("#007bff")); }
        } else {
            colorPicker.setValue(Color.web("#007bff"));
        }

        // Error labels
        Label nameErrorLabel = new Label();
        nameErrorLabel.setStyle("-fx-text-fill: #d32f2f; -fx-font-size: 12px;");
        nameErrorLabel.setVisible(false);
        nameErrorLabel.setManaged(false);
        
        Label colorErrorLabel = new Label();
        colorErrorLabel.setStyle("-fx-text-fill: #d32f2f; -fx-font-size: 12px;");
        colorErrorLabel.setVisible(false);
        colorErrorLabel.setManaged(false);

        GridPane grid = new GridPane();
        grid.setHgap(12);
        grid.setVgap(10);
        grid.setPadding(new Insets(16));
        grid.add(new Label("Name"), 0, 0);
        grid.add(tfName, 1, 0);
        grid.add(nameErrorLabel, 1, 1);
        grid.add(new Label("Description"), 0, 2);
        grid.add(taDesc, 1, 2);
        grid.add(new Label("Color"), 0, 3);
        grid.add(colorPicker, 1, 3);
        grid.add(colorErrorLabel, 1, 4);

        tfName.setPrefWidth(420);
        pane.setContent(grid);

        // Real-time validation
        tfName.textProperty().addListener((obs, oldText, newText) -> {
            validateCategoryName(newText.trim(), nameErrorLabel);
            updateOkButton(dialog, tfName, colorPicker, nameErrorLabel, colorErrorLabel);
        });
        
        colorPicker.valueProperty().addListener((obs, oldColor, newColor) -> {
            validateCategoryColor(toHex(newColor), colorErrorLabel);
            updateOkButton(dialog, tfName, colorPicker, nameErrorLabel, colorErrorLabel);
        });

        // Initial validation
        validateCategoryName(tfName.getText().trim(), nameErrorLabel);
        validateCategoryColor(toHex(colorPicker.getValue()), colorErrorLabel);
        updateOkButton(dialog, tfName, colorPicker, nameErrorLabel, colorErrorLabel);

        dialog.setResultConverter(bt -> {
            if (bt != ButtonType.OK) return null;
            ForumCategory c = new ForumCategory();
            c.setId(existing == null ? 0 : existing.getId());
            c.setName(tfName.getText().trim());
            c.setDescription(taDesc.getText().trim());
            c.setColor(toHex(colorPicker.getValue()));
            c.setCreatedAt(existing == null
                    ? new Timestamp(System.currentTimeMillis())
                    : existing.getCreatedAt());
            return c;
        });

        return dialog.showAndWait().orElse(null);
    }

    private ForumDiscussion showDiscussionDialog(String title, ForumDiscussion existing) {
        return showDiscussionDialog(title, existing, null, false);
    }

    private ForumDiscussion showDiscussionDialog(String title, ForumDiscussion existing,
                                                 ForumCategory preferredCategory,
                                                 boolean lockCategory) {
        Dialog<ForumDiscussion> dialog = new Dialog<>();
        dialog.setTitle(title);

        DialogPane pane = dialog.getDialogPane();
        pane.getButtonTypes().addAll(ButtonType.CANCEL, ButtonType.OK);

        TextField tfTitle = new TextField(existing == null ? "" : safe(existing.getTitle()));
        TextField tfAuthor = new TextField(existing == null ? "" : safe(existing.getAuthorName()));
        TextArea taContent = new TextArea(existing == null ? "" : safe(existing.getContent()));
        taContent.setWrapText(true);
        taContent.setPrefRowCount(7);

        ComboBox<ForumCategory> categoryBox = new ComboBox<>(FXCollections.observableArrayList(
                allCategories.stream()
                        .sorted(Comparator.comparing(ForumCategory::getName, String.CASE_INSENSITIVE_ORDER))
                        .collect(Collectors.toList())
        ));

        if (preferredCategory != null) {
            for (ForumCategory c : categoryBox.getItems()) {
                if (c.getId() == preferredCategory.getId()) {
                    categoryBox.getSelectionModel().select(c);
                    break;
                }
            }
        } else if (existing == null) {
            if (!categoryBox.getItems().isEmpty()) {
                categoryBox.getSelectionModel().selectFirst();
            }
        } else {
            for (ForumCategory c : categoryBox.getItems()) {
                if (c.getId() == existing.getCategoryId()) {
                    categoryBox.getSelectionModel().select(c);
                    break;
                }
            }
        }
        categoryBox.setDisable(lockCategory);

        CheckBox cbPinned = new CheckBox("Pinned");
        cbPinned.setSelected(existing != null && existing.isPinned());
        CheckBox cbLocked = new CheckBox("Locked");
        cbLocked.setSelected(existing != null && existing.isLocked());
        HBox flags = new HBox(12, cbPinned, cbLocked);

        GridPane grid = new GridPane();
        grid.setHgap(12);
        grid.setVgap(10);
        grid.setPadding(new Insets(16));
        grid.add(new Label("Title"), 0, 0);        grid.add(tfTitle, 1, 0);
        grid.add(new Label("Author"), 0, 1);       grid.add(tfAuthor, 1, 1);
        grid.add(new Label("Category"), 0, 2);     grid.add(categoryBox, 1, 2);
        grid.add(new Label("Content"), 0, 3);      grid.add(taContent, 1, 3);
        grid.add(new Label("Flags"), 0, 4);        grid.add(flags, 1, 4);

        tfTitle.setPrefWidth(420);
        tfAuthor.setPrefWidth(420);
        categoryBox.setPrefWidth(420);

        pane.setContent(grid);

        Button ok = (Button) pane.lookupButton(ButtonType.OK);
        ok.addEventFilter(javafx.event.ActionEvent.ACTION, ev -> {
            String err = validateDiscussion(tfTitle.getText(), taContent.getText(),
                    tfAuthor.getText(), categoryBox.getValue());
            if (!err.isBlank()) {
                ev.consume();
                showWarning(err);
            }
        });

        dialog.setResultConverter(bt -> {
            if (bt != ButtonType.OK) return null;
            ForumCategory cat = categoryBox.getValue();
            ForumDiscussion d = new ForumDiscussion();
            d.setId(existing == null ? 0 : existing.getId());
            d.setTitle(tfTitle.getText().trim());
            d.setContent(taContent.getText().trim());
            d.setAuthorName(tfAuthor.getText().trim());
            d.setPinned(cbPinned.isSelected());
            d.setLocked(cbLocked.isSelected());
            d.setCategoryId(cat == null ? 0 : cat.getId());
            d.setCategoryName(cat == null ? "" : cat.getName());
            d.setViews(existing == null ? 0 : existing.getViews());
            d.setCreatedAt(existing == null
                    ? new Timestamp(System.currentTimeMillis())
                    : existing.getCreatedAt());
            return d;
        });

        return dialog.showAndWait().orElse(null);
    }

    private ForumMessage showMessageDialog(String title, ForumMessage existing) {
        Dialog<ForumMessage> dialog = new Dialog<>();
        dialog.setTitle(title);

        DialogPane pane = dialog.getDialogPane();
        pane.getButtonTypes().addAll(ButtonType.CANCEL, ButtonType.OK);

        TextField tfAuthor = new TextField(existing == null ? "" : safe(existing.getAuthorName()));
        TextArea taContent = new TextArea(existing == null ? "" : safe(existing.getContent()));
        taContent.setWrapText(true);
        taContent.setPrefRowCount(6);
        CheckBox cbIsAuthor = new CheckBox("Is discussion author");
        cbIsAuthor.setSelected(existing != null && existing.isAuthor());

        GridPane grid = new GridPane();
        grid.setHgap(12);
        grid.setVgap(10);
        grid.setPadding(new Insets(16));
        grid.add(new Label("Author"), 0, 0);    grid.add(tfAuthor, 1, 0);
        grid.add(new Label("Content"), 0, 1);   grid.add(taContent, 1, 1);
        grid.add(new Label("Flag"), 0, 2);      grid.add(cbIsAuthor, 1, 2);

        tfAuthor.setPrefWidth(420);
        pane.setContent(grid);

        Button ok = (Button) pane.lookupButton(ButtonType.OK);
        ok.addEventFilter(javafx.event.ActionEvent.ACTION, ev -> {
            String err = validateMessage(taContent.getText());
            if (!err.isBlank()) {
                ev.consume();
                showWarning(err);
            }
        });

        dialog.setResultConverter(bt -> {
            if (bt != ButtonType.OK) return null;
            ForumMessage m = new ForumMessage();
            m.setId(existing == null ? 0 : existing.getId());
            m.setContent(taContent.getText().trim());
            m.setAuthorName(tfAuthor.getText().trim());
            m.setAuthor(cbIsAuthor.isSelected());
            m.setDiscussionId(existing == null ? 0 : existing.getDiscussionId());
            m.setDiscussionTitle(existing == null ? "" : existing.getDiscussionTitle());
            m.setUpvotes(existing == null ? 0 : existing.getUpvotes());
            m.setDownvotes(existing == null ? 0 : existing.getDownvotes());
            m.setCreatedAt(existing == null ? new Timestamp(System.currentTimeMillis()) : existing.getCreatedAt());
            return m;
        });

        return dialog.showAndWait().orElse(null);
    }

    // ============================================================
    // VALIDATION
    // ============================================================

    private String validateCategory(String name) {
        StringBuilder sb = new StringBuilder();
        if (name == null || name.trim().isEmpty()) sb.append("Category name is required.\n");
        else if (name.trim().length() < 3) sb.append("Category name must be at least 3 characters.\n");
        return sb.toString().trim();
    }

    private String validateDiscussion(String title, String content, String author, ForumCategory cat) {
        StringBuilder sb = new StringBuilder();
        if (title == null || title.trim().isEmpty()) sb.append("Discussion title is required.\n");
        else if (title.trim().length() < 3) sb.append("Title must be at least 3 characters.\n");
        if (content == null || content.trim().isEmpty()) sb.append("Discussion content is required.\n");
        if (author == null || author.trim().isEmpty()) sb.append("Author name is required.\n");
        if (cat == null) sb.append("Choose a parent category.\n");
        return sb.toString().trim();
    }

    private String validateMessage(String content) {
        StringBuilder sb = new StringBuilder();
        if (content == null || content.trim().isEmpty()) sb.append("Message content is required.\n");
        return sb.toString().trim();
    }

    // ============================================================
    // UTILS
    // ============================================================

    private boolean confirm(String title, String message) {
        Alert alert = new Alert(Alert.AlertType.CONFIRMATION, message, ButtonType.OK, ButtonType.CANCEL);
        alert.setTitle(title);
        alert.setHeaderText(null);
        Optional<ButtonType> r = alert.showAndWait();
        return r.isPresent() && r.get() == ButtonType.OK;
    }

    private void showWarning(String message) {
        Alert a = new Alert(Alert.AlertType.WARNING, message, ButtonType.OK);
        a.setTitle("Validation");
        a.setHeaderText(null);
        a.showAndWait();
    }

    private ForumCategory findCategoryById(int id) {
        return allCategories.stream().filter(c -> c.getId() == id).findFirst().orElse(null);
    }

    private String buildCategoryMeta(ForumCategory c) {
        return formatTimestamp(c.getCreatedAt()) + " | " + c.getDiscussionCount() + " discussions";
    }

    private void status(String msg) {
        if (statusLabel != null) statusLabel.setText(msg == null ? "" : msg);
    }

    private String preview(String value, int max) {
        String s = safe(value);
        if (s.length() <= max) return s;
        return s.substring(0, Math.max(0, max - 3)) + "...";
    }

    private String safe(String value) { return value == null ? "" : value; }

    private String safe(String value, String fallback) {
        return value == null || value.isBlank() ? fallback : value;
    }

    private String formatTimestamp(Timestamp ts) {
        if (ts == null) return "Date unavailable";
        return DATE_FORMAT.format(ts.toInstant().atZone(ZoneId.systemDefault()).toLocalDateTime());
    }

    private String toHex(Color color) {
        if (color == null) return null;
        return String.format("#%02X%02X%02X",
                (int) (color.getRed() * 255),
                (int) (color.getGreen() * 255),
                (int) (color.getBlue() * 255));
    }

    private ForumDiscussion buildAllDiscussionsOption() {
        ForumDiscussion d = new ForumDiscussion();
        d.setId(0);
        d.setTitle("All discussions");
        return d;
    }

    // ===== Stats Tab Methods =====
    
    private void initStatsTab() {
        refreshStats();
    }
    
    @FXML
    public void refreshStats() {
        if (statsFlowPane == null) return;
        
        ForumStatsService statsService = ForumStatsService.getInstance();
        statsFlowPane.getChildren().clear();
        
        // Create stats cards
        statsFlowPane.getChildren().add(createStatCard("Total Discussions", String.valueOf(statsService.getTotalDiscussions())));
        statsFlowPane.getChildren().add(createStatCard("Total Messages", String.valueOf(statsService.getTotalMessages())));
        statsFlowPane.getChildren().add(createStatCard("Most Active Category", statsService.getMostActiveCategory()));
        statsFlowPane.getChildren().add(createStatCard("Top Author", statsService.getTopAuthor()));
        statsFlowPane.getChildren().add(createStatCard("Total Votes", String.valueOf(statsService.getTotalVotes())));
        
        // Recent activity card with ListView
        VBox recentActivityCard = createRecentActivityCard(statsService.getRecentActivityLog(5));
        statsFlowPane.getChildren().add(recentActivityCard);
    }
    
    private VBox createStatCard(String title, String value) {
        VBox card = new VBox(8);
        card.getStyleClass().add("stat-card");
        card.setPrefSize(200, 120);
        
        Label valueLabel = new Label(value);
        valueLabel.getStyleClass().add("stat-value");
        
        Label titleLabel = new Label(title);
        titleLabel.getStyleClass().add("stat-title");
        
        card.getChildren().addAll(valueLabel, titleLabel);
        return card;
    }
    
    private VBox createRecentActivityCard(List<String> recentActivities) {
        VBox card = new VBox(8);
        card.getStyleClass().add("stat-card");
        card.setPrefSize(250, 200);
        
        Label titleLabel = new Label("Recent Activity");
        titleLabel.getStyleClass().add("stat-title");
        
        ListView<String> activityList = new ListView<>();
        activityList.getStyleClass().add("activity-list");
        activityList.setItems(FXCollections.observableArrayList(recentActivities));
        
        VBox.setVgrow(activityList, Priority.ALWAYS);
        
        card.getChildren().addAll(titleLabel, activityList);
        return card;
    }

    // ===== Input Validation Methods =====
    
    private void validateCategoryName(String name, Label errorLabel) {
        boolean isValid = true;
        String errorMessage = "";
        
        if (name.isEmpty()) {
            isValid = false;
            errorMessage = "Category name is required.";
        } else if (name.length() < 2) {
            isValid = false;
            errorMessage = "Category name must be at least 2 characters.";
        } else if (name.length() > 50) {
            isValid = false;
            errorMessage = "Category name cannot exceed 50 characters.";
        } else if (!name.matches("[a-zA-ZÀ-ÿ0-9 _-]+")) {
            isValid = false;
            errorMessage = "Category name can only contain letters, numbers, spaces, hyphens, and underscores.";
        }
        
        errorLabel.setText(errorMessage);
        errorLabel.setVisible(!isValid);
        errorLabel.setManaged(!isValid);
    }
    
    private void validateCategoryColor(String color, Label errorLabel) {
        boolean isValid = true;
        String errorMessage = "";
        
        if (color == null || !color.matches("#[0-9A-Fa-f]{6}")) {
            isValid = false;
            errorMessage = "Please select a valid color.";
        }
        
        errorLabel.setText(errorMessage);
        errorLabel.setVisible(!isValid);
        errorLabel.setManaged(!isValid);
    }
    
    private void updateOkButton(Dialog<?> dialog, TextField nameField, ColorPicker colorPicker, 
                              Label nameErrorLabel, Label colorErrorLabel) {
        Button okButton = (Button) dialog.getDialogPane().lookupButton(ButtonType.OK);
        boolean isNameValid = nameErrorLabel.getText().isEmpty();
        boolean isColorValid = colorErrorLabel.getText().isEmpty();
        boolean hasName = !nameField.getText().trim().isEmpty();
        
        okButton.setDisable(!(isNameValid && isColorValid && hasName));
    }
}
