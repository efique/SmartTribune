<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201023100035 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE question_answer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE question_historic_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE question_answer (id INT NOT NULL, title VARCHAR(255) NOT NULL, promoted BOOLEAN NOT NULL, status VARCHAR(255) NOT NULL, answers TEXT NOT NULL, created_at DATE NOT NULL, updated_at DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN question_answer.answers IS \'(DC2Type:json)\'');
        $this->addSql('CREATE TABLE question_historic (id INT NOT NULL, title VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, updated_at DATE NOT NULL, qa_id INT NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE question_answer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE question_historic_id_seq CASCADE');
        $this->addSql('DROP TABLE question_answer');
        $this->addSql('DROP TABLE question_historic');
    }
}
