<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190629005623 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activity_category_link DROP FOREIGN KEY FK_51EEA5A1CC8F7EE');
        $this->addSql('ALTER TABLE activity_category_link DROP FOREIGN KEY FK_51EEA5A81C06096');
        $this->addSql('ALTER TABLE activity_category_link ADD CONSTRAINT FK_BCE52A7281C06096 FOREIGN KEY (activity_id) REFERENCES activity (id)');
        $this->addSql('ALTER TABLE activity_category_link ADD CONSTRAINT FK_BCE52A721CC8F7EE FOREIGN KEY (activity_category_id) REFERENCES activity_category (id)');
        $this->addSql('ALTER TABLE activity_category_link RENAME INDEX idx_51eea5a81c06096 TO IDX_BCE52A7281C06096');
        $this->addSql('ALTER TABLE activity_category_link RENAME INDEX idx_51eea5a1cc8f7ee TO IDX_BCE52A721CC8F7EE');
        $this->addSql('ALTER TABLE activity_images_link DROP FOREIGN KEY FK_22CC2026146A8E4');
        $this->addSql('DROP INDEX IDX_22CC2026146A8E4 ON activity_images_link');
        $this->addSql('ALTER TABLE activity_images_link CHANGE activity_id activity_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE activity_images_link ADD CONSTRAINT FK_22CC2026146A8E4 FOREIGN KEY (activity_id_id) REFERENCES activity (id)');
        $this->addSql('CREATE INDEX IDX_22CC2026146A8E4 ON activity_images_link (activity_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activity_category_link DROP FOREIGN KEY FK_BCE52A7281C06096');
        $this->addSql('ALTER TABLE activity_category_link DROP FOREIGN KEY FK_BCE52A721CC8F7EE');
        $this->addSql('ALTER TABLE activity_category_link ADD CONSTRAINT FK_51EEA5A1CC8F7EE FOREIGN KEY (activity_category_id) REFERENCES activity_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activity_category_link ADD CONSTRAINT FK_51EEA5A81C06096 FOREIGN KEY (activity_id) REFERENCES activity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activity_category_link RENAME INDEX idx_bce52a721cc8f7ee TO IDX_51EEA5A1CC8F7EE');
        $this->addSql('ALTER TABLE activity_category_link RENAME INDEX idx_bce52a7281c06096 TO IDX_51EEA5A81C06096');
        $this->addSql('ALTER TABLE activity_images_link DROP FOREIGN KEY FK_22CC2026146A8E4');
        $this->addSql('DROP INDEX IDX_22CC2026146A8E4 ON activity_images_link');
        $this->addSql('ALTER TABLE activity_images_link CHANGE activity_id_id activity_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE activity_images_link ADD CONSTRAINT FK_22CC2026146A8E4 FOREIGN KEY (activity_id) REFERENCES activity (id)');
        $this->addSql('CREATE INDEX IDX_22CC2026146A8E4 ON activity_images_link (activity_id)');
    }
}
