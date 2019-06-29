<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190628225526 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE activity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, popular TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activity_category_link (activity_id INT NOT NULL, activity_category_id INT NOT NULL, INDEX IDX_51EEA5A81C06096 (activity_id), INDEX IDX_51EEA5A1CC8F7EE (activity_category_id), PRIMARY KEY(activity_id, activity_category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activity_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activity_images_link (id INT AUTO_INCREMENT NOT NULL, activity_id INT DEFAULT NULL, image_url VARCHAR(255) DEFAULT NULL, INDEX IDX_22CC2026146A8E4 (activity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activity_category_link ADD CONSTRAINT FK_51EEA5A81C06096 FOREIGN KEY (activity_id) REFERENCES activity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activity_category_link ADD CONSTRAINT FK_51EEA5A1CC8F7EE FOREIGN KEY (activity_category_id) REFERENCES activity_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activity_images_link ADD CONSTRAINT FK_22CC2026146A8E4 FOREIGN KEY (activity_id) REFERENCES activity (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activity_category_link DROP FOREIGN KEY FK_51EEA5A81C06096');
        $this->addSql('ALTER TABLE activity_images_link DROP FOREIGN KEY FK_22CC2026146A8E4');
        $this->addSql('ALTER TABLE activity_category_link DROP FOREIGN KEY FK_51EEA5A1CC8F7EE');
        $this->addSql('DROP TABLE activity');
        $this->addSql('DROP TABLE activity_category_link');
        $this->addSql('DROP TABLE activity_category');
        $this->addSql('DROP TABLE activity_images_link');
    }
}
