<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220126175445 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('use macopedia');
        $this->addSql('CREATE TABLE Products (indeks VARCHAR(50), name VARCHAR(50), PRIMARY KEY(indeks))');
        $this->addSql('CREATE TABLE category (id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                                                name varchar(50) NOT NULL, 
                                                PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE product_categories (id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                                                        id_category int(10) UNSIGNED NOT NULL,
                                                        product_indeks varchar(50) NOT NULL, 
                                                        PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE product_categories ADD KEY id_category (id_category), ADD KEY product_indeks (product_indeks);');
        $this->addSql('ALTER TABLE product_categories 
                        ADD CONSTRAINT product_category_category_fk FOREIGN KEY (id_category) REFERENCES category (id),
                        ADD CONSTRAINT product_category_product_fk FOREIGN KEY (product_indeks) REFERENCES products (indeks)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('use macopedia');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE product_categories');
    }
}
