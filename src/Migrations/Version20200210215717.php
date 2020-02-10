<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200210215717 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Initial migration for setting up the project';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE course (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name CLOB NOT NULL)');
        $this->addSql('CREATE INDEX course_idx ON course (id)');
        $this->addSql('CREATE TABLE coursework (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name CLOB NOT NULL, deadline VARCHAR(255) NOT NULL, credit_weight INTEGER NOT NULL, feedback_due_date VARCHAR(255) NOT NULL, course_id INTEGER DEFAULT NULL)');
        $this->addSql('CREATE INDEX coursework_idx ON coursework (id)');
        $this->addSql('CREATE TABLE student (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name CLOB NOT NULL)');
        $this->addSql('CREATE INDEX student_idx ON student (id)');
        $this->addSql('CREATE TABLE submission (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, mark INTEGER DEFAULT NULL, hand_in_date VARCHAR(255) NOT NULL, is_second_submission BOOLEAN NOT NULL, grade CLOB DEFAULT NULL, coursework_id INTEGER NOT NULL, student_id INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX submission_idx ON submission (id)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, name VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6495E237E06 ON user (name)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE coursework');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE submission');
        $this->addSql('DROP TABLE user');
    }
}
