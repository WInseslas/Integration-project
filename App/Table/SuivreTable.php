<?php
	namespace App\Table;

	use Core\Table\Table;
	
	/**
	 * Class SuivreTable
	 * 		
	 */
	class SuivreTable extends Table{

		/**
		 * @param string table 	: Nom de la table
		 */
		protected $table = "suivre";

		/**
		 * @method findWithSuivre
		 * @param fields
		 * @return object 
		 */

		public function findWithSuivre(Array $fields){
			return $this->query("SELECT * FROM {$this->table} 
								WHERE (suivie = :idfollowed AND suiveur = :idSession) 
								OR (suivie = :idSession AND suiveur = :idfollowed)",
								$fields, true
			);
		}

		/**
		 * @method findWithInvitation
		 * @param fields
		 * @return object 
		 */

		public function findWithInvitation(Array $fields){
			return $this->query("SELECT * 
								FROM {$this->table} 
								WHERE (suiveur = :idSession AND suivie = :idfollower)
								OR (suiveur = :idfollower AND suivie = :idSession)",
								$fields, true);
		}


		/**
		 * @method countFriend
		 * @param fields
		 * @return App\Entity\SuivreEntity  
		 */

		// public function countFriend(Array $fields) : object{
		// 	return $this->query("SELECT COUNT(*) AS countFriend
		// 						FROM {$this->table} 
		// 						WHERE (suiveur = :idSession OR suivie = :idSession)
		// 						AND statut = 2",
		// 						$fields, true);
		// }

	}