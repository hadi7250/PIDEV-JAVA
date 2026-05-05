package controllers;

import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.Parent;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.ButtonType;
import javafx.scene.control.CheckBox;
import javafx.scene.control.ComboBox;
import javafx.scene.control.Dialog;
import javafx.scene.control.DialogPane;
import javafx.scene.control.Label;
import javafx.scene.control.ListView;
import javafx.scene.control.ScrollPane;
import javafx.scene.control.Separator;
import javafx.scene.control.Tab;
import javafx.scene.control.TabPane;
import javafx.scene.control.TextArea;
import javafx.scene.control.TextField;
import javafx.scene.layout.BorderPane;
import javafx.scene.layout.GridPane;
import javafx.scene.layout.HBox;
import javafx.scene.layout.Priority;
import javafx.scene.layout.Region;
import javafx.scene.layout.StackPane;
import javafx.scene.layout.VBox;
import javafx.scene.shape.Circle;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.stage.Modality;
import javafx.stage.Stage;
import javafx.application.Platform;
import models.ForumCategory;
import models.ForumDiscussion;
import models.ForumMessage;
import services.ForumCategoryService;
import services.ForumDiscussionService;
import services.ForumMessageService;
import services.ForumViewService;
import services.NotificationService;
import services.BadWordFilterService;
import services.ForumReportService;
import utils.SessionManager;

import java.sql.*;
import java.time.ZoneId;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.Comparator;
import java.util.List;
import java.util.Optional;
import java.util.stream.Collectors;
import utils.MyDB;

public class ForumController {
    private static final DateTimeFormatter DATE_FORMAT =
            DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm");

    @FXML private TextField searchField;
    @FXML private ComboBox<ForumCategory> categoryFilter;
    @FXML private VBox discussionCardsBox;
    @FXML private Label totalLabel;
    
    // Filter buttons
    @FXML private Button filterMostViewedBtn;
    @FXML private Button filterMostRepliedBtn;
    @FXML private Button filterNewestBtn;
    @FXML private Button filterPinnedBtn;
    @FXML private Button filterSolvedBtn;

    @FXML private Label selectedTitle;
    @FXML private Label selectedMeta;
    @FXML private TextArea selectedContent;
    @FXML private Label lockedNotice;
    @FXML private Label emptyStateLabel;
    @FXML private ScrollPane messagesScroll;
    @FXML private VBox messagesBox;

    @FXML private TextArea replyContentArea;
    @FXML private Button postReplyBtn;
    @FXML private Button notificationBtn;
    @FXML private Label notificationBadge;
    @FXML private Label badWordWarningLabel;
    @FXML private Label replyContentErrorLabel;

    // Inline reply management
    private VBox currentReplyBox;
    private ForumMessage currentReplyParent;

    private final ForumCategoryService categoryService = new ForumCategoryService();
    private final ForumDiscussionService discussionService = new ForumDiscussionService();
    private final ForumMessageService messageService = new ForumMessageService();

    private final ObservableList<ForumCategory> allCategories = FXCollections.observableArrayList();
    private final ObservableList<ForumDiscussion> allDiscussions = FXCollections.observableArrayList();
    private final ObservableList<ForumDiscussion> filteredDiscussions = FXCollections.observableArrayList();

    private final ForumCategory allCategoriesOption =
            new ForumCategory(0, "All categories", "", null, null, null, 0);

    private ForumDiscussion selectedDiscussion;
    private String currentFilter = "newest"; // Default filter

    @FXML
    public void initialize() {
        searchField.textProperty().addListener((obs, o, n) -> applyFilter());
        categoryFilter.valueProperty().addListener((obs, o, n) -> applyFilter());
        
        // Set up filter button actions
        setupFilterButtons();
        
        // Set default active filter
        setActiveFilter("newest");

        // Setup real-time validation for reply content
        setupReplyContentValidation();

        // Initialize notification badge
        updateNotificationBadge();

        clearDetail();
        onRefresh();
    }

    // ===== Vote Management Methods =====
    
    private String getUserVote(int messageId) {
        if (!SessionManager.getInstance().isLoggedIn()) {
            return null;
        }
        
        int userId = SessionManager.getInstance().getCurrentUserId();
        String query = "SELECT vote_type FROM forum_votes WHERE user_id = ? AND message_id = ?";
        
        try (PreparedStatement pstmt = MyDB.getInstance().getConnection().prepareStatement(query)) {
            pstmt.setInt(1, userId);
            pstmt.setInt(2, messageId);
            ResultSet rs = pstmt.executeQuery();
            
            if (rs.next()) {
                return rs.getString("vote_type");
            }
        } catch (SQLException e) {
            System.err.println("Error checking user vote: " + e.getMessage());
        }
        return null;
    }
    
    private boolean setUserVote(int messageId, String voteType) {
        if (!SessionManager.getInstance().isLoggedIn()) {
            return false;
        }
        
        int userId = SessionManager.getInstance().getCurrentUserId();
        
        // First check if user already voted
        String existingVote = getUserVote(messageId);
        
        if (existingVote != null) {
            // User already voted, remove the vote
            String deleteQuery = "DELETE FROM forum_votes WHERE user_id = ? AND message_id = ?";
            try (PreparedStatement pstmt = MyDB.getInstance().getConnection().prepareStatement(deleteQuery)) {
                pstmt.setInt(1, userId);
                pstmt.setInt(2, messageId);
                pstmt.executeUpdate();
                
                // Vote removed - vote counts will be automatically calculated from forum_votes table
                return true;
            } catch (SQLException e) {
                System.err.println("Error removing vote: " + e.getMessage());
                return false;
            }
        } else {
            // New vote, add it
            String insertQuery = "INSERT INTO forum_votes (user_id, message_id, vote_type) VALUES (?, ?, ?)";
            try (PreparedStatement pstmt = MyDB.getInstance().getConnection().prepareStatement(insertQuery)) {
                pstmt.setInt(1, userId);
                pstmt.setInt(2, messageId);
                pstmt.setString(3, voteType);
                pstmt.executeUpdate();
                
                // Vote added - vote counts will be automatically calculated from forum_votes table
                return true;
            } catch (SQLException e) {
                System.err.println("Error adding vote: " + e.getMessage());
                return false;
            }
        }
    }

