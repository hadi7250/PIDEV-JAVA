package controllers;

import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.ScrollPane;
import javafx.scene.layout.VBox;
import services.NotificationService;
import utils.SessionManager;

import java.net.URL;
import java.time.format.DateTimeFormatter;
import java.util.List;
import java.util.ResourceBundle;

public class NotificationController implements Initializable {

    @FXML private VBox notificationContainer;
    @FXML private ScrollPane notificationScrollPane;
    @FXML private Label notificationCountLabel;
    @FXML private Button markAllReadButton;
    @FXML private Button refreshButton;
    @FXML private Label emptyStateLabel;

    private NotificationService notificationService;
    private DateTimeFormatter dateFormatter = DateTimeFormatter.ofPattern("MMM dd, yyyy HH:mm");

    @Override
    public void initialize(URL location, ResourceBundle resources) {
        notificationService = NotificationService.getInstance();
        setupUI();
        loadNotifications();
    }

    private void setupUI() {
        // Setup scroll pane
        notificationScrollPane.setFitToWidth(true);
        notificationScrollPane.setHbarPolicy(ScrollPane.ScrollBarPolicy.NEVER);

        // Setup container
        notificationContainer.setSpacing(10);
        notificationContainer.setStyle("-fx-padding: 10;");

        // Setup empty state
        emptyStateLabel.setText("No notifications");
        emptyStateLabel.setStyle("-fx-text-fill: #666; -fx-font-size: 14px;");

        // Setup button actions
        markAllReadButton.setOnAction(e -> markAllAsRead());
        refreshButton.setOnAction(e -> refreshNotifications());

        // Initial load
        updateNotificationCount();
    }

    @FXML
    public void refreshNotifications() {
        loadNotifications();
    }

    @FXML
    public void markAllAsRead() {
        if (!SessionManager.getInstance().isLoggedIn()) {
            return;
        }
        
        int userId = SessionManager.getInstance().getCurrentUserId();
        notificationService.markAllAsRead(userId);
        loadNotifications(); // Refresh the display
        updateNotificationCount();
    }

    private void loadNotifications() {
        if (!SessionManager.getInstance().isLoggedIn()) {
            showEmptyState("Please log in to see notifications");
            return;
        }

        int userId = SessionManager.getInstance().getCurrentUserId();
        List<NotificationService.Notification> notifications = notificationService.getAllNotifications(userId);

        notificationContainer.getChildren().clear();

        if (notifications.isEmpty()) {
            showEmptyState("No notifications");
            return;
        }

        emptyStateLabel.setManaged(false);
        emptyStateLabel.setVisible(false);

        for (NotificationService.Notification notification : notifications) {
            VBox notificationCard = createNotificationCard(notification);
            notificationContainer.getChildren().add(notificationCard);
        }
    }

    private VBox createNotificationCard(NotificationService.Notification notification) {
        VBox card = new VBox(8);
        card.setStyle("-fx-background-color: " + (notification.isRead() ? "#f8f9fa" : "#e3f2fd") + "; " +
                     "-fx-border-color: #dee2e6; -fx-border-radius: 8; " +
                     "-fx-background-radius: 8; -fx-padding: 12;");
        card.setPrefWidth(350);

        // Header with type and time
        Label headerLabel = new Label();
        headerLabel.setStyle("-fx-font-weight: bold; -fx-text-fill: #333;");
        
        String typeText = getTypeDisplayText(notification.getType());
        String timeText = notification.getCreatedAt().format(dateFormatter);
        headerLabel.setText(typeText + " • " + timeText);

        // Message content
        Label messageLabel = new Label(notification.getMessage());
        messageLabel.setWrapText(true);
        messageLabel.setStyle("-fx-text-fill: #555; -fx-font-size: 13px;");

        // Action buttons for unread notifications
        if (!notification.isRead()) {
            Button markReadButton = new Button("Mark as read");
            markReadButton.setStyle("-fx-background-color: #2196f3; -fx-text-fill: white; " +
                                   "-fx-background-radius: 4; -fx-font-size: 11px;");
            markReadButton.setOnAction(e -> {
                notificationService.markAsRead(notification.getId());
                loadNotifications();
                updateNotificationCount();
            });

            card.getChildren().addAll(headerLabel, messageLabel, markReadButton);
        } else {
            card.getChildren().addAll(headerLabel, messageLabel);
        }

        return card;
    }

    private String getTypeDisplayText(String type) {
        switch (type) {
            case "discussion_reply":
                return "💬 New Reply";
            case "message_reply":
                return "↩️ Message Reply";
            case "discussion_solved":
                return "✅ Solved";
            default:
                return "📢 Notification";
        }
    }

    private void showEmptyState(String message) {
        notificationContainer.getChildren().clear();
        emptyStateLabel.setText(message);
        emptyStateLabel.setVisible(true);
        notificationScrollPane.setVisible(false);
    }

    // Public method to refresh notifications from external controllers
    public void refreshNotificationsExternal() {
        loadNotifications();
        updateNotificationCount();
    }

    private void updateNotificationCount() {
        if (!SessionManager.getInstance().isLoggedIn()) {
            notificationCountLabel.setText("0");
            markAllReadButton.setDisable(true);
            return;
        }

        int userId = SessionManager.getInstance().getCurrentUserId();
        int unreadCount = notificationService.getUnreadCount(userId);
        
        notificationCountLabel.setText(String.valueOf(unreadCount));
        markAllReadButton.setDisable(unreadCount == 0);
    }

    // Public method to refresh notifications from external controllers
    public void refresh() {
        loadNotifications();
        updateNotificationCount();
    }
}
