<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190812204347 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE systemevents (ID INT UNSIGNED AUTO_INCREMENT NOT NULL, CustomerID BIGINT DEFAULT NULL, ReceivedAt DATETIME DEFAULT NULL, DeviceReportedTime DATETIME DEFAULT NULL, Facility SMALLINT DEFAULT NULL, Priority SMALLINT DEFAULT NULL, FromHost VARCHAR(60) DEFAULT \'NULL\', Message TEXT DEFAULT NULL, NTSeverity INT DEFAULT NULL, Importance INT DEFAULT NULL, EventSource VARCHAR(60) DEFAULT \'NULL\', EventUser VARCHAR(60) DEFAULT \'NULL\', EventCategory INT DEFAULT NULL, EventID INT DEFAULT NULL, EventBinaryData TEXT DEFAULT NULL, MaxAvailable INT DEFAULT NULL, CurrUsage INT DEFAULT NULL, MinUsage INT DEFAULT NULL, MaxUsage INT DEFAULT NULL, InfoUnitID INT DEFAULT NULL, SysLogTag VARCHAR(60) DEFAULT \'NULL\', EventLogType VARCHAR(60) DEFAULT \'NULL\', GenericFileName VARCHAR(60) DEFAULT \'NULL\', SystemID INT DEFAULT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE systemevents');
    }
}
