<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220307063417 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gt_user ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE gt_user ADD CONSTRAINT FK_555AB38D12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_555AB38D12469DE2 ON gt_user (category_id)');
        $this->addSql('ALTER TABLE task ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB2512469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_527EDB2512469DE2 ON task (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category CHANGE category_name category_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE category_description category_description VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE gt_user DROP FOREIGN KEY FK_555AB38D12469DE2');
        $this->addSql('DROP INDEX IDX_555AB38D12469DE2 ON gt_user');
        $this->addSql('ALTER TABLE gt_user DROP category_id, CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE full_name full_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB2512469DE2');
        $this->addSql('DROP INDEX IDX_527EDB2512469DE2 ON task');
        $this->addSql('ALTER TABLE task DROP category_id, CHANGE task_name task_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE task_description task_description VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