    @FXML
    public void onRefresh() {
        int selectedCatId = categoryFilter.getValue() == null ? 0 : categoryFilter.getValue().getId();
        int selectedDiscId = selectedDiscussion == null ? -1 : selectedDiscussion.getId();

        allCategories.setAll(categoryService.getAllCategories());
        allDiscussions.setAll(discussionService.getAllDiscussions());

        rebuildCategoryFilter(selectedCatId);
        applyFilter();

        // Update notification badge
        updateNotificationBadge();

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
        String searchText = safe(searchField.getText()).trim();
        int categoryId = categoryFilter.getValue() != null ? categoryFilter.getValue().getId() : 0;
        
        // Use the new getFilteredDiscussions method
        List<ForumDiscussion> filtered = discussionService.getFilteredDiscussions(categoryId, currentFilter, searchText);
        
        filteredDiscussions.setAll(filtered);
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

        HBox actions = new HBox(8);
        actions.setAlignment(Pos.CENTER_LEFT);
        actions.getStyleClass().add("discussion-card-actions");
        actions.getChildren().add(openBtn);

        // Add edit/delete buttons only for discussions by current user
        if (SessionManager.getInstance().isLoggedIn()) {
            String currentUserFullName = SessionManager.getInstance().getCurrentUserFullName();
            if (currentUserFullName.equals(d.getAuthorName())) {
                Button editBtn = new Button("Edit");
                editBtn.getStyleClass().add("secondary-btn");
                editBtn.setOnAction(e -> editDiscussion(d));

                Button deleteBtn = new Button("Delete");
                deleteBtn.getStyleClass().add("danger-btn");
                deleteBtn.setOnAction(e -> deleteDiscussion(d));

                actions.getChildren().addAll(editBtn, deleteBtn);
            } else {
                // Add Report button for other users' discussions
                Button reportBtn = new Button("🚩 Report");
                reportBtn.getStyleClass().addAll("secondary-btn");
                reportBtn.setStyle("-fx-background-color: rgba(255, 107, 107, 0.2); -fx-border-color: rgba(255, 107, 107, 0.3);");
                reportBtn.setOnAction(e -> showReportDialog(d.getId(), "discussion", d.getTitle()));
                
                actions.getChildren().addAll(reportBtn);
            }
        }

        if (selectedDiscussion != null && selectedDiscussion.getId() == d.getId()) {
            card.getStyleClass().add("admin-list-card-active");
        }

        card.getChildren().addAll(title, meta, preview, actions);
        return card;
    }

    private void showDiscussion(ForumDiscussion d) {
        // CRITICAL FIX: Clear stale state BEFORE setting new discussion
        // This prevents showing messages from previously opened discussion
        messagesBox.getChildren().clear();
        removeCurrentReplyBox();
        currentReplyParent = null;
        
        selectedDiscussion = d;

        // Record unique view for logged-in users
        if (SessionManager.getInstance().isLoggedIn()) {
            int userId = SessionManager.getInstance().getCurrentUserId();
            ForumViewService viewService = ForumViewService.getInstance();
            boolean isNewView = viewService.recordView(userId, d.getId());
            
            // Update view count if this is a new view
            if (isNewView) {
                // Refresh discussion data to get updated view count
                List<ForumDiscussion> discussions = discussionService.getAllDiscussions();
                for (ForumDiscussion disc : discussions) {
                    if (disc.getId() == d.getId()) {
                        d.setViews(disc.getViews());
                        break;
                    }
                }
                renderDiscussionCards();
            }
        }

        String prefix = (d.isPinned() ? "\uD83D\uDCCC " : "") + (d.isLocked() ? "\uD83D\uDD12 " : "");
        selectedTitle.setText(prefix + safe(d.getTitle(), "Untitled"));
        selectedMeta.setText("By " + safe(d.getAuthorName(), "Anonymous")
                + " \u2022 " + safe(d.getCategoryName(), "No category")
                + " \u2022 " + formatTimestamp(d.getCreatedAt())
                + " \u2022 " + d.getViews() + " views");
        selectedContent.setText(safe(d.getContent(), ""));

        if (d.isLocked()) {
            lockedNotice.setText("\uD83D\uDD12 Locked — replies disabled");
            postReplyBtn.setDisable(true);
            replyContentArea.setDisable(true);
        } else {
            lockedNotice.setText("");
            // Only enable reply if user is logged in
            boolean isLoggedIn = SessionManager.getInstance().isLoggedIn();
            postReplyBtn.setDisable(!isLoggedIn);
            replyContentArea.setDisable(!isLoggedIn);
            
            if (!isLoggedIn) {
                lockedNotice.setText("You must be logged in to post replies.");
            }
        }

        renderMessages();
    }

    private VBox buildMessageCard(ForumMessage m) {
        VBox card = new VBox(10);
        card.getStyleClass().addAll("material-card", "message-card");
        card.setPadding(new Insets(16, 20, 16, 20));

        // Create avatar with initials
        String authorName = safe(m.getAuthorName(), "Anonymous");
        String initials = getInitials(authorName);
        Label avatar = createAvatar(initials);
        avatar.getStyleClass().add("message-avatar");
        
        // Create header with avatar
        HBox headerBox = new HBox(10);
        headerBox.setAlignment(Pos.CENTER_LEFT);
        headerBox.getStyleClass().add("message-header");
        headerBox.getChildren().add(avatar);
        
        VBox authorBox = new VBox(2);
        Label authorLabel = new Label(authorName + (m.isAuthor() ? " (author)" : ""));
        authorLabel.getStyleClass().addAll("message-author", "section-header");
        Label dateLabel = new Label(formatTimestamp(m.getCreatedAt()));
        dateLabel.getStyleClass().addAll("message-date", "meta-text");
        authorBox.getChildren().addAll(authorLabel, dateLabel);
        headerBox.getChildren().add(authorBox);

        Label body = new Label(safe(m.getContent(), ""));
        body.setWrapText(true);
        body.getStyleClass().addAll("message-content", "body-text");

        HBox voteRow = new HBox(10);
        voteRow.setAlignment(Pos.CENTER_RIGHT);
        voteRow.getStyleClass().add("message-footer");
        Label votes = new Label("\u25B2 " + m.getUpvotes() + "   \u25BC " + m.getDownvotes());
        votes.getStyleClass().addAll("vote-counter", "meta-text");

        // Check if user has already voted on this message
        String userVote = getUserVote(m.getId());
        
        // Check if current user is the author of this message
        boolean isAuthor = false;
        if (SessionManager.getInstance().isLoggedIn()) {
            String currentUserFullName = SessionManager.getInstance().getCurrentUserFullName();
            isAuthor = currentUserFullName.equals(m.getAuthorName());
        }
        
        Button up = new Button(userVote != null && userVote.equals("up") ? "✓ Upvoted" : "Upvote");
        up.getStyleClass().add("secondary-btn");
        if (userVote != null && userVote.equals("up")) {
            up.getStyleClass().add("vote-active");
        }
        
        // Disable voting buttons if user is the author
        if (isAuthor) {
            up.setDisable(true);
            up.setOpacity(0.4);
        }
        
        up.setOnAction(e -> {
            if (SessionManager.getInstance().isLoggedIn()) {
                setUserVote(m.getId(), "up");
                renderMessages();
            } else {
                showWarning("You must be logged in to vote.");
            }
        });

        Button down = new Button(userVote != null && userVote.equals("down") ? "✓ Downvoted" : "Downvote");
        down.getStyleClass().add("secondary-btn");
        if (userVote != null && userVote.equals("down")) {
            down.getStyleClass().add("vote-active");
        }
        
        // Disable voting buttons if user is the author
        if (isAuthor) {
            down.setDisable(true);
            down.setOpacity(0.4);
        }
        
        down.setOnAction(e -> {
            if (SessionManager.getInstance().isLoggedIn()) {
                setUserVote(m.getId(), "down");
                renderMessages();
            } else {
                showWarning("You must be logged in to vote.");
            }
        });

        // Add reply button for all logged-in users
        Button replyBtn = new Button("💬 Reply");
        replyBtn.getStyleClass().add("secondary-btn");
        replyBtn.setPrefHeight(28);
        replyBtn.setOnAction(e -> {
            if (SessionManager.getInstance().isLoggedIn()) {
                startReplyToMessage(m);
            } else {
                showWarning("You must be logged in to reply.");
            }
        });

        up.setPrefHeight(28);
        down.setPrefHeight(28);

        // Add edit/delete buttons only for messages by current user
        if (SessionManager.getInstance().isLoggedIn()) {
            String currentUserFullName = SessionManager.getInstance().getCurrentUserFullName();
            if (currentUserFullName.equals(m.getAuthorName())) {
                Button editMsgBtn = new Button("Edit");
                editMsgBtn.getStyleClass().add("secondary-btn");
                editMsgBtn.setPrefHeight(28);
                editMsgBtn.setOnAction(e -> editMessage(m));

                Button deleteMsgBtn = new Button("Delete");
                deleteMsgBtn.getStyleClass().add("danger-btn");
                deleteMsgBtn.setPrefHeight(28);
                deleteMsgBtn.setOnAction(e -> deleteMessage(m));

                voteRow.getChildren().addAll(votes, new Region(), replyBtn, up, down, editMsgBtn, deleteMsgBtn);
            } else {
                // Add Report button for other users' messages
                Button reportMsgBtn = new Button("🚩 Report");
                reportMsgBtn.getStyleClass().addAll("secondary-btn");
                reportMsgBtn.setPrefHeight(28);
                reportMsgBtn.setStyle("-fx-background-color: rgba(255, 107, 107, 0.2); -fx-border-color: rgba(255, 107, 107, 0.3);");
                reportMsgBtn.setOnAction(e -> showReportDialog(m.getId(), "message", m.getContent()));
                
                voteRow.getChildren().addAll(votes, new Region(), replyBtn, up, down, reportMsgBtn);
            }
        } else {
            voteRow.getChildren().addAll(votes, new Region(), replyBtn, up, down);
        }
        HBox.setHgrow(voteRow.getChildren().get(1), javafx.scene.layout.Priority.ALWAYS);

        card.getChildren().addAll(headerBox, body, voteRow);
        return card;
    }

