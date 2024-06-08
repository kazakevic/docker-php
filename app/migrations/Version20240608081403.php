<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240608081403 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE hotels_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE prices_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE rooms_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE hotels (id INT NOT NULL, price_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E402F625D614C7E7 ON hotels (price_id)');
        $this->addSql('COMMENT ON COLUMN hotels.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE prices (id INT NOT NULL, amount INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE rooms (id INT NOT NULL, hotel INT DEFAULT NULL, size NUMERIC(2, 10) NOT NULL, name VARCHAR(128) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7CA11A963535ED9 ON rooms (hotel)');
        $this->addSql('ALTER TABLE hotels ADD CONSTRAINT FK_E402F625D614C7E7 FOREIGN KEY (price_id) REFERENCES prices (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rooms ADD CONSTRAINT FK_7CA11A963535ED9 FOREIGN KEY (hotel) REFERENCES hotels (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE hotels_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE prices_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE rooms_id_seq CASCADE');
        $this->addSql('ALTER TABLE hotels DROP CONSTRAINT FK_E402F625D614C7E7');
        $this->addSql('ALTER TABLE rooms DROP CONSTRAINT FK_7CA11A963535ED9');
        $this->addSql('DROP TABLE hotels');
        $this->addSql('DROP TABLE prices');
        $this->addSql('DROP TABLE rooms');
    }
}
