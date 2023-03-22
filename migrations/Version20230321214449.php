<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230321214449 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE course (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(50) NOT NULL)');
        $this->addSql('CREATE TABLE course_work (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, course_id INTEGER NOT NULL, name VARCHAR(75) NOT NULL, deadline DATETIME DEFAULT NULL, credit_weight INTEGER NOT NULL, feedback_due_date DATETIME DEFAULT NULL, CONSTRAINT FK_9BECB586591CC992 FOREIGN KEY (course_id) REFERENCES course (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_9BECB586591CC992 ON course_work (course_id)');
        $this->addSql('CREATE TABLE student (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(75) NOT NULL, average_mark INTEGER DEFAULT NULL, average_grade VARCHAR(2) DEFAULT NULL)');
        $this->addSql('CREATE TABLE submission (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, coursework_id INTEGER NOT NULL, student_id INTEGER DEFAULT NULL, mark INTEGER DEFAULT NULL, hand_in_date DATETIME NOT NULL, resubmitted BOOLEAN DEFAULT NULL, grade VARCHAR(2) DEFAULT NULL, CONSTRAINT FK_DB055AF3EC3F7515 FOREIGN KEY (coursework_id) REFERENCES course_work (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_DB055AF3CB944F1A FOREIGN KEY (student_id) REFERENCES student (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_DB055AF3EC3F7515 ON submission (coursework_id)');
        $this->addSql('CREATE INDEX IDX_DB055AF3CB944F1A ON submission (student_id)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, name VARCHAR(180) NOT NULL , roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE course_work');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE submission');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
