<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240727232322 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE report_article ALTER code SET NOT NULL');
        $this->addSql('ALTER TABLE report_article_version ALTER code SET NOT NULL');
        $this->addSql('ALTER TABLE report_default_report_version ALTER code SET NOT NULL');
        $this->addSql('ALTER TABLE report_report_section ALTER code SET NOT NULL');
        $this->addSql('ALTER TABLE report_report_section_version ALTER code SET NOT NULL');
        $this->addSql('ALTER TABLE report_web_link ALTER code SET NOT NULL');
        $this->addSql('ALTER TABLE report_youtube_link ALTER code SET NOT NULL');
        $this->addSql('ALTER TABLE tag_tag ADD default_label VARCHAR(64) NOT NULL');
        $this->addSql('ALTER TABLE tag_tag ADD default_description TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE tag_tag ALTER code SET NOT NULL');
        $this->addSql('ALTER TABLE tag_tag_version ADD tag_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tag_tag_version ADD CONSTRAINT FK_91E48489BAD26311 FOREIGN KEY (tag_id) REFERENCES tag_tag (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_91E48489BAD26311 ON tag_tag_version (tag_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE report_article_version ALTER code DROP NOT NULL');
        $this->addSql('ALTER TABLE report_report_section ALTER code DROP NOT NULL');
        $this->addSql('ALTER TABLE report_report_section_version ALTER code DROP NOT NULL');
        $this->addSql('ALTER TABLE report_article ALTER code DROP NOT NULL');
        $this->addSql('ALTER TABLE tag_tag_version DROP CONSTRAINT FK_91E48489BAD26311');
        $this->addSql('DROP INDEX IDX_91E48489BAD26311');
        $this->addSql('ALTER TABLE tag_tag_version DROP tag_id');
        $this->addSql('ALTER TABLE report_default_report_version ALTER code DROP NOT NULL');
        $this->addSql('ALTER TABLE tag_tag DROP default_label');
        $this->addSql('ALTER TABLE tag_tag DROP default_description');
        $this->addSql('ALTER TABLE tag_tag ALTER code DROP NOT NULL');
        $this->addSql('ALTER TABLE report_web_link ALTER code DROP NOT NULL');
        $this->addSql('ALTER TABLE report_youtube_link ALTER code DROP NOT NULL');
    }
}
