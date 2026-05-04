package services;

import models.ForumCategory;
import models.ForumDiscussion;
import models.ForumMessage;

import java.sql.Timestamp;
import java.time.Instant;
import java.util.ArrayList;
import java.util.List;
import java.util.Random;

/**
 * Comprehensive forum data populator for EduConnect
 * Creates realistic educational content for demonstration purposes
 */
public class ForumDataPopulator {
    
    private final ForumCategoryService categoryService = new ForumCategoryService();
    private final ForumDiscussionService discussionService = new ForumDiscussionService();
    private final ForumMessageService messageService = new ForumMessageService();
    private final Random random = new Random();
    
    // Realistic student names
    private final String[] studentNames = {
        "Alex Chen", "Sarah Johnson", "Michael Brown", "Emma Wilson", 
        "David Lee", "Jessica Martinez", "Ryan Taylor", "Sophia Anderson",
        "James Thomas", "Olivia Garcia", "William Rodriguez", "Ava White",
        "Benjamin Harris", "Isabella Clark", "Lucas Lewis", "Mia Walker",
        "Henry Hall", "Charlotte Young", "Daniel King", "Amelia Wright"
    };
    
    /**
     * Populates the entire forum with realistic data
     */
    public void populateForum() {
        System.out.println("Starting forum population...");
        
        // Clear existing data (optional - comment out if you want to keep existing data)
        // clearExistingData();
        
        // Create categories
        List<Integer> categoryIds = createCategories();
        
        // Create discussions and messages for each category
        for (int categoryId : categoryIds) {
            createDiscussionsAndMessages(categoryId);
        }
        
        System.out.println("Forum population completed successfully!");
    }
    
    /**
     * Creates realistic educational categories
     */
    private List<Integer> createCategories() {
        List<Integer> categoryIds = new ArrayList<>();
        
        // Category 1: Programming Help
        ForumCategory programming = new ForumCategory(
            "Programming Help", 
            "Get help with coding problems, algorithms, and programming concepts", 
            "#2E86AB"
        );
        programming.setCreatedAt(Timestamp.from(Instant.now().minusSeconds(random.nextInt(86400 * 30))));
        int progId = categoryService.addCategory(programming);
        categoryIds.add(progId);
        
        // Category 2: Mathematics Support
        ForumCategory math = new ForumCategory(
            "Mathematics Support", 
            "Discuss math problems, calculus, algebra, and get study tips", 
            "#A23B72"
        );
        math.setCreatedAt(Timestamp.from(Instant.now().minusSeconds(random.nextInt(86400 * 30))));
        int mathId = categoryService.addCategory(math);
        categoryIds.add(mathId);
        
        // Category 3: Exam Preparation
        ForumCategory exams = new ForumCategory(
            "Exam Preparation", 
            "Share study strategies, exam tips, and preparation techniques", 
            "#F18F01"
        );
        exams.setCreatedAt(Timestamp.from(Instant.now().minusSeconds(random.nextInt(86400 * 30))));
        int examId = categoryService.addCategory(exams);
        categoryIds.add(examId);
        
        // Category 4: Project Ideas
        ForumCategory projects = new ForumCategory(
            "Project Ideas", 
            "Brainstorm and discuss academic and personal project ideas", 
            "#C73E1D"
        );
        projects.setCreatedAt(Timestamp.from(Instant.now().minusSeconds(random.nextInt(86400 * 30))));
        int projId = categoryService.addCategory(projects);
        categoryIds.add(projId);
        
        // Category 5: Course Questions
        ForumCategory courses = new ForumCategory(
            "Course Questions", 
            "Ask questions about specific courses and assignments", 
            "#5D737E"
        );
        courses.setCreatedAt(Timestamp.from(Instant.now().minusSeconds(random.nextInt(86400 * 30))));
        int courseId = categoryService.addCategory(courses);
        categoryIds.add(courseId);
        
        // Category 6: Study Methods
        ForumCategory study = new ForumCategory(
            "Study Methods", 
            "Share effective study techniques and learning strategies", 
            "#6500B3"
        );
        study.setCreatedAt(Timestamp.from(Instant.now().minusSeconds(random.nextInt(86400 * 30))));
        int studyId = categoryService.addCategory(study);
        categoryIds.add(studyId);
        
        // Category 7: Internships & Career
        ForumCategory career = new ForumCategory(
            "Internships & Career", 
            "Discuss internship opportunities, career advice, and job hunting", 
            "#008B5D"
        );
        career.setCreatedAt(Timestamp.from(Instant.now().minusSeconds(random.nextInt(86400 * 30))));
        int careerId = categoryService.addCategory(career);
        categoryIds.add(careerId);
        
        // Category 8: General Student Discussion
        ForumCategory general = new ForumCategory(
            "General Student Discussion", 
            "General chat about student life, campus events, and everything else", 
            "#FF6B6B"
        );
        general.setCreatedAt(Timestamp.from(Instant.now().minusSeconds(random.nextInt(86400 * 30))));
        int generalId = categoryService.addCategory(general);
        categoryIds.add(generalId);
        
        System.out.println("Created 8 educational categories");
        return categoryIds;
    }
    
