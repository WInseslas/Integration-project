<?php
	
	namespace App\Table;

	use \Core\Table\Table;

	/**
	 * Class TexteTable
	 */
	class TexteTable extends Table{
		
		/**
		 * @method allTexte 		:	recupere tout (*)
		 * @param fin 				:	int
		 * @param depart 			:	int
		 * @param nomType 			:	string
		 * @return Object 			:	retoune le resultat
		 */
		
		public function allTexte(string $nomType, int $depart = 0, int $fin = 0) : Array{
			if ($nomType === '"Sujet du jour"') {
				if ($fin === 0) {
					return $this->query("SELECT texte.*, type.*, nom, prenom
						FROM {$this->table} 
						INNER JOIN type
						ON _idType = idType
						INNER JOIN utilisateur
						ON idUtilisateur = _idUtilisateur 
						WHERE nomType = $nomType
						ORDER BY dateRedaction DESC"
					);
				}
				return $this->query("SELECT texte.*, type.*, nom, prenom
					FROM {$this->table} 
					INNER JOIN type
					ON _idType = idType
					INNER JOIN utilisateur
					ON idUtilisateur = _idUtilisateur 
					WHERE nomType = $nomType
					ORDER BY dateRedaction DESC
					LIMIT {$depart}, {$fin}"
				);
			} elseif ($nomType === '"Communiquer"') {
				if ($fin === 0) {
					return $this->query("SELECT texte.*, type.*, nom, prenom
						FROM {$this->table} 
						INNER JOIN type
						ON _idType = idType
						INNER JOIN utilisateur
						ON idUtilisateur = _idUtilisateur 
						WHERE nomType = $nomType
						ORDER BY dateRedaction DESC"
					);
				}
				return $this->query("SELECT texte.*, type.*, nom, prenom
					FROM {$this->table} 
					INNER JOIN type
					ON _idType = idType
					INNER JOIN utilisateur
					ON idUtilisateur = _idUtilisateur 
					WHERE nomType = $nomType
					ORDER BY dateRedaction DESC
					LIMIT {$depart}, {$fin}"
				);
			}

			return $this->query("SELECT * 
				FROM {$this->table} 
				INNER JOIN type
				ON _idType = idType
				INNER JOIN utilisateur
				ON utilisateur.idUtilisateur = _idUtilisateur
				WHERE nomType = {$nomType}"
			);
		}

		/**
		 * @method findWithText 		:	recupere tout (*)
		 * @param idTexte				:	int
		 * @param nomType 				:	string
		 * @return Object 				:	retoune le resultat
		 */
		
		public function findWithText(string $nomType, int $idTexte){
			
			return $this->query("SELECT * 
				FROM {$this->table} 
				INNER JOIN type
				ON _idType = idType
				WHERE nomType = ? AND idTexte = ?", 
				array($nomType, $idTexte), 
				true
			);
		}
	}