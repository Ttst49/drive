<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230911185635 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE directory_file (directory_id INT NOT NULL, file_id INT NOT NULL, PRIMARY KEY(directory_id, file_id))');
        $this->addSql('CREATE INDEX IDX_FA483FF22C94069F ON directory_file (directory_id)');
        $this->addSql('CREATE INDEX IDX_FA483FF293CB796C ON directory_file (file_id)');
        $this->addSql('ALTER TABLE directory_file ADD CONSTRAINT FK_FA483FF22C94069F FOREIGN KEY (directory_id) REFERENCES directory (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE directory_file ADD CONSTRAINT FK_FA483FF293CB796C FOREIGN KEY (file_id) REFERENCES file (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE directory_file DROP CONSTRAINT FK_FA483FF22C94069F');
        $this->addSql('ALTER TABLE directory_file DROP CONSTRAINT FK_FA483FF293CB796C');
        $this->addSql('DROP TABLE directory_file');
    }
}
