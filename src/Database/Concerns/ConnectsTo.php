<?php 

namespace Ikonc\PhpMvc\Database\Concerns;

use Ikonc\PhpMvc\Database\Managers\Contracts\DatabaseManager;

trait ConnectsTo
	{
		public static function connect(DatabaseManager $manager)
		{
			return $manager->connect();
		}
	}