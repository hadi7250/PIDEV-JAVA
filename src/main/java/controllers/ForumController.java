package controllers;

import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.geometry.Pos;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.ButtonType;
import javafx.scene.control.ComboBox;
import javafx.scene.control.Label;
import javafx.scene.control.ScrollPane;
import javafx.scene.control.TextArea;
import javafx.scene.control.TextField;
import javafx.scene.layout.HBox;
import javafx.scene.layout.Region;
import javafx.scene.layout.VBox;
import models.ForumCategory;
import models.ForumDiscussion;
import models.ForumMessage;
import services.ForumCategoryService;
import services.ForumDiscussionService;
import services.ForumMessageService;

import java.sql.Timestamp;
import java.time.ZoneId;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.Comparator;
import java.util.List;
import java.util.stream.Collectors;

public class ForumController {
    private static final DateTimeFormatter DATE_FORMAT =
            DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm");

    @FXML private TextField searchField;
    @FXML private ComboBox<ForumCategory> categoryFilter;
    @FXML private VBox discussionCardsBox;
    @FXML private Label totalLabel;

    @FXML private Label selectedTitle;
    @FXML private Label selectedMeta;
    @FXML private Label selectedContent;
    @FXML private Label lockedNotice;
    @FXML private Label emptyStateLabel;
    @FXML private ScrollPane messagesScroll;
    @FXML private VBox messagesBox;

    @FXML private TextField replyAuthorField;
    @FXML private TextArea replyContentArea;
    @FXML private Button postReplyBtn;

    private final ForumCategoryService categoryService = new ForumCategoryService();
    private final ForumDiscussionService discussionService = new ForumDiscussionService();
    private final ForumMessageService messageService = new ForumMessageService();

    private final ObservableList<ForumCategory> allCategories = FXCollections.observableArrayList();
    private final ObservableList<ForumDiscussion> allDiscussions = FXCollections.observableArrayList();
    private final ObservableList<ForumDiscussion> filteredDiscussions = FXCollections.observableArrayList();

    private final ForumCategory allCategoriesOption =
            new ForumCategory(0, "All categories", "", null, null, null, 0);

    private ForumDiscussion selectedDiscussion;

    @FXML
    public void initialize() {
        searchField.textProperty().addListener((obs, o, n) -> applyFilter());
        categoryFilter.valueProperty().addListener((obs, o, n) -> applyFilter());

        clearDetail();
        onRefresh();
    }

    @FXML
    public void onRefresh() {
        int selectedCatId = categoryFilter.getValue() == null ? 0 : categoryFilter.getValue().getId();
        int selectedDiscId = selectedDiscussion == null ? -1 : selectedDiscussion.getId();

        allCategories.setAll(categoryService.getAllCategories());
        allDiscussions.setAll(discussionService.getAllDiscussions());

        rebuildCategoryFilter(selectedCatId);
        applyFilter();

        if (selectedDiscId > 0) {
            allDiscussions.stream()
                    .filter(d -> d.getId() == selectedDiscId)
                    .findFirst()
                    .ifPresentOrElse(this::showDiscussion, this::clearDetail);
        }
    }

    private void rebuildCategoryFilter(int selectedId) {
        List<ForumCategory> options = new ArrayList<>();
        options.add(allCategoriesOption);
        options.addAll(allCategories.stream()
                .sorted(Comparator.comparing(ForumCategory::getName, String.CASE_INSENSITIVE_ORDER))
                .collect(Collectors.toList()));

        categoryFilter.setItems(FXCollections.observableArrayList(options));

        for (ForumCategory o : categoryFilter.getItems()) {
            if (o.getId() == selectedId) {
                categoryFilter.getSelectionModel().select(o);
                return;
            }
        }
        categoryFilter.getSelectionModel().select(allCategoriesOption);
    }

