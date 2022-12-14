<?php 

use Ikonc\PhpMvc\ApplicationMigration;

require_once __DIR__.'/vendor/autoload.php';
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
    
    'dbm' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

$appm = new ApplicationMigration(__DIR__, $config);

$appm->dbm->applyMigrations();