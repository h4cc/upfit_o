<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130404211528 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        
        $this->addSql("ALTER TABLE Member CHANGE admin admin TINYINT(1) DEFAULT '0', CHANGE owner owner TINYINT(1) DEFAULT '0'");
        $this->addSql("CREATE UNIQUE INDEX user_club ON Member (user_id, club_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        
        $this->addSql("DROP INDEX user_club ON Member");
        $this->addSql("ALTER TABLE Member CHANGE admin admin TINYINT(1) DEFAULT '0', CHANGE owner owner TINYINT(1) DEFAULT '0'");
    }
}
