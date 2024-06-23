<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240622211031 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE auth_auth (ulid VARCHAR(26) NOT NULL, password VARCHAR(255) DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', created_at DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', email_email VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_D6F850ED7ADF3DFB (email_email), PRIMARY KEY(ulid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_attribute (ulid VARCHAR(26) NOT NULL, product_ulid VARCHAR(26) NOT NULL, name VARCHAR(32) NOT NULL, value VARCHAR(255) NOT NULL, INDEX IDX_94DA59764F60EAF8 (product_ulid), PRIMARY KEY(ulid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_category (id INT AUTO_INCREMENT NOT NULL, tree_root INT DEFAULT NULL, parent_id INT DEFAULT NULL, name VARCHAR(64) NOT NULL, description VARCHAR(512) NOT NULL, lft INT NOT NULL, lvl INT NOT NULL, rgt INT NOT NULL, creator_ulid_ulid VARCHAR(26) NOT NULL, INDEX IDX_CDFC7356A977936C (tree_root), INDEX IDX_CDFC7356727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_product (ulid VARCHAR(26) NOT NULL, name VARCHAR(64) NOT NULL, description VARCHAR(255) NOT NULL, price NUMERIC(6, 2) NOT NULL, main_image VARCHAR(255) NOT NULL, images JSON NOT NULL, creator_ulid_ulid VARCHAR(26) NOT NULL, PRIMARY KEY(ulid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_category_to_product (product_ulid VARCHAR(26) NOT NULL, category_id INT NOT NULL, INDEX IDX_228D82B44F60EAF8 (product_ulid), INDEX IDX_228D82B412469DE2 (category_id), PRIMARY KEY(product_ulid, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE refresh_token (id INT AUTO_INCREMENT NOT NULL, auth_ulid VARCHAR(26) DEFAULT NULL, created_at DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', refresh_token VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, valid DATETIME NOT NULL, INDEX IDX_C74F2195ECAE28ED (auth_ulid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_attribute ADD CONSTRAINT FK_94DA59764F60EAF8 FOREIGN KEY (product_ulid) REFERENCES product_product (ulid)');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC7356A977936C FOREIGN KEY (tree_root) REFERENCES product_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC7356727ACA70 FOREIGN KEY (parent_id) REFERENCES product_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_category_to_product ADD CONSTRAINT FK_228D82B44F60EAF8 FOREIGN KEY (product_ulid) REFERENCES product_product (ulid)');
        $this->addSql('ALTER TABLE product_category_to_product ADD CONSTRAINT FK_228D82B412469DE2 FOREIGN KEY (category_id) REFERENCES product_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE refresh_token ADD CONSTRAINT FK_C74F2195ECAE28ED FOREIGN KEY (auth_ulid) REFERENCES auth_auth (ulid)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_attribute DROP FOREIGN KEY FK_94DA59764F60EAF8');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC7356A977936C');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC7356727ACA70');
        $this->addSql('ALTER TABLE product_category_to_product DROP FOREIGN KEY FK_228D82B44F60EAF8');
        $this->addSql('ALTER TABLE product_category_to_product DROP FOREIGN KEY FK_228D82B412469DE2');
        $this->addSql('ALTER TABLE refresh_token DROP FOREIGN KEY FK_C74F2195ECAE28ED');
        $this->addSql('DROP TABLE auth_auth');
        $this->addSql('DROP TABLE product_attribute');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('DROP TABLE product_product');
        $this->addSql('DROP TABLE product_category_to_product');
        $this->addSql('DROP TABLE refresh_token');
    }
}
