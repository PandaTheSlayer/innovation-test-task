<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200116014650 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE disease (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_F3B6AC15E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE diseases_drugs (disease_id INT NOT NULL, drug_id INT NOT NULL, INDEX IDX_ECAD40EFD8355341 (disease_id), INDEX IDX_ECAD40EFAABCA765 (drug_id), PRIMARY KEY(disease_id, drug_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE drug (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_43EB7A3E5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE diseases_drugs ADD CONSTRAINT FK_ECAD40EFD8355341 FOREIGN KEY (disease_id) REFERENCES disease (id)');
        $this->addSql('ALTER TABLE diseases_drugs ADD CONSTRAINT FK_ECAD40EFAABCA765 FOREIGN KEY (drug_id) REFERENCES drug (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE diseases_drugs DROP FOREIGN KEY FK_ECAD40EFD8355341');
        $this->addSql('ALTER TABLE diseases_drugs DROP FOREIGN KEY FK_ECAD40EFAABCA765');
        $this->addSql('DROP TABLE disease');
        $this->addSql('DROP TABLE diseases_drugs');
        $this->addSql('DROP TABLE drug');
    }
}
