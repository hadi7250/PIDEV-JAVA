# EduConnect - Competence & Evaluation Management System

## Project Overview
This module is part of the EduConnect platform, focusing on managing skills (Competences) and their associated assessments (Evaluations).

## Tech Stack
- **Language:** Java 17
- **Build Tool:** Maven
- **UI Framework:** JavaFX 21
- **Database:** MySQL (JDBC)
- **ORM/Libraries:** Hibernate, OpenCSV, Hibernate Validator

## Module Entities (Synchronized with Symfony Model)
### Competence
- id: int (Primary Key)
- 
ame: String (Unique, Not Null)
- description: String
- category: String (Choices: technique, comportementale, langue, autre)
- maxLevel: int (Range: 1-10, Default: 5)

### Evaluation
- id: int (Primary Key)
- 	itle: String (Not Null)
- description: String
- 	ype: String (Choices: exam, quiz, project, oral, homework)
- evaluationDate: LocalDateTime
- weight: Float (Range: 0-100)
- competence: Competence (ManyToOne relationship)

## Development Guidelines
- **Commit Strategy:** Perform a git commit after every file creation or significant method/functionality implementation.
- **Commit Messages:** Use clear titles and detailed descriptions for every commit.
- **Architecture:** Follow the Service layer pattern using the IService<T> interface.

## Current Progress
- [x] Initialized competence_management branch.
- [x] Updated pom.xml with Hibernate, Validation, and CSV dependencies.
- [x] Created Competence and Evaluation entities.
- [x] Implemented full CRUD in CompetenceService and EvaluationService.
## Module Implementation History
- **Entities**: Synchronized Competence and Evaluation with documentation (field renaming, added status, comment, score, certificate, 	imestamps).
- **UI Design**: Implemented consistent theme (Dark/Light mode) across all views using style.css.
- **Competence Module**: Implemented card-based student view with CRUD operations and PDF file upload support.
- **Evaluation Module**: Implemented teacher-side evaluation management (grading, commenting, status updates) and student-side viewing.
- **Authentication**: Updated role-based redirection to support TEACHER and STUDENT workflows. 
- **Documentation**: Synchronized all developments with the JAVA_FX_DOCUMENTATION.md architecture.