<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250307191202 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'make top anime fields nullable';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE top_anime CHANGE external_id external_id VARCHAR(255) DEFAULT NULL, CHANGE score score DOUBLE PRECISION DEFAULT NULL, CHANGE scored_by scored_by INT DEFAULT NULL, CHANGE anime_rank anime_rank INT DEFAULT NULL, CHANGE popularity popularity INT DEFAULT NULL, CHANGE members members INT DEFAULT NULL, CHANGE favorites favorites INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE top_anime CHANGE external_id external_id VARCHAR(255) NOT NULL, CHANGE score score DOUBLE PRECISION NOT NULL, CHANGE scored_by scored_by INT NOT NULL, CHANGE anime_rank anime_rank INT NOT NULL, CHANGE popularity popularity INT NOT NULL, CHANGE members members INT NOT NULL, CHANGE favorites favorites INT NOT NULL');
    }
}
