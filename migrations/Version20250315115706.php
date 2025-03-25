<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250315115706 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Adding seasons table and rename TopAnime table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE top_season (id INT AUTO_INCREMENT NOT NULL, external_id VARCHAR(255) DEFAULT NULL, score DOUBLE PRECISION DEFAULT NULL, scored_by INT DEFAULT NULL, anime_rank INT DEFAULT NULL, popularity INT DEFAULT NULL, members INT DEFAULT NULL, favorites INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE top_anime');
        $this->addSql('ALTER TABLE anime ADD original_title VARCHAR(255) NOT NULL, DROP original_name, DROP total_rating');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE TABLE top_anime (id INT AUTO_INCREMENT NOT NULL, external_id VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, score DOUBLE PRECISION DEFAULT NULL, scored_by INT DEFAULT NULL, anime_rank INT DEFAULT NULL, popularity INT DEFAULT NULL, members INT DEFAULT NULL, favorites INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE top_season');
        $this->addSql('ALTER TABLE anime ADD original_name VARCHAR(255) DEFAULT NULL, ADD total_rating DOUBLE PRECISION DEFAULT NULL, DROP original_title');
    }
}
