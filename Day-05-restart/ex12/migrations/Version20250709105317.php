<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250709105317 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address ADD street VARCHAR(255) NOT NULL, ADD country VARCHAR(255) NOT NULL, CHANGE city city VARCHAR(255) NOT NULL, CHANGE person_id person_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bank_account DROP FOREIGN KEY FK_53A23E0A217BBB47');
        $this->addSql('DROP INDEX IDX_53A23E0A217BBB47 ON bank_account');
        $this->addSql('ALTER TABLE bank_account ADD iban VARCHAR(34) NOT NULL, ADD bank_name VARCHAR(255) NOT NULL, DROP balance, DROP person_id');
        $this->addSql('ALTER TABLE person ADD marital_status VARCHAR(16) NOT NULL, ADD bank_account_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD17612CB990C FOREIGN KEY (bank_account_id) REFERENCES bank_account (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_34DCD176E7927C74 ON person (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_34DCD17612CB990C ON person (bank_account_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address DROP street, DROP country, CHANGE city city VARCHAR(255) DEFAULT NULL, CHANGE person_id person_id INT NOT NULL');
        $this->addSql('ALTER TABLE bank_account ADD balance DOUBLE PRECISION DEFAULT NULL, ADD person_id INT NOT NULL, DROP iban, DROP bank_name');
        $this->addSql('ALTER TABLE bank_account ADD CONSTRAINT FK_53A23E0A217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_53A23E0A217BBB47 ON bank_account (person_id)');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD17612CB990C');
        $this->addSql('DROP INDEX UNIQ_34DCD176E7927C74 ON person');
        $this->addSql('DROP INDEX UNIQ_34DCD17612CB990C ON person');
        $this->addSql('ALTER TABLE person DROP marital_status, DROP bank_account_id');
    }
}
