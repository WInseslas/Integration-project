<?php
	namespace App\Controller;
	use \Core\Authentification\dbAuthentification;
	use \Core\Processing\Processing;
	use \Core\HTML\Form;
	use \App\App;

	/**
	 * class UsersController
	 */
	class UsersController extends AppController{
		
		/**
		 * @method __construct
		 * @param securisation
		 */

		private $securisation;

		public function __construct(){
			$this->db = App::getInstance()->getDb();
			parent::__construct();
			$this->form = new Form();
			$this->loadModel("grade");
			$this->loadModel("utilisateur");
			$this->securisation = new Processing();
		}

		/**
		 * @method index
		 * @return model
		 */

		public function index(){
			$link = ["Users.index" => "Accueil", "Users.Login" => "Connexion", "Users.Register" => "S'inscrire"];
			$this->render("Users.index", compact("link"));
		}

		/**
		 * @method login
		 * @return model
		 */

		public function login(){
			$errors = false;
			$form = $this->form;
			$errors_message = "";

			if (!empty($_POST)) {
				$authentification = new dbAuthentification($this->db);
				$pseudo = $this->securisation->checkInput($_POST["pseudo"]);
				$user = $authentification->login($pseudo, $_POST['password']);

				if (!is_null($user)) {
					if ($user->actif) {
						
						if (isset($_POST['sesssion'])) {
							setcookie('pseudo', $user->pseudo, time()+3600*24*30, null, null, false, true);
							setcookie('password', $user->password, time()+3600*24*30, null, null, false, true);
						}

						foreach ($user as $key => $value) {
							$_SESSION["info"]["$key"] = $value;
						}
						$authentification->online(1, $user->idUtilisateur);
						$this->redirect();
					} else {
						$errors = true;
						$errors_message = "Votre compte n'est pas encore actif, veillez contacter l'entreprise ou vous rapprocher du Directeur des ressources humaines"; 
					}
				} else {
					$errors = true;
					$errors_message = "Le pseudo ou le mot de passe est incorrectes"; 
				}
			}

			$link = ["Users.Login" => "Connexion", "Users.Register" => "S'inscrire", "Users.index" => "Accueil"];
			$this->render("Users.Login", compact("form", "link", "errors", "errors_message"));
		}


		/**
		 * @method register
		 * @return model
		 */

		public function register(){

			$errors = false;
			$success = false;
			$errors_message = "";
			$success_message = "";
			$sexe = ['Homme', 'Femme'];


			
			if (!empty($_POST) && !empty($this->utilisateur->findPseudo($_POST['pseudo']))) {
				$errors = true;
				$errors_message = "Ce pseudo est déjà pris vous ne pouvez pas l’utiliser, veillez choisir un autre !";
			} elseif (!empty($_POST)) {
				
				if ($_POST['password'] === $_POST['passwordS']) {
					$nom = $this->securisation->checkInput($_POST["nom"]);
					$pseudo = $this->securisation->checkInput($_POST["pseudo"]);
					$prenom = $this->securisation->checkInput($_POST["prenom"]);
					$fin =date('Y');
					$debut = '1900-01-01';
					$dateNaissance = explode('-', $_POST['dateNaissance']);

					if (!preg_match("/^[a-zA-Z0-9_]*$/",$pseudo)) {
						$errors = true;
						$errors_message = "Le pseudo ne doit pas contenir d'espace ni de caractères spéciaux !";
					} elseif (!($_POST['dateNaissance'] < date('Y-m-d')) || !($_POST['dateNaissance'] > $debut) || (($fin - $dateNaissance[0]) < 14)) 
					{
						$errors = true;
						$errors_message = "Votre date de naissance n'est pas valide, Ou vous êtes trop jeune pour travailler. ";
					} else {
						$create = $this->utilisateur->create([
											'nom' => $nom, 
											'prenom' => $prenom,
											'dateNaissance' => $_POST['dateNaissance'],
											'sexe' => $_POST['sexe'],
											'pseudo' => $pseudo,
											'password' => sha1($_POST['password'])
										]);	
						if ($create) {
							$success = true;
							$success_message = "Votre compte a été creer avec success, Il sera bientot actif !";
						}else{
							$errors = true;
							$errors_message = "Une erreur s'est produite !";
						}
					}

				} else {
					$errors = true;
					$errors_message = "Les deux mot de passe ne sont identique !";
				}
			}

			$form = $this->form;
			$link = ["Users.Login" => "Connexion", "Users.index" => "Accueil"];

			$this->render("Users.Register", compact("form", "link", "errors", "sexe", "errors_message", "success", "success_message"));
		}

		
	}