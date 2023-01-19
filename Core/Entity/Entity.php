<?php
	
	namespace Core\Entity;

	use \App\App;
	/**
	 * Class Entity
	 */
	class Entity{

		
		/**
		 * @param string db 	: la connexion a la base de donnee
		 * 
		 */
		
		private $db;

		/**
		 * @method __construct
		 *	
		 */

		public function __construct(){
			$this->db = App::getInstance()->getDb();
		}

		/**
		 * @param string key 		:	la clée ou la variable a charger magiquement
		 * @return string
		 */
		public function __get(string $key){
			$method = "get".ucfirst($key);
			$this->$key = $this->$method();
			return $this->$key; 
		}
		
		/**
		 * @method follow
		 * @param fields
		 * @return object
		 */
		protected function follow(Array $fields) : object{
			return $this->db->prepare("SELECT *
									FROM utilisateur
									INNER JOIN grade 
									ON _idGrade = idGrade
									LEFT JOIN suivre 
									ON
									    (
									        suivie = idUtilisateur AND suiveur = :idUtilisateur
									    ) OR(
									        suivie = :idUtilisateur AND suiveur = idUtilisateur
									    )
									WHERE
									    idUtilisateur = :idSession", 
									    $fields,
									    null,
									    true 
									);
		}


		/**
		 * @method coutLikes 	: Recupere tout (*)
		 * @param fields 		: Array
		 * @return Object 		: Retoune le resultat
		 */


		protected function coutLikes(Array $fields) : object{
			return $this->db->prepare("SELECT COUNT(*) AS countLike 
										FROM texte
										INNER JOIN aimer
										ON _idTexte = idTexte
										WHERE idTexte = ? AND likes = ?", 
									    $fields,
									    null,
									    true 
									);
		}

	}