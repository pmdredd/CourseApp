<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191114101403 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create initial set of tables using the original projects sqlite database';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE course (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name CLOB NOT NULL)');
        $this->addSql('CREATE TABLE coursework (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, course_id INTEGER NOT NULL, name CLOB NOT NULL, deadline DATE NOT NULL, credit_weight INTEGER NOT NULL, feedback_due_date DATE NOT NULL)');
        $this->addSql('CREATE INDEX IDX_6BA9F748591CC992 ON coursework (course_id)');
        $this->addSql('CREATE TABLE student (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name CLOB NOT NULL)');
        $this->addSql('CREATE TABLE submission (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, coursework_id INTEGER NOT NULL, student_id INTEGER NOT NULL, mark INTEGER DEFAULT NULL, hand_in_date DATE NOT NULL, second_submission BOOLEAN NOT NULL, grade CLOB DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_DB055AF3EC3F7515 ON submission (coursework_id)');
        $this->addSql('CREATE INDEX IDX_DB055AF3CB944F1A ON submission (student_id)');
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
