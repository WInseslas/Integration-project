<?php
	namespace App\Entity;

	use Core\Entity\Entity;

	/**
	 * Class TexteEntity
	 */
	
	class TexteEntity extends Entity{
		
		/**
		 * @method getLikes
		 * @return int
		 */
		
		public function getLikes() : int {
			return $this->coutLikes(array($this->idTexte, 1))->countLike;
		}

		/**
		 * @method getDislikes
		 * @return int
		 */
		
		public function getDislikes() : int {
			return $this->coutLikes(array($this->idTexte, 2))->countLike;
		}

		/**
		 * @method getUrl 	:	retourne la propriete url avec un formatage
		 * @return string
		 */
		
		public function getUrl(){
			return "?page=Logged.Message.Show&idTexte=". $this->idTexte;
		}

		/**
		 * @method getExtrait 	:	effectue un formatage du contenu
		 * @return string
		 */

		public function getExtrait(){
			$content = substr($this->contenuTexte, 0, 80) . "... <br/><br/><a href=\"$this->url\" class=\"btn btn-primary\"> Lire la suite »</a>";
			return $content;

		}

		/**
		 * @method getExtrait 	:	effectue un formatage du contenu
		 * @return string
		 */

		public function getExt(){
			$content = substr($this->contenuTexte, 0, 90) . "...";
			return $content;

		}

		
	}