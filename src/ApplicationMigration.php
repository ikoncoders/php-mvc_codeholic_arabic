<?php 

namespace Ikonc\PhpMvc;

// use Ikonc\PhpMvc\Http\Route;
// use Ikonc\PhpMvc\Http\Request;
// use Ikonc\PhpMvc\Http\Response;
use Ikonc\PhpMvc\Support\Config;
// use Ikonc\PhpMvc\Support\Session;
use Ikonc\PhpMvc\Database\DatabaseMigration;


class ApplicationMigration
{
        // protected Route $route;
		// protected Request $request;
		// protected Response $response;
		protected Config $config;
		public DatabaseMigration $dbm; 		
		// protected Session $session;
        public static ApplicationMigration $appm;
        public static string $ROOT_DIR;

        public function __construct($rootPath,array $config)
		{    
            self::$ROOT_DIR = $rootPath;
            self::$appm = $this;
			// $this->request = new Request;
			// $this->response = new Response;
			// $this->route = new Route($this->request, $this->response);	
            $this->dbm = new DatabaseMigration($config['dbm']);			
			// $this->session = new Session;		  
		}
	 
        public function run()
		{
			// $this->db->init();      
			$this->route->resolve();
		}

       

        
}