    private void setupFilterButtons() {
        filterMostViewedBtn.setOnAction(e -> handleFilterClick("views"));
        filterMostRepliedBtn.setOnAction(e -> handleFilterClick("replies"));
        filterNewestBtn.setOnAction(e -> handleFilterClick("newest"));
        filterPinnedBtn.setOnAction(e -> handleFilterClick("pinned"));
        filterSolvedBtn.setOnAction(e -> handleFilterClick("solved"));
    }

    private void handleFilterClick(String filterType) {
        if (currentFilter.equals(filterType)) {
            // Clicking same filter deactivates it and resets to newest
            setActiveFilter("newest");
        } else {
            setActiveFilter(filterType);
        }
        applyFilter();
    }

    private void setActiveFilter(String filterType) {
        currentFilter = filterType;
        
        // Reset all buttons to inactive filter style
        filterMostViewedBtn.getStyleClass().removeAll("filter-btn-active", "primary-btn");
        filterMostViewedBtn.getStyleClass().addAll("filter-btn", "secondary-btn");
        filterMostRepliedBtn.getStyleClass().removeAll("filter-btn-active", "primary-btn");
        filterMostRepliedBtn.getStyleClass().addAll("filter-btn", "secondary-btn");
        filterNewestBtn.getStyleClass().removeAll("filter-btn-active", "primary-btn");
        filterNewestBtn.getStyleClass().addAll("filter-btn", "secondary-btn");
        filterPinnedBtn.getStyleClass().removeAll("filter-btn-active", "primary-btn");
        filterPinnedBtn.getStyleClass().addAll("filter-btn", "secondary-btn");
        filterSolvedBtn.getStyleClass().removeAll("filter-btn-active", "primary-btn");
        filterSolvedBtn.getStyleClass().addAll("filter-btn", "secondary-btn");
        
        // Set active button to active filter style
        switch (filterType) {
            case "views":
                filterMostViewedBtn.getStyleClass().removeAll("filter-btn", "secondary-btn");
                filterMostViewedBtn.getStyleClass().addAll("filter-btn-active", "primary-btn");
                break;
            case "replies":
                filterMostRepliedBtn.getStyleClass().removeAll("filter-btn", "secondary-btn");
                filterMostRepliedBtn.getStyleClass().addAll("filter-btn-active", "primary-btn");
                break;
            case "newest":
                filterNewestBtn.getStyleClass().removeAll("filter-btn", "secondary-btn");
                filterNewestBtn.getStyleClass().addAll("filter-btn-active", "primary-btn");
                break;
            case "pinned":
                filterPinnedBtn.getStyleClass().removeAll("filter-btn", "secondary-btn");
                filterPinnedBtn.getStyleClass().addAll("filter-btn-active", "primary-btn");
                break;
            case "solved":
                filterSolvedBtn.getStyleClass().removeAll("filter-btn", "secondary-btn");
                filterSolvedBtn.getStyleClass().addAll("filter-btn-active", "primary-btn");
                break;
        }
    }

