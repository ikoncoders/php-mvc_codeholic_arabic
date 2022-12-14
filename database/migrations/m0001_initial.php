<?php 

use Ikonc\PhpMvc\ApplicationMigration;

class m0001_initial 
{
    public function up()
    {
        $dbm = ApplicationMigration::$appm->dbm;
        $sql = "CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(255) NOT NULL,
                full_name VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL, 
                password VARCHAR(255) NOT NULL,              
                status TINYINT DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )  ENGINE=INNODB;";
        $dbm->pdo->exec($sql);
    }

    public function down()
    {
        $dbm = ApplicationMigration::$appm->dbm;
        $sql = "DROP TABLE users;";
        $dbm->pdo->exec($sql);
    }
}