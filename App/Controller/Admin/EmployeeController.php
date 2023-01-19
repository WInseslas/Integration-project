<?php
	namespace App\Controller\Admin;
	use \Core\HTML\Form;
	
	/**
	 * class EmployeeController
	 */
	class EmployeeController extends \App\Controller\dbAuthentificationController{
		
		/**
		 * @param object form 
		 * 
		 */
		private $form;

		/**
		 * @method __construct
		 */

		public function __construct(){
			parent::__construct();
			$this->loadModel("grade");
			$this->loadModel("messages");
			$this->loadModel("utilisateur");
			$this->form = new Form();
		}
		
		/**
		 * @method index
		 */

		public function index() : void{

			$_SESSION['session'] = "Directeur des ressources humaines";
			$this->verify();
			
			$element = 4;
			$profile = true;
			$link = ["Logged.Users.HumanResourcesDirector" => "Retour", "Admin.Big.index"=>"Administrer les different Grades"];

			$total = ceil((count($this->utilisateur->all())-1)/$element);

			if (isset($_GET["pages"]) && !empty($_GET['pages']) && $_GET['pages']  > 0 && $_GET['pages'] <= $total) {
				$pageCourate = $this->secure($_GET['pages']);
			} else {
				$pageCourate = 1;
			}

			$depart = ($pageCourate - 1)*$element;
			$users = $this->utilisateur->allUsers($depart, $element);

			$this->render("Admin.Employee.index", compact("profile", "users", "link", "total", "pageCourate"));
		}

		/**
		 * @method Edit
		 */

		public function Edit() : void{
			$_SESSION['session'] = "Directeur des ressources humaines";
			$this->verify();
			$user = "";

			if (isset($_GET["id"]) && !empty($_GET['id']) && $_GET['id']  > 0 ) {
				$idUtilisateur = $this->secure($_GET['id']);
				$user = $this->utilisateur->findWithUsers($idUtilisateur);
			} else {
				$this->render("Logged.Pages.404");
			}

			if (!$user) {
				$this->render("Logged.Pages.Blank");
			}

			$form = $this->form;
			$big = $this->grade->lists('idGrade', 'nomGrade');


			if (!empty($_POST)) {
				$update = $this->utilisateur->update($idUtilisateur, [
											'_idGrade' => $_POST['_idGrade']
										]);	
				if ($update) {
					?>
						<script type="text/javascript">
							window.alert("Mise à jour du grade effectuer avec success");
							location.href = "?page=Admin.Employee.index";
						</script>
					<?php
				}else{
					?>
						<script type="text/javascript">
							window.alert("Une erreur s'est produite");
							location.href = "?page=Admin.Employee.index";
						</script>
					<?php
				}
			}

			$link = ["Admin.Employee.index" => "Retour"];
			$this->render("Admin.Employee.Edit", compact("form", "user", "big", "link"));
		}



		/**
		 * @method EditState
		 */

		public function EditState() : void{
			$_SESSION['session'] = "Directeur des ressources humaines";
			$this->verify();

			$user = "";
			$profile = true;

			$link = ["Logged.Users.HumanResourcesDirector" => "Retour", "Admin.Big.index"=>"Administrer les different Grades"];

			if (isset($_GET["id"]) && !empty($_GET['id']) && $_GET['id']  > 0 ) {
				$idUtilisateur = $this->secure($_GET['id']);
				$user = $this->messages->messagerie(array("idSession" => $idUtilisateur));
				$users = $this->utilisateur->findWithUsers($idUtilisateur);
			} else {
				$this->render("Logged.Pages.404");
			}


			if (empty($users)) {
				$this->render("Logged.Pages.Blank");
			}
			
			if (!empty($user)) {
				?>
					<script type="text/javascript">
						window.alert("Vous ne pouvez pas désactiver cet utilisateur car utilisateur fait déjà partir du réseau social, vous ne pouvez que le supprimez.");
					</script>
				<?php
			}

			if (($_GET['etat'] == 1 || $_GET['etat'] == 0) && empty($user)) {
				$etat = $this->secure($_GET['etat']);

				if ($etat == 0) {
					$etat = 1;
				} elseif($etat == 1) {
					$etat = 0;
				}
				$update = $this->utilisateur->update($_GET['id'], [	'actif' => $etat]);
				if ($update && $etat == 1) {
					?>
						<script type="text/javascript">
							window.alert("Compte activer effectuer avec success");
							location.href = "?page=Admin.Employee.index";
						</script>
					<?php
				} elseif ($update && $etat == 0 ) {
					?>
						<script type="text/javascript">
							window.alert("Compte déactiver effectuer avec success");
							location.href = "?page=Admin.Employee.index";
						</script>
					<?php
				} else {
					?>
						<script type="text/javascript">
							window.alert("Une erreur s'est produite l'or de l'activation / déactivation.");
							location.href = "?page=Admin.Employee.index";
						</script>
					<?php
				}
			}

			$element = 4;
			$total = ceil((count($this->utilisateur->all())-1)/$element);

			if (isset($_GET["pages"]) && !empty($_GET['pages']) && $_GET['pages']  > 0 && $_GET['pages'] <= $total) {
				$pageCourate = $this->secure($_GET['pages']);
			} else {
				$pageCourate = 1;
			}

			$depart = ($pageCourate - 1)*$element;
			$users = $this->utilisateur->allUsers($depart, $element);
			$total = ceil((count($this->utilisateur->all())-1)/$element);

			$this->render("Admin.Employee.index", compact("profile", "users", "link", "total", "pageCourate"));
		}
		

		/**
		 * @method Delete
		 */

		public function Delete() : void{
			if (!empty($_POST)) {
				// $delete = $this->utilisateur->delete($_POST['id']);	
				if (1) {
					?>
						<script type="text/javascript">
							window.alert("Suppression effectuer avec success.");
							location.href = "?page=Admin.Employee.index";
						</script>
					<?php
				}else{
					?>
						<script type="text/javascript">
							window.alert("Une erreur s'est produite lors de la suppression.");
							location.href = "?page=Admin.Employee.index";
						</script>
					<?php
				}
			}
		}
	}