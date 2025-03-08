<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250307184307 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'rename to top_anime table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE top_anime (id INT AUTO_INCREMENT NOT NULL, external_id VARCHAR(255) NOT NULL, score DOUBLE PRECISION NOT NULL, scored_by INT NOT NULL, `rank` INT NOT NULL, popularity INT NOT NULL, members INT NOT NULL, favorites INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE top');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE TABLE top (id INT AUTO_INCREMENT NOT NULL, external_id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, score DOUBLE PRECISION NOT NULL, scored_by INT NOT NULL, `rank` INT NOT NULL, popularity INT NOT NULL, members INT NOT NULL, favorites INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE top_anime');
    }
}
