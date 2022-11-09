<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220527084515 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Tables for User functionality';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE credentials_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE identity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE profile_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE credentials (id INT NOT NULL, identity_id INT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FA05280EFF3ED4A8 ON credentials (identity_id)');
        $this->addSql('CREATE TABLE identity (id INT NOT NULL, username VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE profile (id INT NOT NULL, identity_id INT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, id_identity INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8157AA0FFF3ED4A8 ON profile (identity_id)');
        $this->addSql('ALTER TABLE credentials ADD CONSTRAINT FK_FA05280EFF3ED4A8 FOREIGN KEY (identity_id) REFERENCES identity (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0FFF3ED4A8 FOREIGN KEY (identity_id) REFERENCES identity (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE credentials DROP CONSTRAINT FK_FA05280EFF3ED4A8');
        $this->addSql('ALTER TABLE profile DROP CONSTRAINT FK_8157AA0FFF3ED4A8');
        $this->addSql('DROP SEQUENCE credentials_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE identity_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE profile_id_seq CASCADE');
        $this->addSql('DROP TABLE credentials');
        $this->addSql('DROP TABLE identity');
        $this->addSql('DROP TABLE profile');
    }
}
