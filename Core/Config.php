<?php 
	namespace Core;
	
	/**
	 * Class Config
	 */
	class Config{
		
		/**
		 * @param Array settings 	: Les parametres du site
		 * @param string instance 	: Instance de connexion
		 */
		 
		private $settings = [];
		private static $instance;
		
		
		/**
		 * @method __construct 	:	fouurnie les parametres du site
		 * @param file 			:	le chemin d'acces au fichier 
		 *	
		 */
		public function __construct($file){
			$this->settings = require_once ($file);			
		}
		
		/**
		 * @method getInstance	:	Instancie la connexion avec la base de donnee
		 * @param file 			:	le chemin d'acces au fichier
		 * @return string 		:	retoune la connexion a la base de donnee
		 *	
		 */
		 
		public static function getInstance($file) : Config{
			if (is_null(self::$instance)){
				self::$instance = new Config($file);
			}
			return self::$instance;
		}
		
		/**
		 * @method get 		:	recupere un element s'il existe
		 * @param string 	:	l'element rechercher
		 * @return string 	:	retoune l'element rechercher 
		 *	
		 */
		public function get($key) : string{
			if (!isset($this->settings[$key])){
				return null;
			}
			return $this->settings[$key];
		}
	}