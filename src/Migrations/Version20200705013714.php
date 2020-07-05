<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200705013714 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create task and its relationships';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql(
            'CREATE TABLE task (
                    task_id CHAR(36) NOT NULL PRIMARY KEY,
                    project_id CHAR(36) NOT NULL,
                    name VARCHAR(100) NOT NULL,
                    description TINYTEXT DEFAULT NULL,
                    created_at DATETIME NOT NULL,
                    updated_at DATETIME NOT NULL,
                    INDEX IDX_task_project_id (project_id),
                    CONSTRAINT FK_task_project_id FOREIGN KEY (project_id) REFERENCES project (project_id) ON UPDATE CASCADE ON DELETE CASCADE
            )DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE = InnoDB'
        );

    }

    public function down(Schema $schema) : void
    {
        //$this->addSql('DROP TABLE task');
        $this->addSql('DROP TABLE task');

    }
}
