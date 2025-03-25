<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250313101414 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add title to anime';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE anime ADD title VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE anime DROP title');
    }
}
