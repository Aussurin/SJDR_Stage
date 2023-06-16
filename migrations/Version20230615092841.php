<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230615092841 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pouvoir_perso (id INT AUTO_INCREMENT NOT NULL, progression_id INT NOT NULL, UNIQUE INDEX UNIQ_2A7541E8AF229C18 (progression_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pouvoir_perso_discipline (pouvoir_perso_id INT NOT NULL, discipline_id INT NOT NULL, INDEX IDX_28F9C83F8BDBFF5 (pouvoir_perso_id), INDEX IDX_28F9C83FA5522701 (discipline_id), PRIMARY KEY(pouvoir_perso_id, discipline_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pouvoir_perso_pouvoir (pouvoir_perso_id INT NOT NULL, pouvoir_id INT NOT NULL, INDEX IDX_A8E064758BDBFF5 (pouvoir_perso_id), INDEX IDX_A8E06475C8A705F8 (pouvoir_id), PRIMARY KEY(pouvoir_perso_id, pouvoir_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pouvoir_perso ADD CONSTRAINT FK_2A7541E8AF229C18 FOREIGN KEY (progression_id) REFERENCES progression (id)');
        $this->addSql('ALTER TABLE pouvoir_perso_discipline ADD CONSTRAINT FK_28F9C83F8BDBFF5 FOREIGN KEY (pouvoir_perso_id) REFERENCES pouvoir_perso (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pouvoir_perso_discipline ADD CONSTRAINT FK_28F9C83FA5522701 FOREIGN KEY (discipline_id) REFERENCES discipline (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pouvoir_perso_pouvoir ADD CONSTRAINT FK_A8E064758BDBFF5 FOREIGN KEY (pouvoir_perso_id) REFERENCES pouvoir_perso (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pouvoir_perso_pouvoir ADD CONSTRAINT FK_A8E06475C8A705F8 FOREIGN KEY (pouvoir_id) REFERENCES pouvoir (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE progression_pouvoir DROP FOREIGN KEY FK_DD2AB228AF229C18');
        $this->addSql('ALTER TABLE progression_pouvoir DROP FOREIGN KEY FK_DD2AB228C8A705F8');
        $this->addSql('DROP TABLE progression_pouvoir');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE progression_pouvoir (progression_id INT NOT NULL, pouvoir_id INT NOT NULL, INDEX IDX_DD2AB228AF229C18 (progression_id), INDEX IDX_DD2AB228C8A705F8 (pouvoir_id), PRIMARY KEY(progression_id, pouvoir_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE progression_pouvoir ADD CONSTRAINT FK_DD2AB228AF229C18 FOREIGN KEY (progression_id) REFERENCES progression (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE progression_pouvoir ADD CONSTRAINT FK_DD2AB228C8A705F8 FOREIGN KEY (pouvoir_id) REFERENCES pouvoir (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pouvoir_perso DROP FOREIGN KEY FK_2A7541E8AF229C18');
        $this->addSql('ALTER TABLE pouvoir_perso_discipline DROP FOREIGN KEY FK_28F9C83F8BDBFF5');
        $this->addSql('ALTER TABLE pouvoir_perso_discipline DROP FOREIGN KEY FK_28F9C83FA5522701');
        $this->addSql('ALTER TABLE pouvoir_perso_pouvoir DROP FOREIGN KEY FK_A8E064758BDBFF5');
        $this->addSql('ALTER TABLE pouvoir_perso_pouvoir DROP FOREIGN KEY FK_A8E06475C8A705F8');
        $this->addSql('DROP TABLE pouvoir_perso');
        $this->addSql('DROP TABLE pouvoir_perso_discipline');
        $this->addSql('DROP TABLE pouvoir_perso_pouvoir');
    }
}
