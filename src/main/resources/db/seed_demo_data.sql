-- =============================================================================
-- Données de démo pour la base `3a62` (phpMyAdmin → SQL)
-- 1) Créez d'abord participation / rating / certificat si besoin :
--    src/main/resources/db/app_event_support_tables.sql
-- 2) Puis exécutez ce fichier. Les INSERT utilisent id fixes + ON DUPLICATE KEY.
-- =============================================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------------
-- 1) Catégories d'événements (table `event_category`)
-- ---------------------------------------------------------------------------
INSERT INTO `event_category` (`id`, `name`) VALUES
(1, 'Conference'),
(2, 'Atelier'),
(3, 'Culture')
ON DUPLICATE KEY UPDATE `name` = VALUES(`name`);

-- ---------------------------------------------------------------------------
-- 2) Classe (pour FK `user.classe_id` — optionnel)
-- ---------------------------------------------------------------------------
INSERT INTO `classe` (`id`, `nom`, `niveau`, `anneeScolaire`, `description`) VALUES
(1, '3A62', 'Universitaire', '2025-2026', 'Classe démonstration')
ON DUPLICATE KEY UPDATE `nom` = VALUES(`nom`);

-- ---------------------------------------------------------------------------
-- 3) Utilisateurs (`user`) — roles = JSON valide
-- Mot de passe en clair "demo123" pour test uniquement (changez en prod)
-- ---------------------------------------------------------------------------
INSERT INTO `user` (`id`, `email`, `password`, `roles`, `nom`, `prenom`, `dateNaissance`, `isActive`, `createdAt`, `classe_id`) VALUES
(1, 'admin@educonnect.tn', 'demo123', '["ROLE_ADMIN","ROLE_USER"]', 'Admin', 'Système', '1990-01-15', 1, NOW(), 1),
(2, 'ahmed.ben@educonnect.tn', 'demo123', '["ROLE_USER"]', 'Ben Salem', 'Ahmed', '2002-06-01', 1, NOW(), 1),
(3, 'sara.m@educonnect.tn', 'demo123', '["ROLE_USER"]', 'Mansouri', 'Sara', '2003-03-20', 1, NOW(), 1)
ON DUPLICATE KEY UPDATE
  `email` = VALUES(`email`),
  `password` = VALUES(`password`),
  `roles` = VALUES(`roles`),
  `nom` = VALUES(`nom`),
  `prenom` = VALUES(`prenom`);

-- ---------------------------------------------------------------------------
-- 4) Événements (`event`) — colonnes camelCase comme votre dump
-- ---------------------------------------------------------------------------
INSERT INTO `event` (`id`, `titre`, `dateDebut`, `dateFin`, `lieu`, `description`, `duree`, `nombreMaxParticipants`, `image`, `category_id`) VALUES
(1, 'Journée portes ouvertes', '2026-05-10 09:00:00', '2026-05-10 17:00:00', 'Campus principal', 'Visite des laboratoires et rencontre avec les enseignants.', 480, 120, NULL, 1),
(2, 'Atelier JavaFX', '2026-05-15 14:00:00', '2026-05-15 17:00:00', 'Salle Info 2', 'Introduction aux interfaces graphiques JavaFX.', 180, 25, NULL, 2),
(3, 'Soirée culturelle', '2026-06-01 19:00:00', '2026-06-01 22:30:00', 'Amphithéâtre A', 'Musique et théâtre étudiants.', 210, 200, NULL, 3)
ON DUPLICATE KEY UPDATE
  `titre` = VALUES(`titre`),
  `dateDebut` = VALUES(`dateDebut`),
  `dateFin` = VALUES(`dateFin`);

-- ---------------------------------------------------------------------------
-- 5) Participations, avis, certificats (nécessitent les tables créées avant)
-- ---------------------------------------------------------------------------
INSERT INTO `participation` (`id`, `user_id`, `event_id`, `date_inscription`) VALUES
(1, 2, 1, '2026-04-01 10:30:00'),
(2, 3, 1, '2026-04-02 11:00:00'),
(3, 2, 2, '2026-04-05 09:15:00')
ON DUPLICATE KEY UPDATE `date_inscription` = VALUES(`date_inscription`);

INSERT INTO `rating` (`id`, `user_id`, `event_id`, `note`, `commentaire`, `date_creation`) VALUES
(1, 2, 1, 5, 'Très bien organisé, merci !', '2026-04-03 18:00:00'),
(2, 3, 1, 4, 'Intéressant, un peu long.', '2026-04-04 12:00:00'),
(3, 2, 2, 5, 'Atelier clair et utile.', '2026-04-06 20:00:00')
ON DUPLICATE KEY UPDATE `note` = VALUES(`note`), `commentaire` = VALUES(`commentaire`);

INSERT INTO `certificat` (`id`, `user_id`, `event_id`, `date_obtention`, `code_unique`) VALUES
(1, 2, 1, '2026-05-10 17:05:00', 'CERT-OPEN-DAY-2026'),
(2, 2, 2, '2026-05-15 17:10:00', 'CERT-JAVAFX-001')
ON DUPLICATE KEY UPDATE `date_obtention` = VALUES(`date_obtention`);

