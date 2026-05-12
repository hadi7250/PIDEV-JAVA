<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260511200000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create forum tables matching Java forum database schema';
    }

    public function up(Schema $schema): void
    {
        // forum_category table - matches Java forum schema
        $this->addSql('CREATE TABLE forum_category (
            id_forum_category INT AUTO_INCREMENT NOT NULL,
            forum_category_name VARCHAR(255) NOT NULL,
            forum_category_description LONGTEXT DEFAULT NULL,
            forum_category_color VARCHAR(7) DEFAULT NULL,
            forum_category_created_at DATETIME NOT NULL,
            forum_category_updated_at DATETIME DEFAULT NULL,
            PRIMARY KEY(id_forum_category)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        // forum_discussion table - matches Java forum schema
        $this->addSql('CREATE TABLE forum_discussion (
            id INT AUTO_INCREMENT NOT NULL,
            id_forum_category INT DEFAULT NULL,
            author_id INT NOT NULL,
            author_name VARCHAR(255) NOT NULL,
            title VARCHAR(255) NOT NULL,
            content LONGTEXT NOT NULL,
            attachment_name VARCHAR(255) DEFAULT NULL,
            is_pinned TINYINT(1) DEFAULT 0 NOT NULL,
            is_solved TINYINT(1) DEFAULT 0 NOT NULL,
            is_locked TINYINT(1) DEFAULT 0 NOT NULL,
            created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\',
            updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\',
            INDEX IDX_CATEGORY (id_forum_category),
            INDEX IDX_AUTHOR (author_id),
            INDEX IDX_PINNED (is_pinned),
            INDEX IDX_SOLVED (is_solved),
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        // forum_message table - matches Java forum schema with content and author_name columns
        $this->addSql('CREATE TABLE forum_message (
            id INT AUTO_INCREMENT NOT NULL,
            discussion_id INT NOT NULL,
            author_id INT NOT NULL,
            author_name VARCHAR(255) NOT NULL,
            content LONGTEXT NOT NULL,
            parent_message_id INT DEFAULT NULL,
            created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\',
            INDEX IDX_DISCUSSION (discussion_id),
            INDEX IDX_AUTHOR (author_id),
            INDEX IDX_PARENT (parent_message_id),
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        // forum_votes table - for upvote/downvote system
        $this->addSql('CREATE TABLE forum_votes (
            id INT AUTO_INCREMENT NOT NULL,
            user_id INT NOT NULL,
            message_id INT NOT NULL,
            vote_type VARCHAR(20) NOT NULL,
            created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\',
            UNIQUE INDEX unique_user_message_vote (user_id, message_id),
            INDEX IDX_USER (user_id),
            INDEX IDX_MESSAGE (message_id),
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        // forum_views table - for unique view tracking
        $this->addSql('CREATE TABLE forum_views (
            id INT AUTO_INCREMENT NOT NULL,
            user_id INT NOT NULL,
            discussion_id INT NOT NULL,
            viewed_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\',
            UNIQUE INDEX unique_user_discussion_view (user_id, discussion_id),
            INDEX IDX_USER (user_id),
            INDEX IDX_DISCUSSION (discussion_id),
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        // forum_report table - for reporting system
        $this->addSql('CREATE TABLE forum_report (
            id INT AUTO_INCREMENT NOT NULL,
            reporter_id INT NOT NULL,
            discussion_id INT DEFAULT NULL,
            message_id INT DEFAULT NULL,
            type VARCHAR(20) NOT NULL,
            reason VARCHAR(50) NOT NULL,
            description LONGTEXT DEFAULT NULL,
            status VARCHAR(20) NOT NULL DEFAULT \'PENDING\',
            created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\',
            resolved_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\',
            resolved_by_id INT DEFAULT NULL,
            INDEX IDX_REPORTER (reporter_id),
            INDEX IDX_DISCUSSION (discussion_id),
            INDEX IDX_MESSAGE (message_id),
            INDEX IDX_STATUS (status),
            INDEX IDX_RESOLVED_BY (resolved_by_id),
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        // notifications table - updated for Java forum compatibility
        $this->addSql('CREATE TABLE notifications (
            id INT AUTO_INCREMENT NOT NULL,
            user_id INT NOT NULL,
            type VARCHAR(50) NOT NULL,
            message LONGTEXT NOT NULL,
            discussion_id INT DEFAULT NULL,
            message_id INT DEFAULT NULL,
            is_read TINYINT(1) DEFAULT 0 NOT NULL,
            created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\',
            INDEX IDX_USER (user_id),
            INDEX IDX_DISCUSSION (discussion_id),
            INDEX IDX_MESSAGE (message_id),
            INDEX IDX_IS_READ (is_read),
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        // Add foreign key constraints
        $this->addSql('ALTER TABLE forum_discussion 
            ADD CONSTRAINT FK_DISCUSSION_CATEGORY FOREIGN KEY (id_forum_category) REFERENCES forum_category (id_forum_category) ON DELETE SET NULL,
            ADD CONSTRAINT FK_DISCUSSION_AUTHOR FOREIGN KEY (author_id) REFERENCES `user` (id)');

        $this->addSql('ALTER TABLE forum_message 
            ADD CONSTRAINT FK_MESSAGE_DISCUSSION FOREIGN KEY (discussion_id) REFERENCES forum_discussion (id) ON DELETE CASCADE,
            ADD CONSTRAINT FK_MESSAGE_AUTHOR FOREIGN KEY (author_id) REFERENCES `user` (id),
            ADD CONSTRAINT FK_MESSAGE_PARENT FOREIGN KEY (parent_message_id) REFERENCES forum_message (id) ON DELETE CASCADE');

        $this->addSql('ALTER TABLE forum_votes 
            ADD CONSTRAINT FK_VOTE_USER FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE,
            ADD CONSTRAINT FK_VOTE_MESSAGE FOREIGN KEY (message_id) REFERENCES forum_message (id) ON DELETE CASCADE');

        $this->addSql('ALTER TABLE forum_views 
            ADD CONSTRAINT FK_VIEW_USER FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE,
            ADD CONSTRAINT FK_VIEW_DISCUSSION FOREIGN KEY (discussion_id) REFERENCES forum_discussion (id) ON DELETE CASCADE');

        $this->addSql('ALTER TABLE forum_report 
            ADD CONSTRAINT FK_REPORT_REPORTER FOREIGN KEY (reporter_id) REFERENCES `user` (id),
            ADD CONSTRAINT FK_REPORT_DISCUSSION FOREIGN KEY (discussion_id) REFERENCES forum_discussion (id) ON DELETE CASCADE,
            ADD CONSTRAINT FK_REPORT_MESSAGE FOREIGN KEY (message_id) REFERENCES forum_message (id) ON DELETE CASCADE,
            ADD CONSTRAINT FK_REPORT_RESOLVER FOREIGN KEY (resolved_by_id) REFERENCES `user` (id) ON DELETE SET NULL');

        $this->addSql('ALTER TABLE notifications 
            ADD CONSTRAINT FK_NOTIFICATION_USER FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE,
            ADD CONSTRAINT FK_NOTIFICATION_DISCUSSION FOREIGN KEY (discussion_id) REFERENCES forum_discussion (id) ON DELETE CASCADE,
            ADD CONSTRAINT FK_NOTIFICATION_MESSAGE FOREIGN KEY (message_id) REFERENCES forum_message (id) ON DELETE CASCADE');

        // Insert default categories
        $this->addSql("INSERT INTO forum_category (forum_category_name, forum_category_description, forum_category_created_at) VALUES 
            ('General Discussion', 'General topics and casual conversations', NOW()),
            ('Technical Support', 'Get help with technical issues', NOW()),
            ('Feature Requests', 'Suggest new features and improvements', NOW()),
            ('Bug Reports', 'Report bugs and issues', NOW()),
            ('Announcements', 'Official announcements and news', NOW())");
    }

    public function down(Schema $schema): void
    {
        // Drop foreign keys first
        $this->addSql('ALTER TABLE forum_discussion DROP FOREIGN KEY IF EXISTS FK_DISCUSSION_CATEGORY');
        $this->addSql('ALTER TABLE forum_discussion DROP FOREIGN KEY IF EXISTS FK_DISCUSSION_AUTHOR');
        $this->addSql('ALTER TABLE forum_message DROP FOREIGN KEY FK_MESSAGE_DISCUSSION');
        $this->addSql('ALTER TABLE forum_message DROP FOREIGN KEY FK_MESSAGE_AUTHOR');
        $this->addSql('ALTER TABLE forum_message DROP FOREIGN KEY FK_MESSAGE_PARENT');
        $this->addSql('ALTER TABLE forum_votes DROP FOREIGN KEY FK_VOTE_USER');
        $this->addSql('ALTER TABLE forum_votes DROP FOREIGN KEY FK_VOTE_MESSAGE');
        $this->addSql('ALTER TABLE forum_views DROP FOREIGN KEY FK_VIEW_USER');
        $this->addSql('ALTER TABLE forum_views DROP FOREIGN KEY FK_VIEW_DISCUSSION');
        $this->addSql('ALTER TABLE forum_report DROP FOREIGN KEY FK_REPORT_REPORTER');
        $this->addSql('ALTER TABLE forum_report DROP FOREIGN KEY FK_REPORT_DISCUSSION');
        $this->addSql('ALTER TABLE forum_report DROP FOREIGN KEY FK_REPORT_MESSAGE');
        $this->addSql('ALTER TABLE forum_report DROP FOREIGN KEY FK_REPORT_RESOLVER');
        $this->addSql('ALTER TABLE notifications DROP FOREIGN KEY FK_NOTIFICATION_USER');
        $this->addSql('ALTER TABLE notifications DROP FOREIGN KEY FK_NOTIFICATION_DISCUSSION');
        $this->addSql('ALTER TABLE notifications DROP FOREIGN KEY FK_NOTIFICATION_MESSAGE');

        // Drop tables
        $this->addSql('DROP TABLE IF EXISTS notifications');
        $this->addSql('DROP TABLE IF EXISTS forum_report');
        $this->addSql('DROP TABLE IF EXISTS forum_views');
        $this->addSql('DROP TABLE IF EXISTS forum_votes');
        $this->addSql('DROP TABLE IF EXISTS forum_message');
        $this->addSql('DROP TABLE IF EXISTS forum_discussion');
        $this->addSql('DROP TABLE IF EXISTS forum_category');
    }
}
