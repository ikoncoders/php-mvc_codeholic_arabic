<?php 

namespace Ikonc\PhpMvc;

use Ikonc\PhpMvc\Http\Route;
use Ikonc\PhpMvc\Database\DB;
use Ikonc\PhpMvc\Http\Request;
use Ikonc\PhpMvc\Http\Response;
use Ikonc\PhpMvc\Support\Config;
use Ikonc\PhpMvc\Support\Session;
use Ikonc\PhpMvc\Database\Managers\MySQLManager;
use Ikonc\PhpMvc\Database\Managers\SQLiteManager;

class Application 
{
        protected Route $route;
		protected Request $request;
		protected Response $response;
		protected Config $config;
		protected DB $db; 		
		protected Session $session;
		public static Application $app;

        public function __construct()
		{
			$this->request = new Request;
			$this->response = new Response;
			$this->route = new Route($this->request, $this->response);	
			$this->config = new Config($this->loadConfigurations()); 
			$this->db = new DB($this->getDatabaseDriver()); 			
			$this->session = new Session;		  
		}
		protected function loadConfigurations()
		{
			foreach(scandir(config_path()) as $file){
				if($file == '.' || $file == '..'){
					continue;
				}
				$filename = explode('.',$file)[0];
				yield $filename => require config_path().$file;
			}
		}
		protected function getDatabaseDriver()                
		{
			 return match(env('DB_DRIVER')) {
				'sqlite' => new SQLiteManager,
				'mysql' => new MySQLManager,
				default => new SQLiteManager
			};
		}
        public function run()
		{
			$this->db->init();      
			$this->route->resolve();
		}

        public function __get($name)
		{
			if(property_exists($this, $name)) {
				return $this->$name;
			}
		}
}