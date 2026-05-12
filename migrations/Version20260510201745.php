<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260510201745 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attempt DROP FOREIGN KEY `attempt_ibfk_1`');
        $this->addSql('ALTER TABLE chapitre DROP FOREIGN KEY `fk_chapitre_cours`');
        $this->addSql('ALTER TABLE forum_discussion DROP FOREIGN KEY `fk_forum_discussion_category`');
        $this->addSql('ALTER TABLE forum_message DROP FOREIGN KEY `fk_forum_message_discussion`');
        $this->addSql('ALTER TABLE forum_report DROP FOREIGN KEY `fk_report_reporter`');
        $this->addSql('ALTER TABLE forum_views DROP FOREIGN KEY `fk_forum_views_discussion`');
        $this->addSql('ALTER TABLE forum_views DROP FOREIGN KEY `fk_forum_views_user`');
        $this->addSql('ALTER TABLE forum_votes DROP FOREIGN KEY `forum_votes_ibfk_1`');
        $this->addSql('ALTER TABLE forum_votes DROP FOREIGN KEY `forum_votes_ibfk_2`');
        $this->addSql('ALTER TABLE notifications DROP FOREIGN KEY `fk_notifications_discussion`');
        $this->addSql('ALTER TABLE notifications DROP FOREIGN KEY `fk_notifications_message`');
        $this->addSql('ALTER TABLE notifications DROP FOREIGN KEY `fk_notifications_user`');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY `question_ibfk_1`');
        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY `quiz_ibfk_1`');
        $this->addSql('ALTER TABLE quiz_attempt DROP FOREIGN KEY `quiz_attempt_ibfk_1`');
        $this->addSql('ALTER TABLE quiz_attempt DROP FOREIGN KEY `quiz_attempt_ibfk_2`');
        $this->addSql('ALTER TABLE student_answer DROP FOREIGN KEY `student_answer_ibfk_1`');
        $this->addSql('ALTER TABLE student_answer DROP FOREIGN KEY `student_answer_ibfk_2`');
        $this->addSql('DROP TABLE attempt');
        $this->addSql('DROP TABLE chapitre');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE forum_category');
        $this->addSql('DROP TABLE forum_discussion');
        $this->addSql('DROP TABLE forum_message');
        $this->addSql('DROP TABLE forum_report');
        $this->addSql('DROP TABLE forum_views');
        $this->addSql('DROP TABLE forum_votes');
        $this->addSql('DROP TABLE notifications');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE quiz');
        $this->addSql('DROP TABLE quiz_attempt');
        $this->addSql('DROP TABLE student_answer');
        $this->addSql('ALTER TABLE user ADD name VARCHAR(100) DEFAULT NULL, ADD avatar VARCHAR(50) DEFAULT NULL, ADD reset_token VARCHAR(255) DEFAULT NULL, ADD reset_token_expiry DATETIME DEFAULT NULL, DROP role, CHANGE firstname firstname VARCHAR(50) DEFAULT NULL, CHANGE lastname lastname VARCHAR(50) DEFAULT NULL, CHANGE username username VARCHAR(50) DEFAULT NULL, CHANGE roles roles JSON NOT NULL, CHANGE status status VARCHAR(20) NOT NULL, CHANGE google_id google_id VARCHAR(50) DEFAULT NULL, CHANGE bio bio LONGTEXT DEFAULT NULL, CHANGE age age INT DEFAULT NULL, CHANGE email email VARCHAR(180) NOT NULL, CHANGE password password VARCHAR(255) DEFAULT NULL, CHANGE photo_path photo_path VARCHAR(255) DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('ALTER TABLE user RENAME INDEX email TO UNIQ_IDENTIFIER_EMAIL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attempt (id INT AUTO_INCREMENT NOT NULL, quiz_id INT NOT NULL, started_at DATETIME DEFAULT \'NULL\', completed_at DATETIME DEFAULT \'NULL\', score INT DEFAULT NULL, answers TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, INDEX quiz_id (quiz_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE chapitre (id_chapitre INT AUTO_INCREMENT NOT NULL, titre VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, contenu LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, resource_url TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, id_cours INT NOT NULL, ai_summary TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, INDEX idx_chapitre_cours (id_cours), PRIMARY KEY (id_chapitre)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE cours (id_cours INT AUTO_INCREMENT NOT NULL, titre VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, created_at DATETIME DEFAULT \'current_timestamp()\', PRIMARY KEY (id_cours)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE forum_category (id_forum_category INT AUTO_INCREMENT NOT NULL, forum_category_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, forum_category_description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, forum_category_color VARCHAR(7) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, forum_category_created_at DATETIME NOT NULL, forum_category_updated_at DATETIME DEFAULT \'NULL\', PRIMARY KEY (id_forum_category)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE forum_discussion (id_forum_discussion INT AUTO_INCREMENT NOT NULL, forum_discussion_title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, forum_discussion_content LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, forum_discussion_author_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, forum_discussion_is_pinned TINYINT DEFAULT 0 NOT NULL, forum_discussion_is_locked TINYINT DEFAULT 0 NOT NULL, forum_discussion_views INT DEFAULT 0 NOT NULL, forum_discussion_created_at DATETIME NOT NULL, forum_discussion_updated_at DATETIME DEFAULT \'NULL\', id_forum_category INT DEFAULT NULL, solved TINYINT DEFAULT 0, INDEX idx_forum_discussion_category (id_forum_category), PRIMARY KEY (id_forum_discussion)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE forum_message (id_forum_message INT AUTO_INCREMENT NOT NULL, forum_message_content LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, forum_message_author_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, forum_message_is_author TINYINT DEFAULT 0 NOT NULL, forum_message_upvotes INT DEFAULT 0 NOT NULL, forum_message_downvotes INT DEFAULT 0 NOT NULL, forum_message_created_at DATETIME NOT NULL, forum_message_updated_at DATETIME DEFAULT \'NULL\', id_forum_discussion INT NOT NULL, parent_message_id INT DEFAULT NULL, INDEX idx_forum_message_discussion (id_forum_discussion), PRIMARY KEY (id_forum_message)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE forum_report (id INT AUTO_INCREMENT NOT NULL, type ENUM(\'message\', \'discussion\') CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, target_id INT NOT NULL, reporter_id INT NOT NULL, reason VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, status ENUM(\'pending\', \'reviewed\', \'dismissed\') CHARACTER SET utf8mb4 DEFAULT \'\'\'pending\'\'\' COLLATE `utf8mb4_general_ci`, created_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL, INDEX idx_report_created (created_at), INDEX idx_report_reporter (reporter_id), INDEX idx_report_status (status), INDEX idx_report_target (target_id, type), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE forum_views (user_id INT NOT NULL, discussion_id INT NOT NULL, viewed_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL, INDEX idx_forum_views_user (user_id), INDEX idx_forum_views_discussion (discussion_id), PRIMARY KEY (user_id, discussion_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE forum_votes (user_id INT NOT NULL, message_id INT NOT NULL, vote_type ENUM(\'up\', \'down\') CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, INDEX message_id (message_id), INDEX IDX_49FFDC18A76ED395 (user_id), PRIMARY KEY (user_id, message_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE notifications (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, type VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, message TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, discussion_id INT NOT NULL, message_id INT DEFAULT NULL, created_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL, is_read TINYINT DEFAULT 0, INDEX fk_notifications_message (message_id), INDEX idx_notifications_read (is_read), INDEX idx_notifications_created (created_at), INDEX fk_notifications_discussion (discussion_id), INDEX idx_notifications_user (user_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, question_text TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, options LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, correct_answer VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, points INT DEFAULT NULL, quiz_id INT DEFAULT NULL, INDEX quiz_id (quiz_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE quiz (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, description TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, time_limit INT DEFAULT NULL, total_score INT DEFAULT NULL, cours_id INT DEFAULT NULL, INDEX cours_id (cours_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE quiz_attempt (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, quiz_id INT NOT NULL, score FLOAT DEFAULT \'0\', started_at DATETIME DEFAULT \'current_timestamp()\', completed_at DATETIME DEFAULT \'NULL\', status VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'\'\'in_progress\'\'\' COLLATE `utf8mb4_general_ci`, INDEX user_id (user_id), INDEX quiz_id (quiz_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE student_answer (id INT AUTO_INCREMENT NOT NULL, attempt_id INT NOT NULL, question_id INT NOT NULL, answer TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, is_correct TINYINT DEFAULT 0, INDEX attempt_id (attempt_id), INDEX question_id (question_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE attempt ADD CONSTRAINT `attempt_ibfk_1` FOREIGN KEY (quiz_id) REFERENCES quiz (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE chapitre ADD CONSTRAINT `fk_chapitre_cours` FOREIGN KEY (id_cours) REFERENCES cours (id_cours) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE forum_discussion ADD CONSTRAINT `fk_forum_discussion_category` FOREIGN KEY (id_forum_category) REFERENCES forum_category (id_forum_category) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE forum_message ADD CONSTRAINT `fk_forum_message_discussion` FOREIGN KEY (id_forum_discussion) REFERENCES forum_discussion (id_forum_discussion) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE forum_report ADD CONSTRAINT `fk_report_reporter` FOREIGN KEY (reporter_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE forum_views ADD CONSTRAINT `fk_forum_views_discussion` FOREIGN KEY (discussion_id) REFERENCES forum_discussion (id_forum_discussion) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE forum_views ADD CONSTRAINT `fk_forum_views_user` FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE forum_votes ADD CONSTRAINT `forum_votes_ibfk_1` FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE forum_votes ADD CONSTRAINT `forum_votes_ibfk_2` FOREIGN KEY (message_id) REFERENCES forum_message (id_forum_message)');
        $this->addSql('ALTER TABLE notifications ADD CONSTRAINT `fk_notifications_discussion` FOREIGN KEY (discussion_id) REFERENCES forum_discussion (id_forum_discussion) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE notifications ADD CONSTRAINT `fk_notifications_message` FOREIGN KEY (message_id) REFERENCES forum_message (id_forum_message) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE notifications ADD CONSTRAINT `fk_notifications_user` FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (quiz_id) REFERENCES quiz (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT `quiz_ibfk_1` FOREIGN KEY (cours_id) REFERENCES cours (id_cours) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quiz_attempt ADD CONSTRAINT `quiz_attempt_ibfk_1` FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quiz_attempt ADD CONSTRAINT `quiz_attempt_ibfk_2` FOREIGN KEY (quiz_id) REFERENCES quiz (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student_answer ADD CONSTRAINT `student_answer_ibfk_1` FOREIGN KEY (attempt_id) REFERENCES quiz_attempt (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student_answer ADD CONSTRAINT `student_answer_ibfk_2` FOREIGN KEY (question_id) REFERENCES question (id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677 ON user');
        $this->addSql('ALTER TABLE user ADD role ENUM(\'USER\', \'ADMIN\') DEFAULT \'\'\'USER\'\'\' NOT NULL, DROP name, DROP avatar, DROP reset_token, DROP reset_token_expiry, CHANGE email email VARCHAR(100) NOT NULL, CHANGE firstname firstname VARCHAR(255) DEFAULT \'NULL\', CHANGE lastname lastname VARCHAR(255) DEFAULT \'NULL\', CHANGE username username VARCHAR(180) DEFAULT \'NULL\', CHANGE roles roles LONGTEXT DEFAULT NULL COLLATE `utf8mb4_bin`, CHANGE status status VARCHAR(20) DEFAULT \'\'\'active\'\'\' NOT NULL, CHANGE google_id google_id VARCHAR(255) DEFAULT \'NULL\', CHANGE photo_path photo_path VARCHAR(255) DEFAULT \'NULL\', CHANGE password password VARCHAR(255) NOT NULL, CHANGE age age INT NOT NULL, CHANGE bio bio TEXT DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL');
        $this->addSql('ALTER TABLE user RENAME INDEX uniq_identifier_email TO email');
    }
}
