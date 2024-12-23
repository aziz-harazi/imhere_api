<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241218232327 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE member (id UUID NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, gender VARCHAR(255) NOT NULL, parent_email VARCHAR(255) NOT NULL, parent_phone VARCHAR(255) NOT NULL, parent_first_name VARCHAR(255) NOT NULL, parent_last_name VARCHAR(255) NOT NULL, birth_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX gender_idx ON member (gender)');
        $this->addSql('CREATE INDEX first_name_idx ON member (first_name)');
        $this->addSql('CREATE INDEX last_name_idx ON member (last_name)');
        $this->addSql('COMMENT ON COLUMN member.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN member.birth_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN member.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN member.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE presence (id UUID NOT NULL, member_id UUID DEFAULT NULL, day TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6977C7A5E5A02990 ON presence (day)');
        $this->addSql('CREATE INDEX IDX_6977C7A57597D3FE ON presence (member_id)');
        $this->addSql('COMMENT ON COLUMN presence.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN presence.member_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN presence.day IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE presence ADD CONSTRAINT FK_6977C7A57597D3FE FOREIGN KEY (member_id) REFERENCES member (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER INDEX uniq_8d93d649e7927c74 RENAME TO UNIQ_1483A5E9E7927C74');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE presence DROP CONSTRAINT FK_6977C7A57597D3FE');
        $this->addSql('DROP TABLE member');
        $this->addSql('DROP TABLE presence');
        $this->addSql('ALTER INDEX uniq_1483a5e9e7927c74 RENAME TO uniq_8d93d649e7927c74');
    }
}
