<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200904110007 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE invite_friend (id INT AUTO_INCREMENT NOT NULL, message VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invite_friend_events (invite_friend_id INT NOT NULL, events_id INT NOT NULL, INDEX IDX_74426CECFE8AACAD (invite_friend_id), INDEX IDX_74426CEC9D6A1065 (events_id), PRIMARY KEY(invite_friend_id, events_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE invite_friend_events ADD CONSTRAINT FK_74426CECFE8AACAD FOREIGN KEY (invite_friend_id) REFERENCES invite_friend (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE invite_friend_events ADD CONSTRAINT FK_74426CEC9D6A1065 FOREIGN KEY (events_id) REFERENCES events (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD photo VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invite_friend_events DROP FOREIGN KEY FK_74426CECFE8AACAD');
        $this->addSql('DROP TABLE invite_friend');
        $this->addSql('DROP TABLE invite_friend_events');
        $this->addSql('ALTER TABLE user DROP photo');
    }
}
