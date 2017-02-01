<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170201081857 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE venue (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, bio LONGTEXT DEFAULT NULL, market_name VARCHAR(255) NOT NULL, market_subtitle VARCHAR(255) NOT NULL, profile_image VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, state VARCHAR(255) NOT NULL, address1 VARCHAR(255) NOT NULL, address2 VARCHAR(255) NOT NULL, zipcode VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_91911B0DE7927C74 (email), UNIQUE INDEX UNIQ_91911B0DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE venue ADD CONSTRAINT FK_91911B0DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE venue');
    }
}
