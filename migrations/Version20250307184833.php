<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250307184833 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'rename rank column';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE top_anime CHANGE `rank` anime_rank INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE top_anime CHANGE anime_rank `rank` INT NOT NULL');
    }
}
