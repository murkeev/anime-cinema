<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250313135808 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add original_name, description, ongoing, total_rating, year_of_publication to anime and season';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE anime ADD original_name VARCHAR(255) DEFAULT NULL, ADD description VARCHAR(255) DEFAULT NULL, ADD ongoing TINYINT(1) NOT NULL, ADD total_rating DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE season ADD year_of_publication INT NOT NULL, CHANGE external_id external_id VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE anime DROP original_name, DROP description, DROP ongoing, DROP total_rating');
        $this->addSql('ALTER TABLE season DROP year_of_publication, CHANGE external_id external_id VARCHAR(255) DEFAULT NULL');
    }
}
