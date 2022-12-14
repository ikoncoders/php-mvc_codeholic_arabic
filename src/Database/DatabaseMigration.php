<?php 

namespace Ikonc\PhpMvc\Database;

use Ikonc\PhpMvc\ApplicationMigration;

class DatabaseMigration 
{
    public \PDO $pdo;

    public function __construct(array $config)
    {  
        $dsn       = $config['dsn'] ?? '';
        $user      = $config['user'] ?? '';
        $password  = $config['password'] ?? '';
        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function applyMigrations()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $newMigrations = [];
        $files = scandir(ApplicationMigration::$ROOT_DIR . '/database/migrations');
       
        $toApplyMigrations = array_diff($files, $appliedMigrations);
        foreach ($toApplyMigrations as $migration) {
            if ($migration === '.' || $migration === '..') { 
                continue;
            }
            require_once ApplicationMigration::$ROOT_DIR . '/database/migrations/' . $migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();           
            $this->log("Creating migration $migration");
            $instance->up();
            $this->log("Migration Created  $migration");
            $newMigrations[] = $migration;
        }

        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            $this->log("There are no migrations to create");
        }
    }

    protected function createMigrationsTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )  ENGINE=INNODB;");
    }

    protected function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    private function log($message)
    {
        echo "[" . date("Y-m-d H:i:s") . "] - " . $message . PHP_EOL;
    }
    protected function saveMigrations(array $newMigrations)
    {
        $str = implode(',', array_map(fn($m) => "('$m')", $newMigrations));
        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES 
            $str
        ");
        $statement->execute();
    }

    public function prepare($sql): \PDOStatement
    {
        return $this->pdo->prepare($sql);
    }
    

}