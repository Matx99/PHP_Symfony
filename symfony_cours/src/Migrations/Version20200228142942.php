<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200228142942 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE consultation (id INT AUTO_INCREMENT NOT NULL, matricule_id INT NOT NULL, num_ss_id INT NOT NULL, date_heure DATETIME DEFAULT NULL, INDEX IDX_964685A69AAADC05 (matricule_id), INDEX IDX_964685A6DF59CF24 (num_ss_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne_prescription (id INT AUTO_INCREMENT NOT NULL, numero_orrdre_id INT NOT NULL, denomination_id INT NOT NULL, posologie VARCHAR(255) NOT NULL, INDEX IDX_A761F81638CD9E5B (numero_orrdre_id), INDEX IDX_A761F816E9293F06 (denomination_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medicament (id INT AUTO_INCREMENT NOT NULL, denomination VARCHAR(255) NOT NULL, conditionnement VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordonnance (id INT AUTO_INCREMENT NOT NULL, num_ss_id INT NOT NULL, matricule_id INT NOT NULL, numero_orrdre INT NOT NULL, date_heure DATETIME DEFAULT NULL, INDEX IDX_924B326CDF59CF24 (num_ss_id), INDEX IDX_924B326C9AAADC05 (matricule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A69AAADC05 FOREIGN KEY (matricule_id) REFERENCES medecin (id)');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A6DF59CF24 FOREIGN KEY (num_ss_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE ligne_prescription ADD CONSTRAINT FK_A761F81638CD9E5B FOREIGN KEY (numero_orrdre_id) REFERENCES ordonnance (id)');
        $this->addSql('ALTER TABLE ligne_prescription ADD CONSTRAINT FK_A761F816E9293F06 FOREIGN KEY (denomination_id) REFERENCES medicament (id)');
        $this->addSql('ALTER TABLE ordonnance ADD CONSTRAINT FK_924B326CDF59CF24 FOREIGN KEY (num_ss_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE ordonnance ADD CONSTRAINT FK_924B326C9AAADC05 FOREIGN KEY (matricule_id) REFERENCES medecin (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ligne_prescription DROP FOREIGN KEY FK_A761F816E9293F06');
        $this->addSql('ALTER TABLE ligne_prescription DROP FOREIGN KEY FK_A761F81638CD9E5B');
        $this->addSql('DROP TABLE consultation');
        $this->addSql('DROP TABLE ligne_prescription');
        $this->addSql('DROP TABLE medicament');
        $this->addSql('DROP TABLE ordonnance');
    }
}
