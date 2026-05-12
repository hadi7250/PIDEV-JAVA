-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 11 mai 2026 à 21:41
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `educonnect2`
--

-- --------------------------------------------------------

--
-- Structure de la table `attempt`
--

CREATE TABLE `attempt` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `started_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `answers` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `chapitre`
--

CREATE TABLE `chapitre` (
  `id_chapitre` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `contenu` longtext NOT NULL,
  `resource_url` text DEFAULT NULL,
  `id_cours` int(11) NOT NULL,
  `ai_summary` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `id_cours` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20260510203000', '2026-05-10 22:30:58', 78),
('DoctrineMigrations\\Version20260510203100', '2026-05-10 22:35:49', 79),
('DoctrineMigrations\\Version20260510210000', '2026-05-11 01:04:05', 3),
('DoctrineMigrations\\Version20260510220000', '2026-05-11 20:13:00', 13);

-- --------------------------------------------------------

--
-- Structure de la table `forum_category`
--

CREATE TABLE `forum_category` (
  `id_forum_category` int(11) NOT NULL,
  `forum_category_name` varchar(255) NOT NULL,
  `forum_category_description` longtext DEFAULT NULL,
  `forum_category_color` varchar(7) DEFAULT NULL,
  `forum_category_created_at` datetime NOT NULL,
  `forum_category_updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `forum_category`
--

INSERT INTO `forum_category` (`id_forum_category`, `forum_category_name`, `forum_category_description`, `forum_category_color`, `forum_category_created_at`, `forum_category_updated_at`) VALUES
(2, 'nsdlfsd', 'hellllllooooo', '#007BFF', '2026-05-11 18:32:48', '2026-05-11 18:32:59');

-- --------------------------------------------------------

--
-- Structure de la table `forum_discussion`
--

