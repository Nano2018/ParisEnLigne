<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190327214612 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE `match` (id INT AUTO_INCREMENT NOT NULL, sport VARCHAR(255) NOT NULL, equipe1 VARCHAR(255) NOT NULL, equipe2 VARCHAR(255) NOT NULL, quand DATETIME NOT NULL, resultat VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, is_admin TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pari (id INT AUTO_INCREMENT NOT NULL, parieur_id INT DEFAULT NULL, matsh_id INT NOT NULL, vainqueur VARCHAR(255) NOT NULL, montant DOUBLE PRECISION NOT NULL, gain DOUBLE PRECISION NOT NULL, INDEX IDX_2A091C1F9FBD62B1 (parieur_id), INDEX IDX_2A091C1F4A5E3B54 (matsh_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pari ADD CONSTRAINT FK_2A091C1F9FBD62B1 FOREIGN KEY (parieur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE pari ADD CONSTRAINT FK_2A091C1F4A5E3B54 FOREIGN KEY (matsh_id) REFERENCES `match` (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pari DROP FOREIGN KEY FK_2A091C1F4A5E3B54');
        $this->addSql('ALTER TABLE pari DROP FOREIGN KEY FK_2A091C1F9FBD62B1');
        $this->addSql('DROP TABLE `match`');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE pari');
    }
}
