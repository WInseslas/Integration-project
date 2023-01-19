<?php 
	namespace App;

	use \Core\Database\MySQLDatabase;
	use \Core\Config;	

	/**
	 * Class App
	 */

	class App{
		
		/**
		 * @param string instance 		: Instance de configuration du site
		 * @param string db_instance 	: Instance de connexion a la base de donnee
		 */
		 
		private static $instance;
		private $db_instance;

		/**
		 * @method load 	:	recupere les class et les charge
		 *	
		 */
		
		public static function load() : void {
			if (session_status() === PHP_SESSION_NONE) {
				session_start();
			}

			require_once ROOT ."/App/Autoloader.php";
			\App\Autoloader::register();				
			require_once ROOT ."/Core/Autoloader.php";
			\Core\Autoloader::register();				
		}

		/**
		 * @method getInstance 	:	instancie la connexion avec la base de donnee
		 * @return string 		:	retourne une instance
		 *	
		 */
		 
		public static function getInstance() : App{
			if (is_null(self::$instance)){
				self::$instance = new App();
			}
			return self::$instance;
		}
		
		/**
		 * @method getDb 	:	recupere la connexion a la base de donne
		 * @return string 	:	retoune la connexion a la base de donnee
		 *	
		 */
		
		public function getDb() : MySQLDatabase {
			if (is_null($this->db_instance)) {
				$config = Config::getInstance(ROOT . '/Config/Config.php');
				$this->db_instance = new MySQLDatabase($config->get("db_host"), $config->get("db_name"), $config->get("db_user"), $config->get("db_pass"));
			}
			return $this->db_instance;
		}


		/**
		 * @method getTable 	:	recupere une table
		 * @param string $name 	:	le nom de la table
		 * @return string 		:	retoune le nom de la table
		 *	
		 */
		 
		public function getTable($name) {
			$class_name = '\\App\\Table\\'.ucfirst($name).'Table';
			return new $class_name($this->getDb());
		}
	}