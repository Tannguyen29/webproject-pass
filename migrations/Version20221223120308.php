<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221223120308 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classroom_subject (classroom_id INT NOT NULL, subject_id INT NOT NULL, INDEX IDX_713FFF526278D5A8 (classroom_id), INDEX IDX_713FFF5223EDC87 (subject_id), PRIMARY KEY(classroom_id, subject_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classroom_subject ADD CONSTRAINT FK_713FFF526278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classroom_subject ADD CONSTRAINT FK_713FFF5223EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classroom_subject DROP FOREIGN KEY FK_713FFF526278D5A8');
        $this->addSql('ALTER TABLE classroom_subject DROP FOREIGN KEY FK_713FFF5223EDC87');
        $this->addSql('DROP TABLE classroom_subject');
    }
}
