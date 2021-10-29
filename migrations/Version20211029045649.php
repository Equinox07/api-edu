<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211029045649 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE department (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, type VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__subject AS SELECT id, name, slug, duration FROM subject');
        $this->addSql('DROP TABLE subject');
        $this->addSql('CREATE TABLE subject (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, tutor_id_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, slug VARCHAR(255) DEFAULT NULL COLLATE BINARY, duration INTEGER DEFAULT NULL, CONSTRAINT FK_FBCE3E7AAED1ECE5 FOREIGN KEY (tutor_id_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO subject (id, name, slug, duration) SELECT id, name, slug, duration FROM __temp__subject');
        $this->addSql('DROP TABLE __temp__subject');
        $this->addSql('CREATE INDEX IDX_FBCE3E7AAED1ECE5 ON subject (tutor_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_FBCE3E7AAED1ECE5');
        $this->addSql('CREATE TEMPORARY TABLE __temp__subject AS SELECT id, name, slug, duration FROM subject');
        $this->addSql('DROP TABLE subject');
        $this->addSql('CREATE TABLE subject (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) DEFAULT NULL, duration INTEGER DEFAULT NULL, tutor_id INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO subject (id, name, slug, duration) SELECT id, name, slug, duration FROM __temp__subject');
        $this->addSql('DROP TABLE __temp__subject');
    }
}