    /**
     * Creates discussions and messages for a specific category
     */
    private void createDiscussionsAndMessages(int categoryId) {
        ForumCategory category = categoryService.getCategoryById(categoryId);
        if (category == null) return;
        
        switch (category.getName()) {
            case "Programming Help":
                createProgrammingDiscussions(categoryId);
                break;
            case "Mathematics Support":
                createMathDiscussions(categoryId);
                break;
            case "Exam Preparation":
                createExamDiscussions(categoryId);
                break;
            case "Project Ideas":
                createProjectDiscussions(categoryId);
                break;
            case "Course Questions":
                createCourseDiscussions(categoryId);
                break;
            case "Study Methods":
                createStudyDiscussions(categoryId);
                break;
            case "Internships & Career":
                createCareerDiscussions(categoryId);
                break;
            case "General Student Discussion":
                createGeneralDiscussions(categoryId);
                break;
        }
    }
    
    private void createProgrammingDiscussions(int categoryId) {
        // Discussion 1: Java recursion help
        ForumDiscussion recursion = new ForumDiscussion(
            "Help with recursion in Java - getting StackOverflowError",
            "I'm working on a recursive method to calculate factorial, but I keep getting StackOverflowError when I input numbers larger than 20. I don't understand what's happening - shouldn't recursion work for any input size? Here's my code:\n\n```java\npublic static long factorial(int n) {\n    if (n <= 1) return 1;\n    return n * factorial(n - 1);\n}\n```\n\nAm I missing something fundamental about recursion? The error happens at n=21. Is this a limitation of Java or my approach?",
            getRandomStudentName(),
            categoryId
        );
        recursion.setCreatedAt(Timestamp.from(Instant.now().minusSeconds(86400 * 3)));
        recursion.setViews(156);
        int recursionId = discussionService.addDiscussion(recursion);
        
        // Messages for recursion discussion
        addMessage(recursionId, "This is a classic recursion issue! The problem isn't with Java, but with the call stack limit. Each recursive call adds to the stack, and after about 20 calls, you run out of stack space. For larger numbers, you should either use iteration or memoization.", "David Lee", false, 12, 0);
        addMessage(recursionId, "Also, you're hitting the limit of long data type. 21! is way larger than Long.MAX_VALUE. You should use BigInteger for large factorials: `BigInteger result = BigInteger.ONE; for (int i = 2; i <= n; i++) result = result.multiply(BigInteger.valueOf(i));`", "Sarah Johnson", false, 8, 0);
        addMessage(recursionId, "Thanks both! I didn't realize about the stack limit. The BigInteger solution is perfect for my assignment. This explains why my professor mentioned using iteration for this specific problem.", recursion.getAuthorName(), true, 3, 0);
        
        // Discussion 2: SQL connection issues
        ForumDiscussion sql = new ForumDiscussion(
            "SQL connection pooling vs direct connections - which is better?",
            "I'm building a web application and I'm confused about database connections. Should I use connection pooling or just open/close connections for each query? My current approach opens a new connection for every database operation, but I'm worried about performance.\n\nWhat are the pros and cons of each approach? When should I use pooling vs direct connections?",
            getRandomStudentName(),
            categoryId
        );
        sql.setCreatedAt(Timestamp.from(Instant.now().minusSeconds(86400 * 2)));
        sql.setViews(89);
        int sqlId = discussionService.addDiscussion(sql);
        
        addMessage(sqlId, "Connection pooling is almost always better for web applications. Opening/closing connections is expensive and can become a bottleneck. Most connection pools handle connection reuse, timeout management, and connection validation automatically.", "Michael Brown", false, 15, 1);
        addMessage(sqlId, "I'd add that for small personal projects with low traffic, direct connections might be simpler. But for anything production-level, use pooling. Libraries like HikariCP (Java) or SQLAlchemy (Python) make it really easy to set up.", "Emma Wilson", false, 10, 0);
        addMessage(sqlId, "What about connection limits? If I use pooling, won't I run out of available connections faster?", sql.getAuthorName(), true, 2, 0);
        addMessage(sqlId, "Good question! That's why pools have configuration options like maximum pool size, connection timeout, and idle connection management. You set limits based on your database capacity and expected load.", "Michael Brown", false, 7, 0);
        
        // Discussion 3: Git merge conflicts
        ForumDiscussion git = new ForumDiscussion(
            "Git merge conflicts are driving me crazy - any tips?",
            "I'm working on a group project and every time we try to merge branches, we get horrible merge conflicts. We're all working on the same files and Git can't automatically resolve the conflicts.\n\nIs there a better workflow to avoid this? Should we be using feature branches differently? Any tools that make resolving conflicts easier?",
            getRandomStudentName(),
            categoryId
        );
        git.setCreatedAt(Timestamp.from(Instant.now().minusSeconds(86400 * 1)));
        git.setViews(234);
        int gitId = discussionService.addDiscussion(git);
        
        addMessage(gitId, "The key is to merge frequently and communicate with your team. Don't let branches diverge for days. Also, consider using pull requests instead of direct merges - they force code review and reduce conflicts.", "Jessica Martinez", false, 18, 2);
        addMessage(gitId, "VS Code has great merge conflict tools! Also, `git merge --abort` is your friend when things get really messy. For complex conflicts, I use `git mergetool` with Beyond Compare.", "Ryan Taylor", false, 14, 0);
        addMessage(gitId, "We started using a 'trunk-based development' approach where everyone merges to main daily. Reduced our conflicts by 80%! The key is small, frequent merges.", "Sophia Anderson", false, 22, 1);
    }
    
