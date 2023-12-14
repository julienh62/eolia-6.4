<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231214121404 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activitie_category_settings DROP title, DROP text_color, DROP border_color, DROP back_ground_color, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE activitie_category_settings ADD CONSTRAINT FK_B6495099BF396750 FOREIGN KEY (id) REFERENCES category_settings (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_settings ADD type VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_settings DROP type');
        $this->addSql('ALTER TABLE activitie_category_settings DROP FOREIGN KEY FK_B6495099BF396750');
        $this->addSql('ALTER TABLE activitie_category_settings ADD title VARCHAR(255) NOT NULL, ADD text_color VARCHAR(255) NOT NULL, ADD border_color VARCHAR(255) NOT NULL, ADD back_ground_color VARCHAR(255) NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
    }
}
