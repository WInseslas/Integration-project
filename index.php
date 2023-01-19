<?php
	use \App\Autoloader;
	use \App\App;
	define('ROOT', dirname(__FILE__));
	require_once ROOT."/App/App.php";
	
	App::load();
	$app = App::getInstance();

	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	}else{
		$page = 'Users.index';
	}

	$page = explode('.', $page);

	if ($page[0] == "Admin") {
		$controller = "\App\Controller\Admin\\" . ucfirst($page[1]) . "Controller";
		$action = $page[2];

	} elseif ($page[0] == "Logged") {
		$controller = "\App\Controller\Logged\\" . ucfirst($page[1]) . "Controller";
		$action = $page[2];

	} else {
		$action = $page[1];
		$controller = "\App\Controller\\" . ucfirst($page[0]) . "Controller";
	}
	
	$controller = new $controller();
	$controller->$action();