    private void createMathDiscussions(int categoryId) {
        // Discussion 1: Calculus limits
        ForumDiscussion calculus = new ForumDiscussion(
            "Struggling with epsilon-delta definition of limits",
            "I'm in Calculus I and the epsilon-delta definition is killing me. I understand the concept of limits intuitively, but the formal definition with epsilon and delta makes no sense to me.\n\nWhy do we need this complicated definition? Can someone explain it in simple terms? I'm failing my homework because I can't write proper epsilon-delta proofs.",
            getRandomStudentName(),
            categoryId
        );
        calculus.setCreatedAt(Timestamp.from(Instant.now().minusSeconds(86400 * 4)));
        calculus.setViews(178);
        int calculusId = discussionService.addDiscussion(calculus);
        
        addMessage(calculusId, "Think of it like this: epsilon is how close you want to get to the limit, and delta is how close x needs to be to a to guarantee that closeness. It's a formal way of saying 'for any desired precision, I can find a range of x-values that achieve it'.", "James Thomas", false, 16, 1);
        addMessage(calculusId, "I struggled with this too! Watch the 3Blue1Brown video on epsilon-delta - it has great visualizations. Also, practice with simple functions first (like f(x) = 2x) before moving to complex ones.", "Olivia Garcia", false, 12, 0);
        addMessage(calculusId, "The key insight: it's about control. For ANY epsilon someone gives you, you must be able to respond with a delta that works. It's a game - they challenge you with precision, you respond with a range.", calculus.getAuthorName(), true, 4, 0);
        addMessage(calculusId, "Exactly! And remember: you don't need the 'best' delta, just one that works. Often you can start with what you want and work backwards to find delta.", "James Thomas", false, 8, 0);
        
        // Discussion 2: Linear algebra applications
        ForumDiscussion linear = new ForumDiscussion(
            "Real-world applications of linear algebra?",
            "I'm taking linear algebra and while I understand how to do the calculations (matrices, vectors, eigenvalues), I don't get WHY we're learning this. What are some real-world applications of linear algebra that I can mention in my essay?\n\nProfessor says it's used everywhere but I can only think of computer graphics.",
            getRandomStudentName(),
            categoryId
        );
        linear.setCreatedAt(Timestamp.from(Instant.now().minusSeconds(86400 * 2)));
        linear.setViews(145);
        int linearId = discussionService.addDiscussion(linear);
        
        addMessage(linearId, "Machine learning is HUGE on linear algebra! Neural networks, PCA, recommendation systems - all built on linear algebra. Also used in physics (quantum mechanics), economics (input-output models), and engineering (structural analysis).", "William Rodriguez", false, 20, 2);
        addMessage(linearId, "Google's PageRank algorithm is essentially eigenvector computation! And GPS navigation uses linear systems to calculate routes. Even social networks use adjacency matrices to analyze connections.", "Ava White", false, 15, 0);
        addMessage(linearId, "Don't forget signal processing! Fourier transforms (used in audio processing, image compression) are linear transformations. And cryptography uses linear algebra in many encryption schemes.", "Benjamin Harris", false, 11, 0);
        addMessage(linearId, "This is amazing! I had no idea it was so fundamental to modern technology. Thanks everyone - my essay is going to be much more interesting now!", linear.getAuthorName(), true, 6, 0);
        
        // Discussion 3: Statistics probability
        ForumDiscussion stats = new ForumDiscussion(
            "Conditional probability confusion - Bayes' Theorem",
            "I'm so confused about conditional probability. I can calculate P(A|B) using the formula, but I don't understand WHEN to use it vs regular probability.\n\nExample: In a medical test, 1% of people have a disease. The test is 99% accurate. If someone tests positive, what's the probability they actually have the disease? My answer seems wrong.",
            getRandomStudentName(),
            categoryId
        );
        stats.setCreatedAt(Timestamp.from(Instant.now().minusSeconds(86400 * 1)));
        stats.setViews(92);
        int statsId = discussionService.addDiscussion(stats);
        
        addMessage(statsId, "This is a classic Bayes' Theorem problem! The answer is only about 50% - surprising right? Most people think it should be 99%. You need to account for false positives from the 99% of healthy people.", "Isabella Clark", false, 14, 3);
        addMessage(statsId, "Let me break it down: Out of 10,000 people, 100 have the disease (99 test positive = 99 true positives). 9,900 are healthy (1% false positive = 99 false positives). So 198 test positive total, but only 99 actually have the disease. That's 99/198 = 50%!", "Lucas Lewis", false, 18, 1);
        addMessage(statsId, "This blew my mind! So a '99% accurate' test can still be wrong half the time for rare diseases? This explains why doctors often do multiple tests.", stats.getAuthorName(), true, 7, 0);
    }
    
