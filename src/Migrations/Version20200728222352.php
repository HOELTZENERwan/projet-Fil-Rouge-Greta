<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200728222352 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE frais DROP FOREIGN KEY FK_25404C9872AE4A38');
        $this->addSql('ALTER TABLE frais DROP FOREIGN KEY FK_25404C98290912ED');
        $this->addSql('DROP INDEX IDX_25404C9872AE4A38 ON frais');
        $this->addSql('ALTER TABLE frais ADD id_trajet_id INT NOT NULL, ADD id_client_id INT NOT NULL, ADD id_commercial_id INT NOT NULL, CHANGE type_frais_id id_type_frais_id INT NOT NULL');
        $this->addSql('ALTER TABLE frais ADD CONSTRAINT FK_25404C98CC869B5D FOREIGN KEY (id_type_frais_id) REFERENCES type_frais (id)');
        $this->addSql('ALTER TABLE frais ADD CONSTRAINT FK_25404C988D271404 FOREIGN KEY (id_trajet_id) REFERENCES trajet (id)');
        $this->addSql('ALTER TABLE frais ADD CONSTRAINT FK_25404C9899DED506 FOREIGN KEY (id_client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE frais ADD CONSTRAINT FK_25404C98C67CD679 FOREIGN KEY (id_commercial_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE frais ADD CONSTRAINT FK_25404C98290912ED FOREIGN KEY (id_statut_frais_id) REFERENCES role (id)');
        $this->addSql('CREATE INDEX IDX_25404C98CC869B5D ON frais (id_type_frais_id)');
        $this->addSql('CREATE INDEX IDX_25404C988D271404 ON frais (id_trajet_id)');
        $this->addSql('CREATE INDEX IDX_25404C9899DED506 ON frais (id_client_id)');
        $this->addSql('CREATE INDEX IDX_25404C98C67CD679 ON frais (id_commercial_id)');
        $this->addSql('ALTER TABLE trajet ADD id_client_id INT NOT NULL');
        $this->addSql('ALTER TABLE trajet ADD CONSTRAINT FK_2B5BA98C99DED506 FOREIGN KEY (id_client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_2B5BA98C99DED506 ON trajet (id_client_id)');
        $this->addSql('ALTER TABLE type_frais CHANGE label label VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE frais DROP FOREIGN KEY FK_25404C98CC869B5D');
        $this->addSql('ALTER TABLE frais DROP FOREIGN KEY FK_25404C988D271404');
        $this->addSql('ALTER TABLE frais DROP FOREIGN KEY FK_25404C9899DED506');
        $this->addSql('ALTER TABLE frais DROP FOREIGN KEY FK_25404C98C67CD679');
        $this->addSql('ALTER TABLE frais DROP FOREIGN KEY FK_25404C98290912ED');
        $this->addSql('DROP INDEX IDX_25404C98CC869B5D ON frais');
        $this->addSql('DROP INDEX IDX_25404C988D271404 ON frais');
        $this->addSql('DROP INDEX IDX_25404C9899DED506 ON frais');
        $this->addSql('DROP INDEX IDX_25404C98C67CD679 ON frais');
        $this->addSql('ALTER TABLE frais ADD type_frais_id INT NOT NULL, DROP id_type_frais_id, DROP id_trajet_id, DROP id_client_id, DROP id_commercial_id');
        $this->addSql('ALTER TABLE frais ADD CONSTRAINT FK_25404C9872AE4A38 FOREIGN KEY (type_frais_id) REFERENCES type_frais (id)');
        $this->addSql('ALTER TABLE frais ADD CONSTRAINT FK_25404C98290912ED FOREIGN KEY (id_statut_frais_id) REFERENCES statut_frais (id)');
        $this->addSql('CREATE INDEX IDX_25404C9872AE4A38 ON frais (type_frais_id)');
        $this->addSql('ALTER TABLE trajet DROP FOREIGN KEY FK_2B5BA98C99DED506');
        $this->addSql('DROP INDEX IDX_2B5BA98C99DED506 ON trajet');
        $this->addSql('ALTER TABLE trajet DROP id_client_id');
        $this->addSql('ALTER TABLE type_frais CHANGE label label VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