    private void applyFilter() {
        String query = safe(searchField.getText()).trim().toLowerCase();
        ForumCategory cat = categoryFilter.getValue();

        List<ForumDiscussion> out = allDiscussions.stream()
                .filter(d -> query.isBlank()
                        || safe(d.getTitle()).toLowerCase().contains(query)
                        || safe(d.getContent()).toLowerCase().contains(query)
                        || safe(d.getAuthorName()).toLowerCase().contains(query))
                .filter(d -> cat == null || cat.getId() == 0 || d.getCategoryId() == cat.getId())
                .sorted(Comparator.comparing(ForumDiscussion::isPinned).reversed()
                        .thenComparing(ForumDiscussion::getCreatedAt,
                                Comparator.nullsLast(Comparator.reverseOrder())))
                .collect(Collectors.toList());

        filteredDiscussions.setAll(out);
        renderDiscussionCards();

        if (totalLabel != null) {
            totalLabel.setText(filteredDiscussions.size() + " discussion"
                    + (filteredDiscussions.size() == 1 ? "" : "s"));
        }
    }

    private void renderDiscussionCards() {
        discussionCardsBox.getChildren().clear();
        if (filteredDiscussions.isEmpty()) {
            Label empty = new Label("No discussions match your filters.");
            empty.getStyleClass().add("empty-note");
            empty.setWrapText(true);
            discussionCardsBox.getChildren().add(empty);
            return;
        }
        for (ForumDiscussion d : filteredDiscussions) {
            discussionCardsBox.getChildren().add(buildDiscussionCard(d));
        }
    }

    private VBox buildDiscussionCard(ForumDiscussion d) {
        VBox card = new VBox(8);
        card.getStyleClass().add("admin-list-card");

        String prefix = (d.isPinned() ? "\uD83D\uDCCC " : "") + (d.isLocked() ? "\uD83D\uDD12 " : "");
        Label title = new Label(prefix + safe(d.getTitle(), "Untitled"));
        title.getStyleClass().add("admin-card-title");
        title.setWrapText(true);

        Label meta = new Label("By " + safe(d.getAuthorName(), "Anonymous")
                + " \u2022 " + safe(d.getCategoryName(), "No category")
                + " \u2022 " + d.getMessageCount() + " replies \u2022 " + d.getViews() + " views");
        meta.getStyleClass().add("admin-card-meta");

        Label preview = new Label(preview(d.getContent(), 140));
        preview.getStyleClass().add("admin-card-desc");
        preview.setWrapText(true);

        Button openBtn = new Button("Open");
        openBtn.getStyleClass().add("primary-btn");
        openBtn.setOnAction(e -> showDiscussion(d));

        HBox actions = new HBox(10, openBtn);
        actions.setAlignment(Pos.CENTER_LEFT);

        if (selectedDiscussion != null && selectedDiscussion.getId() == d.getId()) {
            card.getStyleClass().add("admin-list-card-active");
        }

        card.getChildren().addAll(title, meta, preview, actions);
        return card;
    }

    private void showDiscussion(ForumDiscussion d) {
        selectedDiscussion = d;

        // increment view counter (async is overkill for this scope)
        discussionService.incrementViews(d.getId());
        d.setViews(d.getViews() + 1);
        renderDiscussionCards();

        String prefix = (d.isPinned() ? "\uD83D\uDCCC " : "") + (d.isLocked() ? "\uD83D\uDD12 " : "");
        selectedTitle.setText(prefix + safe(d.getTitle(), "Untitled"));
        selectedMeta.setText("By " + safe(d.getAuthorName(), "Anonymous")
                + " \u2022 " + safe(d.getCategoryName(), "No category")
                + " \u2022 " + formatTimestamp(d.getCreatedAt())
                + " \u2022 " + d.getViews() + " views");
        selectedContent.setText(safe(d.getContent(), ""));

        if (d.isLocked()) {
            lockedNotice.setText("\uD83D\uDD12 Locked \u2014 replies disabled");
            postReplyBtn.setDisable(true);
            replyContentArea.setDisable(true);
            replyAuthorField.setDisable(true);
        } else {
            lockedNotice.setText("");
            postReplyBtn.setDisable(false);
            replyContentArea.setDisable(false);
            replyAuthorField.setDisable(false);
        }

        renderMessages();
    }