    private void createExamDiscussions(int categoryId) {
        // Discussion 1: Study schedule
        ForumDiscussion schedule = new ForumDiscussion(
            "How to create an effective study schedule for finals?",
            "Finals are in 3 weeks and I'm feeling overwhelmed. I have 5 exams and haven't started studying seriously yet. How do you guys create study schedules that actually work?\n\nI tried making one before but ended up procrastinating and falling behind. Any tips for staying on track and covering everything efficiently?",
            getRandomStudentName(),
            categoryId
        );
        schedule.setCreatedAt(Timestamp.from(Instant.now().minusSeconds(86400 * 5)));
        schedule.setViews(267);
        int scheduleId = discussionService.addDiscussion(schedule);
        
        addMessage(scheduleId, "Use the Pomodoro Technique! 25 minutes study, 5 minutes break. After 4 sessions, take a 30-minute break. It keeps you focused and prevents burnout. I use the Forest app to stay off my phone.", "Mia Walker", false, 24, 2);
        addMessage(scheduleId, "I make a detailed schedule with specific topics for each session. But the key is building in buffer time - I only plan 70% of my available time so I can catch up if I fall behind. Also, start with your hardest subject when you're fresh.", "Henry Hall", false, 19, 1);
        addMessage(scheduleId, "Don't forget to schedule sleep! All-nighters actually hurt your performance. I aim for 7-8 hours even during finals week. Also, exercise between study sessions helps with retention.", "Charlotte Young", false, 22, 0);
        addMessage(scheduleId, "What about group study vs solo study? Which is better for finals?", schedule.getAuthorName(), true, 5, 0);
        addMessage(scheduleId, "Mix both! Use solo study for heavy memorization, but group study for explaining concepts to others (teaching helps you learn). Just make sure group sessions stay focused.", "Mia Walker", false, 11, 0);
        
        // Discussion 2: Multiple choice strategies
        ForumDiscussion multiple = new ForumDiscussion(
            "Strategies for multiple choice exams?",
            "I always struggle with multiple choice exams. I know the material but second-guess myself and change right answers to wrong ones. Any strategies for improving multiple choice performance?\n\nEspecially for questions where 'all of the above' or 'none of the above' are options - those trip me up every time.",
            getRandomStudentName(),
            categoryId
        );
        multiple.setCreatedAt(Timestamp.from(Instant.now().minusSeconds(86400 * 3)));
        multiple.setViews(134);
        int multipleId = discussionService.addDiscussion(multiple);
        
        addMessage(multipleId, "Trust your first instinct! Research shows students who change answers are 2x more likely to change from right to wrong than wrong to right. Only change if you find definite evidence you were wrong.", "Daniel King", false, 17, 3);
        addMessage(multipleId, "For 'all of the above' questions: if even ONE option is wrong, 'all of the above' is wrong. For 'none of the above': if even ONE option is right, 'none of the above' is wrong. Process each option individually.", "Amelia Wright", false, 14, 1);
        addMessage(multipleId, "I cover the options and try to answer the question first. Then I uncover options one by one and see if they match my answer. This prevents me from being influenced by tempting but wrong options.", "Sophia Anderson", false, 12, 0);
        addMessage(multipleId, "Also look for absolute words like 'always' or 'never' - those are often wrong. Qualifying words like 'usually' or 'sometimes' are more likely to be correct.", "Michael Brown", false, 9, 0);
        
        // Discussion 3: Exam anxiety
        ForumDiscussion anxiety = new ForumDiscussion(
            "How to deal with exam anxiety?",
            "I have terrible test anxiety. I study hard and know the material, but during exams my mind goes blank and I can't think clearly. My hands shake, I sweat, and sometimes I almost panic.\n\nThis is affecting my grades even though I understand the subjects. Has anyone dealt with this? What helped?",
            getRandomStudentName(),
            categoryId
        );
        anxiety.setCreatedAt(Timestamp.from(Instant.now().minusSeconds(86400 * 2)));
        anxiety.setViews(189);
        int anxietyId = discussionService.addDiscussion(anxiety);
        
        addMessage(anxietyId, "I used to have this badly! What helped me: 1) Deep breathing exercises before starting, 2) Reading all questions first before answering any, 3) Keeping a positive mantra like 'I am prepared and capable', 4) Getting to the exam early to settle in.", "Emma Wilson", false, 28, 2);
        addMessage(anxietyId, "Consider talking to your school's counseling center. They might offer accommodations like extra time or a separate testing room. Also, practice with timed study sessions to simulate exam conditions.", "Sarah Johnson", false, 21, 1);
        addMessage(anxietyId, "Physical exercise helps! I go for a brisk walk before exams. It reduces cortisol and improves focus. Also, avoid caffeine right before exams - it can increase anxiety.", "James Thomas", false, 16, 0);
        addMessage(anxietyId, "Thank you all! I didn't realize this was so common. I'm going to try the breathing exercises and talk to counseling about accommodations. You've given me hope!", anxiety.getAuthorName(), true, 8, 0);
    }
    
