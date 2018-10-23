<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20181023091956 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $createApartmentTableSql = <<<SQL
CREATE TABLE apartments
(
    id MEDIUMINT UNSIGNED NOT NULL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    link VARCHAR(255) NOT NULL,
    city VARCHAR(100) NOT NULL,
    main_img_link VARCHAR(255) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
)
SQL;

        $this->addSql($createApartmentTableSql);
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE apartments');
    }
}
