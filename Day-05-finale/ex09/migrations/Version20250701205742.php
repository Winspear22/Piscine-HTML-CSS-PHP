<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250701205742 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, street LONGTEXT NOT NULL, city LONGTEXT NOT NULL, person_id INT NOT NULL, INDEX IDX_D4E6F81217BBB47 (person_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE bank_account (id INT AUTO_INCREMENT NOT NULL, iban INT NOT NULL, bank_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE person ADD bank_account_id INT NOT NULL');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD17612CB990C FOREIGN KEY (bank_account_id) REFERENCES bank_account (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_34DCD17612CB990C ON person (bank_account_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81217BBB47');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE bank_account');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD17612CB990C');
        $this->addSql('DROP INDEX UNIQ_34DCD17612CB990C ON person');
        $this->addSql('ALTER TABLE person DROP bank_account_id');
    }
}
