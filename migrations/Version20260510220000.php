<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260510220000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Drop roles column from user table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify to your needs
        $this->addSql('ALTER TABLE `user` DROP COLUMN `roles`');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify to your needs
        $this->addSql('ALTER TABLE `user` ADD `roles` JSON NOT NULL COMMENT \'(DC2Type:json)\'');
    }
}
