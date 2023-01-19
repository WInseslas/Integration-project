<?php
	namespace App\Table;

	use \App\App;
	use \Core\Table\Table;
	use \Core\Authentification\dbAuthentification;
	
	/**
	 * Class GradeTable
	 * 		
	 */
	class MessagesTable extends Table{

		/**
		 * @param string table 	: Nom de la table
		 */
		protected $table = "messages";
		
		/**
		 * @method messages
		 * @param fields
		 * @return Array
		 */

		 public function messages(Array $fields, bool $one = false){
		 	return $this->db->prepare("SELECT *
										FROM {$this->table}
										WHERE
										    (
										        (emetteur, destinateur) =(:idSession, :idUtilisateur) 
										        OR (emetteur, destinateur) =(:idUtilisateur, :idSession)
										    )
										ORDER BY dateCreation ASC",
										$fields,
										null,
										$one
									);

		 }		
		
		/**
		 * @method messagerie
		 * @param fields
		 * @return Array
		 */
		public function messagerie(Array $fields, bool $one = false) : Array{
			return $this->db->prepare("SELECT
										    *
										FROM
										    (
										    SELECT
										        IF(
										            s.suiveur = :idSession,
										            s.suivie,
										            s.suiveur
										        ) idUtilisateur,
										        MAX(m.idMessages) maxId
										    FROM
										        suivre s
										    LEFT JOIN {$this->table} m ON
										        (
										            (m.emetteur, m.destinateur) =(s.suiveur, s.suivie) OR(m.emetteur, m.destinateur) =(s.suivie, s.suiveur)
										        )
										    WHERE
										        (s.suiveur = :idSession OR s.suivie = :idSession) AND s.statut = 2
										    GROUP BY
										        IF(
										            m.emetteur = :idSession,
										            m.destinateur,
										            m.emetteur
										        ),
										        s.idSuivre
										) AS DM
										LEFT JOIN {$this->table} m ON
										    m.idMessages = DM.maxId
										LEFT JOIN utilisateur u ON
										    u.idUtilisateur = DM.idUtilisateur
										ORDER BY u.enLigne DESC", 
									    $fields,
									    null,
									    $one 
									);
		}		
		
	}