CREATE TABLE `forum_discussion` (
  `id_forum_discussion` int(11) NOT NULL,
  `forum_discussion_title` varchar(255) NOT NULL,
  `forum_discussion_content` longtext NOT NULL,
  `forum_discussion_author_name` varchar(255) NOT NULL,
  `forum_discussion_is_pinned` tinyint(4) NOT NULL DEFAULT 0,
  `forum_discussion_is_locked` tinyint(4) NOT NULL DEFAULT 0,
  `forum_discussion_views` int(11) NOT NULL DEFAULT 0,
  `forum_discussion_created_at` datetime NOT NULL,
  `forum_discussion_updated_at` datetime DEFAULT NULL,
  `id_forum_category` int(11) DEFAULT NULL,
  `solved` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `forum_message`
--

CREATE TABLE `forum_message` (
  `id_forum_message` int(11) NOT NULL,
  `content` text NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `discussion_id` int(11) NOT NULL,
  `parent_message_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `forum_report`
--

CREATE TABLE `forum_report` (
  `id` int(11) NOT NULL,
  `type` enum('message','discussion') NOT NULL,
  `target_id` int(11) NOT NULL,
  `reporter_id` int(11) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `status` enum('pending','reviewed','dismissed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `forum_views`
--

CREATE TABLE `forum_views` (
  `user_id` int(11) NOT NULL,
  `discussion_id` int(11) NOT NULL,
  `viewed_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `forum_votes`
--

CREATE TABLE `forum_votes` (
  `user_id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `vote_type` enum('up','down') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `discussion_id` int(11) NOT NULL,
  `message_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `options` varchar(500) DEFAULT NULL,
  `correct_answer` varchar(255) DEFAULT NULL,
  `points` int(11) DEFAULT 10,
  `quiz_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `quiz`
--

CREATE TABLE `quiz` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `time_limit` int(11) DEFAULT 30,
  `total_score` int(11) DEFAULT 100
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `quiz`
--

INSERT INTO `quiz` (`id`, `title`, `description`, `time_limit`, `total_score`) VALUES
(1, 'Java Basics', 'Test your knowledge of Java fundamentals including variables, loops, and conditionals.', 600, 100),
(2, 'Object-Oriented Programming', 'Questions about classes, objects, inheritance, and polymorphism.', 900, 100),
(3, 'Database Design', 'Test your SQL and database normalization knowledge.', 720, 100),
(4, 'JavaFX UI Development', 'Questions about building user interfaces with JavaFX.', 480, 100);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `google_id` varchar(50) DEFAULT NULL,
  `bio` longtext DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `email` varchar(180) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `avatar` varchar(50) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expiry` datetime DEFAULT NULL,
  `role` enum('USER','ADMIN') NOT NULL DEFAULT 'USER'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `status`, `google_id`, `bio`, `age`, `email`, `password`, `photo_path`, `created_at`, `updated_at`, `avatar`, `reset_token`, `reset_token_expiry`, `role`) VALUES
(1, 'Admin', 'User', 'admin@educonnect.com', 'active', NULL, NULL, 25, 'admin@educonnect.com', 'admin123', NULL, '2026-04-26 23:46:09', '2026-05-11 19:52:44', '01.png', NULL, NULL, 'ADMIN'),
(2, 'John', 'Doe', 'john@educonnect.com', 'active', NULL, NULL, 20, 'john@educonnect.com', 'user123', NULL, '2026-04-26 23:46:09', '2026-05-10 20:38:57', NULL, NULL, NULL, 'USER'),
(7, 'ahmedd', 'ghabri', 'ahmedghabri007@gmail.com', 'active', NULL, NULL, 24, 'ahmedghabri007@gmail.com', 'google_111855379332910375316', NULL, '2026-04-27 19:45:01', '2026-05-10 20:38:57', NULL, NULL, NULL, 'USER'),
(20, 'john', 'wick', 'johnwick@gmail.com', 'active', NULL, NULL, 44, 'johnwick@gmail.com', '9A8z7e6r5t4y', NULL, '2026-04-27 20:41:03', '2026-05-10 20:38:57', NULL, NULL, NULL, 'USER'),
(184, 'ahmed', 'ghabri', 'ahmedghabri00@gmail.com', 'active', NULL, NULL, 24, 'ahmedghabri00@gmail.com', '9A8z7e6r5t4y', NULL, '2026-05-05 11:13:24', '2026-05-10 20:38:57', NULL, NULL, NULL, 'USER'),
(193, 'hellodd', 'worlddd', 'hello@world.com', 'active', NULL, NULL, 24, 'hello@world.com', '1234', NULL, '2026-05-05 11:26:46', '2026-05-10 20:38:57', NULL, NULL, NULL, 'USER'),
(202, 'kileni', 'ahmed', 'rajhia003@gmail.com', 'active', '117130257197540299303', NULL, 25, 'rajhia003@gmail.com', '000000', NULL, '2026-05-10 20:30:14', '2026-05-10 20:38:57', '01.png', NULL, '2026-05-11 20:46:15', 'ADMIN'),
(213, 'test', 'test', 'test@gmail.com', 'active', NULL, NULL, 25, 'test@gmail.com', '000000', NULL, '2026-05-10 21:27:54', '2026-05-10 21:27:54', NULL, NULL, NULL, 'USER'),
(216, 'bohh', 'bohh', 'bohh@gmail.com', 'active', NULL, NULL, 22, 'bohh@gmail.com', '000000', 'C:\\Users\\rajhi\\OneDrive\\Bureau\\PIDEV-JAVA-user_management\\photos\\user_216_1778454695592.png', NULL, '2026-05-11 00:12:25', NULL, NULL, NULL, 'USER'),
(219, 'pubg', 'mobile', NULL, 'active', '101695761564327049286', NULL, NULL, 'rajhiahmed100@gmail.com', '000000', 'Capture-d-ecran-2023-10-09-152841-6a0121330ee15.png', NULL, NULL, '01.png', NULL, '2026-05-11 02:30:05', 'USER'),
(220, 'youssef', 'laradh', 'yousseflaradh@gmail.com', 'active', NULL, NULL, 22, 'yousseflaradh@gmail.com', '000000', NULL, NULL, NULL, NULL, NULL, NULL, 'USER');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `attempt`
--
ALTER TABLE `attempt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Index pour la table `chapitre`
--
ALTER TABLE `chapitre`
  ADD PRIMARY KEY (`id_chapitre`),
  ADD KEY `idx_chapitre_cours` (`id_cours`);

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id_cours`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `forum_category`
--
ALTER TABLE `forum_category`
  ADD PRIMARY KEY (`id_forum_category`);

--
-- Index pour la table `forum_discussion`
--
ALTER TABLE `forum_discussion`
  ADD PRIMARY KEY (`id_forum_discussion`),
  ADD KEY `idx_forum_discussion_category` (`id_forum_category`);

--
-- Index pour la table `forum_message`
--
ALTER TABLE `forum_message`
  ADD PRIMARY KEY (`id_forum_message`),
  ADD KEY `idx_message_discussion` (`discussion_id`),
  ADD KEY `idx_message_created` (`created_at`),
  ADD KEY `idx_message_parent` (`parent_message_id`);

--
-- Index pour la table `forum_report`
--
ALTER TABLE `forum_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_report_target` (`target_id`,`type`),
  ADD KEY `idx_report_reporter` (`reporter_id`),
  ADD KEY `idx_report_status` (`status`),
  ADD KEY `idx_report_created` (`created_at`);

--
-- Index pour la table `forum_views`
--
ALTER TABLE `forum_views`
  ADD PRIMARY KEY (`user_id`,`discussion_id`),
  ADD KEY `idx_forum_views_user` (`user_id`),
  ADD KEY `idx_forum_views_discussion` (`discussion_id`);

--
-- Index pour la table `forum_votes`
--
ALTER TABLE `forum_votes`
  ADD PRIMARY KEY (`user_id`,`message_id`),
  ADD KEY `idx_forum_votes_user` (`user_id`),
  ADD KEY `idx_forum_votes_message` (`message_id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_notifications_user` (`user_id`),
  ADD KEY `idx_notifications_read` (`is_read`),
  ADD KEY `idx_notifications_created` (`created_at`),
  ADD KEY `fk_notifications_discussion` (`discussion_id`),
  ADD KEY `fk_notifications_message` (`message_id`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Index pour la table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `attempt`
--
ALTER TABLE `attempt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `chapitre`
--
ALTER TABLE `chapitre`
  MODIFY `id_chapitre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `id_cours` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `forum_category`
--
ALTER TABLE `forum_category`
  MODIFY `id_forum_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `forum_discussion`
--
ALTER TABLE `forum_discussion`
  MODIFY `id_forum_discussion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `forum_message`
--
ALTER TABLE `forum_message`
  MODIFY `id_forum_message` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `forum_report`
--
ALTER TABLE `forum_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `attempt`
--
ALTER TABLE `attempt`
  ADD CONSTRAINT `attempt_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `chapitre`
--
ALTER TABLE `chapitre`
  ADD CONSTRAINT `fk_chapitre_cours` FOREIGN KEY (`id_cours`) REFERENCES `cours` (`id_cours`) ON DELETE CASCADE;

--
-- Contraintes pour la table `forum_discussion`
--
ALTER TABLE `forum_discussion`
  ADD CONSTRAINT `fk_forum_discussion_category` FOREIGN KEY (`id_forum_category`) REFERENCES `forum_category` (`id_forum_category`) ON DELETE SET NULL;

--
-- Contraintes pour la table `forum_message`
--
ALTER TABLE `forum_message`
  ADD CONSTRAINT `fk_message_discussion` FOREIGN KEY (`discussion_id`) REFERENCES `forum_discussion` (`id_forum_discussion`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_message_parent` FOREIGN KEY (`parent_message_id`) REFERENCES `forum_message` (`id_forum_message`) ON DELETE CASCADE;

--
-- Contraintes pour la table `forum_report`
--
ALTER TABLE `forum_report`
  ADD CONSTRAINT `fk_report_reporter` FOREIGN KEY (`reporter_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `forum_views`
--
ALTER TABLE `forum_views`
  ADD CONSTRAINT `fk_forum_views_discussion` FOREIGN KEY (`discussion_id`) REFERENCES `forum_discussion` (`id_forum_discussion`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_forum_views_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `forum_votes`
--
ALTER TABLE `forum_votes`
  ADD CONSTRAINT `fk_forum_votes_message` FOREIGN KEY (`message_id`) REFERENCES `forum_message` (`id_forum_message`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_forum_votes_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_notifications_discussion` FOREIGN KEY (`discussion_id`) REFERENCES `forum_discussion` (`id_forum_discussion`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_notifications_message` FOREIGN KEY (`message_id`) REFERENCES `forum_message` (`id_forum_message`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_notifications_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
