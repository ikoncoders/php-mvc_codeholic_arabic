<?php 

use Ikonc\PhpMvc\ApplicationMigration;

class m0003_posts_table 
{
    public function up()
    {
        $dbm = ApplicationMigration::$appm->dbm;
        $sql = "CREATE TABLE posts (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,                               
                slug VARCHAR(255) NOT NULL, 
                status TINYINT DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )  ENGINE=INNODB;";
        $dbm->pdo->exec($sql);
    }

    public function down()
    {
        $dbm = ApplicationMigration::$appm->dbm;
        $sql = "DROP TABLE posts;";
        $dbm->pdo->exec($sql);
    }
}