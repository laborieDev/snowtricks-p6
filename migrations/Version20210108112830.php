<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210108112830 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE figure DROP INDEX IDX_2F57B37A3569D950, ADD UNIQUE INDEX UNIQ_2F57B37A3569D950 (featured_image_id)');
        $this->addSql('ALTER TABLE media ADD figure_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C5C011B5 FOREIGN KEY (figure_id) REFERENCES figure (id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10C5C011B5 ON media (figure_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE figure DROP INDEX UNIQ_2F57B37A3569D950, ADD INDEX IDX_2F57B37A3569D950 (featured_image_id)');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C5C011B5');
        $this->addSql('DROP INDEX IDX_6A2CA10C5C011B5 ON media');
        $this->addSql('ALTER TABLE media DROP figure_id');
    }
}
