<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230622094513 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attache (id INT AUTO_INCREMENT NOT NULL, fiche_vampire_id INT NOT NULL, nom VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, conviction VARCHAR(255) NOT NULL, INDEX IDX_75BB009063049FD6 (fiche_vampire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attribut (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attribut_personnage (id INT AUTO_INCREMENT NOT NULL, attribut_id INT NOT NULL, progression_id INT NOT NULL, niveau SMALLINT NOT NULL, INDEX IDX_50928A6E51383AF3 (attribut_id), INDEX IDX_50928A6EAF229C18 (progression_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avantage_inconvenient (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, type INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE campagne (id INT AUTO_INCREMENT NOT NULL, maitre_de_jeu_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_539B5D16AF1BFB8B (maitre_de_jeu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE campagne_membre (campagne_id INT NOT NULL, membre_id INT NOT NULL, INDEX IDX_C4F7183A16227374 (campagne_id), INDEX IDX_C4F7183A6A99F74A (membre_id), PRIMARY KEY(campagne_id, membre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clan (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, faiblesse VARCHAR(255) NOT NULL, lore LONGTEXT NOT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competences (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE discipline (id INT AUTO_INCREMENT NOT NULL, description LONGTEXT NOT NULL, nom VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE discipline_clan (discipline_id INT NOT NULL, clan_id INT NOT NULL, INDEX IDX_4A8A94E2A5522701 (discipline_id), INDEX IDX_4A8A94E2BEAF84C8 (clan_id), PRIMARY KEY(discipline_id, clan_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche_vampire (id INT AUTO_INCREMENT NOT NULL, clan_id INT NOT NULL, membre_id INT NOT NULL, nom VARCHAR(100) NOT NULL, concept VARCHAR(100) DEFAULT NULL, description LONGTEXT DEFAULT NULL, experience SMALLINT DEFAULT NULL, ambition VARCHAR(50) NOT NULL, desire VARCHAR(50) NOT NULL, generation SMALLINT DEFAULT NULL, sire VARCHAR(50) NOT NULL, humanite SMALLINT NOT NULL, INDEX IDX_A437D026BEAF84C8 (clan_id), INDEX IDX_A437D0266A99F74A (membre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membre (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, pseudo VARCHAR(50) NOT NULL, date_naissance DATE NOT NULL, image_name VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_F6B4FB29E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE point_creation (id INT AUTO_INCREMENT NOT NULL, avantage_inconvenient_id INT NOT NULL, progression_id INT NOT NULL, niveau SMALLINT NOT NULL, INDEX IDX_C58BDF16A3E701B3 (avantage_inconvenient_id), INDEX IDX_C58BDF16AF229C18 (progression_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE possession (id INT AUTO_INCREMENT NOT NULL, fiche_vampire_id INT DEFAULT NULL, nom VARCHAR(100) NOT NULL, valeur VARCHAR(255) DEFAULT NULL, poids NUMERIC(6, 2) DEFAULT NULL, description LONGTEXT NOT NULL, INDEX IDX_F9EE3F4263049FD6 (fiche_vampire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pouvoir (id INT AUTO_INCREMENT NOT NULL, discipline_id INT DEFAULT NULL, nom VARCHAR(100) NOT NULL, niveau SMALLINT NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_BE7F6EC6A5522701 (discipline_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pouvoir_perso (id INT AUTO_INCREMENT NOT NULL, progression_id INT NOT NULL, UNIQUE INDEX UNIQ_2A7541E8AF229C18 (progression_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pouvoir_perso_discipline (pouvoir_perso_id INT NOT NULL, discipline_id INT NOT NULL, INDEX IDX_28F9C83F8BDBFF5 (pouvoir_perso_id), INDEX IDX_28F9C83FA5522701 (discipline_id), PRIMARY KEY(pouvoir_perso_id, discipline_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pouvoir_perso_pouvoir (pouvoir_perso_id INT NOT NULL, pouvoir_id INT NOT NULL, INDEX IDX_A8E064758BDBFF5 (pouvoir_perso_id), INDEX IDX_A8E06475C8A705F8 (pouvoir_id), PRIMARY KEY(pouvoir_perso_id, pouvoir_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE predateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(100) NOT NULL, effet_divers LONGTEXT DEFAULT NULL, specialisation VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE predateur_discipline (predateur_id INT NOT NULL, discipline_id INT NOT NULL, INDEX IDX_CE1E83CEFACB624B (predateur_id), INDEX IDX_CE1E83CEA5522701 (discipline_id), PRIMARY KEY(predateur_id, discipline_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE predateur_avantage_inconvenient (predateur_id INT NOT NULL, avantage_inconvenient_id INT NOT NULL, INDEX IDX_5649B3FCFACB624B (predateur_id), INDEX IDX_5649B3FCA3E701B3 (avantage_inconvenient_id), PRIMARY KEY(predateur_id, avantage_inconvenient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE progression (id INT AUTO_INCREMENT NOT NULL, predateur_id INT DEFAULT NULL, fiche_vampire_id INT NOT NULL, INDEX IDX_D5B25073FACB624B (predateur_id), UNIQUE INDEX UNIQ_D5B2507363049FD6 (fiche_vampire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill_personnage (id INT AUTO_INCREMENT NOT NULL, skill_id INT NOT NULL, progression_id INT NOT NULL, niveau SMALLINT NOT NULL, INDEX IDX_7F63941F5585C142 (skill_id), INDEX IDX_7F63941FAF229C18 (progression_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attache ADD CONSTRAINT FK_75BB009063049FD6 FOREIGN KEY (fiche_vampire_id) REFERENCES fiche_vampire (id)');
        $this->addSql('ALTER TABLE attribut_personnage ADD CONSTRAINT FK_50928A6E51383AF3 FOREIGN KEY (attribut_id) REFERENCES attribut (id)');
        $this->addSql('ALTER TABLE attribut_personnage ADD CONSTRAINT FK_50928A6EAF229C18 FOREIGN KEY (progression_id) REFERENCES progression (id)');
        $this->addSql('ALTER TABLE campagne ADD CONSTRAINT FK_539B5D16AF1BFB8B FOREIGN KEY (maitre_de_jeu_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE campagne_membre ADD CONSTRAINT FK_C4F7183A16227374 FOREIGN KEY (campagne_id) REFERENCES campagne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE campagne_membre ADD CONSTRAINT FK_C4F7183A6A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE discipline_clan ADD CONSTRAINT FK_4A8A94E2A5522701 FOREIGN KEY (discipline_id) REFERENCES discipline (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE discipline_clan ADD CONSTRAINT FK_4A8A94E2BEAF84C8 FOREIGN KEY (clan_id) REFERENCES clan (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fiche_vampire ADD CONSTRAINT FK_A437D026BEAF84C8 FOREIGN KEY (clan_id) REFERENCES clan (id)');
        $this->addSql('ALTER TABLE fiche_vampire ADD CONSTRAINT FK_A437D0266A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE point_creation ADD CONSTRAINT FK_C58BDF16A3E701B3 FOREIGN KEY (avantage_inconvenient_id) REFERENCES avantage_inconvenient (id)');
        $this->addSql('ALTER TABLE point_creation ADD CONSTRAINT FK_C58BDF16AF229C18 FOREIGN KEY (progression_id) REFERENCES progression (id)');
        $this->addSql('ALTER TABLE possession ADD CONSTRAINT FK_F9EE3F4263049FD6 FOREIGN KEY (fiche_vampire_id) REFERENCES fiche_vampire (id)');
        $this->addSql('ALTER TABLE pouvoir ADD CONSTRAINT FK_BE7F6EC6A5522701 FOREIGN KEY (discipline_id) REFERENCES discipline (id)');
        $this->addSql('ALTER TABLE pouvoir_perso ADD CONSTRAINT FK_2A7541E8AF229C18 FOREIGN KEY (progression_id) REFERENCES progression (id)');
        $this->addSql('ALTER TABLE pouvoir_perso_discipline ADD CONSTRAINT FK_28F9C83F8BDBFF5 FOREIGN KEY (pouvoir_perso_id) REFERENCES pouvoir_perso (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pouvoir_perso_discipline ADD CONSTRAINT FK_28F9C83FA5522701 FOREIGN KEY (discipline_id) REFERENCES discipline (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pouvoir_perso_pouvoir ADD CONSTRAINT FK_A8E064758BDBFF5 FOREIGN KEY (pouvoir_perso_id) REFERENCES pouvoir_perso (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pouvoir_perso_pouvoir ADD CONSTRAINT FK_A8E06475C8A705F8 FOREIGN KEY (pouvoir_id) REFERENCES pouvoir (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE predateur_discipline ADD CONSTRAINT FK_CE1E83CEFACB624B FOREIGN KEY (predateur_id) REFERENCES predateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE predateur_discipline ADD CONSTRAINT FK_CE1E83CEA5522701 FOREIGN KEY (discipline_id) REFERENCES discipline (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE predateur_avantage_inconvenient ADD CONSTRAINT FK_5649B3FCFACB624B FOREIGN KEY (predateur_id) REFERENCES predateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE predateur_avantage_inconvenient ADD CONSTRAINT FK_5649B3FCA3E701B3 FOREIGN KEY (avantage_inconvenient_id) REFERENCES avantage_inconvenient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE progression ADD CONSTRAINT FK_D5B25073FACB624B FOREIGN KEY (predateur_id) REFERENCES predateur (id)');
        $this->addSql('ALTER TABLE progression ADD CONSTRAINT FK_D5B2507363049FD6 FOREIGN KEY (fiche_vampire_id) REFERENCES fiche_vampire (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE skill_personnage ADD CONSTRAINT FK_7F63941F5585C142 FOREIGN KEY (skill_id) REFERENCES skill (id)');
        $this->addSql('ALTER TABLE skill_personnage ADD CONSTRAINT FK_7F63941FAF229C18 FOREIGN KEY (progression_id) REFERENCES progression (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attache DROP FOREIGN KEY FK_75BB009063049FD6');
        $this->addSql('ALTER TABLE attribut_personnage DROP FOREIGN KEY FK_50928A6E51383AF3');
        $this->addSql('ALTER TABLE attribut_personnage DROP FOREIGN KEY FK_50928A6EAF229C18');
        $this->addSql('ALTER TABLE campagne DROP FOREIGN KEY FK_539B5D16AF1BFB8B');
        $this->addSql('ALTER TABLE campagne_membre DROP FOREIGN KEY FK_C4F7183A16227374');
        $this->addSql('ALTER TABLE campagne_membre DROP FOREIGN KEY FK_C4F7183A6A99F74A');
        $this->addSql('ALTER TABLE discipline_clan DROP FOREIGN KEY FK_4A8A94E2A5522701');
        $this->addSql('ALTER TABLE discipline_clan DROP FOREIGN KEY FK_4A8A94E2BEAF84C8');
        $this->addSql('ALTER TABLE fiche_vampire DROP FOREIGN KEY FK_A437D026BEAF84C8');
        $this->addSql('ALTER TABLE fiche_vampire DROP FOREIGN KEY FK_A437D0266A99F74A');
        $this->addSql('ALTER TABLE point_creation DROP FOREIGN KEY FK_C58BDF16A3E701B3');
        $this->addSql('ALTER TABLE point_creation DROP FOREIGN KEY FK_C58BDF16AF229C18');
        $this->addSql('ALTER TABLE possession DROP FOREIGN KEY FK_F9EE3F4263049FD6');
        $this->addSql('ALTER TABLE pouvoir DROP FOREIGN KEY FK_BE7F6EC6A5522701');
        $this->addSql('ALTER TABLE pouvoir_perso DROP FOREIGN KEY FK_2A7541E8AF229C18');
        $this->addSql('ALTER TABLE pouvoir_perso_discipline DROP FOREIGN KEY FK_28F9C83F8BDBFF5');
        $this->addSql('ALTER TABLE pouvoir_perso_discipline DROP FOREIGN KEY FK_28F9C83FA5522701');
        $this->addSql('ALTER TABLE pouvoir_perso_pouvoir DROP FOREIGN KEY FK_A8E064758BDBFF5');
        $this->addSql('ALTER TABLE pouvoir_perso_pouvoir DROP FOREIGN KEY FK_A8E06475C8A705F8');
        $this->addSql('ALTER TABLE predateur_discipline DROP FOREIGN KEY FK_CE1E83CEFACB624B');
        $this->addSql('ALTER TABLE predateur_discipline DROP FOREIGN KEY FK_CE1E83CEA5522701');
        $this->addSql('ALTER TABLE predateur_avantage_inconvenient DROP FOREIGN KEY FK_5649B3FCFACB624B');
        $this->addSql('ALTER TABLE predateur_avantage_inconvenient DROP FOREIGN KEY FK_5649B3FCA3E701B3');
        $this->addSql('ALTER TABLE progression DROP FOREIGN KEY FK_D5B25073FACB624B');
        $this->addSql('ALTER TABLE progression DROP FOREIGN KEY FK_D5B2507363049FD6');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE skill_personnage DROP FOREIGN KEY FK_7F63941F5585C142');
        $this->addSql('ALTER TABLE skill_personnage DROP FOREIGN KEY FK_7F63941FAF229C18');
        $this->addSql('DROP TABLE attache');
        $this->addSql('DROP TABLE attribut');
        $this->addSql('DROP TABLE attribut_personnage');
        $this->addSql('DROP TABLE avantage_inconvenient');
        $this->addSql('DROP TABLE campagne');
        $this->addSql('DROP TABLE campagne_membre');
        $this->addSql('DROP TABLE clan');
        $this->addSql('DROP TABLE competences');
        $this->addSql('DROP TABLE discipline');
        $this->addSql('DROP TABLE discipline_clan');
        $this->addSql('DROP TABLE fiche_vampire');
        $this->addSql('DROP TABLE membre');
        $this->addSql('DROP TABLE point_creation');
        $this->addSql('DROP TABLE possession');
        $this->addSql('DROP TABLE pouvoir');
        $this->addSql('DROP TABLE pouvoir_perso');
        $this->addSql('DROP TABLE pouvoir_perso_discipline');
        $this->addSql('DROP TABLE pouvoir_perso_pouvoir');
        $this->addSql('DROP TABLE predateur');
        $this->addSql('DROP TABLE predateur_discipline');
        $this->addSql('DROP TABLE predateur_avantage_inconvenient');
        $this->addSql('DROP TABLE progression');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE skill_personnage');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
