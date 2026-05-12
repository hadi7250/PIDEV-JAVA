<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Manual migration to fix user table schema
 */
final class Version20260510203000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Fix user table schema - drop name column and fix mappings';
    }

    public function up(Schema $schema): void
    {
        // Drop the name column if it exists
        $this->addSql('ALTER TABLE user DROP COLUMN IF EXISTS name');
        
        // Make sure column mappings are correct
        $this->addSql('ALTER TABLE user CHANGE firstname firstname VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE lastname lastname VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE username username VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE google_id google_id VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE password password VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE photo_path photo_path VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE created_at created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE avatar avatar VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE reset_token reset_token VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE reset_token_expiry reset_token_expiry DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // Add back the name column for rollback
        $this->addSql('ALTER TABLE user ADD name VARCHAR(100) DEFAULT NULL');
    }
}