    private void renderMessages() {
        messagesBox.getChildren().clear();
        if (selectedDiscussion == null) {
            emptyStateLabel.setManaged(true);
            emptyStateLabel.setVisible(true);
            emptyStateLabel.setText("No discussion selected.");
            return;
        }

        List<ForumMessage> messages = messageService.getMessagesByDiscussion(selectedDiscussion.getId());

        if (messages.isEmpty()) {
            emptyStateLabel.setManaged(true);
            emptyStateLabel.setVisible(true);
            emptyStateLabel.setText("Be the first to reply to this discussion.");
            return;
        }

        emptyStateLabel.setManaged(false);
        emptyStateLabel.setVisible(false);

        for (ForumMessage m : messages) {
            messagesBox.getChildren().add(buildMessageCard(m));
        }
    }

    private VBox buildMessageCard(ForumMessage m) {
        VBox card = new VBox(6);
        card.getStyleClass().add("material-card");

        Label header = new Label(safe(m.getAuthorName(), "Anonymous")
                + (m.isAuthor() ? " (author)" : "")
                + " \u2022 " + formatTimestamp(m.getCreatedAt()));
        header.getStyleClass().add("admin-card-meta");

        Label body = new Label(safe(m.getContent(), ""));
        body.setWrapText(true);

        HBox voteRow = new HBox(10);
        voteRow.setAlignment(Pos.CENTER_LEFT);
        Label votes = new Label("\u25B2 " + m.getUpvotes() + "   \u25BC " + m.getDownvotes());
        votes.getStyleClass().add("admin-card-meta");

        Button up = new Button("Upvote");
        up.getStyleClass().add("secondary-btn");
        up.setOnAction(e -> {
            messageService.upvote(m.getId());
            renderMessages();
        });

        Button down = new Button("Downvote");
        down.getStyleClass().add("secondary-btn");
        down.setOnAction(e -> {
            messageService.downvote(m.getId());
            renderMessages();
        });

        voteRow.getChildren().addAll(votes, new Region(), up, down);
        HBox.setHgrow(voteRow.getChildren().get(1), javafx.scene.layout.Priority.ALWAYS);

        card.getChildren().addAll(header, body, voteRow);
        return card;
    }

    @FXML
    public void postReply() {
        if (selectedDiscussion == null) {
            showWarning("Select a discussion first.");
            return;
        }
        if (selectedDiscussion.isLocked()) {
            showWarning("This discussion is locked.");
            return;
        }
        String author = safe(replyAuthorField.getText()).trim();
        String content = safe(replyContentArea.getText()).trim();

        if (author.isEmpty()) { showWarning("Please enter your name."); return; }
        if (content.isEmpty()) { showWarning("Reply content cannot be empty."); return; }

        ForumMessage msg = new ForumMessage(content, author, selectedDiscussion.getId());
        msg.setCreatedAt(new Timestamp(System.currentTimeMillis()));
        int id = messageService.addMessage(msg);
        if (id <= 0) {
            showWarning("Could not save your reply.");
            return;
        }

        replyContentArea.clear();
        onRefresh();
    }

    private void clearDetail() {
        selectedDiscussion = null;
        selectedTitle.setText("Select a discussion");
        selectedMeta.setText("Open a discussion card to see replies.");
        selectedContent.setText("");
        lockedNotice.setText("");
        emptyStateLabel.setManaged(true);
        emptyStateLabel.setVisible(true);
        emptyStateLabel.setText("No discussion selected.");
        messagesBox.getChildren().clear();
        postReplyBtn.setDisable(true);
        replyContentArea.setDisable(true);
        replyAuthorField.setDisable(true);
    }

    // ===== utils =====
    private void showWarning(String msg) {
        Alert a = new Alert(Alert.AlertType.WARNING, msg, ButtonType.OK);
        a.setTitle("Forum");
        a.setHeaderText(null);
        a.showAndWait();
    }

    private String safe(String v) { return v == null ? "" : v; }
    private String safe(String v, String fb) { return v == null || v.isBlank() ? fb : v; }

    private String preview(String v, int max) {
        String s = safe(v);
        if (s.length() <= max) return s;
        return s.substring(0, Math.max(0, max - 3)) + "...";
    }

    private String formatTimestamp(Timestamp ts) {
        if (ts == null) return "Date unavailable";
        return DATE_FORMAT.format(ts.toInstant().atZone(ZoneId.systemDefault()).toLocalDateTime());
    }
}
