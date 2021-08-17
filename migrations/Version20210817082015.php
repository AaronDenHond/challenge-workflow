<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210817082015 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, created_by_id INT NOT NULL, assigned_to_agent_id INT DEFAULT NULL, closed_by_id INT NOT NULL, subject VARCHAR(255) NOT NULL, message_body VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, date_closed DATE DEFAULT NULL, is_second_line_problem TINYINT(1) NOT NULL, INDEX IDX_97A0ADA3B03A8386 (created_by_id), INDEX IDX_97A0ADA3DE770F6C (assigned_to_agent_id), INDEX IDX_97A0ADA3E1FA7797 (closed_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3DE770F6C FOREIGN KEY (assigned_to_agent_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3E1FA7797 FOREIGN KEY (closed_by_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ticket');
    }
}