    private void createProjectDiscussions(int categoryId) {
        // Discussion 1: Mobile app ideas
        ForumDiscussion mobile = new ForumDiscussion(
            "Looking for mobile app project ideas for CS course",
            "I need to develop a mobile app for my final CS project. I want something unique but achievable in a semester. Something that solves a real problem would be ideal.\n\nI can use Android or iOS (or cross-platform). I have intermediate programming skills. Any ideas that are impressive but not overly complex?",
            getRandomStudentName(),
            categoryId
        );
        mobile.setCreatedAt(Timestamp.from(Instant.now().minusSeconds(86400 * 4)));
        mobile.setViews(156);
        int mobileId = discussionService.addDiscussion(mobile);
        
        addMessage(mobileId, "Campus event finder app! Pulls data from university website, shows upcoming events, allows filtering by category, and has reminders. Uses basic APIs and local storage - totally doable in a semester.", "Alex Chen", false, 19, 2);
        addMessage(mobileId, "Study group matcher! Students input courses they're taking and study preferences, app suggests compatible study partners. Could include schedule matching and location preferences.", "Jessica Martinez", false, 15, 1);
        addMessage(mobileId, "How about a campus parking spot finder? Uses crowd-sourced data about available spots, shows real-time availability, and predicts availability based on historical patterns. Useful and solves a real campus problem!", "Ryan Taylor", false, 17, 0);
        addMessage(mobileId, "I love the parking idea! But wouldn't it require real-time GPS and lots of users to be useful? Maybe start simple with just reported spots?", mobile.getAuthorName(), true, 6, 0);
        
        // Discussion 2: Web development project
        ForumDiscussion web = new ForumDiscussion(
            "Web app project - what's more impressive: full-stack or specialized?",
            "For my web development final, I can either build a comprehensive full-stack app (basic everything) or specialize deeply in one area (advanced frontend with animations OR complex backend algorithms).\n\nWhich would impress professors more? I want to showcase my skills but also get a good grade.",
            getRandomStudentName(),
            categoryId
        );
        web.setCreatedAt(Timestamp.from(Instant.now().minusSeconds(86400 * 2)));
        web.setViews(98);
        int webId = discussionService.addDiscussion(web);
        
        addMessage(webId, "Go full-stack! It shows you understand the complete development process. Professors want to see you can connect frontend to backend, handle data flow, and deploy a working application.", "David Lee", false, 14, 3);
        addMessage(webId, "I disagree - specialized projects often stand out more. Everyone builds full-stack todo apps, but few build advanced data visualization or machine learning integration. Specialization shows depth.", "Michael Brown", false, 11, 2);
        addMessage(webId, "Compromise: build a full-stack app but with ONE specialized feature that's impressive. Like a basic CRUD app but with real-time collaboration using WebSockets, or advanced search with filtering algorithms.", "Emma Wilson", false, 18, 1);
        addMessage(webId, "That's a great approach! I'll build a standard full-stack app but add a specialized recommendation algorithm. Thanks for the perspective!", web.getAuthorName(), true, 4, 0);
        
        // Discussion 3: Data science project
        ForumDiscussion data = new ForumDiscussion(
            "Data science project ideas with publicly available datasets?",
            "I need a data science project for my portfolio. I want to use real publicly available datasets and create something meaningful. Kaggle datasets are overused - any other sources?\n\nI'm comfortable with Python, pandas, scikit-learn, and basic visualization. Looking for something that tells an interesting story.",
            getRandomStudentName(),
            categoryId
        );
        data.setCreatedAt(Timestamp.from(Instant.now().minusSeconds(86400 * 1)));
        data.setViews(87);
        int dataId = discussionService.addDiscussion(data);
        
        addMessage(dataId, "Check data.gov for government datasets! COVID data, education statistics, climate data - all clean and well-documented. You could analyze pandemic trends or educational outcomes by demographics.", "Olivia Garcia", false, 12, 1);
        addMessage(dataId, "World Bank Open Data has amazing development indicators. You could correlate education, healthcare, and economic data across countries to tell a development story. Great for visualization!", "William Rodriguez", false, 10, 0);
        addMessage(dataId, "NASA has climate and weather data going back decades. You could analyze climate change patterns or create weather prediction models. Very relevant and visually impressive!", "Ava White", false, 9, 0);
        addMessage(dataId, "The World Bank data sounds perfect! I can create an interactive dashboard showing development indicators. Thanks everyone!", data.getAuthorName(), true, 3, 0);
    }
    
    private void createCourseDiscussions(int categoryId) {
        // Discussion 1: Physics homework help
        ForumDiscussion physics = new ForumDiscussion(
            "Physics homework - projectile motion problem",
            "I'm stuck on a projectile motion problem. A ball is thrown from a 50m cliff at 30° above horizontal with initial velocity 20 m/s. I need to find: 1) Maximum height, 2) Time to hit ground, 3) Horizontal distance traveled.\n\nI keep getting different answers each time I calculate. Can someone walk through the steps?",
            getRandomStudentName(),
            categoryId
        );
        physics.setCreatedAt(Timestamp.from(Instant.now().minusSeconds(86400 * 3)));
        physics.setViews(112);
        int physicsId = discussionService.addDiscussion(physics);
        
        addMessage(physicsId, "Break it into components! Initial velocity: Vx = 20cos(30°) = 17.3 m/s, Vy = 20sin(30°) = 10 m/s. Max height: use Vy² = Vy0² - 2g(y-y0). At max height, Vy=0, so 0 = 100 - 19.6(y-50), giving y = 55.1m.", "James Thomas", false, 15, 2);
        addMessage(physicsId, "Time to hit ground: use y = y0 + Vy0*t - 0.5gt². Set y=0: 0 = 50 + 10t - 4.9t². Solve quadratic: t = 4.3s (positive root). Horizontal distance: x = Vx*t = 17.3*4.3 = 74.4m.", "Benjamin Harris", false, 13, 1);
        addMessage(physicsId, "Thank you! I was making an algebra mistake in the quadratic formula. The step-by-step breakdown really helped me see where I went wrong.", physics.getAuthorName(), true, 4, 0);
        
        // Discussion 2: Chemistry lab report
        ForumDiscussion chemistry = new ForumDiscussion(
            "Chemistry lab report - how to discuss experimental errors?",
            "I'm writing a lab report for a titration experiment. My results were off by about 8% from the theoretical value. I need to discuss sources of experimental error but I'm not sure what to include beyond 'human error'.\n\nWhat are legitimate sources of error in titration that I can discuss? How do I explain their impact on results?",
            getRandomStudentName(),
            categoryId
        );
        chemistry.setCreatedAt(Timestamp.from(Instant.now().minusSeconds(86400 * 2)));
        chemistry.setViews(76);
        int chemistryId = discussionService.addDiscussion(chemistry);
        
        addMessage(chemistryId, "Systematic errors: burette not calibrated correctly, concentration of standard solution slightly off, indicator not changing at exact equivalence point. Random errors: reading meniscus incorrectly, adding drops past endpoint, temperature affecting volume.", "Isabella Clark", false, 11, 1);
        addMessage(chemistryId, "Also consider: air bubbles in burette tip, incomplete mixing, impurities in reagents, not rinsing burette with titrant first. For each error, explain whether it would make your result higher or lower than theoretical.", "Lucas Lewis", false, 9, 0);
        addMessage(chemistryId, "This is exactly what I needed! I can now write a detailed error analysis instead of just saying 'human error'. Thank you!", chemistry.getAuthorName(), true, 3, 0);
        
        // Discussion 3: Literature essay
        ForumDiscussion literature = new ForumDiscussion(
            "Literature essay - how to analyze symbolism effectively?",
            "I have to write an essay analyzing symbolism in 'The Great Gatsby'. I can identify symbols (green light, eyes of Dr. T.J. Eckleburg, etc.) but I struggle to explain their significance beyond surface-level observations.\n\nHow do I go from 'this symbol represents X' to deeper analysis? What makes symbolism analysis sophisticated vs basic?",
            getRandomStudentName(),
            categoryId
        );
        literature.setCreatedAt(Timestamp.from(Instant.now().minusSeconds(86400 * 1)));
        literature.setViews(94);
        int literatureId = discussionService.addDiscussion(literature);
        
        addMessage(literatureId, "Connect symbols to themes! The green light isn't just hope - it connects to the American Dream theme, the impossibility of recreating the past, and the illusion of the future. Show how symbols develop throughout the novel.", "Charlotte Young", false, 14, 2);
        addMessage(literatureId, "Consider context and character relationships. The eyes of Eckleburg watch over the valley of ashes - connecting to moral decay, the death of the American Dream, and God's absence in modern society. Use quotes to support each interpretation.", "Mia Walker", false, 12, 1);
        addMessage(literatureId, "Also analyze how symbols interact with each other! The green light and eyes both represent different aspects of vision/oversight but in different ways. This creates layers of meaning.", "Henry Hall", false, 8, 0);
    }
    
