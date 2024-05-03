<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240503104307 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Création des tables Chambre et User ';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chambre (id INT AUTO_INCREMENT NOT NULL, affectation_id INT DEFAULT NULL, gouvernante_id INT DEFAULT NULL, numero INT NOT NULL, nom VARCHAR(255) NOT NULL, nb_personne INT DEFAULT NULL, suivi_menage VARCHAR(255) DEFAULT NULL, is_validate TINYINT(1) NOT NULL, commentaire LONGTEXT DEFAULT NULL, statut VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_C509E4FF6D0ABA22 (affectation_id), INDEX IDX_C509E4FF1139DF98 (gouvernante_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chambre ADD CONSTRAINT FK_C509E4FF6D0ABA22 FOREIGN KEY (affectation_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE chambre ADD CONSTRAINT FK_C509E4FF1139DF98 FOREIGN KEY (gouvernante_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chambre DROP FOREIGN KEY FK_C509E4FF6D0ABA22');
        $this->addSql('ALTER TABLE chambre DROP FOREIGN KEY FK_C509E4FF1139DF98');
        $this->addSql('DROP TABLE chambre');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
