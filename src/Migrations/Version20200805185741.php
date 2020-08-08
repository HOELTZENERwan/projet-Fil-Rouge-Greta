<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200805185741 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE frais CHANGE id_statut_frais_id id_statut_frais_id INT DEFAULT NULL, CHANGE id_type_frais_id id_type_frais_id INT DEFAULT NULL, CHANGE id_trajet_id id_trajet_id INT DEFAULT NULL, CHANGE id_client_id id_client_id INT DEFAULT NULL, CHANGE id_commercial_id id_commercial_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE frais CHANGE id_statut_frais_id id_statut_frais_id INT NOT NULL, CHANGE id_type_frais_id id_type_frais_id INT NOT NULL, CHANGE id_trajet_id id_trajet_id INT NOT NULL, CHANGE id_client_id id_client_id INT NOT NULL, CHANGE id_commercial_id id_commercial_id INT NOT NULL');
    }
}
