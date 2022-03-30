<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220318035649 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gt_user DROP FOREIGN KEY FK_555AB38D8DB60186');
        $this->addSql('DROP INDEX UNIQ_555AB38D8DB60186 ON gt_user');
        $this->addSql('ALTER TABLE gt_user CHANGE task_id task_to_do_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE gt_user ADD CONSTRAINT FK_555AB38D1B29069B FOREIGN KEY (task_to_do_id) REFERENCES task (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_555AB38D1B29069B ON gt_user (task_to_do_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gt_user DROP FOREIGN KEY FK_555AB38D1B29069B');
        $this->addSql('DROP INDEX UNIQ_555AB38D1B29069B ON gt_user');
        $this->addSql('ALTER TABLE gt_user CHANGE task_to_do_id task_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE gt_user ADD CONSTRAINT FK_555AB38D8DB60186 FOREIGN KEY (task_id) REFERENCES task (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_555AB38D8DB60186 ON gt_user (task_id)');
    }
}