    private void createStudyDiscussions(int categoryId) {
        // Discussion 1: Note-taking methods
        ForumDiscussion notes = new ForumDiscussion(
            "Best note-taking method for technical subjects?",
            "I'm taking engineering courses and struggling with effective note-taking. Traditional linear notes don't work well for complex technical content with diagrams and formulas.\n\nI've heard about Cornell notes, mind mapping, and outline methods. What works best for math-heavy, technical subjects? How do you organize notes for easy studying later?",
            getRandomStudentName(),
            categoryId
        );
        notes.setCreatedAt(Timestamp.from(Instant.now().minusSeconds(86400 * 4)));
        notes.setViews(143);
        int notesId = discussionService.addDiscussion(notes);
        
        addMessage(notesId, "For technical subjects, I use a modified Cornell method: left column for key formulas/concepts, right column for detailed explanations, bottom summary for connections between concepts. I also use different colors for definitions, examples, and important formulas.", "Daniel King", false, 16, 2);
        addMessage(notesId, "Digital notes with OneNote! I can type text, draw diagrams, insert equations, and record lectures. Everything is searchable and I can access it anywhere. Much better than paper for technical content.", "Amelia Wright", false, 13, 1);
        addMessage(notesId, "I combine methods: mind maps for conceptual understanding, then structured notes for problem-solving steps. Also, I create 'formula sheets' for each chapter - one page with all key formulas and when to use them.", "Sophia Anderson", false, 11, 0);
        addMessage(notesId, "The OneNote idea sounds great! Do you find that typing is as effective as handwriting for retention?", notes.getAuthorName(), true, 5, 0);
        
        // Discussion 2: Memorization techniques
        ForumDiscussion memory = new ForumDiscussion(
            "Memorization techniques for large amounts of information?",
            "I have a biology course with hundreds of terms, processes, and pathways to memorize. Flashcards aren't working well for complex interconnected systems. What memorization techniques work for large, related information sets?\n\nI need to understand relationships, not just memorize isolated facts.",
            getRandomStudentName(),
            categoryId
        );
        memory.setCreatedAt(Timestamp.from(Instant.now().minusSeconds(86400 * 2)));
        memory.setViews(127);
        int memoryId = discussionService.addDiscussion(memory);
        
        addMessage(memoryId, "Use the memory palace technique! Create a mental 'building' where each room represents a system, and objects in rooms represent concepts. The weirder the imagery, the better it sticks. Great for interconnected information.", "Michael Brown", false, 18, 3);
        addMessage(memoryId, "Spaced repetition with Anki! But instead of simple flashcards, make cards that ask about relationships: 'How does glycolysis connect to Krebs cycle?' or 'What happens if enzyme X is inhibited?'", "Emma Wilson", false, 15, 1);
        addMessage(memoryId, "Draw everything out! Create large diagrams showing all connections. Use different colors for different types of processes. The act of creating the diagram helps cement the relationships in your memory.", "Sarah Johnson", false, 12, 0);
        addMessage(memoryId, "I'm going to try the diagram approach. I think seeing everything visually will help me understand the big picture better than isolated facts.", memory.getAuthorName(), true, 6, 0);
        
        // Discussion 3: Focus and concentration
        ForumDiscussion focus = new ForumDiscussion(
            "How to maintain focus during long study sessions?",
            "I can study for about 30-45 minutes before my mind starts wandering. I check my phone, think about other things, or just stare at the page without processing. This is killing my productivity for long study sessions.\n\nWhat techniques help maintain deep focus for hours? How do you resist distractions during marathon study sessions?",
            getRandomStudentName(),
            categoryId
        );
        focus.setCreatedAt(Timestamp.from(Instant.now().minusSeconds(86400 * 1)));
        focus.setViews(201);
        int focusId = discussionService.addDiscussion(focus);
        
        addMessage(focusId, "The 'deep work' approach! Schedule specific focus blocks (2-4 hours), put phone in another room, use website blockers, and have a clear goal for each session. Also, start with easier subjects to build momentum.", "Alex Chen", false, 22, 4);
        addMessage(focusId, "Active learning techniques help! Instead of just reading, I summarize each paragraph in my own words, create practice problems, or teach concepts to an imaginary person. This keeps my brain engaged.", "Jessica Martinez", false, 19, 2);
        addMessage(focusId, "Environment matters! I study in the library where I can't easily access distractions. I also use noise-canceling headphones with instrumental music. The ritual of going to a specific place signals my brain it's time to focus.", "Ryan Taylor", false, 16, 1);
        addMessage(focusId, "Don't forget proper nutrition and hydration! I keep water and healthy snacks nearby. Hunger or thirst can break concentration without you realizing it.", "Olivia Garcia", false, 11, 0);
    }
    
