<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231222100031 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activitie_settings (id INT AUTO_INCREMENT NOT NULL, activitie_id INT NOT NULL, title VARCHAR(255) NOT NULL, text_color VARCHAR(255) NOT NULL, border_color VARCHAR(255) NOT NULL, back_ground_color VARCHAR(255) NOT NULL, price INT NOT NULL, UNIQUE INDEX UNIQ_FDBA1428EB0ED4F5 (activitie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activitie_settings ADD CONSTRAINT FK_FDBA1428EB0ED4F5 FOREIGN KEY (activitie_id) REFERENCES calendar (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activitie_settings DROP FOREIGN KEY FK_FDBA1428EB0ED4F5');
        $this->addSql('DROP TABLE activitie_settings');
    }
}
