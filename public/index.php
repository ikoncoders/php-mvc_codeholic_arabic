<?php 
 
use Ikonc\PhpMvc\Model\User;
use Ikonc\PhpMvc\ApplicationMigration;

require_once __DIR__. '/../src/Support/Helpers.php';
require_once base_path() . 'vendor/autoload.php';
require_once base_path() . 'routes/web.php';
require_once base_path() . 'init.php';

$env = \Dotenv\Dotenv::createImmutable(base_path());

$env->load();

$config = [
    //'userClass' => \app\models\User::class,
'dbm' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
        ]
    ];
$app = new ApplicationMigration(__DIR__, $config); 

app()->run();

User::create([
  'username' => 'willy',
  'full_name'=> 'willy nilly',
  'email'    => 'willy@gmail.com',
]);
 
