<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250225004433 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // Vérifier si la table 'brand' existe avant de tenter de la créer
        if (!$schema->hasTable('brand')) {
            $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        }

        // Vérifier si la table 'category' existe avant de tenter de la créer
        if (!$schema->hasTable('category')) {
            $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        }

        // Vérifier si la table 'materiel' existe avant de tenter de la créer
        if (!$schema->hasTable('materiel')) {
            $this->addSql('CREATE TABLE materiel (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        }

        // Vérifier si la table 'product' existe avant de tenter de la créer
        if (!$schema->hasTable('product')) {
            $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, brand_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_D34A04AD12469DE2 (category_id), INDEX IDX_D34A04AD44F5D008 (brand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        }

        // Vérifier si la table 'product_materiel' existe avant de tenter de la créer
        if (!$schema->hasTable('product_materiel')) {
            $this->addSql('CREATE TABLE product_materiel (product_id INT NOT NULL, materiel_id INT NOT NULL, INDEX IDX_D362DA064584665A (product_id), INDEX IDX_D362DA0616880AAF (materiel_id), PRIMARY KEY(product_id, materiel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        }

        // Vérifier si la table 'user' existe avant de tenter de la créer
        if (!$schema->hasTable('user')) {
            $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        }

        // Vérifier si la table 'messenger_messages' existe avant de tenter de la créer
        if (!$schema->hasTable('messenger_messages')) {
            $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        }

        // Ajouter les contraintes de clé étrangère avec des noms uniques
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_PRODUCT_CATEGORY FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_PRODUCT_BRAND FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE product_materiel ADD CONSTRAINT FK_PRODUCT_MATERIEL_PRODUCT FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_materiel ADD CONSTRAINT FK_PRODUCT_MATERIEL_MATERIEL FOREIGN KEY (materiel_id) REFERENCES materiel (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // Supprimer les contraintes de clé étrangère
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_PRODUCT_CATEGORY');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_PRODUCT_BRAND');
        $this->addSql('ALTER TABLE product_materiel DROP FOREIGN KEY FK_PRODUCT_MATERIEL_PRODUCT');
        $this->addSql('ALTER TABLE product_materiel DROP FOREIGN KEY FK_PRODUCT_MATERIEL_MATERIEL');
        
        // Supprimer les tables
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE materiel');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_materiel');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
