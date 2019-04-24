<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190327235817 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE matche (id INT AUTO_INCREMENT NOT NULL, sport VARCHAR(255) NOT NULL, equipe1 VARCHAR(255) NOT NULL, equipe2 VARCHAR(255) NOT NULL, quand DATETIME NOT NULL, resultat VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE matsh');
        $this->addSql('DROP INDEX IDX_2A091C1F4A5E3B54 ON pari');
        $this->addSql('ALTER TABLE pari ADD matche_id INT DEFAULT NULL, DROP matsh_id');
        $this->addSql('ALTER TABLE pari ADD CONSTRAINT FK_2A091C1FFD997C2B FOREIGN KEY (matche_id) REFERENCES matche (id)');
        $this->addSql('CREATE INDEX IDX_2A091C1FFD997C2B ON pari (matche_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pari DROP FOREIGN KEY FK_2A091C1FFD997C2B');
        $this->addSql('CREATE TABLE matsh (id INT AUTO_INCREMENT NOT NULL, sport VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, equipe1 VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, equipe2 VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, quand DATETIME NOT NULL, resultat VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE matche');
        $this->addSql('DROP INDEX IDX_2A091C1FFD997C2B ON pari');
        $this->addSql('ALTER TABLE pari ADD matsh_id INT NOT NULL, DROP matche_id');
        $this->addSql('CREATE INDEX IDX_2A091C1F4A5E3B54 ON pari (matsh_id)');
    }
}
