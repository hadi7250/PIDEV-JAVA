# EduConnect - Competence & Evaluation Management System

## Project Overview
This module is a core part of the EduConnect platform, designed to manage professional skills (Competences) and their associated assessments (Evaluations). It provides a unified "Studio" environment for students to build their portfolios and for teachers to grade performance.

## Tech Stack
- **Language:** Java 17 (LTS)
- **Build Tool:** Maven
- **UI Framework:** JavaFX 21 (Modular)
- **Database:** MySQL (JDBC Connection)
- **Styling:** CSS3 (Custom "Studio" theme with Teal/Green palette and Dark/Light mode support)

## Module Entities & Features
### 1. Competence Management (Student Portfolio)
The Competence module allows students to document their progress and upload evidence of their skills.

**CRUD Details:**
- **Create**: Students can add new skills with a title, detailed description, and a chosen category. They can also set a target "Max Level" (1-10) and upload a **PDF Certificate** as proof.
- **Read**: View all owned competences in a stylized "Skill Inventory" table with live search and category filtering.
- **Update**: Modify skill details, adjust mastery levels, or replace existing certificates.
- **Delete**: Safely remove skills from the portfolio with a confirmation prompt.

### 2. Evaluation Management (Teacher Grading)
The Evaluation module provides a "Studio" terminal for teachers to manage student assessments.

**CRUD Details:**
- **Create (Publish)**: Teachers can deploy new assessments (Exams, Projects, Quizzes) linked to specific Competences. Each assessment has a due date and a maximum weight/score.
- **Read (Ledger)**: A multi-table "Grading Terminal" showing both Competences and Evaluations. Selecting a competence filters the associated evaluations.
- **Update (Grade)**: Teachers can "Commit Grades" by entering a numerical score (0-100), assigning a status (Graded, Pending, Rejected), and providing qualitative textual feedback.
- **Delete**: Purge assessment records if they were created in error.

## Architecture & Structural Guidelines
- **Project Structure**: FXML files are organized in `src/main/resources/fxml/` to maintain a clean resource separation.
- **Design Pattern**: Service Layer Pattern (`IService<T>` interface) ensuring separation between UI logic and Data Access (JDBC).
- **UI Consistency**: Every module follows the "Studio Blueprint" (BorderPane-based layout with a sidebar for navigation and a main workspace). Navigation remains persistent within the shell.
- **Security**: Role-based access control (RBAC) ensuring only authorized users (TEACHER/STUDENT) can perform specific CRUD actions.

## Current Progress
- [x] Initialized `competence_management` branch.
- [x] Synced entities and database schema with `3a62.sql`.
- [x] Implemented full CRUD logic in `CompetenceService` and `EvaluationService`.
- [x] Fixed UI loading issues (StackPane/VBox mismatches).
- [x] Restored persistent sidebar navigation across all modules.
- [x] Implemented "Grading Terminal" with separate Competence/Evaluation tables for teachers.
- [x] Added "My Performance" portal for students with detailed feedback viewing.

## Module Implementation History
- **Entities**: Synchronized Competence and Evaluation with documentation (field renaming, added status, comment, score, certificate, timestamps).
- **UI Design**: Implemented the "Studio" layout and CSS synchronization.
- **Competence Module**: Implemented a "Skill Inventory" with PDF evidence support.
- **Evaluation Module**: Implemented a "Grading Terminal" for teacher-side management with dual-table filtering.
- **Authentication**: Updated role-based navigation and sidebar buttons in `EduConnectController`.
- **Database**: Added `3a62.sql` and ensured all `PreparedStatement` queries match the updated table fields.
