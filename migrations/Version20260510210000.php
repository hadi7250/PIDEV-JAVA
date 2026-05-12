<?php
declare(strict_types=1);
namespace DoctrineMigrations;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260510210000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Restore role column and sync existing users';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("ALTER TABLE `user` ADD COLUMN IF NOT EXISTS `role` VARCHAR(20) NOT NULL DEFAULT 'USER'");
        $this->addSql("UPDATE `user` SET `role` = 'USER' WHERE `role` IS NULL OR `role` = ''");
        $this->addSql("UPDATE `user` SET `role` = 'ADMIN' WHERE `roles` LIKE '%ROLE_ADMIN%'");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE `user` DROP COLUMN IF EXISTS `role`');
    }
}
