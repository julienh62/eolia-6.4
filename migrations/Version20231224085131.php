<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231224085131 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activitie_settings (id INT AUTO_INCREMENT NOT NULL, activitie_id INT NOT NULL, title VARCHAR(255) NOT NULL, text_color VARCHAR(255) NOT NULL, border_color VARCHAR(255) NOT NULL, back_ground_color VARCHAR(255) NOT NULL, price INT NOT NULL, UNIQUE INDEX UNIQ_FDBA1428EB0ED4F5 (activitie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE calendar (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, start DATETIME NOT NULL, end DATETIME NOT NULL, calendarType VARCHAR(255) NOT NULL, stock INT DEFAULT NULL, price INT DEFAULT NULL, modified_price INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE calendar_staff (calendar_id INT NOT NULL, staff_id INT NOT NULL, INDEX IDX_2E3AF0FCA40A2C8 (calendar_id), INDEX IDX_2E3AF0FCD4D57CD (staff_id), PRIMARY KEY(calendar_id, staff_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE staff (id INT AUTO_INCREMENT NOT NULL, full_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE staff_calendar (staff_id INT NOT NULL, calendar_id INT NOT NULL, INDEX IDX_4CF701E8D4D57CD (staff_id), INDEX IDX_4CF701E8A40A2C8 (calendar_id), PRIMARY KEY(staff_id, calendar_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE staff_schedule_settings (id INT AUTO_INCREMENT NOT NULL, staff_schedule_id INT NOT NULL, title VARCHAR(255) NOT NULL, text_color VARCHAR(255) NOT NULL, border_color VARCHAR(255) NOT NULL, back_ground_color VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_E60BC1D655397287 (staff_schedule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, full_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activitie_settings ADD CONSTRAINT FK_FDBA1428EB0ED4F5 FOREIGN KEY (activitie_id) REFERENCES calendar (id)');
        $this->addSql('ALTER TABLE calendar_staff ADD CONSTRAINT FK_2E3AF0FCA40A2C8 FOREIGN KEY (calendar_id) REFERENCES calendar (id)');
        $this->addSql('ALTER TABLE calendar_staff ADD CONSTRAINT FK_2E3AF0FCD4D57CD FOREIGN KEY (staff_id) REFERENCES staff (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE staff_calendar ADD CONSTRAINT FK_4CF701E8D4D57CD FOREIGN KEY (staff_id) REFERENCES staff (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE staff_calendar ADD CONSTRAINT FK_4CF701E8A40A2C8 FOREIGN KEY (calendar_id) REFERENCES calendar (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE staff_schedule_settings ADD CONSTRAINT FK_E60BC1D655397287 FOREIGN KEY (staff_schedule_id) REFERENCES calendar (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activitie_settings DROP FOREIGN KEY FK_FDBA1428EB0ED4F5');
        $this->addSql('ALTER TABLE calendar_staff DROP FOREIGN KEY FK_2E3AF0FCA40A2C8');
        $this->addSql('ALTER TABLE calendar_staff DROP FOREIGN KEY FK_2E3AF0FCD4D57CD');
        $this->addSql('ALTER TABLE staff_calendar DROP FOREIGN KEY FK_4CF701E8D4D57CD');
        $this->addSql('ALTER TABLE staff_calendar DROP FOREIGN KEY FK_4CF701E8A40A2C8');
        $this->addSql('ALTER TABLE staff_schedule_settings DROP FOREIGN KEY FK_E60BC1D655397287');
        $this->addSql('DROP TABLE activitie_settings');
        $this->addSql('DROP TABLE calendar');
        $this->addSql('DROP TABLE calendar_staff');
        $this->addSql('DROP TABLE staff');
        $this->addSql('DROP TABLE staff_calendar');
        $this->addSql('DROP TABLE staff_schedule_settings');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
