<head>
	<title>
		<?php
			$name = "Indice";
			if (isset($_GET['page'])) {
			 	$names = explode(".", $_GET['page']); 
			 	$name = ucfirst(end($names));
			}

			$grade = array('HumanResourcesDirector' => "Directeur des ressources humaines", 
							'CommunicationManager' => "Chargé de la communication",
							'PersonalMessage' => "Messagerie privée",
							'GroupMessage' => "Messagerie de groupe",
							'Communicate' => "Communiquer",
							'Subjet' => "Sujet du jour",
							'Edit' => "Mettre a jour",
							'Login' => "Connexion",
							'Chose' => "Bienvenu",
							'Indice' => "Accueil",
							'Index' => "Accueil",
							'index' => "Liste",
							'Add' => "Ajout"
						);

			foreach ($grade as $key => $value) {
				if ($key == $name) {
					$name = $value;
				}
			}
			echo ucfirst($name);
		?>
	</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Reseau social d’entreprise">
    <meta name="author" content="P.I.R.S.E.">

    <link rel="shortcut icon" type="text/css" href="App/Views/img/icon.png">
   	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>


   	<link rel="stylesheet" type="text/css" href="App/Views/Style/index.css">
   	<link rel="stylesheet" type="text/css" href="App/Views/Style/page.css">
   	
   	<link href="App/Views/Style/theme.css" rel="stylesheet">
    <link href="App/Views/Style/starter-template.css" rel="stylesheet">
    <link href="App/Views/Style/sticky-footer-navbar.css" rel="stylesheet">

   	<link href="https://cdn.usebootstrap.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    
    <script src="App/Views/Js/index.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
</head>