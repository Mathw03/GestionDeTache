<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220316165929 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs

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
