<?php
	namespace App\Controller\Logged;

	use \Core\Processing\Processing;

	
	/**
	 * class UsersController
	 * 
	 */
	class UsersController extends \App\Controller\dbAuthentificationController{
		
		/**
		 * @method __construct
		 * @param securisation
		 */

		private $securisation;


		public function __construct(){
			parent::__construct();
			$this->loadModel("grade");
			$this->loadModel("suivre");
			$this->loadModel("utilisateur");
			$this->securisation = new Processing();
		}

		/**
		 * @method CommunicationManager
		 * @return void
		 */

		public function CommunicationManager() : void {
			$profile = true;
			$_SESSION['session'] = "Chargé de la communication";

			$this->verify();

			$link = ["Logged.Users.CommunicationManager" => "Administration", "Users.index" => "Accueil"];
			$this->render("Logged.Users.CommunicationManager", compact("link", "profile"));
		}

		/**
		 * @method HumanResourcesDirector
		 * @return void
		 */

		public function HumanResourcesDirector() : void {
			$profile = true;
			$_SESSION['session'] = "Directeur des ressources humaines";
			
			$this->verify();

			$link = ["Logged.Users.HumanResourcesDirector" => "Administration"];
			$this->render("Logged.Users.HumanResourcesDirector", compact("link", "profile"));
		}

		/**
		 * @method Chose
		 * @return void
		 */

		public function Chose() : void {
			$profile = true;
			$errors = false;
			$errors_message = "";
			$users = $this->utilisateur->allUsers(null, null);
			$nombre = count($users);

			// var_dump($users);

			$link = ["Logged.Users.Chose" => "Messagerie"];

			if ($_SESSION["info"]['nomGrade'] === "Directeur des ressources humaines" || $_SESSION["info"]['nomGrade'] === "Chargé de la communication") {
				$link = ["Logged.Users.HumanResourcesDirector" => "Administration"];
			}

			if (isset($_GET["idFollower"], $_GET['action']) && !empty($_GET['idFollower']) && !empty($_GET['action']) && is_string($_GET['action']) && $_GET['idFollower']  > 0) {
				
				$idfollower = $this->secure($_GET['idFollower']);
				$follower = $this->suivre->findWithInvitation(array("idfollower" => $idfollower, "idSession" => $_SESSION["info"]['idUtilisateur']));

				if (!empty($follower) && ($follower->suivre = $_SESSION["info"]['idUtilisateur'] OR $follower->suiveur = $_SESSION["info"]['idUtilisateur'])) {
					if ($_GET['action'] === "ok") {
						$update = $this->suivre->update($follower->idSuivre, ['statut' => 2 ]);	
						$this->header("?page=Logged.Users.Chose");	
					} elseif ($_GET['action'] === "lock"){
						$update = $this->suivre->update($follower->idSuivre, ['_idBloqueur' => $_SESSION["info"]['idUtilisateur']]);	
						$this->header("?page=Logged.Users.Chose");	
					} elseif ($_GET['action'] === "dislock"){
						if ($follower->_idBloqueur === $_SESSION["info"]['idUtilisateur']) {
							$update = $this->suivre->update($follower->idSuivre, 
										['_idBloqueur' => NULL ]);
						}
						$this->header("?page=Logged.Users.Chose");	
					}
				} else {
					$this->notFound();
				}
			} elseif (isset($_GET["idFollowed"]) && !empty($_GET['idFollowed']) && $_GET['idFollowed']  > 0) {
				$idfollowed = $this->secure($_GET['idFollowed']);
				if ($idfollowed != $_SESSION["info"]['idUtilisateur']) {
					$follow = $this->suivre->findWithSuivre(array("idfollowed" => $idfollowed, "idSession" => $_SESSION["info"]['idUtilisateur']));
					if (empty($follow)) {
						$create = $this->suivre->create([
							'suiveur' => $_SESSION["info"]['idUtilisateur'],
							'suivie' => $idfollowed,
							'statut' => 1
						]);
						$this->header("?page=Logged.Users.Chose");	
					} else {
						$delete = $this->suivre->delete($follow->idSuivre );
						$this->header("?page=Logged.Users.Chose");	
					}
				}
			} else {
				$pageCourate = 1;
			}
			$element = 5;
			$total = ceil((count($this->grade->all())-3)/$element);
			if (isset($_GET["pages"]) && !empty($_GET['pages']) && $_GET['pages']  > 0 && $_GET['pages'] <= $total) {
				$pageCourate = $this->secure($_GET['pages']);
			} else {
				$pageCourate = 1;
			}

			$usersFind = $users;
			$depart = ($pageCourate - 1)*$element;
			$big = $this->grade->allFromGrade($depart, $element);

			if (isset($_GET["idGrade"]) && !empty($_GET['idGrade']) && $_GET['idGrade']  > 0 ) {
				$idGrade= $this->secure($_GET['idGrade']);
				$usersFind = $this->utilisateur->allGradeForUtilisateur($idGrade);
			}

			if (!empty($usersFind) && isset($usersFind)) {
				$users = $usersFind;
				$nombre = count($usersFind);
			} elseif (empty($usersFind)) {
				$errors = true;
				$errors_message = "Ce grade n'a pas d'employer";
				$nombre = 0;
			} 
		
			$this->render("Logged.Users.Chose", compact("profile", "link", "users", "nombre", "big", "total", "pageCourate", "errors","errors_message"));
		}

		/**
		 * @method updateProfil
		 * @return void
		 */

		public function updateProfil() : void {
			if (sha1($_POST['password']) === $_SESSION['info']['password']) {
				
				$nom = $this->securisation->checkInput($_POST["nom"]);
				$pseudo = $this->securisation->checkInput($_POST["pseudo"]);
				$prenom = $this->securisation->checkInput($_POST["prenom"]);

				$fin =date('Y');
				$debut = '1900-01-01';
				$dateNaissance = explode('-', $_POST['dateNaissance']);



				if (!preg_match("/^[a-zA-Z0-9_]*$/",$pseudo)) {
					?>
						<script type="text/javascript">
							window.alert("Le pseudo ne doit pas contenir d'espace ni de caractères spéciaux !");
							history.back()
						</script>
					<?php	
				}elseif (!($_POST['dateNaissance'] < date('Y-m-d')) || !($_POST['dateNaissance'] > $debut) || (($fin - $dateNaissance[0]) < 14)){
					?>
						<script type="text/javascript">
							window.alert("Votre date de naissance n'est pas valide, Ou vous êtes trop jeune pour travailler.");
							history.back()
						</script>
					<?php	
				} elseif ($pseudo != $_SESSION['info']['pseudo']) {

					if (empty($this->utilisateur->findPseudo($pseudo))) {
						$update = $this->utilisateur->update($_SESSION['info']['idUtilisateur'],
														array(
															 'nom' => $nom,
															 'prenom' => $prenom,
															 'pseudo' => $pseudo,
															 'dateNaissance' => $dateNaissance
														)
													);
						if ($update) {
							$user = $this->utilisateur->findWithUsers($_SESSION['info']['idUtilisateur']);
							foreach ($user as $key => $value) {
								$_SESSION["info"]["$key"] = $value;
							}
							?>
								<script type="text/javascript">
									window.alert("Mise à jour effectuer avec success !");
									history.back()
								</script>
							<?php	
						} else {
							?>
								<script type="text/javascript">
									window.alert("Une erreur s'est produite !");
									history.back()
								</script>
							<?php	
						}
					
					} else {
						?>
							<script type="text/javascript">
								window.alert("Ce pseudo est déjà pris vous ne pouvez pas l’utiliser, veillez choisir un autre !");
								history.back()
							</script>
						<?php
					}
				} else {
					$update = $this->utilisateur->update($_SESSION['info']['idUtilisateur'],
														array(
															 'nom' => $_POST['nom'],
															 'prenom' => $_POST['prenom'],
															 'dateNaissance' => $dateNaissance
														)
													);
					if ($update) {
						$user = $this->utilisateur->findWithUsers($_SESSION['info']['idUtilisateur']);
						foreach ($user as $key => $value) {
							$_SESSION["info"]["$key"] = $value;
						}
						?>
							<script type="text/javascript">
								window.alert("Mise à jour effectuer avec success !");
								history.back()
							</script>
						<?php	
					} else {
						?>
							<script type="text/javascript">
								window.alert("Une erreur s'est produite !");
								history.back()
							</script>
						<?php	
					}
				}
			} else {
				?>
					<script type="text/javascript">
						window.alert("Mot de passe incorrecte !");
						history.back()
					</script>
				<?php
			}
		}
		
		/**
		 * @method updatePassword
		 * @return void
		 */

		public function updatePassword() : void {
			if (!empty($_POST)) {
				if ($_SESSION['info']['password'] === sha1($_POST['cpassword'])) {
					if ($_POST['cpassword'] == $_POST['apassword']) {
						?>
							<script type="text/javascript">
								window.alert("Le nouveau mot de passe doit etre different de l'actuel !");
								history.back()
							</script>
						<?php
					} else {
						$update = $this->utilisateur->update($_SESSION['info']['idUtilisateur'],
														array('password' => sha1($_POST['apassword'])));
						if ($update) {
							$user = $this->utilisateur->findWithUsers($_SESSION['info']['idUtilisateur']);
							foreach ($user as $key => $value) {
								$_SESSION["info"]["$key"] = $value;
							}
							?>
								<script type="text/javascript">
									window.alert("Votre mot de passe a été modifier avec success !");
									history.back()
								</script>
							<?php
						} else {
							?>
								<script type="text/javascript">
									window.alert("Une erreur s'est produite !");
									history.back()
								</script>
							<?php	
						}
					}
				} else {
					?>
						<script type="text/javascript">
							window.alert("Le mot de passe actuel incorrect !");
							history.back()
						</script>
					<?php
				}
			} else {
				?>
					<script type="text/javascript">
						window.alert("veillez saisir  tout les champs !");
						history.back()
					</script>
				<?php
			}
		}


		/**
		 * @method updatePhoto
		 * @return void
		 */

		public function updatePhoto() : void {

			$fileInfo = PATHINFO($_FILES["image"]["name"]);

			if (empty($_FILES["image"]["name"])){
				?>
					<script>
						window.alert('La photo télécharger est vide!');
						window.history.back();
					</script>
				<?php
			} else {
				if ($fileInfo['extension'] == "jpg" || $fileInfo['extension'] == "png") {
					$newFilename = $fileInfo['filename'] . "_" . time() . "._." .$_SESSION['info']['idUtilisateur'] .".". $fileInfo['extension'];

					try {
						move_uploaded_file($_FILES["image"]["tmp_name"], "App/Views/upload/" . $newFilename);
					} catch (Exception $e) {
						die($e->getMessage());
					}
					
					$update = $this->utilisateur->update($_SESSION['info']['idUtilisateur'], 
															array(
																'photo' => $newFilename
															)
														);

					if ($update) {
						$user = $this->utilisateur->findWithUsers($_SESSION['info']['idUtilisateur']);
						foreach ($user as $key => $value) {
							$_SESSION["info"]["$key"] = $value;
						}
						?>
							<script type="text/javascript">
								window.alert('Photo téléchargée avec succès!');
								history.back()
							</script>
						<?php	
					} else {
						?>
							<script type="text/javascript">
								window.alert("Une erreur s'est produite !");
								history.back()
							</script>
						<?php	
					}
				}
				else{
					?>
						<script>
							window.alert('Photo non mise à jour. Veuillez télécharger uniquement des fichiers jpg ou png!');
							window.history.back();
						</script>
					<?php
				}
			}

		}
	}




