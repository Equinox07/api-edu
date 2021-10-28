<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211028103531 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subject ADD COLUMN duration INTEGER DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__subject AS SELECT id, name, slug, tutor_id FROM subject');
        $this->addSql('DROP TABLE subject');
        $this->addSql('CREATE TABLE subject (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) DEFAULT NULL, tutor_id INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO subject (id, name, slug, tutor_id) SELECT id, name, slug, tutor_id FROM __temp__subject');
        $this->addSql('DROP TABLE __temp__subject');
    }
}
