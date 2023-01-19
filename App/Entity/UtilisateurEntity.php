<?php
	namespace App\Entity;

	use Core\Entity\Entity;

	/**
	 * Class UtilisateurEntity
	 */
	
	class UtilisateurEntity extends Entity{

		/**
		 * @method getFollowers
		 * @return object
		 */
		
		private function getFollowers() : object {
			return $this->follow(array("idUtilisateur" => $this->idUtilisateur, "idSession" => $_SESSION["info"]['idUtilisateur']));
		}

		/**
		 * @method getStatut
		 * @return string
		 */

		public function getStatut(){
			return $this->getFollowers()->statut;
		}

		/**
		 * @method getBloqueur
		 * @return int
		 */

		public function getBloqueur(){
			return $this->getFollowers()->_idBloqueur;
		}

		/**
		 * @method getSuivie
		 * @return int
		 */

		public function getSuivie(){
			return $this->getFollowers()->suivie;
		}
	}