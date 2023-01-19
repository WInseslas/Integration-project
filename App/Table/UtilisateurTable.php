<?php
	namespace App\Table;
	use \App\App;
	use \Core\Table\Table;
	
	/**
	 * Class UtilisateurTable
	 * 		
	 */
	class UtilisateurTable extends Table{

		/**
		 * @param string table 	: Nom de la table
		 */
		protected $table = "utilisateur";


		/**
		 * @method findWithUsers
		 * @param int 
		 * @return Object 
		 *	
		 */

		public function findWithUsers($id = 0){
			return $this->query("SELECT * FROM {$this->table} 
				LEFT JOIN grade ON utilisateur._idGrade = grade.idGrade 
				WHERE utilisateur.idUtilisateur = ?", array($id), true);		
		}


		/**
		 * @method allUsers
		 * @param depart 
		 * @param fin 
		 * @return Object 
		 *	
		 */

		public function allUsers($depart, $fin) : Array{
			if (is_null($depart) || is_null($fin)) {
				return $this->query("SELECT * 
					FROM {$this->table} 
					WHERE idUtilisateur != {$_SESSION["info"]['idUtilisateur']} 
					AND actif = 1
					ORDER BY actif ASC");
			}
			return $this->query("SELECT * 
					FROM {$this->table} 
					WHERE idUtilisateur != {$_SESSION["info"]['idUtilisateur']} 
					ORDER BY actif ASC 
					LIMIT {$depart}, {$fin}");
		}

		/**
		 * @method allGradeForUtilisateur
		 * @param id
		 * @return Array 
		 *	
		 */

		public function allGradeForUtilisateur($id) : Array{
			return $this->query("SELECT * 
				FROM {$this->table}  
				INNER JOIN grade
				ON idGrade = _idGrade
				WHERE idGrade = {$id}
			");
		}

		/**
		 * @method findPseudo
		 * @param pseudo
		 * @return Array 
		 */

		public function findPseudo($pseudo) : Array{
			return $this->query("SELECT * FROM {$this->table} WHERE pseudo = ? ", array($pseudo));
		}

		/**
		 * @method allForGroup
		 * @param int 
		 * @return Array 
		 *	
		 */

		public function allForGroup() : Array{
			return $this->query("SELECT * FROM {$this->table}  
				WHERE actif = 1 
				AND enLigne = 1 
				AND idUtilisateur != {$_SESSION["info"]['idUtilisateur']}"
			);		
		}
	}