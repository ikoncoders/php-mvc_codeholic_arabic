<?php 

use Ikonc\PhpMvc\ApplicationMigration;

class m0002_add_phone_column_users_table 
{
    public function up()
    {
        $dbm = ApplicationMigration::$appm->dbm;
        $dbm->pdo->exec("ALTER TABLE users ADD COLUMN phone int(10) NOT NULL");
    }

    public function down()
    {
        $dbm = ApplicationMigration::$appm->dbm;
        $dbm->pdo->exec("ALTER TABLE users ADD COLUMN phone int(10) NOT NULL");
    }
}