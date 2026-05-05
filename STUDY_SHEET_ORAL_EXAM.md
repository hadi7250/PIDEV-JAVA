# EduConnect Forum Module - Oral Exam Study Sheet

## JDBC & Database

### What does JDBC stand for and what is it used for?
**Answer:** JDBC stands for Java Database Connectivity. It's the standard Java API that lets our application connect to and execute queries on MySQL databases.

**Example from my code:** In `MyDB.java`, I use `DriverManager.getConnection(url, user, password)` to establish the connection, then use `PreparedStatement` to execute SQL queries like `SELECT * FROM forum_discussions`.

**Quick answer:** JDBC is the bridge between Java code and the MySQL database.

**Professor might ask:** "What JDBC driver did you use?" → I used the MySQL Connector/J driver (mysql-connector-java) which is added as a dependency in my project.

---

### What is the difference between Statement and PreparedStatement and why do we use PreparedStatement?
**Answer:** Statement is basic and just executes raw SQL strings. PreparedStatement is pre-compiled and lets us safely insert variables using `setString()`, `setInt()` etc. We always use PreparedStatement because it's more secure and faster.

**Example:** In `ForumDiscussionService.java` at line 87: `PreparedStatement stmt = conn.prepareStatement("SELECT * FROM forum_discussions WHERE category_id = ?"); stmt.setInt(1, categoryId);`

**Quick answer:** PreparedStatement is safer (prevents SQL injection) and more efficient than Statement.

**Professor might ask:** "Can you show me where you used it?" → Open ForumDiscussionService.java and point to any method with `PreparedStatement stmt = conn.prepareStatement(...)`

---

### What is SQL injection and how does PreparedStatement prevent it?
**Answer:** SQL injection is when a hacker types malicious SQL into a form field (like `' OR 1=1 --`) to break your query. PreparedStatement prevents this by treating user input as data only, never as executable code.

**Example:** If a user types `"admin' OR '1'='1"` in a search box, with Statement it would break the query. With PreparedStatement, it's treated as literal text: the `?` placeholder is escaped automatically.

**Quick answer:** SQL injection tricks your query into running malicious code; PreparedStatement escapes everything so input stays as data.

**Professor might ask:** "Show me an example of what a SQL injection attack looks like." → `' OR 1=1 --` would make `SELECT * FROM users WHERE username=''` return all rows.

---

### What is ResultSet and how do we iterate through it?
**Answer:** ResultSet is the object that holds the rows returned from a SELECT query. It starts before the first row, and we use `while (rs.next())` to move through each row and extract data with `getString()`, `getInt()`, etc.

**Example:** In `ForumDiscussionService.getAllDiscussions()`:
```java
ResultSet rs = stmt.executeQuery();
while (rs.next()) {
    ForumDiscussion d = new ForumDiscussion();
    d.setId(rs.getInt("id"));
    d.setTitle(rs.getString("title"));
}
```

**Quick answer:** ResultSet is a cursor pointing to database rows; `rs.next()` moves to the next row.

**Professor might ask:** "What happens if you call rs.getString on a null value?" → It returns null, but I use `safe(rs.getString("column"))` helper to handle nulls gracefully.

---

### What is a singleton pattern and why is MyDB.java a singleton?
**Answer:** Singleton ensures only ONE instance of a class exists in the entire application. MyDB is a singleton because we only want ONE database connection pool, not multiple connections causing memory leaks.

**Example:** In `MyDB.java`:
```java
private static MyDB instance;
public static MyDB getInstance() {
    if (instance == null) {
        synchronized (MyDB.class) {
            if (instance == null) instance = new MyDB();
        }
    }
    return instance;
}
```
I use double-checked locking for thread safety.

**Quick answer:** Singleton = only one instance ever; MyDB is singleton so we don't create 50 database connections.

**Professor might ask:** "Why the synchronized block?" → To prevent two threads from creating two instances at the same time (race condition).

---

### What does autoReconnect=true do in the connection URL?
**Answer:** It tells MySQL to automatically reconnect if the connection drops after being idle. Without this, after some time of inactivity, our app would crash with "connection closed" errors.

**Example:** In `MyDB.java` line 24: `jdbc:mysql://localhost:3306/educonnect?autoReconnect=true&useSSL=false`

**Quick answer:** autoReconnect=true keeps the database connection alive even after idle periods.

**Professor might ask:** "What happens without it?" → The connection times out after 8 hours (MySQL default) and the app throws SQLException "Connection closed".

---

### What is a foreign key and why do we use SET FOREIGN_KEY_CHECKS = 0 before truncating?
**Answer:** A foreign key creates a relationship between tables (like forum_messages.discussion_id references forum_discussions.id). We disable checks before truncating so we can delete parent records without MySQL blocking us due to child records existing.

**Example:** In `ForumSchemaService.resetDatabase()`, I run `SET FOREIGN_KEY_CHECKS = 0` before truncating tables, then `SET FOREIGN_KEY_CHECKS = 1` after. This lets me clear forum_discussions even if forum_messages still has rows referencing them.

**Quick answer:** Foreign key = relationship constraint; we disable checks temporarily to bulk-delete without dependency errors.

**Professor might ask:** "Why not just delete in the right order?" → We could, but with many related tables it's easier to just disable checks, truncate everything, and re-enable.

---

### What is CASCADE DELETE and why is it important?
**Answer:** CASCADE DELETE automatically deletes child records when a parent is deleted. If we delete a discussion, all its messages get auto-deleted thanks to `ON DELETE CASCADE` in the foreign key definition.

**Example:** In `ForumSchemaService.java`, when creating the forum_messages table:
```sql
CONSTRAINT fk_message_discussion 
    FOREIGN KEY (discussion_id) REFERENCES forum_discussions(id) 
    ON DELETE CASCADE
```
So when I delete discussion ID 5, all messages with discussion_id=5 automatically delete.

**Quick answer:** CASCADE DELETE = delete parent, children auto-delete; prevents orphaned records.

**Professor might ask:** "What if you didn't use cascade?" → We'd have to manually delete messages first, then discussions, or we'd get foreign key constraint errors.

---

### What is the difference between DELETE and TRUNCATE?
**Answer:** DELETE removes specific rows (with WHERE) and logs each deletion; TRUNCATE wipes the entire table instantly without logging individual rows. TRUNCATE is faster but can't be rolled back in some databases.

