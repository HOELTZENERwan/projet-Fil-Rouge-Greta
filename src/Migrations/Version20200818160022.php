<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200818160022 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, tel VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE frais (id INT AUTO_INCREMENT NOT NULL, id_statut_frais_id INT DEFAULT NULL, id_type_frais_id INT DEFAULT NULL, id_trajet_id INT DEFAULT NULL, id_commercial_id INT DEFAULT NULL, montant DOUBLE PRECISION DEFAULT NULL, date DATETIME NOT NULL, scan VARCHAR(255) DEFAULT NULL, commentaire VARCHAR(255) DEFAULT NULL, INDEX IDX_25404C98290912ED (id_statut_frais_id), INDEX IDX_25404C98CC869B5D (id_type_frais_id), INDEX IDX_25404C988D271404 (id_trajet_id), INDEX IDX_25404C98C67CD679 (id_commercial_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statut_frais (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trajet (id INT AUTO_INCREMENT NOT NULL, id_client_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE DEFAULT NULL, commentaire VARCHAR(255) DEFAULT NULL, INDEX IDX_2B5BA98C99DED506 (id_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_frais (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, telephone VARCHAR(25) NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', UNIQUE INDEX UNIQ_1D1C63B3E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE frais ADD CONSTRAINT FK_25404C98290912ED FOREIGN KEY (id_statut_frais_id) REFERENCES statut_frais (id)');
        $this->addSql('ALTER TABLE frais ADD CONSTRAINT FK_25404C98CC869B5D FOREIGN KEY (id_type_frais_id) REFERENCES type_frais (id)');
        $this->addSql('ALTER TABLE frais ADD CONSTRAINT FK_25404C988D271404 FOREIGN KEY (id_trajet_id) REFERENCES trajet (id)');
        $this->addSql('ALTER TABLE frais ADD CONSTRAINT FK_25404C98C67CD679 FOREIGN KEY (id_commercial_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE trajet ADD CONSTRAINT FK_2B5BA98C99DED506 FOREIGN KEY (id_client_id) REFERENCES client (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE trajet DROP FOREIGN KEY FK_2B5BA98C99DED506');
        $this->addSql('ALTER TABLE frais DROP FOREIGN KEY FK_25404C98290912ED');
        $this->addSql('ALTER TABLE frais DROP FOREIGN KEY FK_25404C988D271404');
        $this->addSql('ALTER TABLE frais DROP FOREIGN KEY FK_25404C98CC869B5D');
        $this->addSql('ALTER TABLE frais DROP FOREIGN KEY FK_25404C98C67CD679');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE frais');
        $this->addSql('DROP TABLE statut_frais');
        $this->addSql('DROP TABLE trajet');
        $this->addSql('DROP TABLE type_frais');
        $this->addSql('DROP TABLE utilisateur');
    }
}
