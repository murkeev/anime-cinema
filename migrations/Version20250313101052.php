<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250313101052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'create anime and season tables';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE anime (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE season (id INT AUTO_INCREMENT NOT NULL, anime_id INT NOT NULL, external_id VARCHAR(255) DEFAULT NULL, title VARCHAR(255) NOT NULL, score DOUBLE PRECISION DEFAULT NULL, scored_by INT DEFAULT NULL, `rank` INT DEFAULT NULL, popularity INT DEFAULT NULL, members INT DEFAULT NULL, favorites INT DEFAULT NULL, INDEX IDX_F0E45BA9794BBE89 (anime_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE season ADD CONSTRAINT FK_F0E45BA9794BBE89 FOREIGN KEY (anime_id) REFERENCES anime (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE season DROP FOREIGN KEY FK_F0E45BA9794BBE89');
        $this->addSql('DROP TABLE anime');
        $this->addSql('DROP TABLE season');
    }
}