    private void createCareerDiscussions(int categoryId) {
        // Discussion 1: Internship search
        ForumDiscussion internship = new ForumDiscussion(
            "When should I start applying for summer internships?",
            "I'm a sophomore in computer science and wondering when to start looking for summer internships. Some friends are already applying, but I feel like I don't have enough experience yet.\n\nWhen do companies usually start hiring for summer positions? Should I wait until I have more projects completed?",
            getRandomStudentName(),
            categoryId
        );
        internship.setCreatedAt(Timestamp.from(Instant.now().minusSeconds(86400 * 5)));
        internship.setViews(189);
        int internshipId = discussionService.addDiscussion(internship);
        
        addMessage(internshipId, "Start NOW! Big companies (Google, Microsoft, etc.) hire in fall for next summer. Medium companies hire in winter/spring. Apply even if you think you're not qualified - they expect students to be learning.", "David Lee", false, 24, 3);
        addMessage(internshipId, "I got my internship as a sophomore with just one personal project! Focus on showing your learning ability and enthusiasm. Contribute to open source or build something simple but complete.", "William Rodriguez", false, 18, 2);
        addMessage(internshipId, "Don't wait for 'perfect' experience. Start with smaller companies or local businesses. Every interview is practice. I applied to 50+ places before getting my first acceptance.", "Ava White", false, 15, 1);
        addMessage(internshipId, "This is really encouraging! I was going to wait until junior year but I'll start applying now. Better to get rejected and learn than to not try at all.", internship.getAuthorName(), true, 7, 0);
        
        // Discussion 2: Resume building
        ForumDiscussion resume = new ForumDiscussion(
            "How to build a strong resume with limited experience?",
            "I'm applying for part-time jobs and internships but my resume feels weak. I have good grades but no professional experience, only a few small personal projects.\n\nHow do I make my resume stand out with limited experience? What should I emphasize instead of work history?",
            getRandomStudentName(),
            categoryId
        );
        resume.setCreatedAt(Timestamp.from(Instant.now().minusSeconds(86400 * 3)));
        resume.setViews(156);
        int resumeId = discussionService.addDiscussion(resume);
        
        addMessage(resumeId, "Focus on projects! Even small projects show skills. List technologies used, problems solved, and results achieved. Quantify everything: 'Improved performance by 30%' instead of 'Improved performance'.", "Benjamin Harris", false, 20, 2);
        addMessage(resumeId, "Include relevant coursework, academic achievements, and extracurricular leadership. Show soft skills through examples: 'Led team of 4 in semester project, coordinated meetings, delivered presentation 2 weeks ahead of schedule'.", "Isabella Clark", false, 17, 1);
        addMessage(resumeId, "Create a portfolio website! Even if it's simple, it shows initiative and technical skills. Include your resume, projects, and contact info. Many recruiters appreciate this extra effort.", "Lucas Lewis", false, 14, 0);
        addMessage(resumeId, "The portfolio idea is brilliant! I have a GitHub but a dedicated website would look much more professional. Thanks for the suggestion!", resume.getAuthorName(), true, 5, 0);
        
        // Discussion 3: Interview preparation
        ForumDiscussion interview = new ForumDiscussion(
            "Technical interview preparation - where to start?",
            "I have my first technical interview coming up and I'm nervous. I know I need to practice coding problems, but where do I start? There are so many resources (LeetCode, HackerRank, etc.) and I'm feeling overwhelmed.\n\nWhat's a realistic study plan for 2 weeks of preparation? How many problems should I aim to solve?",
            getRandomStudentName(),
            categoryId
        );
        interview.setCreatedAt(Timestamp.from(Instant.now().minusSeconds(86400 * 2)));
        interview.setViews  (134);
        int interviewId = discussionService.addDiscussion(interview);
        
        addMessage(interviewId, "Focus on fundamentals! Arrays, strings, linked lists, trees, sorting, searching. Aim for 2-3 problems per day, understanding the pattern rather than memorizing solutions. LeetCode 'Top Interview Questions' list is perfect.", "Henry Hall", false, 19, 3);
        addMessage(interviewId, "Practice explaining your thought process out loud! In interviews, how you think matters more than getting the right answer immediately. Record yourself explaining solutions and watch it back.", "Charlotte Young", false, 16, 2);
        addMessage(interviewId, "Don't forget behavioral questions! Prepare stories using the STAR method (Situation, Task, Action, Result). Have 3-5 solid examples of teamwork, problem-solving, and overcoming challenges.", "Mia Walker", false, 13, 1);
        addMessage(internshipId, "I hadn't thought about behavioral questions - thanks for the reminder! I'll focus on both technical and behavioral preparation.", interview.getAuthorName(), true, 4, 0);
    }
    
