<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200210215218 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__coursework AS SELECT id, name, deadline, credit_weight, feedback_due_date, course_id FROM coursework');
        $this->addSql('DROP TABLE coursework');
        $this->addSql('CREATE TABLE coursework (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name CLOB NOT NULL COLLATE BINARY, deadline VARCHAR(255) NOT NULL COLLATE BINARY, credit_weight INTEGER NOT NULL, feedback_due_date VARCHAR(255) NOT NULL COLLATE BINARY, course_id INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO coursework (id, name, deadline, credit_weight, feedback_due_date, course_id) SELECT id, name, deadline, credit_weight, feedback_due_date, course_id FROM __temp__coursework');
        $this->addSql('DROP TABLE __temp__coursework');
        $this->addSql('CREATE INDEX coursework_idx ON coursework (id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__course AS SELECT id, name FROM course');
        $this->addSql('DROP TABLE course');
        $this->addSql('CREATE TABLE course (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name CLOB NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO course (id, name) SELECT id, name FROM __temp__course');
        $this->addSql('DROP TABLE __temp__course');
        $this->addSql('CREATE INDEX course_idx ON course (id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__student AS SELECT id, name FROM student');
        $this->addSql('DROP TABLE student');
        $this->addSql('CREATE TABLE student (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name CLOB NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO student (id, name) SELECT id, name FROM __temp__student');
        $this->addSql('DROP TABLE __temp__student');
        $this->addSql('CREATE INDEX student_idx ON student (id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__submission AS SELECT id, mark, hand_in_date, is_second_submission, grade, coursework_id, student_id FROM submission');
        $this->addSql('DROP TABLE submission');
        $this->addSql('CREATE TABLE submission (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, mark INTEGER DEFAULT NULL, hand_in_date VARCHAR(255) NOT NULL COLLATE BINARY, is_second_submission BOOLEAN NOT NULL, grade CLOB DEFAULT NULL COLLATE BINARY, coursework_id INTEGER NOT NULL, student_id INTEGER NOT NULL)');
        $this->addSql('INSERT INTO submission (id, mark, hand_in_date, is_second_submission, grade, coursework_id, student_id) SELECT id, mark, hand_in_date, is_second_submission, grade, coursework_id, student_id FROM __temp__submission');
        $this->addSql('DROP TABLE __temp__submission');
        $this->addSql('CREATE INDEX submission_idx ON submission (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX course_idx');
        $this->addSql('CREATE TEMPORARY TABLE __temp__course AS SELECT id, name FROM course');
        $this->addSql('DROP TABLE course');
        $this->addSql('CREATE TABLE course (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name CLOB NOT NULL)');
        $this->addSql('INSERT INTO course (id, name) SELECT id, name FROM __temp__course');
        $this->addSql('DROP TABLE __temp__course');
        $this->addSql('DROP INDEX coursework_idx');
        $this->addSql('CREATE TEMPORARY TABLE __temp__coursework AS SELECT id, name, deadline, credit_weight, feedback_due_date, course_id FROM coursework');
        $this->addSql('DROP TABLE coursework');
        $this->addSql('CREATE TABLE coursework (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name CLOB NOT NULL, deadline VARCHAR(255) NOT NULL, credit_weight INTEGER NOT NULL, feedback_due_date VARCHAR(255) NOT NULL, course_id INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO coursework (id, name, deadline, credit_weight, feedback_due_date, course_id) SELECT id, name, deadline, credit_weight, feedback_due_date, course_id FROM __temp__coursework');
        $this->addSql('DROP TABLE __temp__coursework');
        $this->addSql('DROP INDEX student_idx');
        $this->addSql('CREATE TEMPORARY TABLE __temp__student AS SELECT id, name FROM student');
        $this->addSql('DROP TABLE student');
        $this->addSql('CREATE TABLE student (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name CLOB NOT NULL)');
        $this->addSql('INSERT INTO student (id, name) SELECT id, name FROM __temp__student');
        $this->addSql('DROP TABLE __temp__student');
        $this->addSql('DROP INDEX submission_idx');
        $this->addSql('CREATE TEMPORARY TABLE __temp__submission AS SELECT id, mark, hand_in_date, is_second_submission, grade, coursework_id, student_id FROM submission');
        $this->addSql('DROP TABLE submission');
        $this->addSql('CREATE TABLE submission (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, mark INTEGER DEFAULT NULL, hand_in_date VARCHAR(255) NOT NULL, is_second_submission BOOLEAN NOT NULL, grade CLOB DEFAULT NULL, coursework_id INTEGER NOT NULL, student_id INTEGER NOT NULL)');
        $this->addSql('INSERT INTO submission (id, mark, hand_in_date, is_second_submission, grade, coursework_id, student_id) SELECT id, mark, hand_in_date, is_second_submission, grade, coursework_id, student_id FROM __temp__submission');
        $this->addSql('DROP TABLE __temp__submission');
    }
}
