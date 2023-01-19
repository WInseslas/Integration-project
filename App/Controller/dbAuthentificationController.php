<?php
	namespace App\Controller;
	use \App\App;
	use \Core\Authentification\dbAuthentification;

	/**
	 * class dbAuthentificationController
	 */

	class dbAuthentificationController extends AppController{

		/**
		 * @param string template
		 */

		protected $template = "Default";
		protected $authentification;

		/**
		 * @method __construct
		 */
		
		public function __construct(){
			parent::__construct();
			$this->authentification = new dbAuthentification(App::getInstance()->getDb());
			$this->logged();
		}

		/**
		 * @method logged
		 * ?page=Logged.Users.HumanResourcesDirector
		 * 
		 */
		private function logged() : void{
			if (!$this->authentification->logged() && !isset($_COOKIE['pseudo']) && !isset($_COOKIE['password'])) {
				$this->header("?page=Users.login");
			} elseif (!$this->authentification->logged() AND isset($_COOKIE['pseudo'], $_COOKIE['password']) AND !empty($_COOKIE['pseudo']) AND !empty($_COOKIE['password'])) {
				
				$user = $this->authentification->login($_COOKIE['pseudo'], $_COOKIE['password'], true);

				if (!is_null($user)) {
					if ($user->actif) {
						foreach ($user as $key => $value) {
							$_SESSION["info"]["$key"] = $value;
						}
						$this->authentification->online(1, $user->idUtilisateur);
						$this->redirect();
					} else {
						?>
							<script type="text/javascript">
					          alert("Votre compte a été déactiver, veillez vous rapprocher de la direction des ressources humaines !");
					          window.location.href="?page=Users.index";
					        </script>
						<?php
					}
				} else {
					?>
						<script type="text/javascript">
				          alert("Le pseudo ou le mot de passe sont incorrectes !");
				          window.location.href="?page=Users.login";
				        </script>
					<?php
				}

			}
		}

		/**
		 * @method logout
		 * 
		 */
		public function logout() : void{
			$this->authentification->logout();
			$this->header("?page=Users.index");
		}

		/**
		 * @method verifyBig
		 * @method big
		 * @return boolean
		 * 
		 */
		protected function verifyBig($big) : bool{
			$user = $this->utilisateur->findWithUsers($this->authentification->getUserId());
			return $user->nomGrade === $big;
		}


		protected function verify() : void{
			if (!$this->verifyBig($_SESSION['session'])) {
				$this->redirect();
			}
		}
	}

	// http://localhost/pirse/Views/index.php?page=Logged.Users.HumanResourcesDirector
	// http://localhost/pirse/Views/index.php?page=Admin.Employee.index