**Example:** In `ForumSchemaService.resetDatabase()`, I use `TRUNCATE TABLE forum_discussions` to wipe everything instantly for testing, rather than `DELETE FROM forum_discussions` which would be slower.

**Quick answer:** DELETE = remove specific rows, can rollback; TRUNCATE = wipe entire table fast, minimal logging.

**Professor might ask:** "Can you use WHERE with TRUNCATE?" → No, TRUNCATE is all-or-nothing. DELETE supports WHERE clauses.

---

### What is AUTO_INCREMENT?
**Answer:** AUTO_INCREMENT tells MySQL to automatically generate the next ID number when inserting a new row. ID 1, 2, 3, 4... gets assigned without us manually picking numbers.

**Example:** In `ForumSchemaService`, table creation: `id INT AUTO_INCREMENT PRIMARY KEY`. When I insert a new discussion without specifying ID, MySQL assigns the next available number automatically.

**Quick answer:** AUTO_INCREMENT = MySQL auto-assigns increasing ID numbers to new rows.

**Professor might ask:** "What happens if you delete row 5, then insert a new row?" → The new row gets ID 6 (AUTO_INCREMENT doesn't reuse deleted numbers).

---

## JavaFX & MVC

### What does MVC stand for and how is it applied in this project?
**Answer:** MVC = Model-View-Controller. Model is the data classes (ForumDiscussion, ForumMessage), View is the FXML files (AdminForumDashboard.fxml), Controller handles the logic (AdminForumController.java). They stay separate so UI and logic don't get mixed up.

**Example:** 
- Model: `ForumDiscussion.java` - just data fields (id, title, content)
- View: `AdminForumDashboard.fxml` - defines the tabs, tables, buttons
- Controller: `AdminForumController.java` - has `refreshStats()`, `loadCategories()` methods

**Quick answer:** MVC = Model (data) + View (UI) + Controller (logic); keeps code organized and reusable.

**Professor might ask:** "What if you put database code in the View?" → That would be messy and break MVC. The View should never talk to the database directly.

---

### What is the role of the Controller, Model, and Service in this project?
**Answer:** Controller handles user input and updates the UI. Model is just data containers (POJOs). Service layer handles business logic and database operations so Controllers stay clean.

**Example:**
- Model: `ForumDiscussion.java` - getters/setters only
- Service: `ForumDiscussionService.java` - has `addDiscussion()`, `updateDiscussion()`, SQL queries
- Controller: `AdminForumController.java` - calls `discussionService.addDiscussion(d)` and updates the TableView

**Quick answer:** Controller = UI events; Model = data; Service = database and business logic.

**Professor might ask:** "Why have a Service layer at all?" → So we can reuse database code across multiple controllers, and test logic without the UI.

---

### What is FXML and why do we use it instead of building UI in Java?
**Answer:** FXML is an XML format for defining JavaFX user interfaces declaratively. We use it instead of writing `Button b = new Button(); b.setText(...)` in Java because it's cleaner, designers can edit it, and SceneBuilder can visualize it.

**Example:** In `AdminForumDashboard.fxml`:
```xml
<TabPane>
  <Tab text="Discussions">
    <TableView fx:id="discussionsTable">
      <columns>
        <TableColumn text="Title" fx:id="titleColumn"/>
      </columns>
    </TableView>
  </Tab>
</TabPane>
```
Instead of writing 50 lines of Java code to create the same structure.

**Quick answer:** FXML = XML-based UI layout; cleaner than building UI in Java code.

**Professor might ask:** "Can you mix FXML and Java UI code?" → Yes, I do this in `refreshStats()` where I programmatically create stat cards and add them to the FXML-defined `statsFlowPane`.

---

### What does @FXML annotation do?
**Answer:** @FXML marks fields and methods that are connected to FXML elements. JavaFX automatically injects the UI components into these fields when the FXML loads.

**Example:** In `AdminForumController.java`:
```java
@FXML private TableView<ForumDiscussion> discussionsTable;
@FXML private Button refreshButton;
@FXML private TextField searchField;
```
These are automatically wired to the `fx:id` attributes in the FXML file.

**Quick answer:** @FXML = marks fields to be auto-injected from FXML; connects Java code to UI elements.

**Professor might ask:** "What happens if fx:id doesn't match the @FXML field name?" → The field stays null and we get a NullPointerException when trying to use it.

---

### What is FXMLLoader and what does it do?
**Answer:** FXMLLoader reads an FXML file and creates the actual Java objects (Buttons, Labels, etc.) from it. It also connects the @FXML fields and sets up the controller.

**Example:** In `Main.java` or when opening a dialog:
```java
FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/AdminForumDashboard.fxml"));
Parent root = loader.load();
AdminForumController controller = loader.getController();
```

**Quick answer:** FXMLLoader = reads FXML file and creates the Java UI objects from it.

**Professor might ask:** "How do you get the controller instance after loading?" → `loader.getController()` returns the controller object with all @FXML fields injected.

---

### What is the difference between VBox, HBox, AnchorPane, ScrollPane?
**Answer:** VBox stacks children vertically; HBox arranges horizontally; AnchorPane lets you anchor to edges with absolute positioning; ScrollPane adds scrollbars around its content.

**Examples from my code:**
- VBox: In `createStatCard()`, I use `VBox card = new VBox(8)` to stack icon, value, and description vertically
- HBox: In the filter bar, `HBox filterBox = new HBox(10)` arranges filter buttons horizontally
- ScrollPane: `notificationScrollPane` wraps the notifications list so it scrolls when there are many
- AnchorPane: Used as root in some FXMLs for absolute positioning of sidebar vs content

**Quick answer:** VBox = vertical stack; HBox = horizontal row; AnchorPane = edge anchoring; ScrollPane = scrollable container.

**Professor might ask:** "Which layout would you use for a form with labels and fields?" → GridPane (used in my discussion dialog) or VBox with nested HBoxes.

---

### What is an ObservableList and why is it used with JavaFX?
**Answer:** ObservableList is a List that fires change events when items are added/removed. JavaFX TableView and ListView automatically refresh when the ObservableList changes.

**Example:** In `AdminForumController.loadCategories()`:
```java
ObservableList<ForumCategory> categories = FXCollections.observableArrayList(categoryService.getAllCategories());
categoryTable.setItems(categories);
```
When I add a category to this list, the TableView updates automatically without calling `refresh()`.

**Quick answer:** ObservableList = a List that notifies JavaFX controls when it changes; enables auto-UI-updates.

**Professor might ask:** "What happens if you use a regular ArrayList instead?" → The UI won't update automatically when you add/remove items; you'd have to manually refresh the TableView.

---

### What is a TableView and how does setCellValueFactory work?
**Answer:** TableView displays data in rows and columns. `setCellValueFactory` tells each column how to extract data from the row object (like calling `getTitle()` on a ForumDiscussion).

**Example:** In `AdminForumController.setupTable()`:
```java
titleColumn.setCellValueFactory(new PropertyValueFactory<>("title"));
authorColumn.setCellValueFactory(cellData -> 
    new SimpleStringProperty(cellData.getValue().getAuthorName()));
```
The first uses reflection on the "title" property; the second uses a lambda to call getAuthorName().

**Quick answer:** TableView = data grid; setCellValueFactory = defines how each column extracts data from the row object.

**Professor might ask:** "What's the difference between PropertyValueFactory and a lambda CellValueFactory?" → PropertyValueFactory uses reflection (simpler), lambda gives full control (can format dates, combine fields, etc.).

---

### What is setCellFactory and when do we use it instead of setCellValueFactory?
**Answer:** setCellValueFactory defines WHAT data to show; setCellFactory defines HOW to render it (custom UI). Use setCellFactory when you need buttons, colors, or custom formatting in cells.

**Example:** In `AdminForumController.setupReportsTableColumns()`, the Actions column uses setCellFactory:
```java
actionsColumn.setCellFactory(col -> new TableCell<>() {
    @Override
    protected void updateItem(Void item, boolean empty) {
        super.updateItem(item, empty);
        if (!empty) {
            HBox buttons = new HBox(5, reviewedBtn, dismissedBtn);
            setGraphic(buttons); // Custom buttons instead of text
        }
    }
});
```

**Quick answer:** setCellValueFactory = what text to show; setCellFactory = custom UI (buttons, colors, etc.).

**Professor might ask:** "Can you use both on the same column?" → Yes, setCellValueFactory provides the data, setCellFactory customizes how it's displayed.

---

### What is the difference between setVisible(false) and setManaged(false)?
**Answer:** setVisible(false) hides the component but it still takes up space in the layout. setManaged(false) removes it from layout calculations entirely (no space reserved). Use both together to fully hide and collapse.

**Example:** In my inline error labels:
```java
errorLabel.setVisible(false);
errorLabel.setManaged(false); // Label takes no space when hidden
```
When showing: `setVisible(true); setManaged(true);` so the label appears and pushes other content down.

**Quick answer:** setVisible = hide but keep space; setManaged = remove from layout (no space); use both together.

**Professor might ask:** "What happens if you only do setVisible(false)?" → The component becomes invisible but still occupies its space in the layout, leaving a blank gap.

---

### What is a ChangeListener and how is it used for real-time validation?
**Answer:** ChangeListener is an interface that gets called whenever a property changes (like text in a TextField). I use it to validate input as the user types and show error messages immediately.

**Example:** In `ForumController.showDiscussionDialog()`:
```java
tfTitle.textProperty().addListener((obs, old, newVal) -> {
    validateDiscussionTitle(newVal, titleErrorLabel, titleCounter);
    validateBadWords(tfTitle.getText(), taContent.getText(), badWordErrorLabel);
    updateDiscussionOkButton(dialog, tfTitle, taContent, categoryBox, ...);
});
```
Every keystroke triggers validation and updates the OK button state.

**Quick answer:** ChangeListener = callback when a value changes; used for real-time validation on every keystroke.

**Professor might ask:** "What's the difference between ChangeListener and EventHandler?" → ChangeListener reacts to property value changes; EventHandler reacts to user actions (clicks, key presses).

---

### What is Platform.runLater() and when would you use it?
**Answer:** Platform.runLater() schedules code to run on the JavaFX UI thread later. Use it when you need to update UI from a background thread (like after a database query finishes).

**Example:** If I had a background thread loading data:
```java
new Thread(() -> {
    List<Discussion> data = service.loadSlowData();
    Platform.runLater(() -> {
        tableView.setItems(FXCollections.observableArrayList(data));
    });
}).start();
```

**Quick answer:** Platform.runLater() = run code on JavaFX UI thread; needed when updating UI from background threads.

**Professor might ask:** "What happens if you update UI from a background thread without runLater?" → It throws `IllegalStateException: Not on FX application thread`.

---

## Architecture & Design Patterns

### What is the Singleton pattern and where is it used in this project?
**Answer:** Singleton ensures only one instance exists. I use it for: MyDB (one DB connection), SessionManager (one user session store), ForumStatsService, ForumReportService, BadWordFilterService.

**Example:** All these classes have:
```java
private static ClassName instance;
public static ClassName getInstance() {
    if (instance == null) {
        synchronized (ClassName.class) {
            if (instance == null) instance = new ClassName();
        }
    }
    return instance;
}
private ClassName() {} // private constructor
```

**Quick answer:** Singleton = one instance only; used for MyDB, SessionManager, and all Service classes.

**Professor might ask:** "Why make the constructor private?" → So no one can accidentally create a second instance with `new MyDB()`.

---

### What is the Service layer and why do we separate it from the Controller?
**Answer:** Service layer contains business logic and database operations. Controllers handle UI events. Separating them keeps Controllers thin, enables code reuse, and makes testing easier.

**Example:** ForumDiscussionService has `addDiscussion()`, `updateDiscussion()`, `deleteDiscussion()` with all the SQL. AdminForumController just calls `discussionService.addDiscussion(d)` without knowing the SQL.

**Quick answer:** Service layer = database and business logic; keeps Controllers clean and enables code reuse.

**Professor might ask:** "What if you put SQL directly in the Controller?" → The Controller gets bloated, SQL is duplicated if multiple controllers need it, and we can't test database logic without the UI.

---

### What is SessionManager and why is it needed?
**Answer:** SessionManager is a singleton that stores the currently logged-in user's info (ID, name, role) during the app session. It's needed so any part of the app can check who's logged in without passing user objects everywhere.

**Example:** In `ForumController.postReply()`:
```java
String author = SessionManager.getInstance().getCurrentUserFullName();
```
In `SignInController` after login:
```java
SessionManager.getInstance().setCurrentUser(user);
```

**Quick answer:** SessionManager = stores logged-in user globally; any controller can check user identity anytime.

**Professor might ask:** "How does it handle logout?" → `SessionManager.getInstance().logout()` clears the user fields, then UI navigates back to login screen.

---

### Why do we use ensureSchema() in ForumSchemaService?
**Answer:** ensureSchema() checks if database tables exist and creates them if missing. It makes the app self-initializing - no manual SQL setup needed when someone runs the app for the first time.

**Example:** In `ForumSchemaService.ensureSchema()`:
```java
// Check if forum_discussions table exists
if (!tableExists(conn, "forum_discussions")) {
    createDiscussionsTable(conn);
}
// Same for messages, categories, votes, etc.
```
Called on app startup so tables are ready.

**Quick answer:** ensureSchema() = auto-creates DB tables if missing; makes app self-initializing.

**Professor might ask:** "What if the table exists but has wrong columns?" → ensureSchema() only checks existence; for migrations we'd need ALTER TABLE logic or a proper migration system.

---

### What is the difference between ALTER TABLE ADD COLUMN IF NOT EXISTS and a regular ALTER TABLE?
**Answer:** `ADD COLUMN IF NOT EXISTS` only adds the column if it's not already there (safe to run multiple times). Regular `ALTER TABLE ADD COLUMN` throws an error if the column exists.

**Example:** In `ForumSchemaService` when adding new fields to existing tables:
```java
String sql = "ALTER TABLE forum_discussions ADD COLUMN IF NOT EXISTS is_pinned BOOLEAN DEFAULT FALSE";
```
This lets me run it every startup without errors.

**Quick answer:** IF NOT EXISTS = safe to run multiple times; regular ALTER fails if column already exists.

**Professor might ask:** "Does MySQL support IF NOT EXISTS on ADD COLUMN?" → MySQL 8.0+ supports it; older versions need a different approach like checking INFORMATION_SCHEMA first.

---

## My Services - Detailed Explanations

### ForumStatsService

#### What does this service do and why is it useful?
**Answer:** It calculates forum statistics for the admin dashboard - total discussions, messages, most active category, top author, total votes. It gives admins a quick overview of forum activity.

**Example:** The admin Stats tab displays 5 stat cards showing these numbers refreshed on demand.

**Quick answer:** Calculates and provides forum statistics for the admin dashboard.

**Professor might ask:** "How often does it refresh?" → Only when the admin clicks Refresh button; it's not automatic polling.

---

#### Explain each method
**Answer:**
- `getTotalDiscussions()` - runs `SELECT COUNT(*) FROM forum_discussions`
- `getTotalMessages()` - runs `SELECT COUNT(*) FROM forum_messages`
- `getMostActiveCategory()` - runs `SELECT category_name, COUNT(*) as count FROM forum_discussions GROUP BY category_name ORDER BY count DESC LIMIT 1`, returns the category name
- `getTopAuthor()` - similar query but groups by author_name
- `getTotalVotes()` - `SELECT COUNT(*) FROM forum_votes`
- `getRecentActivityLog(limit)` - `SELECT title, created_at FROM forum_discussions ORDER BY created_at DESC LIMIT ?`

**Quick answer:** Each method runs a COUNT or aggregate SQL query and returns the result.

**Professor might ask:** "What SQL join is used in getMostActiveCategory?" → No join needed; category_name is stored directly in forum_discussions table (denormalized for simplicity).

---

#### Why is this a singleton?
**Answer:** No state to maintain, just database queries. Singleton ensures we don't create multiple instances doing the same thing. All stats services follow this pattern.

**Quick answer:** No state, just queries; singleton avoids unnecessary object creation.

---

#### How is it displayed in the admin Stats tab?
**Answer:** In `AdminForumController.refreshStats()`, I call the service methods and create styled cards with the values. Each card shows an emoji icon, the big number, and a description label.

**Example:**
```java
cardsRow.getChildren().add(createStatCard("📊", 
    String.valueOf(statsService.getTotalDiscussions()), 
    "Total Discussions"));
```

**Quick answer:** refreshStats() calls service methods and creates styled cards with emoji, number, and label.

---

### BadWordFilterService

#### What does this service do and why is it important?
**Answer:** It detects and censors inappropriate language in discussions and replies. Important for maintaining a professional learning environment and preventing abuse.

**Quick answer:** Detects and censors profanity in user-generated content.

---

#### How does containsBadWord(String text) work internally?
**Answer:** It normalizes the text (lowercase, removes spaces, converts numbers to letters), then runs 5 checks: direct match, spaced match, stretched letters pattern, missing vowels pattern, combined pattern.

**Quick answer:** Normalizes input then runs 5 pattern checks including stretched words and number substitutions.

---

#### What is regex and how is it used to catch stretched words?
**Answer:** Regex (regular expressions) are patterns for matching text. For stretched words like "fuuuuck", I build a pattern where each letter can repeat: `f+u+c+k+` matches "fck", "fuuuck", "fuuuuuck", etc.

**Example code:**
```java
StringBuilder stretched = new StringBuilder();
for (char c : word.toCharArray()) {
    stretched.append(Pattern.quote(String.valueOf(c))).append("+");
}
// Pattern becomes: f+u+c+k+
```

**Quick answer:** Regex = pattern matching language; `+` means "one or more" so f+u+c+k+ catches fuuuuck.

**Professor might ask:** "What does the + quantifier mean?" → It means the preceding character must appear at least once, but can repeat any number of times.

---

#### How does it catch number substitutions like f4ck, sh1t?
**Answer:** I normalize the text first by replacing numbers with letters: `0→o, 1→i, 3→e, 4→a, 5→s, 6→g, 7→t, 8→b, 9→g`. Then check if the normalized version contains banned words.

**Example:** "f4ck" → replace 4 with a → "fack" → contains "fuck"? No, wait... Actually I normalize then check patterns. The number substitution is handled in the normalization step.

**Quick answer:** Pre-processes text converting 4→a, 1→i, etc., then checks against banned words.

---

#### How does it catch joined words like fuckyou with spaces removed?
**Answer:** In the normalization step, I remove ALL spaces: `.replace(" ", "")`. So "fuck you" becomes "fuckyouchuck" and matches the compound word "fuckyou" in the banned list.

**Quick answer:** Removes all spaces during normalization so "fuck you" matches "fuckyou".

---

#### Where in the app is it called?
**Answer:** Two places:
1. `ForumController.showDiscussionDialog()` - when creating/editing a discussion, validates title and content
2. `ForumController.postReply()` - when posting a reply, checks content before saving

Both show inline error labels, not popup alerts.

**Quick answer:** Discussion creation form and reply posting; both use inline error labels.

---

#### What is the badwords.txt file and how is it loaded?
**Answer:** Actually I now use a hardcoded HashSet in the constructor instead of a file. Originally I considered loading from file with `getResourceAsStream()`, but hardcoding is more reliable for deployment.

**Quick answer:** Currently hardcoded HashSet in constructor; originally planned file-based loading.

---

### ForumReportService

#### What does this service do end to end?
**Answer:** It manages the report system where users can report inappropriate content. Stores reports, checks for duplicates, retrieves pending reports for admins, and updates report status (reviewed/dismissed).

**Quick answer:** Manages user reports of inappropriate content for admin review.

---

#### Explain each method
**Answer:**
- `addReport()` - inserts a new report into forum_reports table
- `alreadyReported()` - checks if user already reported this content (prevents duplicates)
- `getAllReports()` - retrieves all reports with reporter and target info using SQL JOINs
- `getPendingCount()` - counts reports with status='pending' for the badge
- `updateStatus()` - changes report status to 'reviewed' or 'dismissed'

**Quick answer:** add/create, check duplicates, retrieve, count, update status.

---

#### What SQL JOIN is used in getAllReports() and why?
**Answer:** LEFT JOINs on users table (for reporter name) and forum_discussions/forum_messages (for target content). LEFT JOIN ensures we still get the report even if the original content was deleted.

**Example query:**
```sql
SELECT r.*, u.full_name as reporter_name, 
       COALESCE(d.title, m.content) as target_content
FROM forum_reports r
LEFT JOIN users u ON r.reporter_id = u.id
LEFT JOIN forum_discussions d ON r.target_type='discussion' AND r.target_id=d.id
LEFT JOIN forum_messages m ON r.target_type='message' AND r.target_id=m.id
```

**Quick answer:** LEFT JOINs on users and content tables; ensures reports show even if content was deleted.

---

#### What is a LEFT JOIN vs INNER JOIN?
**Answer:** INNER JOIN only returns rows where both tables have matching data. LEFT JOIN returns all rows from the left table, with NULLs if no match in the right table.

**Example:** If a user is deleted but their reports remain:
- INNER JOIN would hide those reports (no matching user)
- LEFT JOIN shows the report with reporter_name=NULL

**Quick answer:** INNER JOIN = match required; LEFT JOIN = keep left rows even without match.

---

#### What is COALESCE and why is it used?
**Answer:** COALESCE returns the first non-NULL value. I use it to get the target content from either discussions or messages tables: `COALESCE(d.title, m.content)`. Whichever table has data, that's what we show.

**Quick answer:** COALESCE = return first non-NULL value; used to get content from either discussions or messages.

---

#### How does the admin see and manage reports?
**Answer:** In the Reports tab, there's a TableView showing reports with columns: type, content preview, reporter, reason, date, status, and action buttons. Pending reports are highlighted in orange. Admin clicks "Reviewed" or "Dismissed" buttons.

**Quick answer:** Reports tab with TableView; pending highlighted; Reviewed/Dismissed buttons.

---

### ForumDiscussionService.getFilteredDiscussions()

#### What does this method do?
**Answer:** It builds and executes a dynamic SQL query based on filter criteria (sort by views, replies, newest, pinned, solved) plus optional search text and category filter.

**Quick answer:** Builds dynamic SQL for filtering and sorting discussions.

---

#### How does StringBuilder build the SQL dynamically?
**Answer:** I start with base query string, then append WHERE clauses if search/category provided, append ORDER BY based on sort mode, append LIMIT/OFFSET for pagination. StringBuilder is efficient for concatenating query parts.

**Example:**
```java
StringBuilder sql = new StringBuilder("SELECT d.*, c.name as category_name FROM forum_discussions d");
sql.append(" JOIN forum_categories c ON d.category_id = c.id");
if (search != null && !search.isEmpty()) {
    sql.append(" WHERE d.title LIKE ? OR d.content LIKE ?");
}
// ... more conditions
sql.append(" ORDER BY ").append(getSortColumn(sortBy));
```

**Quick answer:** Appends WHERE, ORDER BY, and LIMIT clauses conditionally based on parameters.

---

#### What does each filter mode do differently in SQL?
**Answer:**
- `views` - `ORDER BY views DESC`
- `replies` - Uses `LEFT JOIN (SELECT discussion_id, COUNT(*) as reply_count FROM forum_messages GROUP BY discussion_id) replies ON d.id = replies.discussion_id` then `ORDER BY reply_count DESC`
- `newest` - `ORDER BY created_at DESC`
- `pinned` - `WHERE is_pinned = TRUE` (actually we show pinned first, then apply other sorts)
- `solved` - Similar to pinned, filter where is_solved = TRUE

**Quick answer:** Different ORDER BY columns; replies uses a subquery COUNT; pinned/solved use WHERE filters.

---

#### What is a LEFT JOIN with COUNT() used for in the replies sort?
**Answer:** I need to count messages per discussion to sort by most replies. The subquery `SELECT discussion_id, COUNT(*) FROM forum_messages GROUP BY discussion_id` creates a temporary reply count table, then LEFT JOIN connects it to discussions.

**Quick answer:** Subquery counts messages per discussion; LEFT JOIN connects counts to discussion rows.

---

#### How does it stack with search text and category filter?
**Answer:** All conditions are ANDed together. If search and category both provided: `WHERE (title LIKE ? OR content LIKE ?) AND category_id = ?`. Then ORDER BY applies after filtering.

**Quick answer:** WHERE clauses are combined with AND; happens before ORDER BY.

---

## Advanced Features

### Upvote/Downvote System

#### How does it work technically?
**Answer:** Users click up or down arrows on messages. Each vote is a row in forum_votes table with message_id, user_id, and vote_type ('up' or 'down'). The score is calculated as (upvotes - downvotes).

**Quick answer:** forum_votes table stores message_id, user_id, vote_type; score = up - down.

---

#### What is the forum_votes table structure?
**Answer:**
```sql
CREATE TABLE forum_votes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    message_id INT NOT NULL,
    user_id INT NOT NULL,
    vote_type ENUM('up', 'down') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_vote (message_id, user_id)
);
```
The UNIQUE constraint prevents double voting.

**Quick answer:** message_id, user_id, vote_type (up/down), with unique constraint preventing duplicates.

---

#### How do we prevent a user from voting on their own message?
**Answer:** Before allowing vote, check if the message author matches the current user from SessionManager:
```java
if (message.getAuthorName().equals(SessionManager.getInstance().getCurrentUserFullName())) {
    showWarning("You cannot vote on your own message");
    return;
}
```

**Quick answer:** Compare message author with SessionManager current user; block if same.

---

#### How do we prevent double voting?
**Answer:** The database has a UNIQUE constraint on (message_id, user_id). Also, I check first with `alreadyVoted()` method, and if voting again, I update the existing row (toggle) instead of inserting.

**Quick answer:** UNIQUE constraint on message_id+user_id; code checks before inserting.

---

#### What happens when the user votes again?
**Answer:** If they click the same vote type again, I remove their vote (toggle off). If they click the opposite type, I update their vote from up to down (or vice versa).

**Quick answer:** Same vote = remove it; opposite vote = change to new type.

---

### Threaded Inline Replies

#### How does clicking "Reply" on a message inject a reply box?
**Answer:** In the message card's "Reply" button handler, I call `createInlineReplyBox()` which builds a TextArea and Post/Cancel buttons, then insert it into the messages container at the right position (below the parent message).

**Quick answer:** createInlineReplyBox() builds UI programmatically and inserts into the VBox at the correct index.

---

#### What is parentMessageId and how is it stored?
**Answer:** When replying to a specific message (not the whole discussion), parentMessageId stores which message this is a reply to. NULL means it's a top-level reply to the discussion.

**Example:**
```java
ForumMessage reply = new ForumMessage(content, author, discussionId);
reply.setParentMessageId(parentMessageId); // Set if replying to a specific message
```

**Quick answer:** parentMessageId = ID of message being replied to; NULL = reply to discussion itself.

---

#### How are nested replies rendered indented under their parent?
**Answer:** When rendering messages, I check `message.getParentMessageId()`. If not null, I add left padding or margin to visually indent the reply card under its parent message.

**Example in buildMessageCard():**
```java
if (message.getParentMessageId() != null) {
    card.setStyle(card.getStyle() + " -fx-padding: 12 12 12 32;"); // Extra left padding
}
```

**Quick answer:** Check parentMessageId; add left padding to visually indent child replies.

---

#### How is only one reply box open at a time enforced?
**Answer:** I track `currentReplyBox` and `currentReplyParent` as fields in the controller. When opening a new reply box, I first call `removeCurrentReplyBox()` to close any existing one.

**Example:**
```java
private void startReplyToMessage(ForumMessage parentMessage) {
    removeCurrentReplyBox(); // Close existing
    VBox replyBox = createInlineReplyBox(parentMessage);
    currentReplyBox = replyBox;
    currentReplyParent = parentMessage;
    // ... add to UI
}
```

**Quick answer:** Track currentReplyBox field; close existing before opening new.

---

### Report System

#### How does a user report a message or discussion?
**Answer:** In the message/discussion card, there's a "Report" button that opens a dialog with reason options (Spam, Inappropriate, Off-topic, Harassment, Other). User selects reason and clicks Submit.

**Quick answer:** Report button opens dialog with reason dropdown; Submit creates report record.

---

#### What dialog appears and what are the reason options?
**Answer:** A simple dialog with ComboBox for reasons: "Spam", "Inappropriate Content", "Off-topic", "Harassment/Bullying", "Other". TextArea for optional details.

**Quick answer:** Dialog with ComboBox (5 options) and optional details TextArea.

---

#### How is double reporting prevented?
**Answer:** The `alreadyReported()` method checks if a report exists with same reporter_id, target_type, and target_id. If yes, shows "You already reported this" warning.

**Example:**
```java
if (reportService.alreadyReported(userId, targetType, targetId)) {
    showWarning("You have already reported this content");
    return;
}
```

**Quick answer:** Check if report exists with same user+target; block if already reported.

---

#### How does the admin see it in the Reports tab?
**Answer:** TableView with columns showing report info. Pending reports highlighted in orange/yellow. Badge on Reports tab shows pending count.

**Quick answer:** TableView with pending reports highlighted; badge shows pending count.

---

#### What actions can the admin take?
**Answer:** Two buttons per report: "Reviewed" (marks as handled) and "Dismissed" (marks as invalid). Both update the status field in the database.

**Quick answer:** Reviewed or Dismissed buttons; updates report status.

---

### Pin and Solved (Admin Only)

#### How does pinning work and what SQL is used?
**Answer:** Boolean flag `is_pinned` in forum_discussions. When admin clicks Pin button: `UPDATE forum_discussions SET is_pinned = TRUE WHERE id = ?`.

**Quick answer:** Boolean is_pinned field; UPDATE sets it TRUE/FALSE.

---

#### How are pinned discussions always shown at the top?
**Answer:** In the query for listing discussions, I add `ORDER BY is_pinned DESC, created_at DESC`. This puts pinned posts first regardless of date.

**Example SQL:**
```sql
SELECT * FROM forum_discussions 
ORDER BY is_pinned DESC, created_at DESC
```

**Quick answer:** ORDER BY is_pinned DESC puts pinned posts first.

---

#### How is it enforced that only admin can pin/solve?
**Answer:** Pin/Solve buttons only exist in AdminForumController, not in ForumController (user side). Also, I could check user role before allowing the action.

**Quick answer:** Buttons only in admin UI; not shown to regular users.

---

#### How do badges appear on the user side?
**Answer:** When rendering discussion cards, I check `discussion.isPinned()` and `discussion.isSolved()` and prepend emojis to the title: 📌 for pinned, ✔ for solved.

**Example:**
```java
String prefix = (d.isPinned() ? "📌 " : "") + (d.isSolved() ? "✔ " : "");
titleLabel.setText(prefix + d.getTitle());
```

**Quick answer:** Check boolean flags; prepend 📌 or ✔ emojis to title.

---

### Smart Filter Bar

#### What are the 5 filters and what does each do?
**Answer:**
1. **All** - No filter, show everything
2. **Popular** - Sort by view count (most viewed first)
3. **Active** - Sort by reply count (most replies first)
4. **Newest** - Sort by created_at descending
5. **Pinned** - Show only pinned discussions

**Quick answer:** All, Popular (views), Active (replies), Newest (date), Pinned.

---

#### How does clicking a filter call getFilteredDiscussions()?
**Answer:** Each filter button has an action handler that sets the `currentFilter` variable and calls `loadDiscussions()` which internally calls `getFilteredDiscussions()` with the appropriate sortBy parameter.

**Example:**
```java
popularFilterBtn.setOnAction(e -> {
    currentFilter = "views";
    loadDiscussions();
});
```

**Quick answer:** Sets currentFilter variable; triggers loadDiscussions() which calls service with sort parameter.

---

#### How do filters stack with search and category dropdown?
**Answer:** All three parameters are passed to the service method: `getFilteredDiscussions(searchText, categoryId, sortBy)`. The SQL builder combines them with AND clauses.

**Quick answer:** All parameters passed together; SQL builder combines with AND.

---

#### How is the active filter button styled differently?
**Answer:** The active filter gets the "filter-btn-active" CSS class (darker background), while inactive ones have "filter-btn" class. I have a `setActiveFilter()` method that updates styles.

**Example:**
```java
private void setActiveFilter(String filter) {
    allFilterBtn.getStyleClass().remove("filter-btn-active");
    popularFilterBtn.getStyleClass().remove("filter-btn-active");
    // ... clear all
    
    switch(filter) {
        case "all": allFilterBtn.getStyleClass().add("filter-btn-active"); break;
        case "views": popularFilterBtn.getStyleClass().add("filter-btn-active"); break;
        // ... etc
    }
}
```

**Quick answer:** Active button gets "filter-btn-active" CSS class; inactive have "filter-btn".

---

### Image Attachments

#### How does a user attach an image?
**Answer:** When creating a discussion or reply, there's an "Attach Image" button that opens a FileChooser dialog. User selects an image file (PNG, JPG, etc.).

**Quick answer:** "Attach Image" button opens FileChooser for selecting image files.

---

#### What is FileChooser and how is it used?
**Answer:** FileChooser is a JavaFX dialog for selecting files. I configure it with extension filters for images only, then show it and get the selected File.

**Example:**
```java
FileChooser fileChooser = new FileChooser();
fileChooser.setTitle("Select Image");
fileChooser.getExtensionFilters().add(
    new FileChooser.ExtensionFilter("Image Files", "*.png", "*.jpg", "*.jpeg")
);
File selectedFile = fileChooser.showOpenDialog(stage);
```

**Quick answer:** FileChooser = file selection dialog; configured with image file filters.

---

#### Where are images stored on disk?
**Answer:** In `uploads/forum_images/` directory relative to the project root. I create the directory if it doesn't exist.

**Quick answer:** uploads/forum_images/ directory.

---

#### Why store file path in DB instead of binary image data?
**Answer:** Storing binary BLOBs in database makes it huge and slow. Storing paths keeps the database small; images are loaded from disk on demand.

**Quick answer:** Paths keep database small; BLOBs would bloat and slow down the DB.

---

#### How is the image rendered in the message card?
**Answer:** I create an ImageView, load the image from the file path, and add it to the message card VBox.

**Example:**
```java
if (message.getImagePath() != null && !message.getImagePath().isEmpty()) {
    ImageView imageView = new ImageView(new Image("file:" + message.getImagePath()));
    imageView.setFitWidth(400);
    imageView.setPreserveRatio(true);
    card.getChildren().add(imageView);
}
```

**Quick answer:** ImageView loads image from file path; added to message card layout.

---

#### How does export/save image feature work?
**Answer:** Right-click on image shows "Save Image" option. Uses FileChooser to pick destination, then `Files.copy()` to copy from uploads folder to chosen location.

**Example:**
```java
Files.copy(
    Paths.get(sourceImagePath), 
    Paths.get(destPath), 
    StandardCopyOption.REPLACE_EXISTING
);
```

**Quick answer:** Files.copy() copies from source path to user-selected destination.

---

## User Integration

#### How was the user module integrated into the forum?
**Answer:** The user module was built separately with its own database connection (MyConnection). I integrated it by using SessionManager to share logged-in user info, and I unified the database so both modules use the same MyDB connection.

**Quick answer:** SessionManager shares user state; unified database connection for both modules.

---

#### What is SessionManager - pattern, what it stores, how accessed?
**Answer:** SessionManager is a singleton that stores current user ID, full name, email, and role. Any controller can access it with `SessionManager.getInstance()` to check who's logged in.

**Quick answer:** Singleton storing user ID, name, email, role; accessed via getInstance().

---

#### How does app startup flow work?
**Answer:** App starts at Main.java which loads the login FXML first. After successful login, SignInController calls `SessionManager.getInstance().setCurrentUser(user)` then navigates to the main EduConnect shell window.

**Quick answer:** Main → Login → On success → SessionManager stores user → Main shell opens.

---

#### How does SignInController save the user to SessionManager?
**Answer:** After validating credentials:
```java
User user = userService.authenticate(email, password);
if (user != null) {
    SessionManager.getInstance().setCurrentUser(user);
    // ... navigate to main window
}
```

**Quick answer:** setCurrentUser() called with authenticated user object.

---

#### How does ForumController get the logged-in user's name?
**Answer:** `SessionManager.getInstance().getCurrentUserFullName()` is called when creating discussions or posting replies to set the author automatically.

**Quick answer:** getCurrentUserFullName() from SessionManager.

---

#### How does EduConnectController show the logged-in user's name in sidebar?
**Answer:** The sidebar has a label that's updated from SessionManager on initialization:
```java
userNameLabel.setText(SessionManager.getInstance().getCurrentUserFullName());
```

**Quick answer:** Label text set from SessionManager on controller initialization.

---

#### How does logout work?
**Answer:** Logout button calls `SessionManager.getInstance().logout()` which clears all user fields, then navigates back to the login screen.

**Quick answer:** logout() clears user data; UI returns to login screen.

---

#### How are the two DB connections unified?
**Answer:** The user module originally used MyConnection class. I modified it to use MyDB.getInstance().getConnection() instead, so both modules share the same connection pool.

**Quick answer:** User module changed to use MyDB.getInstance() instead of its own MyConnection.

---

#### Why unify them and what problem do two connections cause?
**Answer:** Two connections create resource waste (double the connections), potential deadlocks if both try to lock the same tables, and transaction issues. One connection pool is more efficient and consistent.

**Quick answer:** Avoids resource waste, deadlocks, and transaction conflicts; more efficient.

---

#### How does admin see different options than regular user?
**Answer:** Role check from SessionManager: `SessionManager.getInstance().isAdmin()`. Admin sees extra buttons (Pin, Solve, Delete on others' posts), Reports tab, and Stats tab.

**Quick answer:** isAdmin() check from SessionManager determines which UI elements to show.

---

## CSS & Styling

#### What is a CSS class and how is it applied in JavaFX?
**Answer:** CSS class is a reusable style definition. In JavaFX, I apply it with `getStyleClass().add("class-name")` on nodes, or in FXML with `styleClass="class-name"`.

**Example:**
```java
Button btn = new Button("Click");
btn.getStyleClass().add("primary-btn");
```

**Quick answer:** Reusable style definition; applied via getStyleClass().add() or FXML.

---

#### What does -fx-background-color do vs -fx-fill?
**Answer:** `-fx-background-color` sets background color for regions (VBox, HBox, Button). `-fx-fill` sets the interior color of shapes (Circle, Rectangle) or text color in Labels.

**Quick answer:** -fx-background-color = region background; -fx-fill = shape interior or text color.

---

#### How does JavaFX CSS differ from web CSS?
**Answer:** JavaFX CSS uses `-fx-` prefix for properties. Some properties are different (no `display: flex`, use JavaFX layout classes instead). Selectors work the same (class, id) but properties are JavaFX-specific.

**Quick answer:** JavaFX CSS has -fx- prefix and JavaFX-specific properties; no web layout properties.

---

#### What is setStyle() and when do we use inline vs CSS classes?
**Answer:** `setStyle()` applies inline CSS directly to one component. Use it for dynamic styles that change at runtime (like alternating row colors). Use CSS classes for static, reusable styles defined in .css files.

**Example:**
```java
// Inline for dynamic
rowBox.setStyle("-fx-background-color: rgba(45,106,79,0.08);");

// CSS class for static
btn.getStyleClass().add("primary-btn");
```

**Quick answer:** setStyle() = inline for dynamic; CSS classes = reusable static styles.

---

#### How does dark mode work?
**Answer:** I don't actually have a toggleable dark mode implemented. The UI uses a fixed dark theme with teal accents (#2d6a4f, #4db886) defined in CSS. The "dark mode" mentioned in earlier code was removed in favor of consistent dark styling.

**Quick answer:** Fixed dark theme with teal accent colors; no toggle implemented.

---

## General Java

#### What is a List vs ArrayList vs ObservableList?
**Answer:**
- List = interface defining list operations
- ArrayList = concrete implementation using array
- ObservableList = JavaFX list that fires change events

**Example:**
```java
List<String> basic = new ArrayList<>(); // Plain list
ObservableList<String> fx = FXCollections.observableArrayList(); // JavaFX list
```

**Quick answer:** List = interface; ArrayList = implementation; ObservableList = JavaFX notifying list.

---

#### What is a lambda expression and give an example?
**Answer:** Lambda is a short way to write anonymous functions. Syntax: `(params) -> { body }`.

**Example from my code:**
```java
titleField.textProperty().addListener((obs, old, newVal) -> {
    validateTitle(newVal);
});
```

**Quick answer:** Short anonymous function syntax; used for event handlers and callbacks.

---

#### What is try-catch and why is it important around DB calls?
**Answer:** try-catch handles exceptions that might occur. Database calls can fail (connection lost, SQL error), so we catch SQLException to prevent app crashes and show user-friendly errors.

**Example:**
```java
try {
    Connection conn = MyDB.getInstance().getConnection();
    // ... execute query
} catch (SQLException e) {
    System.err.println("Database error: " + e.getMessage());
    showWarning("Could not load data");
}
```

**Quick answer:** Handles exceptions; prevents crashes from database errors.

---

#### What is StringBuilder and why is it used in getFilteredDiscussions()?
**Answer:** StringBuilder efficiently concatenates strings without creating many intermediate objects. I use it to build dynamic SQL queries piece by piece.

**Example:**
```java
StringBuilder sql = new StringBuilder("SELECT * FROM forum_discussions");
if (search != null) sql.append(" WHERE title LIKE ?");
sql.append(" ORDER BY created_at DESC");
```

**Quick answer:** Efficient string concatenation; used for building SQL queries dynamically.

---

#### What is an enum and where is it used?
**Answer:** Enum defines a fixed set of constants. Used for:
- User roles: `ADMIN`, `TEACHER`, `STUDENT`
- Report status: `PENDING`, `REVIEWED`, `DISMISSED`
- Vote type: `UP`, `DOWN`

**Quick answer:** Fixed constant set; used for roles, report status, vote types.

---

#### What is the difference between == and .equals()?
**Answer:**
- `==` compares object references (same memory location)
- `.equals()` compares content/value

**Example:**
```java
String a = new String("hi");
String b = new String("hi");
a == b // false (different objects)
a.equals(b) // true (same content)
```

**Quick answer:** == checks if same object; .equals() checks if same value.

---

#### What does Comparator.comparing() do?
**Answer:** Creates a Comparator that compares objects by a specific field. Used for sorting lists.

**Example:**
```java
categories.sort(Comparator.comparing(ForumCategory::getName));
```

**Quick answer:** Creates comparator for sorting by a specific field/method.

---

#### What is BufferedReader and InputStreamReader?
**Answer:** They read text from input streams. InputStreamReader converts bytes to characters; BufferedReader adds buffering for efficiency and provides `readLine()` method.

**Quick answer:** InputStreamReader = bytes to chars; BufferedReader = buffered line reading.

---

#### What is getResourceAsStream() and why is it better than hardcoded paths?
**Answer:** Loads files from the classpath (inside JAR or project resources). Better than hardcoded paths because it works whether running from IDE or deployed JAR.

**Quick answer:** Loads from classpath; works in IDE and deployed JAR without path changes.

---

#### What is a HashSet and why use it for banned words?
**Answer:** HashSet is a collection with no duplicates and O(1) lookup time. Perfect for banned words because we need fast contains() checks and don't care about order.

**Quick answer:** Fast lookup, no duplicates; ideal for fast contains() checks.

---

## Good Luck!

Remember:
- Speak confidently and refer to specific file names and line numbers
- If unsure, say "Let me show you in the code" and navigate to the relevant file
- The professor wants to see you understand, not just memorize
- Use the examples from YOUR actual code - that proves you wrote it
