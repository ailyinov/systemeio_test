<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240529083434 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coupon ALTER created DROP DEFAULT');
        $this->addSql('ALTER TABLE product ALTER created DROP DEFAULT');
        $this->addSql('ALTER TABLE tax_id ADD percent INT NOT NULL DEFAULT 0');
        $this->addSql('ALTER TABLE tax_id ALTER created DROP DEFAULT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE coupon ALTER created SET DEFAULT \'now()\'');
        $this->addSql('ALTER TABLE product ALTER created SET DEFAULT \'now()\'');
        $this->addSql('ALTER TABLE tax_id DROP percent');
        $this->addSql('ALTER TABLE tax_id ALTER created SET DEFAULT \'now()\'');
    }
}
