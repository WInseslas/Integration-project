<?php
	namespace App\Table;

	use \App\App;
	use Core\Table\Table;
	use \Core\Authentification\dbAuthentification;
	
	/**
	 * Class GradeTable
	 * 		
	 */
	class GradeTable extends Table{

		/**
		 * @param string table 	: Nom de la table
		 */
		protected $table = "grade";
		
		
		/**
		 * @method allFromGrade
		 * @param depart
		 * @param fin
		 * @return Array 
		 *	
		 */

		public function allFromGrade(int $depart, int $fin) : Array{
			$authentification = new dbAuthentification(App::getInstance()->getDb());
			return $this->query("SELECT * 
				FROM {$this->table} 
				WHERE idGrade != 1 AND idGrade != 2 AND nomGrade != 'NULL'
				LIMIT {$depart}, {$fin}");
		}


		/**
		 * @method findBig
		 * @param big
		 * @return Array 
		 */

		public function findBig($big) : Array{
			return $this->query("SELECT * FROM {$this->table} WHERE nomGrade = ? ", array($big));
		}
	}