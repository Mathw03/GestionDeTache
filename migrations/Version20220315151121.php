<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220315151121 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gt_user ADD gt_image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE task ADD gt_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25CBFA0827 FOREIGN KEY (gt_user_id) REFERENCES gt_user (id)');
        $this->addSql('CREATE INDEX IDX_527EDB25CBFA0827 ON task (gt_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gt_user DROP gt_image');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25CBFA0827');
        $this->addSql('DROP INDEX IDX_527EDB25CBFA0827 ON task');
        $this->addSql('ALTER TABLE task DROP gt_user_id');
    }
}