    private void createGeneralDiscussions(int categoryId) {
        // Discussion 1: Campus food
        ForumDiscussion food = new ForumDiscussion(
            "Best places to eat on/near campus?",
            "New to campus this semester and tired of the dining hall. What are the best food spots near campus? Looking for both quick options between classes and places to actually sit and study while eating.\n\nBudget-friendly options preferred - I'm a broke college student!",
            getRandomStudentName(),
            categoryId
        );
        food.setCreatedAt(Timestamp.from(Instant.now().minusSeconds(86400 * 4)));
        food.setViews  (267);
        int foodId = discussionService.addDiscussion(food);
        
        addMessage(foodId, "Campus coffee shop has great sandwiches and study space. Library cafe is surprisingly good for studying - quiet and good WiFi. Both accept student meal plans!", "Daniel King", false, 22, 3);
        addMessage(foodId, "Off campus: Joe's Pizza (slice for $3), Taco Tuesday at Maria's (2 tacos for $5), and the food trucks near engineering building have amazing deals. Check student discount apps too!", "Amelia Wright", false, 19, 2);
        addMessage(foodId, "Hidden gem: the student union basement has microwaves and seating if you want to bring food from home. I meal prep Sundays and save $50+ per week.", "Sophia Anderson", false, 25, 4);
        addMessage(foodId, "Meal prep is genius! I'm definitely starting that. The food truck info helps too - I always see them but didn't know the deals.", food.getAuthorName(), true, 8, 0);
        
        // Discussion 2: Study spots
        ForumDiscussion study = new ForumDiscussion(
            "Best study spots on campus?",
            "The library is always crowded and I can never find a good place to study. Where are the hidden gems for studying on campus? Looking for places with good outlets, WiFi, and not too noisy.",
            getRandomStudentName(),
            categoryId
        );
        study.setCreatedAt(Timestamp.from(Instant.now().minusSeconds(86400 * 2)));
        study.setViews (198);
        int studyId = discussionService.addDiscussion(study);
        
        addMessage(studyId, "Engineering building 3rd floor - almost nobody knows about it! Quiet, lots of outlets, whiteboards everywhere. Also, the music building has practice rooms you can use when not occupied.", "Michael Brown", false, 21, 3);
        addMessage(studyId, "Student union upper level during morning hours - quiet before lunch rush. Business building has study pods you can reserve online. Science building has amazing views to help with focus!", "Emma Wilson", false, 17, 2);
        addMessage(studyId, "Don't forget outdoor spots! The quad has benches with tables, and the garden behind the art building is peaceful for reading. Great for nice weather days.", "Sarah Johnson", false, 14, 1);
        
        // Discussion 3: Time management
        ForumDiscussion time = new ForumDiscussion(
            "How do you balance academics with social life?",
            "I'm struggling to balance studying with having a social life. Either I'm getting good grades but feeling isolated, or I'm having fun but my grades suffer. How do you guys find the right balance?\n\nI want to do well in school but also have the 'college experience' everyone talks about.",
            getRandomStudentName(),
            categoryId
        );
        time.setCreatedAt(Timestamp.from(Instant.now().minusSeconds(86400 * 1)));
        time.setViews (312);
        int timeId = discussionService.addDiscussion(time);
        
        addMessage(timeId, "Schedule everything! I put study time, social time, and even downtime in my calendar. Treat social time as important as study time - it prevents burnout and makes you more efficient when studying.", "Alex Chen", false, 28, 4);
        addMessage(timeId, "Study with friends! Combine social and academic by forming study groups. You get both learning and social interaction. Also, choose social activities that don't drain you (movies vs parties every weekend).", "Jessica Martinez", false, 24, 2);
        addMessage(timeId, "Quality over quantity! I have 2-3 focused social events per week instead of trying to do everything. Also, learn to say no to things that don't align with your goals or values.", "Ryan Taylor", false, 19, 1);
        addMessage(timeId, "This is exactly what I needed to hear! I've been trying to do everything and ending up exhausted. The 'quality over quantity' mindset makes so much sense.", time.getAuthorName(), true, 11, 0);
    }
    
    /**
     * Helper method to add a message to a discussion
     */
    private void addMessage(int discussionId, String content, String authorName, boolean isAuthor, int upvotes, int downvotes) {
        ForumMessage message = new ForumMessage(content, authorName, discussionId);
        message.setAuthor(isAuthor);
        message.setUpvotes(upvotes);
        message.setDownvotes(downvotes);
        message.setCreatedAt(Timestamp.from(Instant.now().minusSeconds(random.nextInt(86400 * 7))));
        messageService.addMessage(message);
    }
    
    /**
     * Gets a random student name
     */
    private String getRandomStudentName() {
        return studentNames[random.nextInt(studentNames.length)];
    }
    
    /**
     * Main method to run the population
     */
    public static void main(String[] args) {
        ForumDataPopulator populator = new ForumDataPopulator();
        populator.populateForum();
    }
}
