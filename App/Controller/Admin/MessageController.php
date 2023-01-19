<?php
	namespace App\Controller\Admin;

	use \Core\HTML\Form;
	use \Core\Processing\Processing;

	
	/**
	 * class MessageController
	 */
	class MessageController extends \App\Controller\dbAuthentificationController{
		
		/**
		 * @param object form 
		 * @param object securisation 
		 * 
		 */
		private $form;
		protected $securisation;


		/**
		 * @method __construct
		 */

		public function __construct(){
			parent::__construct();
			$this->loadModel("texte");
			$this->loadModel("utilisateur");
			$this->securisation = new Processing();
			$this->form = new Form();
		}

		/**
		 * @method index
		 * @return void
		 */

		public function index() : void{

			$_SESSION['session'] = "Chargé de la communication";
			$this->verify();
			
			$element = 6;
			$profile = true;
			$link = ["Logged.Users.HumanResourcesDirector" => "Retour", "Admin.Message.Communicates"=>"Les communiquer"];

			$total = ceil((count($this->texte->allTexte("\"Sujet du jour\"")))/$element);

			if (isset($_GET["pages"]) && !empty($_GET['pages']) && $_GET['pages']  > 0 && $_GET['pages'] <= $total) {
				$pageCourate = $this->secure($_GET['pages']);
			} else {
				$pageCourate = 1;
			}

			$depart = ($pageCourate - 1)*$element;
			$Subjet = $this->texte->allTexte("\"Sujet du jour\"", $depart, $element);

			$this->render("Admin.Message.index", compact("profile", "link", "Subjet", "pageCourate", "total"));
		}
		
		/**
		 * @method Communicate
		 * @return void
		 */

		public function Communicate() : void{
			$errors = false;
			$profile = true;
			$errors_message = "";
			$form = $this->form;

			$_SESSION['session'] = "Chargé de la communication";
			$this->verify();

			if (isset($_POST, $_POST['send'])) {
				$contenuTexte = $this->securisation->checkTextarea($_POST['message']);
				$create = $this->texte->create([
										'contenuTexte' => $contenuTexte, 
										'dateRedaction' => date("Y-m-d H:i:s"),
										'_idType' => 1,
										'_idUtilisateur' => $_SESSION["info"]['idUtilisateur']
									]);	
				if ($create) {
					?>
						<script type="text/javascript">
							if (confirm("Le Sujet du jour a été ajouter avec success !\nVoulez-vous ajouter un autre sujet ?")) {
					        	window.location.href="?page=Admin.Message.Communicate";
							} else {
					        	window.location.href="?page=Admin.Message.Communicates";
							}
						</script>
					<?php
				}else{
					$errors = true;
					$errors_message = "Une erreur s'est produite";
				}
			}

			$link = ["Admin.Message.Communicates" => "Retour"];
			$this->render("Admin.Message.Communicate", compact("profile", "link", "form", "errors", "errors_message"));
		}


		/**
		 * @method Subjet
		 * @return void
		 */

		public function Subjet(){
			$errors = false;
			$profile = true;
			$errors_message = "";
			$form = $this->form;

			$_SESSION['session'] = "Chargé de la communication";
			$this->verify();
			
			if (isset($_POST) && !empty($_POST['message'])) {
				$contenuTexte = $this->securisation->checkTextarea($_POST['message']);
				$create = $this->texte->create([
										'contenuTexte' => $contenuTexte, 
										'dateRedaction' => date("Y-m-d H:i:s"),
										'_idType' => 2,
										'_idUtilisateur' => $_SESSION["info"]['idUtilisateur']
									]);	
				if ($create) {
					?>
						<script type="text/javascript">
							if (confirm("Le Sujet du jour a été ajouter avec success !\nVoulez-vous ajouter un autre sujet ?")) {
					        	window.location.href="?page=Admin.Message.Subjet";
							} else {
					        	window.location.href="?page=Admin.Message.index";
							}
						</script>
					<?php
				}else{
					$errors = true;
					$errors_message = "Une erreur s'est produite";
				}
			}

			$link = ["Admin.Message.index"=> "Retour"];
			$this->render("Admin.Message.Subjet", compact("profile", "link", "form", "errors", "errors_message"));
		}



		/**
		 * @method Edit
		 * @return void
		 */

		public function Edit(){
			$_SESSION['session'] = "Chargé de la communication";
			$this->verify();
			$subjet = "";
			$form = $this->form;

			if (isset($_GET["id"]) && !empty($_GET['id']) && $_GET['id']  > 0) {
				$idTexte = $this->secure($_GET['id']);
				$subjet = $this->texte->findWithText('Sujet du jour', $idTexte);
			} else {
				$this->render("Logged.Pages.404");
			}

			if (empty($subjet)) {
				$this->render("Logged.Pages.Blank");
			}
			if (!empty($_POST)) {
				$contenuTexte = $this->securisation->checkTextarea($_POST['messages']);

				$update = $this->texte->update($subjet->idTexte, ['contenuTexte' => $contenuTexte]);	
				if ($update) {
					?>
						<script type="text/javascript">
							window.alert("Mise à jour effectuer avec success.");
							location.href = "?page=Admin.Message.index";
						</script>
					<?php
				}else{
					?>
						<script type="text/javascript">
							window.alert("Une erreur s'est produite lors de la mise à jour du sujet du jour.");
							location.href = "?page=Admin.Message.index";
						</script>
					<?php
				}
			}

			$link = ["Admin.Message.index" => "Retour"];
			$this->render("Admin.Message.Edit", compact("form", "link", "subjet"));
		}


		/**
		 * @method delete
		 * @return void
		 */

		public function delete(){
			if (!empty($_POST)) {
				$delete = $this->texte->delete($_POST['id']);
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
		 * @method Communicates
		 * @return void
		 */

		public function Communicates() : void{
			$_SESSION['session'] = "Chargé de la communication";
			$this->verify();

			$profile = true;
			$form = $this->form;


			$element = 6;
			$total = ceil((count($this->texte->allTexte("\"Communiquer\"")))/$element);

			if (isset($_GET["pages"]) && !empty($_GET['pages']) && $_GET['pages']  > 0 && $_GET['pages'] <= $total) {
				$pageCourate = $this->secure($_GET['pages']);
			} else {
				$pageCourate = 1;
			}

			$depart = ($pageCourate - 1)*$element;
			$Subjet = $this->texte->allTexte("\"Communiquer\"", $depart, $element);

			$link = ["Logged.Users.HumanResourcesDirector" => "Retour", "Admin.Message.index" => "Les sujets du jour"];
			$this->render("Admin.Message.Communicates", compact("profile", "link", "Subjet", "pageCourate", "total"));
		}


		/**
		 * @method Edi
		 * @return void
		 */

		public function Edi(){
			$_SESSION['session'] = "Chargé de la communication";
			$this->verify();
			$subjet = "";
			$form = $this->form;

			if (isset($_GET["id"]) && !empty($_GET['id']) && $_GET['id']  > 0) {
				$idTexte = $this->secure($_GET['id']);
				$subjet = $this->texte->findWithText('Communiquer', $idTexte);
			} else {
				$this->render("Logged.Pages.404");
			}

			if (empty($subjet)) {
				$this->render("Logged.Pages.Blank");
			}

			if (!empty($_POST)) {
				$contenuTexte = $this->securisation->checkTextarea($_POST['messages']);

				$update = $this->texte->update($subjet->idTexte, ['contenuTexte' => $contenuTexte]);	
				if ($update) {
					?>
						<script type="text/javascript">
							window.alert("Mise à jour effectuer avec success.");
							location.href = "?page=Admin.Message.Communicates";
						</script>
					<?php
				}else{
					?>
						<script type="text/javascript">
							window.alert("Une erreur s'est produite lors de la mise à jour du sujet du jour.");
							location.href = "?page=Admin.Message.Communicates";
						</script>
					<?php
				}
			}

			$link = ["Admin.Message.index" => "Retour"];
			$this->render("Admin.Message.Edit", compact("form", "link", "subjet"));
		}
	}