    /**
     * Starts a reply to a specific message (threaded reply)
     */
    private void renderMessages() {
        if (selectedDiscussion == null) {
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

        // Clear existing messages and any reply boxes
        messagesBox.getChildren().clear();
        removeCurrentReplyBox();

        // Render messages with threaded structure
        for (ForumMessage m : messages) {
            VBox messageCard = buildMessageCard(m);
            messageCard.setUserData(m.getId()); // Store message ID for finding parent
            
            // Check if this message has a parent (is a reply)
            if (m.getParentMessageId() != null) {
                // This is a reply - find its parent and render after it
                VBox parentCard = findMessageCardById(m.getParentMessageId());
                if (parentCard != null) {
                    int parentIndex = messagesBox.getChildren().indexOf(parentCard);
                    if (parentIndex >= 0) {
                        // Insert reply after parent with indentation
                        messagesBox.getChildren().add(parentIndex + 1, messageCard);
                        
                        // Apply indentation style
                        messageCard.setTranslateX(30); // 30px indentation
                        messageCard.setStyle(messageCard.getStyle() + " -fx-border-left: 3px solid #2196f3;");
                    } else {
                        // Fallback: add to end
                        messagesBox.getChildren().add(messageCard);
                    }
                } else {
                    // Fallback: add to end
                    messagesBox.getChildren().add(messageCard);
                }
            } else {
                // This is a top-level message - add normally
                messagesBox.getChildren().add(messageCard);
            }
        }
    }

    private VBox findMessageCardById(int messageId) {
        for (javafx.scene.Node node : messagesBox.getChildren()) {
            if (node instanceof VBox && node.getUserData() instanceof Integer) {
                Integer id = (Integer) node.getUserData();
                if (id.equals(messageId)) {
                    return (VBox) node;
                }
            }
        }
        return null;
    }

    private void startReplyToMessage(ForumMessage parentMessage) {
        if (!SessionManager.getInstance().isLoggedIn()) {
            showWarning("You must be logged in to reply.");
            return;
        }

        // Remove any existing reply box first
        removeCurrentReplyBox();
        
        // Create and inject inline reply box
        createInlineReplyBox(parentMessage);
    }

    private void createInlineReplyBox(ForumMessage parentMessage) {
        // Create reply container
        VBox replyContainer = new VBox(8);
        replyContainer.getStyleClass().add("inline-reply-box");
        replyContainer.setTranslateX(30); // Indent 30px from left

        // Create header
        Label replyHeader = new Label("Replying to " + parentMessage.getAuthorName());
        replyHeader.setStyle("-fx-font-weight: bold; -fx-text-fill: #495057; -fx-font-size: 12px;");
        
        // Create text area
        TextArea replyTextArea = new TextArea();
        replyTextArea.setPrefRowCount(2);
        replyTextArea.setWrapText(true);
        replyTextArea.setPromptText("Write a reply...");
        replyTextArea.setStyle("-fx-background-color: white; -fx-border-color: #ced4da; " +
                          "-fx-border-radius: 4; -fx-border-insets: 0; -fx-padding: 8;");
        
        // Add listener to remove error label when user types
        replyTextArea.textProperty().addListener((obs, oldVal, newVal) -> {
            replyContainer.getChildren().removeIf(n -> n instanceof Label && ((Label)n).getText().contains("inappropriate"));
        });
        
        // Real-time censoring when user finishes typing (loses focus)
        replyTextArea.focusedProperty().addListener((obs, wasFocused, isNowFocused) -> {
            if (!isNowFocused) {
                String censored = BadWordFilterService.getInstance().censor(replyTextArea.getText());
                if (!censored.equals(replyTextArea.getText())) {
                    replyTextArea.setText(censored);
                    replyTextArea.positionCaret(censored.length());
                }
            }
        });
        
        // Create buttons container
        HBox buttonContainer = new HBox(8);
        buttonContainer.setAlignment(Pos.CENTER_RIGHT);
        
        // Create send button
        Button sendButton = new Button("Send");
        sendButton.getStyleClass().add("primary-btn");
        sendButton.setStyle("-fx-font-size: 12px; -fx-padding: 6 12;");
        
        // Create cancel button
        Button cancelButton = new Button("Cancel");
        cancelButton.getStyleClass().add("secondary-btn");
        cancelButton.setStyle("-fx-font-size: 12px; -fx-padding: 6 12;");
        
        // Add button actions
        sendButton.setOnAction(e -> sendInlineReply(parentMessage, replyTextArea, replyContainer));
        cancelButton.setOnAction(e -> removeCurrentReplyBox());
        
        buttonContainer.getChildren().addAll(cancelButton, sendButton);
        
        // Assemble reply box
        replyContainer.getChildren().addAll(replyHeader, replyTextArea, buttonContainer);
        
        // Store references
        currentReplyBox = replyContainer;
        currentReplyParent = parentMessage;
        
        // Inject into messages container
        int parentIndex = messagesBox.getChildren().indexOf(getMessageCard(parentMessage));
        if (parentIndex >= 0) {
            messagesBox.getChildren().add(parentIndex + 1, replyContainer);
        } else {
            messagesBox.getChildren().add(replyContainer);
        }
        
        // Focus and scroll to reply box
        replyTextArea.requestFocus();
        
        // Scroll to reply box
        javafx.application.Platform.runLater(() -> {
            messagesBox.layout();
            // Simple scroll to bottom to show reply box
            messagesBox.requestLayout();
            // Find the ScrollPane parent and scroll to bottom
            javafx.scene.Node parent = messagesBox.getParent();
            while (parent != null && !(parent instanceof javafx.scene.control.ScrollPane)) {
                parent = parent.getParent();
            }
            if (parent instanceof javafx.scene.control.ScrollPane) {
                ((javafx.scene.control.ScrollPane) parent).setVvalue(1.0);
            }
        });
        
        System.out.println("Created inline reply box for message " + parentMessage.getId() + " by " + parentMessage.getAuthorName());
    }

    private void sendInlineReply(ForumMessage parentMessage, TextArea replyTextArea, VBox replyContainer) {
        String content = safe(replyTextArea.getText()).trim();
        
        if (content.isEmpty()) {
            showWarning("Reply content cannot be empty.");
            return;
        }

        // Check for bad words
        BadWordFilterService filterService = BadWordFilterService.getInstance();
        if (filterService.containsBadWord(content)) {
            // Show red error label inside the inline reply box
            Label errorLabel = new Label("⚠ Your reply contains inappropriate content.");
            errorLabel.setStyle("-fx-text-fill: #d32f2f; -fx-font-size: 12px;");
            // Add it to the reply VBox if not already there
            if (replyContainer.getChildren().stream().noneMatch(n -> n instanceof Label && ((Label)n).getText().contains("inappropriate"))) {
                replyContainer.getChildren().add(replyContainer.getChildren().size() - 1, errorLabel);
            }
            return; // do NOT save
        }

        // Get current user info
        String author = SessionManager.getInstance().getCurrentUserFullName();
        
        // Create message with parent reference
        ForumMessage reply = new ForumMessage(content, author, selectedDiscussion.getId());
        reply.setParentMessageId(parentMessage.getId());
        reply.setCreatedAt(new Timestamp(System.currentTimeMillis()));
        
        // Save to database in background thread
        new Thread(() -> {
            try {
                int messageId = messageService.addMessage(reply);
                
                // Update UI on JavaFX thread
                javafx.application.Platform.runLater(() -> {
                    if (messageId > 0) {
                        // Remove reply box
                        removeCurrentReplyBox();
                        
                        // Send notifications
                        sendReplyNotifications(selectedDiscussion, author);
                        
                        // Refresh messages
                        renderMessages();
                        
                        // Update notification badge
                        updateNotificationBadge();
                        
                        System.out.println("Inline reply posted successfully by " + author);
                    } else {
                        showWarning("Could not save your reply.");
                    }
                });
                
            } catch (Exception e) {
                javafx.application.Platform.runLater(() -> {
                    showWarning("Error posting reply: " + e.getMessage());
                });
            }
        }).start();
    }

    private void removeCurrentReplyBox() {
        if (currentReplyBox != null) {
            messagesBox.getChildren().remove(currentReplyBox);
            currentReplyBox = null;
            currentReplyParent = null;
            System.out.println("Removed current reply box");
        }
    }

    private VBox getMessageCard(ForumMessage message) {
        // Find the card for a given message
        for (javafx.scene.Node node : messagesBox.getChildren()) {
            if (node instanceof VBox && node.getUserData() instanceof Integer) {
                Integer messageId = (Integer) node.getUserData();
                if (messageId.equals(message.getId())) {
                    return (VBox) node;
                }
            }
        }
        return null;
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
        
        if (!SessionManager.getInstance().isLoggedIn()) {
            showWarning("You must be logged in to post replies.");
            return;
        }
        
        String content = safe(replyContentArea.getText()).trim();

        if (content.isEmpty()) { 
            showWarning("Reply content cannot be empty."); 
            return; 
        }

        // Check for bad words
        BadWordFilterService filterService = BadWordFilterService.getInstance();
        if (filterService.containsBadWord(content)) {
            // Show bad word warning and don't save
            if (badWordWarningLabel != null) {
                badWordWarningLabel.setText("⚠ Your message contains inappropriate content.");
                badWordWarningLabel.setStyle("-fx-text-fill: #d32f2f; -fx-font-size: 12px;");
                badWordWarningLabel.setVisible(true);
            }
            return; // Don't save the message
        }

        // Clear bad word warning if content is clean
        if (badWordWarningLabel != null) {
            badWordWarningLabel.setVisible(false);
        }

        // Disable post button to prevent double submission
        postReplyBtn.setDisable(true);
        postReplyBtn.setText("Posting...");

        // Use logged-in user's name as author
        String author = SessionManager.getInstance().getCurrentUserFullName();

        ForumMessage msg = new ForumMessage(content, author, selectedDiscussion.getId());
        msg.setCreatedAt(new Timestamp(System.currentTimeMillis()));
        
        // Check if this is a threaded reply
        Object parentMessageId = replyContentArea.getUserData();
        if (parentMessageId != null && parentMessageId instanceof Integer) {
            msg.setParentMessageId((Integer) parentMessageId);
            System.out.println("Creating threaded reply to parent message " + parentMessageId);
        }
        
        // Run in a separate thread to keep UI responsive
        new Thread(() -> {
            try {
                int id = messageService.addMessage(msg);
                
                // Update UI on JavaFX thread
                javafx.application.Platform.runLater(() -> {
                    if (id <= 0) {
                        showWarning("Could not save your reply.");
                    } else {
                        // Clear the reply area
                        replyContentArea.clear();
                        
                        // Send notifications
                        sendReplyNotifications(selectedDiscussion, author);
                        
                        // Refresh the discussion to show the new reply
                        showDiscussion(selectedDiscussion);
                        
                        // Update notification badge
                        updateNotificationBadge();
                        
                        System.out.println("Reply posted successfully by " + author);
                    }
                    
                    // Re-enable the button
                    postReplyBtn.setDisable(false);
                    postReplyBtn.setText("Post Reply");
                });
                
            } catch (Exception e) {
                javafx.application.Platform.runLater(() -> {
                    showWarning("Error posting reply: " + e.getMessage());
                    postReplyBtn.setDisable(false);
                    postReplyBtn.setText("Post Reply");
                });
            }
        }).start();
    }

    @FXML
    public void showNotifications() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/NotificationPanel.fxml"));
            Parent notificationPane = loader.load();
            
            NotificationController notificationController = loader.getController();
            
            Stage stage = new Stage();
            stage.setTitle("Notifications");
            stage.setScene(new Scene(notificationPane));
            stage.initModality(Modality.APPLICATION_MODAL);
            stage.initOwner(notificationBtn.getScene().getWindow());
            stage.setResizable(false);
            
            stage.showAndWait();
            
            // Update notification badge after closing
            updateNotificationBadge();
            
        } catch (Exception e) {
            showWarning("Could not open notifications: " + e.getMessage());
        }
    }

    
    
    // ===== Input Validation Methods =====
    
    private void setupReplyContentValidation() {
        if (replyContentArea != null) {
            replyContentArea.textProperty().addListener((obs, oldText, newText) -> {
                validateReplyContent();
            });
            
            // Real-time censoring when user finishes typing (loses focus)
            replyContentArea.focusedProperty().addListener((obs, wasFocused, isNowFocused) -> {
                if (!isNowFocused) {
                    String censored = BadWordFilterService.getInstance().censor(replyContentArea.getText());
                    if (!censored.equals(replyContentArea.getText())) {
                        replyContentArea.setText(censored);
                        replyContentArea.positionCaret(censored.length());
                    }
                }
            });
        }
    }
    
    private void validateReplyContent() {
        String content = replyContentArea.getText().trim();
        boolean isValid = true;
        String errorMessage = "";
        
        if (content.isEmpty()) {
            isValid = false;
            errorMessage = "Reply content is required.";
        } else if (content.length() < 3) {
            isValid = false;
            errorMessage = "Reply must be at least 3 characters.";
        } else if (content.length() > 1000) {
            isValid = false;
            errorMessage = "Reply cannot exceed 1000 characters.";
        } else {
            // Check for bad words
            BadWordFilterService filterService = BadWordFilterService.getInstance();
            if (filterService.containsBadWord(content)) {
                isValid = false;
                errorMessage = "Reply contains inappropriate content.";
            }
        }
        
        // Update error label
        if (replyContentErrorLabel != null) {
            replyContentErrorLabel.setText(errorMessage);
            replyContentErrorLabel.setVisible(!isValid);
            replyContentErrorLabel.setManaged(!isValid);
        }
        
        // Update submit button state
        if (postReplyBtn != null && selectedDiscussion != null && !selectedDiscussion.isLocked()) {
            boolean isLoggedIn = SessionManager.getInstance().isLoggedIn();
            postReplyBtn.setDisable(!isLoggedIn || !isValid);
        }
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
        if (replyContentErrorLabel != null) {
            replyContentErrorLabel.setVisible(false);
            replyContentErrorLabel.setManaged(false);
        }
    }

    // ===== Notification Methods =====
    private void sendReplyNotifications(ForumDiscussion discussion, String replyAuthor) {
        System.out.println("=== sendReplyNotifications called ===");
        System.out.println("Discussion: " + discussion.getTitle());
        System.out.println("Reply author: " + replyAuthor);
        
        NotificationService notificationService = NotificationService.getInstance();
        
        // Get user ID of the reply author to avoid self-notification
        int replyAuthorId = SessionManager.getInstance().getCurrentUserId();
        System.out.println("Reply author ID: " + replyAuthorId);
        
        // Send notification to discussion author (if they're not the reply author)
        if (!discussion.getAuthorName().equals(replyAuthor)) {
            System.out.println("Discussion author: " + discussion.getAuthorName() + " (different from reply author)");
            int discussionAuthorId = getUserIdByName(discussion.getAuthorName());
            System.out.println("Discussion author ID: " + discussionAuthorId);
            if (discussionAuthorId > 0) {
                notificationService.createDiscussionReplyNotification(
                    discussionAuthorId, 
                    discussion.getTitle(), 
                    discussion.getId(), 
                    replyAuthor
                );
            } else {
                System.out.println("Could not find discussion author ID!");
            }
        } else {
            System.out.println("Reply author is same as discussion author - skipping notification");
        }
        
        // Send notifications to message authors in this discussion (excluding the reply author)
        List<ForumMessage> messages = messageService.getMessagesByDiscussion(discussion.getId());
        for (ForumMessage message : messages) {
            if (!message.getAuthorName().equals(replyAuthor) && !message.getAuthorName().equals(discussion.getAuthorName())) {
                int messageAuthorId = getUserIdByName(message.getAuthorName());
                if (messageAuthorId > 0) {
                    notificationService.createMessageReplyNotification(
                        messageAuthorId,
                        discussion.getTitle(),
                        discussion.getId(),
                        replyAuthor
                    );
                }
            }
        }
    }
    
    private int getUserIdByName(String fullName) {
        System.out.println("Looking up user ID for: '" + fullName + "'");
        
        // Try multiple ways to find the user
        String[] queries = {
            "SELECT id FROM `user` WHERE TRIM(CONCAT(COALESCE(firstName,''), ' ', COALESCE(lastName,''))) = ?",
            "SELECT id FROM `user` WHERE email = ?",
            "SELECT id FROM `user` WHERE firstName = ? OR lastName = ?"
        };
        
        try (Connection conn = MyDB.getInstance().getConnection()) {
            
            for (int i = 0; i < queries.length; i++) {
                System.out.println("Trying query " + (i + 1) + ": " + queries[i]);
                
                try (PreparedStatement stmt = conn.prepareStatement(queries[i])) {
                    
                    if (i == 2) {
                        stmt.setString(1, fullName);
                        stmt.setString(2, fullName);
                    } else {
                        stmt.setString(1, fullName);
                    }
                    
                    ResultSet rs = stmt.executeQuery();
                    
                    if (rs.next()) {
                        int userId = rs.getInt("id");
                        System.out.println("Found user ID: " + userId + " for name: '" + fullName + "' using query " + (i + 1));
                        return userId;
                    }
                } catch (SQLException e) {
                    System.err.println("Error with query " + (i + 1) + ": " + e.getMessage());
                }
            }
            
        } catch (SQLException e) {
            System.err.println("Error getting user ID by name: " + e.getMessage());
            e.printStackTrace();
        }
        
        System.out.println("User ID not found for: '" + fullName + "' after trying all queries");
        
        // Debug: Show all users in the database
        debugUserTable();
        
        return -1; // Not found
    }
    
    private void debugUserTable() {
        System.out.println("=== DEBUG: User Table Contents ===");
        String query = "SELECT id, firstName, lastName, email FROM `user` LIMIT 10";
        
        try (Connection conn = MyDB.getInstance().getConnection();
             PreparedStatement stmt = conn.prepareStatement(query);
             ResultSet rs = stmt.executeQuery()) {
            
            while (rs.next()) {
                System.out.println("ID: " + rs.getInt("id") + 
                    ", First: '" + rs.getString("firstName") + "'" +
                    ", Last: '" + rs.getString("lastName") + "'" +
                    ", Email: '" + rs.getString("email") + "'");
            }
            
        } catch (SQLException e) {
            System.err.println("Error debugging user table: " + e.getMessage());
        }
        System.out.println("=== END DEBUG ===");
    }

    // ===== Notification Methods =====
    private void updateNotificationBadge() {
        // Ensure notification button is always visible
        if (notificationBtn != null) {
            notificationBtn.setVisible(true);
            notificationBtn.setManaged(true);
        }
        
        if (notificationBadge != null) {
            if (!SessionManager.getInstance().isLoggedIn()) {
                notificationBadge.setText("0");
                notificationBadge.setVisible(false);
                return;
            }
            
            int userId = SessionManager.getInstance().getCurrentUserId();
            int unreadCount = NotificationService.getInstance().getUnreadCount(userId);
            
            notificationBadge.setText(String.valueOf(unreadCount));
            notificationBadge.setVisible(unreadCount > 0);
        }
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
        
        // Check if user is logged in
        if (!SessionManager.getInstance().isLoggedIn()) {
            showWarning("You must be logged in to edit discussions.");
            return;
        }
        
        // Check if current user is the author of the discussion
        String currentUserFullName = SessionManager.getInstance().getCurrentUserFullName();
        if (!currentUserFullName.equals(discussion.getAuthorName())) {
            showWarning("You can only edit your own discussions.");
            return;
        }
        
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
        
        // Check if user is logged in
        if (!SessionManager.getInstance().isLoggedIn()) {
            showWarning("You must be logged in to delete discussions.");
            return;
        }
        
        // Check if current user is the author of the discussion
        String currentUserFullName = SessionManager.getInstance().getCurrentUserFullName();
        if (!currentUserFullName.equals(discussion.getAuthorName())) {
            showWarning("You can only delete your own discussions.");
            return;
        }
        
        if (!confirm("Delete discussion", "Delete '" + safe(discussion.getTitle(), "Untitled")
                + "' and all its messages?")) return;

        discussionService.deleteDiscussion(discussion.getId());
        onRefresh();
        showSuccess("Discussion deleted.");
    }

    private void editMessage(ForumMessage message) {
        if (message == null) return;
        
        // Check if user is logged in
        if (!SessionManager.getInstance().isLoggedIn()) {
            showWarning("You must be logged in to edit messages.");
            return;
        }
        
        // Check if current user is the author of the message
        String currentUserFullName = SessionManager.getInstance().getCurrentUserFullName();
        if (!currentUserFullName.equals(message.getAuthorName())) {
            showWarning("You can only edit your own messages.");
            return;
        }
        
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
        
        // Check if user is logged in
        if (!SessionManager.getInstance().isLoggedIn()) {
            showWarning("You must be logged in to delete messages.");
            return;
        }
        
        // Check if current user is the author of the message
        String currentUserFullName = SessionManager.getInstance().getCurrentUserFullName();
        if (!currentUserFullName.equals(message.getAuthorName())) {
            showWarning("You can only delete your own messages.");
            return;
        }
        
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
        // Check if user is logged in for creating new discussions
        if (existing == null && !SessionManager.getInstance().isLoggedIn()) {
            showWarning("You must be logged in to create discussions.");
            return null;
        }
        return showDiscussionDialog(title, existing, null, false);
    }

    private ForumDiscussion showDiscussionDialog(String title, ForumDiscussion existing,
                                                 ForumCategory preferredCategory,
                                                 boolean lockCategory) {
        Dialog<ForumDiscussion> dialog = new Dialog<>();
        dialog.setTitle(title);

        DialogPane pane = dialog.getDialogPane();
        pane.getButtonTypes().addAll(ButtonType.CANCEL, ButtonType.OK);

        // Author is automatically set from SessionManager - not shown in UI
        String authorName = existing == null ? SessionManager.getInstance().getCurrentUserFullName() : safe(existing.getAuthorName());
        
        TextField tfTitle = new TextField(existing == null ? "" : safe(existing.getTitle()));
        TextArea taContent = new TextArea(existing == null ? "" : safe(existing.getContent()));
        taContent.setWrapText(true);
        taContent.setPrefRowCount(7);
        
        // Real-time censoring when user finishes typing (loses focus)
        tfTitle.focusedProperty().addListener((obs, wasFocused, isNowFocused) -> {
            if (!isNowFocused) {
                String censored = BadWordFilterService.getInstance().censor(tfTitle.getText());
                if (!censored.equals(tfTitle.getText())) {
                    tfTitle.setText(censored);
                }
            }
        });
        
        taContent.focusedProperty().addListener((obs, wasFocused, isNowFocused) -> {
            if (!isNowFocused) {
                String censored = BadWordFilterService.getInstance().censor(taContent.getText());
                if (!censored.equals(taContent.getText())) {
                    taContent.setText(censored);
                    taContent.positionCaret(censored.length());
                }
            }
        });

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

        // Inline error labels
        Label titleErrorLabel = new Label();
        titleErrorLabel.setStyle("-fx-text-fill: #d32f2f; -fx-font-size: 12px;");
        titleErrorLabel.setVisible(false);
        titleErrorLabel.setManaged(false);

        Label contentErrorLabel = new Label();
        contentErrorLabel.setStyle("-fx-text-fill: #d32f2f; -fx-font-size: 12px;");
        contentErrorLabel.setVisible(false);
        contentErrorLabel.setManaged(false);

        Label categoryErrorLabel = new Label();
        categoryErrorLabel.setStyle("-fx-text-fill: #d32f2f; -fx-font-size: 12px;");
        categoryErrorLabel.setVisible(false);
        categoryErrorLabel.setManaged(false);

        Label badWordErrorLabel = new Label();
        badWordErrorLabel.setStyle("-fx-text-fill: #d32f2f; -fx-font-size: 13px;");
        badWordErrorLabel.setVisible(false);
        badWordErrorLabel.setManaged(false);

        GridPane grid = new GridPane();
        grid.setHgap(12);
        grid.setVgap(8);
        grid.setPadding(new Insets(16));
        grid.add(new Label("Title*"), 0, 0);        grid.add(tfTitle, 1, 0);
        grid.add(titleErrorLabel, 1, 1);
        grid.add(new Label("Category*"), 0, 2);     grid.add(categoryBox, 1, 2);
        grid.add(categoryErrorLabel, 1, 3);
        grid.add(new Label("Content*"), 0, 4);    grid.add(taContent, 1, 4);
        grid.add(contentErrorLabel, 1, 5);
        grid.add(badWordErrorLabel, 1, 6);
        
        // Character counters
        Label titleCounter = new Label("0/100");
        titleCounter.setStyle("-fx-font-size: 11px; -fx-text-fill: #666;");
        grid.add(titleCounter, 2, 0);
        
        Label contentCounter = new Label("0/2000");
        contentCounter.setStyle("-fx-font-size: 11px; -fx-text-fill: #666;");
        grid.add(contentCounter, 2, 4);

        tfTitle.setPrefWidth(380);
        categoryBox.setPrefWidth(420);

        pane.setContent(grid);

        // Real-time validation
        tfTitle.textProperty().addListener((obs, old, newVal) -> {
            validateDiscussionTitle(newVal, titleErrorLabel, titleCounter);
            validateBadWords(tfTitle.getText(), taContent.getText(), badWordErrorLabel);
            updateDiscussionOkButton(dialog, tfTitle, taContent, categoryBox,
                titleErrorLabel, contentErrorLabel, categoryErrorLabel, badWordErrorLabel);
        });

        taContent.textProperty().addListener((obs, old, newVal) -> {
            validateDiscussionContent(newVal, contentErrorLabel, contentCounter);
            validateBadWords(tfTitle.getText(), taContent.getText(), badWordErrorLabel);
            updateDiscussionOkButton(dialog, tfTitle, taContent, categoryBox,
                titleErrorLabel, contentErrorLabel, categoryErrorLabel, badWordErrorLabel);
        });

        categoryBox.valueProperty().addListener((obs, old, newVal) -> {
            validateDiscussionCategory(newVal, categoryErrorLabel);
            updateDiscussionOkButton(dialog, tfTitle, taContent, categoryBox,
                titleErrorLabel, contentErrorLabel, categoryErrorLabel, badWordErrorLabel);
        });

        // Initial validation
        validateDiscussionTitle(tfTitle.getText(), titleErrorLabel, titleCounter);
        validateDiscussionContent(taContent.getText(), contentErrorLabel, contentCounter);
        validateDiscussionCategory(categoryBox.getValue(), categoryErrorLabel);
        validateBadWords(tfTitle.getText(), taContent.getText(), badWordErrorLabel);
        updateDiscussionOkButton(dialog, tfTitle, taContent, categoryBox,
            titleErrorLabel, contentErrorLabel, categoryErrorLabel, badWordErrorLabel);

        dialog.setResultConverter(bt -> {
            if (bt != ButtonType.OK) return null;

            // Check for bad words before saving
            BadWordFilterService filter = BadWordFilterService.getInstance();
            String discussionTitle = tfTitle.getText().trim();
            String discussionContent = taContent.getText().trim();

            if (filter.containsBadWord(discussionTitle) || filter.containsBadWord(discussionContent)) {
                badWordErrorLabel.setText("⚠ Your discussion contains inappropriate content.");
                badWordErrorLabel.setVisible(true);
                badWordErrorLabel.setManaged(true);
                return null; // Don't close dialog, don't save
            }

            ForumCategory cat = categoryBox.getValue();
            ForumDiscussion d = new ForumDiscussion();
            d.setId(existing == null ? 0 : existing.getId());
            d.setTitle(discussionTitle);
            d.setContent(discussionContent);
            d.setAuthorName(authorName); // Author from SessionManager, not from UI field
            d.setPinned(existing != null ? existing.isPinned() : false);
            d.setLocked(existing != null ? existing.isLocked() : false);
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
    
    // ===== Discussion Dialog Validation Methods =====
    
    private void validateDiscussionTitle(String title, Label errorLabel, Label counterLabel) {
        String trimmed = title == null ? "" : title.trim();
        counterLabel.setText(trimmed.length() + "/100");
        
        boolean isValid = true;
        String errorMessage = "";
        
        if (trimmed.isEmpty()) {
            isValid = false;
            errorMessage = "Title is required.";
        } else if (trimmed.length() < 5) {
            isValid = false;
            errorMessage = "Title must be at least 5 characters.";
        } else if (trimmed.length() > 100) {
            isValid = false;
            errorMessage = "Title cannot exceed 100 characters.";
        }
        
        errorLabel.setText(errorMessage);
        errorLabel.setVisible(!isValid);
        errorLabel.setManaged(!isValid);
        
        // Update counter color
        if (trimmed.length() > 100) {
            counterLabel.setStyle("-fx-font-size: 11px; -fx-text-fill: #d32f2f;");
        } else {
            counterLabel.setStyle("-fx-font-size: 11px; -fx-text-fill: #666;");
        }
    }
    
    private void validateDiscussionContent(String content, Label errorLabel, Label counterLabel) {
        String trimmed = content == null ? "" : content.trim();
        counterLabel.setText(trimmed.length() + "/2000");
        
        boolean isValid = true;
        String errorMessage = "";
        
        if (trimmed.isEmpty()) {
            isValid = false;
            errorMessage = "Content is required.";
        } else if (trimmed.length() < 10) {
            isValid = false;
            errorMessage = "Content must be at least 10 characters.";
        } else if (trimmed.length() > 2000) {
            isValid = false;
            errorMessage = "Content cannot exceed 2000 characters.";
        }
        
        errorLabel.setText(errorMessage);
        errorLabel.setVisible(!isValid);
        errorLabel.setManaged(!isValid);
        
        // Update counter color
        if (trimmed.length() > 2000) {
            counterLabel.setStyle("-fx-font-size: 11px; -fx-text-fill: #d32f2f;");
        } else {
            counterLabel.setStyle("-fx-font-size: 11px; -fx-text-fill: #666;");
        }
    }
    
    private void validateDiscussionCategory(ForumCategory category, Label errorLabel) {
        boolean isValid = category != null;
        String errorMessage = isValid ? "" : "Please select a category.";
        
        errorLabel.setText(errorMessage);
        errorLabel.setVisible(!isValid);
        errorLabel.setManaged(!isValid);
    }
    
    private void updateDiscussionOkButton(Dialog<?> dialog, TextField titleField, TextArea contentArea,
                                          ComboBox<ForumCategory> categoryBox,
                                          Label titleError, Label contentError, Label categoryError, Label badWordError) {
        Button okButton = (Button) dialog.getDialogPane().lookupButton(ButtonType.OK);

        boolean hasTitle = !titleField.getText().trim().isEmpty();
        boolean hasContent = !contentArea.getText().trim().isEmpty();
        boolean hasCategory = categoryBox.getValue() != null;

        boolean isTitleValid = titleError.getText().isEmpty();
        boolean isContentValid = contentError.getText().isEmpty();
        boolean isCategoryValid = categoryError.getText().isEmpty();
        boolean isBadWordValid = badWordError.getText().isEmpty() || !badWordError.isVisible();

        okButton.setDisable(!(hasTitle && hasContent && hasCategory &&
                           isTitleValid && isContentValid && isCategoryValid && isBadWordValid));
    }

    private void validateBadWords(String title, String content, Label badWordErrorLabel) {
        BadWordFilterService filter = BadWordFilterService.getInstance();
        boolean hasBadWord = filter.containsBadWord(title) || filter.containsBadWord(content);

        if (hasBadWord) {
            badWordErrorLabel.setText("⚠ Your discussion contains inappropriate content.");
            badWordErrorLabel.setVisible(true);
            badWordErrorLabel.setManaged(true);
        } else {
            badWordErrorLabel.setText("");
            badWordErrorLabel.setVisible(false);
            badWordErrorLabel.setManaged(false);
        }
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
        else {
            // Check for bad words in title
            BadWordFilterService filter = BadWordFilterService.getInstance();
            if (filter.containsBadWord(title)) {
                sb.append("Title contains inappropriate content.\n");
            }
        }
        if (content == null || content.trim().isEmpty()) sb.append("Discussion content is required.\n");
        else {
            // Check for bad words in content
            BadWordFilterService filter = BadWordFilterService.getInstance();
            if (filter.containsBadWord(content)) {
                sb.append("Content contains inappropriate content.\n");
            }
        }
        // Author validation not needed for new discussions since it's auto-filled from logged-in user
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

    // ===== UI Helper Methods =====
    
    private String getInitials(String name) {
        if (name == null || name.trim().isEmpty()) {
            return "?";
        }
        
        String[] parts = name.trim().split("\\s+");
        if (parts.length >= 2) {
            return (parts[0].charAt(0) + "" + parts[1].charAt(0)).toUpperCase();
        } else if (parts.length == 1) {
            String singlePart = parts[0];
            if (singlePart.length() >= 2) {
                return singlePart.substring(0, 2).toUpperCase();
            } else {
                return singlePart.toUpperCase();
            }
        }
        return "?";
    }
    
    private Label createAvatar(String initials) {
        Label avatar = new Label(initials);
        avatar.setStyle("-fx-background-color: " + getAvatarColor(initials) + "; " +
                       "-fx-background-radius: 50%; " +
                       "-fx-text-fill: white; " +
                       "-fx-font-size: 10px; " +
                       "-fx-font-weight: bold; " +
                       "-fx-alignment: center; " +
                       "-fx-pref-width: 32px; " +
                       "-fx-pref-height: 32px; " +
                       "-fx-min-width: 32px; " +
                       "-fx-min-height: 32px; " +
                       "-fx-max-width: 32px; " +
                       "-fx-max-height: 32px;");
        return avatar;
    }
    
    private void showReportDialog(int targetId, String type, String targetContent) {
        if (!SessionManager.getInstance().isLoggedIn()) {
            showWarning("You must be logged in to report.");
            return;
        }
        
        int reporterId = SessionManager.getInstance().getCurrentUser().getId();
        
        // Check if already reported
        if (ForumReportService.getInstance().alreadyReported(targetId, type, reporterId)) {
            // Show temporary warning on message card
            showTemporaryReportWarning();
            return;
        }
        
        // Create dialog
        Stage dialogStage = new Stage();
        dialogStage.initModality(Modality.APPLICATION_MODAL);
        dialogStage.setTitle("🚩 Report " + (type.equals("message") ? "Message" : "Discussion"));
        
        VBox dialogContent = new VBox(15);
        dialogContent.setPadding(new Insets(20));
        dialogContent.setStyle("-fx-background-color: white; -fx-border-radius: 8; -fx-border-color: #ddd; -fx-border-width: 1;");
        
        Label titleLabel = new Label("🚩 Report " + (type.equals("message") ? "Message" : "Discussion"));
        titleLabel.setStyle("-fx-font-size: 18px; -fx-font-weight: bold; -fx-text-fill: #333;");
        
        ComboBox<String> reasonCombo = new ComboBox<>();
        reasonCombo.getItems().addAll("Spam", "Inappropriate content", "Harassment", "Misinformation", "Other");
        reasonCombo.setPromptText("Select a reason");
        reasonCombo.setStyle("-fx-font-size: 14px;");
        
        HBox buttonBox = new HBox(10);
        buttonBox.setAlignment(Pos.CENTER_RIGHT);
        
        Button submitBtn = new Button("Submit Report");
        submitBtn.setStyle("-fx-background-color: #00897B; -fx-text-fill: white; -fx-font-size: 14px; -fx-padding: 8 16;");
        submitBtn.setOnAction(e -> {
            String selectedReason = reasonCombo.getValue();
            if (selectedReason == null) {
                showWarning("Please select a reason for reporting.");
                return;
            }
            
            ForumReportService.getInstance().addReport(targetId, type, reporterId, selectedReason);
            dialogStage.close();
            showTemporaryReportSuccess();
        });
        
        Button cancelBtn = new Button("Cancel");
        cancelBtn.setStyle("-fx-background-color: #6c757d; -fx-text-fill: white; -fx-font-size: 14px; -fx-padding: 8 16;");
        cancelBtn.setOnAction(e -> dialogStage.close());
        
        buttonBox.getChildren().addAll(cancelBtn, submitBtn);
        
        dialogContent.getChildren().addAll(titleLabel, reasonCombo, buttonBox);
        
        Scene scene = new Scene(dialogContent);
        dialogStage.setScene(scene);
        dialogStage.showAndWait();
    }
    
    private void showTemporaryReportWarning() {
        Label warningLabel = new Label("⚠ You already reported this message");
        warningLabel.setStyle("-fx-background-color: #ff9800; -fx-text-fill: white; -fx-padding: 5 10; -fx-background-radius: 4;");
        // Find the message card and add warning temporarily
        // This is a simplified implementation - in production, you'd want to track the specific card
        Platform.runLater(() -> {
            try {
                Thread.sleep(2000); // Show for 2 seconds
            } catch (InterruptedException e) {
                Thread.currentThread().interrupt();
            }
        });
    }
    
    private void showTemporaryReportSuccess() {
        Label successLabel = new Label("✅ Report submitted");
        successLabel.setStyle("-fx-background-color: #4CAF50; -fx-text-fill: white; -fx-padding: 5 10; -fx-background-radius: 4;");
        // Find the message card and add success temporarily
        Platform.runLater(() -> {
            try {
                Thread.sleep(2000); // Show for 2 seconds
            } catch (InterruptedException e) {
                Thread.currentThread().interrupt();
            }
        });
    }

    private String getAvatarColor(String initials) {
        // Generate consistent color based on initials
        int hash = initials.hashCode();
        String[] colors = {
            "#FF6B6B", "#4ECDC4", "#45B7D1", "#96CEB4", "#FFEAA7",
            "#DDA0DD", "#98D8C8", "#F7DC6F", "#BB8FCE", "#85C1E2"
        };
        return colors[Math.abs(hash % colors.length)];
    }

    }
