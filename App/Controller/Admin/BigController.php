<?php
	namespace App\Controller\Admin;

	use \Core\HTML\Form;
	
	/**
	 * class BigController
	 */
	class BigController extends \App\Controller\dbAuthentificationController{
		
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
			$this->loadModel("utilisateur");
			$this->form = new Form();
		}
		
		/**
		 * @method index
		 */

		public function index(){
			$_SESSION['session'] = "Directeur des ressources humaines";
			$this->verify();
			
			$element = 8;

			$profile = true;
			$total = ceil((count($this->grade->all())-3)/$element);
			$link = ["Admin.Employee.index" => "Retour"];

			if (isset($_GET["pages"]) && !empty($_GET['pages']) && $_GET['pages']  > 0 && $_GET['pages'] <= $total) {
				$pageCourate = $this->secure($_GET['pages']);
			} else {
				$pageCourate = 1;
			}

			$depart = ($pageCourate - 1)*$element;
			$big = $this->grade->allFromGrade($depart, $element);

			$this->render("Admin.Big.index", compact("profile", "link", "big", "total", "pageCourate"));
		}

		/**
		 * @method Edit
		 */

		public function Edit(){
			$_SESSION['session'] = "Directeur des ressources humaines";
			$this->verify();
			$big = '';

			$form = $this->form;

			if (isset($_GET["id"]) && !empty($_GET['id']) && $_GET['id']  > 0) {
				$idGrade = $this->secure($_GET['id']);
				$big = $this->grade->find($idGrade);
			} else {
				$this->render("Logged.Pages.404");
			}

			if (!$big) {
				$this->render("Logged.Pages.Blank");
			}

			if (!empty($_POST)) {
				if (!empty($this->grade->findBig($_POST['nomGrade']))) {
					?>
						<script type="text/javascript">
							window.alert("Ce grade existe déjà, veillez choisir un autre !");
							location.href = "?page=Admin.Big.index";
						</script>
					<?php
				} else {
					$update = $this->grade->update($idGrade, ['nomGrade' => $_POST['nomGrade']]);	
					if ($update) {
						?>
							<script type="text/javascript">
								window.alert("Mise à jour effectuer avec success.");
								location.href = "?page=Admin.Big.index";
							</script>
						<?php
					}else{
						?>
							<script type="text/javascript">
								window.alert("Une erreur s'est produite lors de la mise à jour du grade.");
								location.href = "?page=Admin.Big.index";
							</script>
						<?php
					}
				}
			}

			$link = ["Admin.Big.index" => "Retour"];
			$this->render("Admin.Big.Edit", compact("form", "big", "link"));
		}

		/**
		 * @method Add
		 */

		public function Add(){
			$_SESSION['session'] = "Directeur des ressources humaines";
			$this->verify();

			$form = $this->form;
			$errors = false;
			
			$errors_big = false;
			if (!empty($_POST)) {
				if (!empty($this->grade->findBig($_POST['nomGrade']))) {
					?>
						<script type="text/javascript">
							if (window.confirm("Ce grade existe déjà! \nSouhaitez-vous ressayer ?")) {
								location.href = "?page=Admin.Big.Add";
							} else {
								location.href = "?page=Admin.Big.index";
							}
						</script>
					<?php
				} else {
					$create = $this->grade->create(['nomGrade' => $_POST['nomGrade']]);	
					if ($create) {
						?>
							<script type="text/javascript">
								if (window.confirm("Grade ajouter avec success ! \nSouhaitez-vous ajouter un nouveau grade ?")) {
  									location.href = "?page=Admin.Big.Add";
								} else {
									location.href = "?page=Admin.Big.index";
								}
							</script>
						<?php
					}else{
						?>
							<script type="text/javascript">
								window.alert("Une erreur s'est produite lors de l'ajout du grade.");
								location.href = "?page=Admin.Big.Add";
							</script>
						<?php
					}
				}
			}

			$link = ["Admin.Big.index" => "Retour"];
			$this->render("Admin.Big.Add", compact("form", "errors", "errors_big", "link"));
		}

		/**
		 * @method Delete
		 */

		public function Delete(){
			if (!empty($_POST)) {
				// $delete = $this->grade->delete($_POST['id']);	
				if (1) {
					?>
						<script type="text/javascript">
							window.alert("Suppression effectuer avec success.");
							location.href = "?page=Admin.Big.index";
						</script>
					<?php
				}else{
					?>
						<script type="text/javascript">
							window.alert("Une erreur s'est produite lors de la suppression.");
							location.href = "?page=Admin.Big.index";
						</script>
					<?php
				}
			}
		}
	}