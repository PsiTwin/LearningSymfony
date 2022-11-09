<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221031134847 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'modify mashup relations';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mashup ADD CONSTRAINT FK_9CF98ABF629B4313 FOREIGN KEY (id_creator) REFERENCES identity (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_9CF98ABF629B4313 ON mashup (id_creator)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mashup DROP CONSTRAINT FK_9CF98ABF629B4313');
        $this->addSql('DROP INDEX IDX_9CF98ABF629B4313');
    }
}
