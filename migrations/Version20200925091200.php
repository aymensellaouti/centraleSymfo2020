<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200925091200 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE personne_hobbies (personne_id INT NOT NULL, hobbies_id INT NOT NULL, INDEX IDX_E645D0E0A21BD112 (personne_id), INDEX IDX_E645D0E0B2242D72 (hobbies_id), PRIMARY KEY(personne_id, hobbies_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE personne_hobbies ADD CONSTRAINT FK_E645D0E0A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne_hobbies ADD CONSTRAINT FK_E645D0E0B2242D72 FOREIGN KEY (hobbies_id) REFERENCES hobbies (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE personne_hobbies');
    }
}
