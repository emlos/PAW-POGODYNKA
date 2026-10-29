<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20261029100000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creates the location and measurement tables for the weather CRUD.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE IF NOT EXISTS location (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(2) NOT NULL, latitude NUMERIC(10, 7) NOT NULL, longitude NUMERIC(10, 7) NOT NULL)');
        $this->addSql('CREATE TABLE IF NOT EXISTS measurement (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, date DATE NOT NULL, celsius NUMERIC(3, 0) NOT NULL, location_id INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IF NOT EXISTS IDX_2CE0D81164D218E ON measurement (location_id)');
        $this->addSql('CREATE TABLE IF NOT EXISTS messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE IF EXISTS measurement');
        $this->addSql('DROP TABLE IF EXISTS location');
    }
}
