<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201229175854 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Adds default value for column created_at in sfcourse.articles';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('
            ALTER TABLE `articles` MODIFY COLUMN `created_at` DATETIME NOT NULL DEFAULT NOW()
        ');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('
            ALTER TABLE `articles` MODIFY COLUMN `created_at` DATETIME NOT NULL
        ');
    }
}
