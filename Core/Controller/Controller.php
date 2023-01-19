<?php 
	namespace Core\Controller;

	/**
	 * class Controller
	 */
	class Controller{

		/**
		 * @param string viewPath
		 * @param string template
		 */

		protected $viewPath;
		protected $template;
		
		/**
		 * @method render
		 * @param view 	: 	La vue
		 */

		protected function render($view, $variables = []) : void{
			ob_start();
			extract($variables);
			require_once $this->viewPath . str_replace(".", "/", $view). ".php";
			$content = ob_get_clean();
			require_once $this->viewPath . "Template/" . $this->template . ".php";
		}
		
		/**
		 * @method redirect 	
		 */

		protected function redirect() : void{
			if ($_SESSION["info"]['nomGrade'] === "Chargé de la communication") {
				header("Location: index.php?page=Logged.Users.CommunicationManager");
			} elseif($_SESSION["info"]['nomGrade'] === "Directeur des ressources humaines") {
				header("Location: index.php?page=Logged.Users.HumanResourcesDirector");
			} else {
				header("Location: index.php?page=Logged.Users.Chose");
			}
		}

	}