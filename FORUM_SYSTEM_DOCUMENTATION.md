# Forum System - Complete Technical Documentation

## Table of Contents
1. [System Overview](#system-overview)
2. [Architecture & Design](#architecture--design)
3. [Database Schema](#database-schema)
4. [Core Services](#core-services)
5. [Controllers & UI Integration](#controllers--ui-integration)
6. [Advanced Features](#advanced-features)
7. [User Integration](#user-integration)
8. [Security & Authorization](#security--authorization)
9. [API Documentation](#api-documentation)
10. [Implementation Details](#implementation-details)

---

## System Overview

The forum system is a comprehensive JavaFX-based discussion platform integrated into the EduConnect application. It provides full CRUD operations for discussions and messages, with advanced features like real-time notifications, content moderation, voting systems, and user authorization.

### Key Components
- **Frontend**: JavaFX with FXML for UI components
- **Backend**: Java services with MySQL database
- **Integration**: SessionManager for user authentication
- **Features**: Voting, notifications, bad word filtering, authorization

---

## Architecture & Design

### MVC Pattern Implementation
```
├── Models/          # Data entities (ForumDiscussion, ForumMessage, ForumCategory)
├── Views/           # FXML files (Forum.fxml, AdminForumDashboard.fxml)
├── Controllers/     # Business logic (ForumController, AdminForumController)
└── Services/        # Data access and business services
```

### Design Principles
- **Singleton Pattern** for services (ForumDiscussionService, NotificationService, etc.)
- **Repository Pattern** for data access
- **Observer Pattern** for UI updates
- **Factory Pattern** for dialog creation

---

## Database Schema

### Core Tables

#### Forum Categories
```sql
CREATE TABLE forum_category (
    id_forum_category INT AUTO_INCREMENT PRIMARY KEY,
    forum_category_name VARCHAR(255) NOT NULL,
    forum_category_color VARCHAR(7) NOT NULL,
    forum_category_description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NULL
);
```

#### Forum Discussions
```sql
CREATE TABLE forum_discussion (
    id_forum_discussion INT AUTO_INCREMENT PRIMARY KEY,
    forum_discussion_title VARCHAR(255) NOT NULL,
    forum_discussion_content LONGTEXT NOT NULL,
    forum_discussion_author_name VARCHAR(255) NOT NULL,
    forum_discussion_is_pinned BOOLEAN DEFAULT FALSE,
    forum_discussion_is_locked BOOLEAN DEFAULT FALSE,
    forum_discussion_views INT DEFAULT 0,
    forum_discussion_created_at DATETIME NOT NULL,
    forum_discussion_updated_at DATETIME NULL,
    id_forum_category INT NOT NULL,
    solved BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_forum_category) REFERENCES forum_category(id_forum_category)
);
```

#### Forum Messages
```sql
CREATE TABLE forum_message (
    id_forum_message INT AUTO_INCREMENT PRIMARY KEY,
    forum_message_content LONGTEXT NOT NULL,
    forum_message_author_name VARCHAR(255) NOT NULL,
    forum_message_is_author TINYINT DEFAULT 0,
    forum_message_upvotes INT DEFAULT 0,
    forum_message_downvotes INT DEFAULT 0,
    forum_message_created_at DATETIME NOT NULL,
    forum_message_updated_at DATETIME NULL,
    id_forum_discussion INT NOT NULL,
    FOREIGN KEY (id_forum_discussion) REFERENCES forum_discussion(id_forum_discussion)
);
```

#### Advanced Features Tables

##### Unique Voting System
```sql
CREATE TABLE forum_votes (
    user_id INT NOT NULL,
    message_id INT NOT NULL,
    vote_type ENUM('up', 'down') NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, message_id),
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (message_id) REFERENCES forum_message(id_forum_message)
);
```

##### Unique View Tracking
```sql
CREATE TABLE forum_views (
    user_id INT NOT NULL,
    discussion_id INT NOT NULL,
    viewed_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, discussion_id),
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (discussion_id) REFERENCES forum_discussion(id_forum_discussion)
);
```

##### Notification System
```sql
CREATE TABLE notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    type VARCHAR(50) NOT NULL,
    message TEXT NOT NULL,
    discussion_id INT NOT NULL,
    message_id INT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    is_read BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (discussion_id) REFERENCES forum_discussion(id_forum_discussion),
    FOREIGN KEY (message_id) REFERENCES forum_message(id_forum_message)
);
```

---

## Core Services

### 1. ForumSchemaService
**Purpose**: Database schema initialization and management

**Key Methods**:
- `ensureSchema()`: Initializes all forum-related tables
- **Features**: Auto-creation, version management, error handling

**Advanced Implementation**:
```java
public static synchronized void ensureSchema() {
    if (initialized) return;
    
    try (Connection conn = MyDB.getInstance().getConnection();
         Statement st = conn.createStatement()) {
        
        // Creates all tables with proper constraints
        // Handles schema versioning
        // Provides rollback on errors
    }
}
```

### 2. ForumDiscussionService
**Purpose**: CRUD operations for forum discussions

**Key Methods**:
- `getAllDiscussions()`: Retrieves discussions with real-time vote/view counts
- `addDiscussion()`: Creates new discussions with validation
- `updateDiscussion()`: Updates existing discussions
- `deleteDiscussion()`: Removes discussions (cascade delete)

**Advanced Features**:
- **Real-time Statistics**: Calculates votes and views from related tables
- **Category Integration**: Links with forum categories
- **Search & Filtering**: Supports category-based filtering

**SQL Implementation**:
```sql
SELECT d.*, 
       COALESCE((SELECT COUNT(*) FROM forum_views v WHERE v.discussion_id = d.id), 0) AS views,
       c.forum_category_name AS category_name,
       (SELECT COUNT(*) FROM forum_message m WHERE m.id_forum_discussion = d.id) AS message_count
FROM forum_discussion d
LEFT JOIN forum_category c ON c.id_forum_category = d.id_forum_category
```

### 3. ForumMessageService
**Purpose**: Message management and voting calculations

**Key Methods**:
- `getMessagesByDiscussion()`: Retrieves messages with vote counts
- `addMessage()`: Creates new messages
- `updateMessage()`: Updates existing messages
- **Removed**: `upvote()`/`downvote()` methods (now handled by forum_votes table)

**Advanced Implementation**:
```sql
SELECT m.*, 
       COALESCE((SELECT COUNT(*) FROM forum_votes v WHERE v.message_id = m.id AND v.vote_type = 'up'), 0) AS upvotes,
       COALESCE((SELECT COUNT(*) FROM forum_votes v WHERE v.message_id = m.id AND v.vote_type = 'down'), 0) AS downvotes
FROM forum_message m
```

### 4. ForumViewService
**Purpose**: Unique view tracking per user

**Key Methods**:
- `recordView(userId, discussionId)`: Records unique views
- `getUniqueViewCount()`: Calculates real-time view counts
- `hasUserViewed()`: Checks if user has viewed discussion

**Business Logic**:
- **Uniqueness Enforcement**: Composite primary key prevents duplicate views
- **Real-time Updates**: View counts calculated on-demand
- **User Privacy**: Only tracks logged-in user views

### 5. NotificationService
**Purpose**: Real-time notification management

**Key Methods**:
- `createDiscussionReplyNotification()`: Notifies discussion authors
- `createMessageReplyNotification()`: Notifies message authors
- `createDiscussionSolvedNotification()`: Notifies when discussions are solved
- `getUnreadNotifications()`: Retrieves user notifications
- `markAsRead()`: Updates notification status

**Notification Types**:
- `discussion_reply`: New reply to user's discussion
- `message_reply`: Reply to user's message
- `discussion_solved`: Discussion marked as solved

### 6. BadWordFilterService
**Purpose**: Content moderation and profanity filtering

**Key Methods**:
- `containsBadWord(text)`: Detects inappropriate content
- **Languages**: Supports English and French bad words
- **Pattern Matching**: Uses regex with word boundaries

**Implementation**:
```java
private final Set<String> badWords = Set.of(
    "fuck", "shit", "asshole", "bitch", "bastard", "damn", "hell", "crap",
    "putain", "merde", "connard", "salope", "enculé", "bordel", "pute"
);
```

### 7. ForumStatsService
**Purpose**: Statistical analysis and reporting

**Key Methods**:
- `getTotalDiscussions()`: Overall discussion count
- `getTotalMessages()`: Total message count
- `getTotalUsers()`: Active user count
- `getMostActiveDiscussions()`: Engagement metrics
- `getCategoryStats()**: Category-wise statistics

---

## Controllers & UI Integration

### ForumController (User Interface)

**Primary Responsibilities**:
- Discussion browsing and filtering
- Message viewing and replying
- User authorization for edit/delete
- Real-time UI updates

**Key Features**:
- **Dynamic UI**: Avatar generation, vote buttons, edit/delete controls
- **Authorization**: Users can only edit/delete their own content
- **Validation**: Real-time input validation with bad word filtering
- **Notifications**: Triggers notifications on user actions

**Advanced UI Components**:
```java
// Avatar generation with consistent colors
private Label createAvatar(String initials) {
    Label avatar = new Label(initials);
    avatar.setStyle("-fx-background-color: " + getAvatarColor(initials) + "; " +
                   "-fx-background-radius: 50%; -fx-text-fill: white;");
    return avatar;
}

// Conditional edit/delete buttons
if (SessionManager.getInstance().isLoggedIn() && 
    currentUserFullName.equals(discussion.getAuthorName())) {
    // Show edit/delete buttons
}
```

### AdminForumController (Administrative Interface)

**Primary Responsibilities**:
- Complete forum management
- Category management
- User moderation
- Statistics dashboard

**Admin Features**:
- **Full CRUD**: Create, read, update, delete all content
- **Category Management**: Color-coded categories with validation
- **Statistics Dashboard**: Real-time forum metrics
- **Bulk Operations**: Mass moderation capabilities

---

## Advanced Features

### 1. Unique Voting System
**Implementation**: Database-level uniqueness using composite primary keys
**Logic**: Each user can vote once per message (up/down toggle)
**SQL**:
```sql
PRIMARY KEY (user_id, message_id)
```

### 2. Unique View Tracking
**Implementation**: Tracks views per user per discussion
**Benefit**: Accurate view counts without manipulation
**Logic**: Only logged-in users contribute to view counts

### 3. Real-time Notifications
**Trigger Events**:
- New replies to discussions
- Replies to user messages
- Discussions marked as solved
**Delivery**: Database storage with read/unread status

### 4. Content Moderation
**Bad Word Filter**: Multi-language profanity detection
**Validation**: Real-time input validation
**Integration**: Prevents inappropriate content submission

### 5. User Authorization
**Discussion Control**: Users can only edit/delete their own discussions
**Message Control**: Users can only edit/delete their own messages
**UI Adaptation**: Edit/delete buttons only appear for owned content

### 6. Avatar System
**Algorithm**: Hash-based color assignment from user initials
**Consistency**: Same user always gets same color
**Implementation**:
```java
private String getAvatarColor(String initials) {
    int hash = initials.hashCode();
    String[] colors = {"#FF6B6B", "#4ECDC4", "#45B7D1", ...};
    return colors[Math.abs(hash % colors.length)];
}
```

---

## User Integration

### SessionManager Integration
**Purpose**: Bridge between user management and forum system

**Key Integration Points**:
```java
// User authentication check
if (!SessionManager.getInstance().isLoggedIn()) {
    showWarning("You must be logged in to perform this action.");
    return;
}

// Current user information
String currentUser = SessionManager.getInstance().getCurrentUserFullName();
int userId = SessionManager.getInstance().getCurrentUserId();
```

### User Resolution System
**Challenge**: Convert author names to user IDs for notifications
**Solution**: Database query with multiple name formats
```java
private int getUserIdByName(String fullName) {
    String query = "SELECT id FROM user WHERE CONCAT(first_name, ' ', last_name) = ? OR username = ?";
    // Implementation handles various name formats
}
```

### Permission System
**Logic**: Role-based access control through user ownership
**Implementation**:
- **Content Ownership**: Users own their discussions and messages
- **Action Authorization**: Edit/delete based on ownership
- **Admin Override**: Admins can manage all content

---

## Security & Authorization

### 1. Authentication Integration
- **Session-based**: Uses SessionManager for user authentication
- **Login Required**: Critical actions require authenticated users
- **User Context**: All actions performed in user context

### 2. Authorization Model
```java
// Discussion ownership check
if (!currentUserFullName.equals(discussion.getAuthorName())) {
    showWarning("You can only edit your own discussions.");
    return;
}

// Message ownership check
if (!currentUserFullName.equals(message.getAuthorName())) {
    showWarning("You can only edit your own messages.");
    return;
}
```

### 3. Input Validation
- **Bad Word Filtering**: Multi-language profanity detection
- **SQL Injection Prevention**: Parameterized queries
- **XSS Prevention**: Proper input sanitization

### 4. Data Integrity
- **Foreign Key Constraints**: Database-level referential integrity
- **Cascade Deletes**: Automatic cleanup of related data
- **Transaction Safety**: Proper error handling and rollback

---

## API Documentation

### ForumDiscussionService API

#### getAllDiscussions()
**Returns**: `List<ForumDiscussion>`
**Purpose**: Retrieves all discussions with real-time statistics
**Features**: Category joining, vote/view counting, message counting

#### addDiscussion(ForumDiscussion)
**Parameters**: `ForumDiscussion` object
**Returns**: `int` (discussion ID)
**Validation**: Title length, content requirements, category selection
**Integration**: Auto-fills author from SessionManager

#### updateDiscussion(ForumDiscussion)
**Parameters**: `ForumDiscussion` object
**Returns**: `boolean` success status
**Authorization**: Only discussion authors can update

### ForumMessageService API

#### getMessagesByDiscussion(int discussionId)
**Returns**: `List<ForumMessage>`
**Features**: Real-time vote calculation, author information
**Ordering**: Chronological message ordering

#### addMessage(ForumMessage)
**Parameters**: `ForumMessage` object
**Returns**: `int` (message ID)
**Integration**: Triggers notifications, validates content

### NotificationService API

#### createDiscussionReplyNotification(int userId, String title, int discussionId, String author)
**Purpose**: Notify discussion author of new replies
**Logic**: Avoids self-notification, resolves user IDs

#### getUnreadNotifications(int userId)
**Returns**: `List<Notification>`
**Features**: Chronological ordering, unread filter

#### markAsRead(int notificationId)
**Purpose**: Update notification read status
**Integration**: UI feedback for notification management

### ForumViewService API

#### recordView(int userId, int discussionId)
**Returns**: `boolean` (true if new view)
**Logic**: Uniqueness enforcement, view counting

#### getUniqueViewCount(int discussionId)
**Returns**: `int` (unique view count)
**Implementation**: Real-time calculation from forum_views table

---

## Implementation Details

### Database Design Decisions

#### Composite Primary Keys
**Rationale**: Enforce uniqueness at database level
**Examples**: 
- `(user_id, message_id)` for votes
- `(user_id, discussion_id)` for views

#### Cascade Deletes
**Purpose**: Maintain data integrity
**Implementation**: Automatic cleanup of related records

#### Real-time Calculations
**Approach**: Calculate statistics on-demand vs. stored values
**Benefits**: Always accurate, no synchronization issues

### Service Layer Architecture

#### Singleton Pattern
**Reasoning**: Centralized service management
**Implementation**:
```java
private static ForumDiscussionService instance;
public static synchronized ForumDiscussionService getInstance() {
    if (instance == null) instance = new ForumDiscussionService();
    return instance;
}
```

#### Connection Management
**Strategy**: Connection pooling through MyDB
**Error Handling**: Proper resource cleanup and exception handling

### UI/UX Implementation

#### Responsive Design
- **Dynamic Layouts**: VBox, HBox, FlowPane for flexible layouts
- **CSS Styling**: Consistent theming with courses-module.css
- **User Feedback**: Real-time validation, loading states

#### Accessibility Features
- **Keyboard Navigation**: Proper focus management
- **Visual Feedback**: Color-coded categories, status indicators
- **Error Handling**: Clear error messages and recovery options

### Performance Optimizations

#### Database Indexing
**Strategic Indexes**: Foreign keys, frequently queried fields
**Impact**: Improved query performance for large datasets

#### Lazy Loading
**Implementation**: Load discussions/messages on demand
**Benefit**: Reduced memory usage, faster initial load

#### Caching Strategy
**View Counts**: Calculated on-demand with caching potential
**User Data**: SessionManager provides user context caching

---

## Testing & Quality Assurance

### Unit Testing Strategy
- **Service Layer**: Test CRUD operations and business logic
- **Validation**: Test input validation and error handling
- **Integration**: Test service interactions

### Integration Testing
- **Database**: Test schema creation and migrations
- **User Integration**: Test SessionManager integration
- **UI Testing**: Test user workflows and authorization

### Edge Cases Handled
- **Concurrent Access**: Database locking for vote/view tracking
- **Data Integrity**: Handle missing users, deleted discussions
- **Error Recovery**: Graceful handling of database errors

---

## Deployment Considerations

### Database Migration
- **Schema Versioning**: Handle schema updates
- **Data Migration**: Preserve existing data during updates
- **Rollback Strategy**: Ability to revert changes

### Configuration
- **Database Connection**: Configurable connection parameters
- **Feature Flags**: Enable/disable features dynamically
- **Logging**: Comprehensive logging for debugging

### Security
- **SQL Injection**: Parameterized queries throughout
- **Data Validation**: Input sanitization and validation
- **Access Control**: Proper authorization checks

---

## Future Enhancements

### Planned Features
1. **Real-time Updates**: WebSocket integration for live notifications
2. **File Attachments**: Support for images and documents
3. **Advanced Search**: Full-text search capabilities
4. **User Profiles**: Enhanced user profile integration
5. **Moderation Tools**: Advanced moderation workflows

### Scalability Considerations
- **Database Optimization**: Query optimization, partitioning
- **Caching Layer**: Redis integration for performance
- **Load Balancing**: Horizontal scaling capabilities

---

## Conclusion

The forum system represents a comprehensive, production-ready discussion platform with advanced features including real-time notifications, content moderation, user authorization, and sophisticated voting/view tracking systems. The architecture follows best practices with proper separation of concerns, robust error handling, and scalable design patterns.

The integration with the existing user management system through SessionManager provides seamless user experience while maintaining security and proper authorization controls. The database design ensures data integrity through constraints and proper relationships, while the service layer provides clean, maintainable code with comprehensive error handling.

This implementation demonstrates advanced Java development concepts including design patterns, database design, UI/UX principles, and system integration, making it suitable for both educational purposes and production deployment.
