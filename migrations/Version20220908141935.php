<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220908141935 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Table for Mashup functionality';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE mashup_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE mashup (id INT NOT NULL, name VARCHAR(255) NOT NULL, file VARCHAR(255) NOT NULL, id_creator INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE mashup_author (mashup_id INT NOT NULL, author_id INT NOT NULL, PRIMARY KEY(mashup_id, author_id))');
        $this->addSql('CREATE TABLE mashup_tag (mashup_id INT NOT NULL, tag_id INT NOT NULL, PRIMARY KEY(mashup_id, tag_id))');
        $this->addSql('ALTER TABLE mashup_author ADD CONSTRAINT FK_9F385B8CAD4E46F8 FOREIGN KEY (mashup_id) REFERENCES mashup (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mashup_author ADD CONSTRAINT FK_9F385B8CF675F31B FOREIGN KEY (author_id) REFERENCES author (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mashup_tag ADD CONSTRAINT FK_DB96EB78AD4E46F8 FOREIGN KEY (mashup_id) REFERENCES mashup (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mashup_tag ADD CONSTRAINT FK_DB96EB78BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE mashup_id_seq CASCADE');
        $this->addSql('DROP TABLE mashup');
        $this->addSql('DROP TABLE mashup_author');
        $this->addSql('DROP TABLE mashup_tag');
    }

}
