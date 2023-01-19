<?php
	namespace App\Table;
	use \Core\Table\Table;
	
	/**
	 * Class CommentairesTable
	 * 		
	 */
	class CommentairesTable extends Table{

		/**
		 * @param string table 	: Nom de la table
		 */
		protected $table = "commentaires";

		/**
		 * @method comment
		 * @param fields
		 * @return Array 
		 */

		public function comment(int $idTexte) : array{
			return $this->query("SELECT {$this->table}.*, utilisateur.nom, utilisateur.prenom, utilisateur.photo
							FROM {$this->table} 
							LEFT JOIN texte
							ON {$this->table}._idTexte = texte.idTexte
							LEFT JOIN utilisateur
							ON utilisateur.idUtilisateur = {$this->table}._idUtilisateur
							WHERE (idTexte = ?)",
							[$idTexte], false
			);
		}


		/**
		 * @method deleteWithComment
		 * @param int comment
		 * @param int subjet
		 * @return Object 
		 */

		public function deleteWithComment(int $comment, int $subjet) : bool{
			return $this->query("DELETE FROM {$this->table}
					WHERE idCommentaires = ? AND _idTexte = ?", 
					array($comment, $subjet), true
				);		
		}

	}