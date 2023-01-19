<?php
	namespace App\Controller\Logged;
	

	use \Core\HTML\Form;
	use \Core\Processing\Processing;

	/**
	 * class DiscussionsController
	 */
	class DiscussionsController extends \App\Controller\dbAuthentificationController{
		
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
			$this->loadModel("texte");
			$this->loadModel("suivre");
			$this->loadModel("messages");
			$this->loadModel("utilisateur");
			$this->securisation = new Processing();
		}


		/**
		 * @method GroupMessage
		 * @return model
		 */

		public function GroupMessage() : void{

			$profile = true;
			$form = $this->form;
			$link = ["Logged.Users.Chose" => "Retour"];

			if (!empty($_POST)) {
				$messages = $this->securisation->checkTextarea($_POST['commentaire']);

				$create = $this->texte->create([
										'dateRedaction' =>  date("Y-m-d H:i:s"),
										'contenuTexte' => $messages,
										'_idType' => 3,
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
					?>
						<script type="text/javascript">
					        window.history.back();
						</script>
					<?php
				}
			}

			$texte = $this->texte->allTexte("\"discussions\"");
			$users = $this->utilisateur->allForGroup();
			$this->render("Logged.Discussions.GroupMessage", compact("profile", "link", "users", "form", "texte"));
		}

		/**
		 * @method PersonalMessage
		 * @return model
		 */

		public function PersonalMessage() : void{
			$message = "";
			$emetteur = "";
			$errors = false;
			$profile = true;
			$form = $this->form;
			$errors_message = "";
			$link = ["Logged.Users.Chose" => "Retour"];
			$users = $this->messages->messagerie(array("idSession" => $_SESSION["info"]['idUtilisateur']));
			// $nombreConversation = $this->suivre->countFriend(["idSession" => $_SESSION["info"]['idUtilisateur']])->countFriend;

			if (isset($_GET["idUtilisateur"]) && !empty($_GET['idUtilisateur']) && $_GET['idUtilisateur']  > 0 ) {
				$idUtilisateur = $this->secure($_GET['idUtilisateur']);

				$verified = $this->suivre->findWithSuivre(array("idfollowed" => $idUtilisateur, "idSession" => $_SESSION["info"]['idUtilisateur']));

				if (!isset($verified->idSuivre) || !is_null($verified->_idBloqueur)) {
					$this->header("?page=Logged.Discussions.PersonalMessage");
				}

				$emetteur = $this->utilisateur->findWithUsers($idUtilisateur);
				$message = $this->messages->messages(array("idSession" => $_SESSION["info"]['idUtilisateur'], 
															"idUtilisateur" => $idUtilisateur
														)
													);

			}

			if (!empty($_POST)) {
				$messages = $this->securisation->checkTextarea($_POST["message"]);

				$create = true;
				$create = $this->messages->create([
										'contenu' => $messages ,
										'emetteur' => $_SESSION["info"]['idUtilisateur'], 
										'destinateur' => $_GET['idUtilisateur'],
										'dateCreation' =>  date("Y-m-d H:i:s")
									]);	
				if ($create) {
					$this->header("?".$_SERVER['QUERY_STRING']);
				}else{
					$errors = true;
					$errors_message = "Hummmmmmmmmmmmm!";
				}
			}

			$this->render("Logged.Discussions.PersonalMessage", compact("profile", "link", "form","users", "message", "emetteur", "errors", "errors_message"));
		}

		/**
		 * @method delete
		 * @return model
		 */

		public function delete(){
			if (!empty($_POST)) {
				$delete = $this->messages->delete($_POST['message']);
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


		/**
		 * @method deleteTexte
		 * @return model
		 */
		
		public function deleteTexte(){
			if (!empty($_POST)) {
				$delete = $this->texte->delete($_POST['commentaires']);
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