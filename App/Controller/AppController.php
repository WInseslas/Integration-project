<?php
	namespace App\Controller;
	use \Core\Controller\Controller;
	use \App\App;


	/**
	 * class AppController
	 */
	class AppController extends Controller{
		/**
		 * @param string template
		 */
		protected $template = "Default";


		/**
		 * @method __construct
		 */
		
		public function __construct(){
			$this->viewPath = ROOT . "/App/Views/";
		}

		/**
		 * @method loadModel
		 * @param string model
		 */
		
		protected function loadModel($model){
			$this->$model = APP::getInstance()->getTable("{$model}");
		}

		/**
		 * @method header
		 * @param string root
		 */
		protected function header($root){
			return header("Location: $root");
		}

		/**
		 * @method secure
		 * @param element 		
		 * @return int
		 */

		public function secure(string $element) : int{
			return intval($element);
		}
	}