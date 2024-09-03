<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240903090525 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE architecture_entity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ip_entity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE server_entity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE architecture_entity (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE ip_entity (id INT NOT NULL, server_id INT DEFAULT NULL, ip VARCHAR(255) NOT NULL, public BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D0EECE54A5E3B32D ON ip_entity (ip)');
        $this->addSql('CREATE INDEX IDX_D0EECE541844E6B7 ON ip_entity (server_id)');
        $this->addSql('CREATE TABLE server_entity (id INT NOT NULL, architecture_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, memory INT NOT NULL, cores INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_77547DAE73F96878 ON server_entity (architecture_id)');
        $this->addSql('ALTER TABLE ip_entity ADD CONSTRAINT FK_D0EECE541844E6B7 FOREIGN KEY (server_id) REFERENCES server_entity (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE server_entity ADD CONSTRAINT FK_77547DAE73F96878 FOREIGN KEY (architecture_id) REFERENCES architecture_entity (id) NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql('INSERT INTO architecture_entity (id, name) VALUES (1, \'x86\')');
        $this->addSql('INSERT INTO server_entity (id, architecture_id, name, memory, cores) VALUES (1, 1, \'server1\', 1024, 1)');
        $this->addSql('INSERT INTO ip_entity (id, server_id, ip, public) VALUES (1, 1, \'127.0.0.1\', false)');
        $this->addSql('INSERT INTO ip_entity (id, server_id, ip, public) VALUES (2, 1, \'199.99.99.9\', true)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DELETE FROM ip_entity WHERE id = 2');
        $this->addSql('DELETE FROM ip_entity WHERE id = 1');
        $this->addSql('DELETE FROM server_entity WHERE id = 1');
        $this->addSql('DELETE FROM architecture_entity WHERE id = 1');

        $this->addSql('DROP SEQUENCE architecture_entity_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ip_entity_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE server_entity_id_seq CASCADE');
        $this->addSql('ALTER TABLE ip_entity DROP CONSTRAINT FK_D0EECE541844E6B7');
        $this->addSql('ALTER TABLE server_entity DROP CONSTRAINT FK_77547DAE73F96878');
        $this->addSql('DROP TABLE architecture_entity');
        $this->addSql('DROP TABLE ip_entity');
        $this->addSql('DROP TABLE server_entity');
    }
}
