<?php
	namespace App\Table;
	use \Core\Table\Table;
	
	/**
	 * Class AimerTable
	 * 		
	 */
	class AimerTable extends Table{

		/**
		 * @param string table 	: Nom de la table
		 */
		protected $table = "aimer";

		/**
		 * @method findWithLikes
		 * @param fields
		 * @return object 
		 */

		public function findWithLikes(Array $fields){
			return $this->query("SELECT * FROM {$this->table} 
								WHERE (_idTexte = :idTexte AND _idUtilisateur = :idSession)",
								$fields, true
			);
		}

	}