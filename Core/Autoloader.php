<?php
	
	namespace Core;

	/**
	 * Class Autoloader
	 * 		 pour le chargement des class automatique
	 */

	class Autoloader{
		
		/**
		 * @method autoload
		 * @param string 	:	prend la class a charger
		 * @return string 	: 	retourne la class a charger
		 */
		
		public static function autoload($class){
			if (strpos($class, __NAMESPACE__.'\\') === 0) {
				$class = str_replace(__NAMESPACE__.'\\', '/', $class);
				$class = explode('\\', $class);
				$class = implode('/', $class);
				return require_once __DIR__ . $class.'.php';
			}
		}


		/**
		 * @method register
		 * @return string 	:	retourne le chargement
		 */
		public static function register(){
			return spl_autoload_register(array(get_called_class(), 'autoload'));
		}
	}