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
import javafx.scene.control.ComboBox;
import javafx.scene.control.Dialog;
import javafx.scene.control.DialogPane;
import javafx.scene.control.Label;
import javafx.scene.control.ScrollPane;
import javafx.scene.control.TextArea;
import javafx.scene.control.TextField;
import javafx.scene.layout.GridPane;
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
import java.util.Optional;
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

        HBox actions = new HBox(10);
        actions.setAlignment(Pos.CENTER_LEFT);
        actions.getChildren().add(openBtn);

        // Add edit/delete buttons only for discussions by current user
        // For now, we'll use a simple approach - users can edit if they're the author
        // In a real implementation, this would check against logged-in user
        Button editBtn = new Button("Edit");
        editBtn.getStyleClass().add("secondary-btn");
        editBtn.setOnAction(e -> editDiscussion(d));

        Button deleteBtn = new Button("Delete");
        deleteBtn.getStyleClass().add("danger-btn");
        deleteBtn.setOnAction(e -> deleteDiscussion(d));

        actions.getChildren().addAll(editBtn, deleteBtn);

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
        body.setStyle("-fx-text-fill: #EAF7F3; -fx-font-size: 15px;");

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

        // Add edit/delete buttons for messages
        Button editMsgBtn = new Button("Edit");
        editMsgBtn.getStyleClass().add("secondary-btn");
        editMsgBtn.setOnAction(e -> editMessage(m));

        Button deleteMsgBtn = new Button("Delete");
        deleteMsgBtn.getStyleClass().add("danger-btn");
        deleteMsgBtn.setOnAction(e -> deleteMessage(m));

        voteRow.getChildren().addAll(votes, new Region(), up, down, editMsgBtn, deleteMsgBtn);
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

    @FXML
    public void showCreateDiscussionDialog() {
        ForumDiscussion created = showDiscussionDialog("Create discussion", null);
        if (created == null) return;

        int id = discussionService.addDiscussion(created);
        if (id <= 0) {
            showWarning("The discussion could not be saved.");
            return;
        }
        onRefresh();
        showSuccess("Discussion added.");
    }

    private void editDiscussion(ForumDiscussion discussion) {
        if (discussion == null) return;
        ForumDiscussion updated = showDiscussionDialog("Edit discussion", discussion);
        if (updated == null) return;

        discussion.setTitle(updated.getTitle());
        discussion.setContent(updated.getContent());
        discussion.setAuthorName(updated.getAuthorName());
        discussion.setPinned(updated.isPinned());
        discussion.setLocked(updated.isLocked());
        discussion.setCategoryId(updated.getCategoryId());
        discussion.setCategoryName(updated.getCategoryName());

        discussionService.updateDiscussion(discussion);
        onRefresh();
        showSuccess("Discussion updated.");
    }

    private void deleteDiscussion(ForumDiscussion discussion) {
        if (discussion == null) return;
        if (!confirm("Delete discussion", "Delete '" + safe(discussion.getTitle(), "Untitled")
                + "' and all its messages?")) return;

        discussionService.deleteDiscussion(discussion.getId());
        onRefresh();
        showSuccess("Discussion deleted.");
    }

    private void editMessage(ForumMessage message) {
        if (message == null) return;
        ForumMessage updated = showMessageDialog("Edit message", message);
        if (updated == null) return;

        message.setContent(updated.getContent());
        message.setAuthorName(updated.getAuthorName());
        message.setAuthor(updated.isAuthor());
        messageService.updateMessage(message);
        onRefresh();
        showSuccess("Message updated.");
    }

    private void deleteMessage(ForumMessage message) {
        if (message == null) return;
        if (!confirm("Delete message", "Delete this message permanently?")) return;
        messageService.deleteMessage(message.getId());
        onRefresh();
        showSuccess("Message deleted.");
    }

    private void showSuccess(String message) {
        Alert alert = new Alert(Alert.AlertType.INFORMATION);
        alert.setTitle("Success");
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }

    // ============================================================
    // DIALOGS (reused from AdminForumController)
    // ============================================================

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

        // Author field logic: preserve original author, only allow editing if originally anonymous
        String originalAuthor = existing == null ? "" : safe(existing.getAuthorName());
        boolean isOriginallyAnonymous = originalAuthor.isEmpty() || originalAuthor.equalsIgnoreCase("anonymous");
        
        TextField tfAuthor = new TextField(isOriginallyAnonymous ? "" : originalAuthor);
        tfAuthor.setDisable(!isOriginallyAnonymous); // Only enable editing if originally anonymous
        
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
            
            // Preserve original author if editing existing message, use new author if new message
            if (existing != null) {
                m.setAuthorName(originalAuthor); // Keep original author
                m.setAuthor(existing.isAuthor()); // Keep original author flag
            } else {
                m.setAuthorName(tfAuthor.getText().trim()); // Use new author for new messages
                m.setAuthor(cbIsAuthor.isSelected());
            }
            
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
    // VALIDATION (reused from AdminForumController)
    // ============================================================

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
    // UTILS (reused from AdminForumController)
    // ============================================================

    private boolean confirm(String title, String message) {
        Alert alert = new Alert(Alert.AlertType.CONFIRMATION, message, ButtonType.OK, ButtonType.CANCEL);
        alert.setTitle(title);
        alert.setHeaderText(null);
        Optional<ButtonType> r = alert.showAndWait();
        return r.isPresent() && r.get() == ButtonType.OK;
    }

    }
