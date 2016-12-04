<?php

namespace Database\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20161203064509 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tickit_members (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, email VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_53506B23E7927C74 (email), INDEX name_index (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tickit_user_stories (id INT AUTO_INCREMENT NOT NULL, assignee_id INT NOT NULL, name VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, priority INT DEFAULT 0 NOT NULL, INDEX IDX_41A5D61A59EC7D60 (assignee_id), INDEX name_index (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tickit_user_stories ADD CONSTRAINT FK_41A5D61A59EC7D60 FOREIGN KEY (assignee_id) REFERENCES tickit_members (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tickit_user_stories DROP FOREIGN KEY FK_41A5D61A59EC7D60');
        $this->addSql('DROP TABLE tickit_members');
        $this->addSql('DROP TABLE tickit_user_stories');
    }
}
