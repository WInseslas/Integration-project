<?php
	
	namespace Core\Authentification;
	use \Core\Database\Database;

	/**
	 * Class dbAuthentification
	 */
	class dbAuthentification{

		/**
		 * @param string db 	:	La connexion a la base de donne    
		 */

		private $db;
		
		/**
		 * @method __construct
		 * @param string db 	:	La connexion a la base de donne
		 */

		public function __construct(Database $db){
			$this->db = $db;
		}

		/**
		 * @method getUserId
		 * @return int
		 */

		public function getUserId() : int{
			if ($this->logged()) {
				return $_SESSION["info"]['idUtilisateur'];
			}
			return false;
		}

		/**
		 * @method login
		 * @param string pseudo 	:	Le pseudo de l'utilisateur
		 * @param string password 	:	Le mot de passe
		 * @return boolean
		 */

		public function login($pseudo, $password, $cookie = false) {
			$user = $this->db->prepare("SELECT * FROM utilisateur
				LEFT JOIN grade 
				ON _idGrade = idGrade
				WHERE pseudo = ?", array($pseudo), null, true);
			if ($user) {
				if ($cookie) {
					if ($user->password === $password) {
						return $user;
					}
					return null;
				} else {
					if ($user->password === sha1($password)) {
						return $user;
					}
					return null;
				}
			}
			return null;
		}


		/**
		 * @method online
		 * @param statut
		 * @param idUtilisateur
		 */

		public function online($statut, $idUtilisateur) : void{
			$this->db->prepare("UPDATE utilisateur SET enLigne = ? WHERE idUtilisateur = ?", array($statut, $idUtilisateur), null, true);
		}

		/**
		 * @method logged
		 * @return boolean
		 */

		public function logged() : bool{
			return isset($_SESSION["info"]['idUtilisateur']);
		}

		/**
		 * @method logout
		 */

		public function logout() : void{
			$this->online(0, $_SESSION["info"]['idUtilisateur']);
			setcookie('pseudo', '', time()-3600);
			setcookie('password', '', time()-3600);
			session_destroy();
		}

	}