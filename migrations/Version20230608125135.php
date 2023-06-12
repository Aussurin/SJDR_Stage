<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230608125135 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attache ADD fiche_vampire_id INT NOT NULL');
        $this->addSql('ALTER TABLE attache ADD CONSTRAINT FK_75BB009063049FD6 FOREIGN KEY (fiche_vampire_id) REFERENCES fiche_vampire (id)');
        $this->addSql('CREATE INDEX IDX_75BB009063049FD6 ON attache (fiche_vampire_id)');
        $this->addSql('ALTER TABLE fiche_vampire ADD clan_id INT NOT NULL');
        $this->addSql('ALTER TABLE fiche_vampire ADD CONSTRAINT FK_A437D026BEAF84C8 FOREIGN KEY (clan_id) REFERENCES clan (id)');
        $this->addSql('CREATE INDEX IDX_A437D026BEAF84C8 ON fiche_vampire (clan_id)');
        $this->addSql('ALTER TABLE possession ADD fiche_vampire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE possession ADD CONSTRAINT FK_F9EE3F4263049FD6 FOREIGN KEY (fiche_vampire_id) REFERENCES fiche_vampire (id)');
        $this->addSql('CREATE INDEX IDX_F9EE3F4263049FD6 ON possession (fiche_vampire_id)');
        $this->addSql('ALTER TABLE progression ADD fiche_vampire_id INT NOT NULL');
        $this->addSql('ALTER TABLE progression ADD CONSTRAINT FK_D5B2507363049FD6 FOREIGN KEY (fiche_vampire_id) REFERENCES fiche_vampire (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D5B2507363049FD6 ON progression (fiche_vampire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attache DROP FOREIGN KEY FK_75BB009063049FD6');
        $this->addSql('DROP INDEX IDX_75BB009063049FD6 ON attache');
        $this->addSql('ALTER TABLE attache DROP fiche_vampire_id');
        $this->addSql('ALTER TABLE fiche_vampire DROP FOREIGN KEY FK_A437D026BEAF84C8');
        $this->addSql('DROP INDEX IDX_A437D026BEAF84C8 ON fiche_vampire');
        $this->addSql('ALTER TABLE fiche_vampire DROP clan_id');
        $this->addSql('ALTER TABLE possession DROP FOREIGN KEY FK_F9EE3F4263049FD6');
        $this->addSql('DROP INDEX IDX_F9EE3F4263049FD6 ON possession');
        $this->addSql('ALTER TABLE possession DROP fiche_vampire_id');
        $this->addSql('ALTER TABLE progression DROP FOREIGN KEY FK_D5B2507363049FD6');
        $this->addSql('DROP INDEX UNIQ_D5B2507363049FD6 ON progression');
        $this->addSql('ALTER TABLE progression DROP fiche_vampire_id');
    }
}
