<?php
	namespace App\Controller\Logged;

	use \Core\HTML\Form;
	use \Core\Processing\Processing;


	/**
	 * class MessageController
	 */
	class MessageController extends \App\Controller\dbAuthentificationController{
		
		/**
		 * @method __construct
		 * @param form
		 * @param securisation
		 */


		private $form;
		private $securisation;

		public function __construct(){
			parent::__construct();
			$this->form = new Form();
			$this->loadModel("aimer");
			$this->loadModel("texte");
			$this->loadModel("commentaires");
			$this->securisation = new Processing();
			$this->loadModel("utilisateur");
		}


		/**
		 * @method Subjet
		 * @return void
		 */

		public function Subjet() : void {
			$profile = true;
			$link = ["Logged.Users.Chose" => "Retour"];

			$element = 3;
			$total = ceil((count($this->texte->allTexte("\"Sujet du jour\"")))/$element);

			if (isset($_GET["pages"]) && !empty($_GET['pages']) && $_GET['pages']  > 0 && $_GET['pages'] <= $total) {
				$pageCourate = $this->secure($_GET['pages']);
			} else {
				$pageCourate = 1;
			}

			$depart = ($pageCourate - 1)*$element;
			$Subjet = $this->texte->allTexte("\"Sujet du jour\"", $depart, $element);

			$this->render("Logged.Message.Subjet", compact("profile", "link", "Subjet", "pageCourate", "total"));
		}

		/**
		 * @method Communicate
		 * @return void
		 */

		public function Communicate() : void {
			$profile = true;
			$link = ["Logged.Users.Chose" => "Retour"];
			$Communicate = $this->texte->allTexte("\"Communiquer\"");
			$this->render("Logged.Message.Communicate", compact("profile", "link", "Communicate"));
		}
			

		/**
		 * @method Show
		 * @return void
		 */

		public function Show() : void {
			$profile = true;
			$link = ["Logged.Message.Communicate" => "Retour"];

			if (!(isset($_GET["idTexte"]) && !empty($_GET['idTexte']) && $_GET['idTexte']  > 0)) {
				$this->render("Logged.Pages.404");
			} else {
				$idTexte = $this->secure($_GET['idTexte']);
				$texte = $this->texte->find($idTexte);				
			}

			if (isset($_GET['action']) && ($_GET['action'] == 1 || $_GET['action'] == 2) ) {
				$like  = $this->secure($_GET['action']);
				$likes = $this->aimer->findWithLikes(array('idSession' => $_SESSION['info']['idUtilisateur'], 'idTexte' => $texte->idTexte));

				if (empty($likes)) {
					$create = $this->aimer->create(
									array(
										'_idUtilisateur' => $_SESSION["info"]['idUtilisateur'], 
										'_idTexte' => $idTexte,
										'likes' => $like
									));
				} elseif (!empty($likes)) {
					if ($likes->likes != $like && $likes->likes == 1) {
						$update = $this->aimer->update($likes->idAimer, array('likes' =>  2));
					} elseif($likes->likes != $like && $likes->likes == 2){
						$update = $this->aimer->update($likes->idAimer, array('likes' =>  1));
					} elseif ($likes->likes == $like) {
						$delete = $this->aimer->delete($likes->idAimer);
					}
				}				
				$this->header("{$texte->url}");		
			}	
			$this->render("Logged.Message.Show", compact("profile", "link", "texte"));
		}

		/**
		 * @method Discussions
		 * @return void
		 */

		public function Discussions() : void {
			$profile = true;
			$link = ["Logged.Message.Subjet&pages={$_GET['pages']}" => "Retour"];

			if (isset($_GET['idSubjet']) && !empty($_GET['idSubjet']) && $_GET['idSubjet']  > 0 ) {
				$idTexte = $this->secure($_GET['idSubjet']);
				$subjet = $this->texte->findWithText('Sujet du jour', $idTexte);
			} else {
				$this->render("Logged.Pages.404");
			}

			if (empty($subjet)) {
				$this->render("Logged.Pages.Blank");
			}

			$form = $this->form;

			if (!empty($_POST)) {
				$messages = $this->securisation->checkTextarea($_POST['commentaire']);

				$create = $this->commentaires->create([
										'dateRedact' =>  date("Y-m-d H:i:s"),
										'contenuCommentaires' => $messages,
										'_idTexte' => $subjet->idTexte,
										'_idUtilisateur' => $_SESSION["info"]['idUtilisateur']
									]);

				if (!$create) {
					?>
						<script type="text/javascript">
							alert("Une erreur s'est produite");
					        window.history.back();
						</script>
					<?php
				} else {
					$this->header("?".$_SERVER['QUERY_STRING']);
				}
			}

			$comment = $this->commentaires->comment($subjet->idTexte);
			$this->render("Logged.Message.Discussions", compact("profile", "link", "subjet", "form", "comment"));
		}


		/**
		 * @method delete
		 * @return void
		 */

		public function delete(){
			if (!empty($_POST)) {
				$delete = $this->commentaires->deleteWithComment($_POST['commentaires'], $_POST['texte']);
				if ($delete) {
					?>
						<script type="text/javascript">
							window.alert("Suppression effectuer avec success.");
							history.back();
						</script>
					<?php
				}else{
					?>
						<script type="text/javascript">
							window.alert("Une erreur s'est produite lors de la suppression.");
							history.back();
						</script>
					<?php
				}
			}
		}

	}