-- ---------------------------------------------------------------------------
-- 6) LMS : cours → chapitre, compétence → évaluation, quiz → question,
--    forum_category → forum_discussion
-- ---------------------------------------------------------------------------
INSERT INTO `cours` (`id_cours`, `titre`, `description`, `created_at`) VALUES
(1, 'Programmation Java', 'Bases et POO', '2026-01-10 08:00:00'),
(2, 'Base de données', 'SQL et modélisation', '2026-01-12 08:00:00')
ON DUPLICATE KEY UPDATE `titre` = VALUES(`titre`);

INSERT INTO `chapitre` (`id_chapitre`, `titre`, `contenu`, `cours_id`) VALUES
(1, 'Introduction', 'Variables, types, contrôle de flux', 1),
(2, 'Classes et objets', 'Encapsulation, héritage', 1)
ON DUPLICATE KEY UPDATE `titre` = VALUES(`titre`);

INSERT INTO `competence` (`id`, `title`, `description`, `category`, `maxLevel`, `certificate`, `createdAt`, `updatedAt`) VALUES
(1, 'Développement logiciel', 'Concevoir et coder une application', 'Technique', 5, NULL, NOW(), NOW()),
(2, 'Travail en équipe', 'Collaboration et communication', 'Soft skills', 5, NULL, NOW(), NOW())
ON DUPLICATE KEY UPDATE `title` = VALUES(`title`);

INSERT INTO `evaluation` (`id`, `title`, `description`, `type`, `date`, `score`, `status`, `comment`, `competence_id`) VALUES
(1, 'Contrôle continu Java', 'QCM et exercice', 'CC', '2026-03-15 10:00:00', 16.5, 'passed', 'Bon niveau', 1),
(2, 'Auto-équipe projet', 'Grille critères', 'Projet', '2026-03-20 14:00:00', 14.0, 'passed', NULL, 2)
ON DUPLICATE KEY UPDATE `score` = VALUES(`score`);

INSERT INTO `quiz` (`id`, `title`, `description`, `time_limit`, `total_score`, `cours_id`) VALUES
(1, 'Quiz SQL bases', 'SELECT, WHERE, JOIN', 30, 20, 2),
(2, 'Quiz Java débutant', 'Syntaxe et OOP', 45, 30, 1)
ON DUPLICATE KEY UPDATE `title` = VALUES(`title`);

INSERT INTO `question` (`id`, `text`, `type`, `options`, `correct_answer`, `points`, `quiz_id`) VALUES
(1, 'Que signifie SQL ?', 'single', JSON_ARRAY('Structured Query Language', 'Simple Query List', 'System Quality Layer'), 'Structured Query Language', 5, 1),
(2, 'Java est-il compilé puis exécuté sur JVM ?', 'boolean', JSON_ARRAY('true', 'false'), 'true', 5, 2)
ON DUPLICATE KEY UPDATE `text` = VALUES(`text`);

INSERT INTO `forum_category` (`id_forum_category`, `forum_category_name`, `forum_category_description`, `forum_category_color`, `createdAt`, `updatedAt`) VALUES
(1, 'Annonces', 'Messages officiels', '#2563eb', NOW(), NOW()),
(2, 'Entraide', 'Questions / réponses', '#16a34a', NOW(), NOW())
ON DUPLICATE KEY UPDATE `forum_category_name` = VALUES(`forum_category_name`);

INSERT INTO `forum_discussion` (`id_forum_discussion`, `forum_discussion_title`, `forum_discussion_content`, `authorName`, `isPinned`, `isLocked`, `views`, `category_id`) VALUES
(1, 'Bienvenue sur le forum', 'Présentez-vous ici.', 'Admin', 1, 0, 42, 1),
(2, 'Aide pour le Pidev', 'Besoin d''un conseil sur JavaFX.', 'Ahmed Ben Salem', 0, 0, 18, 2)
ON DUPLICATE KEY UPDATE `forum_discussion_title` = VALUES(`forum_discussion_title`);

SET FOREIGN_KEY_CHECKS = 1;

-- Réaligner AUTO_INCREMENT (optionnel, si vous utilisez des id fixes ci-dessus)
ALTER TABLE `event_category` AUTO_INCREMENT = 10;
ALTER TABLE `classe` AUTO_INCREMENT = 10;
ALTER TABLE `user` AUTO_INCREMENT = 10;
ALTER TABLE `event` AUTO_INCREMENT = 10;
ALTER TABLE `participation` AUTO_INCREMENT = 10;
ALTER TABLE `rating` AUTO_INCREMENT = 10;
ALTER TABLE `certificat` AUTO_INCREMENT = 10;
ALTER TABLE `cours` AUTO_INCREMENT = 10;
ALTER TABLE `chapitre` AUTO_INCREMENT = 10;
ALTER TABLE `competence` AUTO_INCREMENT = 10;
ALTER TABLE `evaluation` AUTO_INCREMENT = 10;
ALTER TABLE `quiz` AUTO_INCREMENT = 10;
ALTER TABLE `question` AUTO_INCREMENT = 10;
ALTER TABLE `forum_category` AUTO_INCREMENT = 10;
ALTER TABLE `forum_discussion` AUTO_INCREMENT = 10;
