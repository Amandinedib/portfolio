<?php
// //Permet de démarrer une session
session_start();



//On inclut le fichier config qui regroupe les constantes dont on a besoin
include('config.php');

//Mise en place de l'autoload
spl_autoload_register(function($className){
	$folder = CLASSES_PATH;
	$extension = CLASSES_EXTENSION;
	// On cherche 'controller' dans le nom de la classe, si on le trouve alors on dnne le nom du dossier et de l'extension du fichier
	if(strpos($className, 'Controller') !== false){
		$folder = CONTROLLERS_PATH;
		$extension = CONTROLLERS_EXTENSION;
	}
		// On cherche 'model' dans le nom de la classe, si on le trouve alors on dnne le nom du dossier et de l'extension du fichier
	else if(strpos($className, 'Model') !== false){
		$folder = MODELS_PATH;
		$extension = MODELS_EXTENSION;
	}
		// On cherche 'handler' dans le nom de la classe, si on le trouve alors on dnne le nom du dossier et de l'extension du fichier
	else if(strpos($className, 'Handler') !== false){
		$folder = HANDLER_PATH;
		$extension = HANDLER_EXTENSION;
	}
	//Enfin pour atteindre le fichier, le chemin se compose du dossier, du nom de la classe et de son extension
	$filename = $folder . DS . $className . $extension;
	// S'il existe bien on l'inclut
	if(file_exists($filename)){
		include($filename);
	}
});

//Si le get est vide, l'accueil est appelée par défaut grâce au controller et l'action
$params = array('controller'=>'accueil','action'=>'afficherAccueil');

//Si le get n'est pas vide, on écrase les valeurs par défaut
$params = array_merge($params,$_GET);

//On définit le nom du controller à appeler
$controllerName = strtolower($params['controller']).'Controller';

//On définit le nom de l'action à appeler
$actionName = $params['action']. 'Action';

//On instancie le bon controller
if((!empty($_GET) && isset($_GET['controller'])) ||empty($_GET)){
	if(class_exists($controllerName)){
		$controller = new $controllerName;
		//On entre nos paramètres(GET) et nos données(POST)
		$controller->setParameters($_GET);
		$controller->setData($_POST);

		//Vérification de l'existence de la méthode nécessaire
		if(method_exists($controller, $actionName)){
			$controller->$actionName();
		}
		//Si la méthode n'existe pas, le controller d'erreur affichera un message
		else{
			echo "Erreur méthode 1";
		}
	}
	//Si la méthode n'existe pas, le controller d'erreur affichera un message
	else{
		echo "Erreur méthode 2";
	}
}
//Si le controller n'existe pas, le controller d'erreur affichera un message
else{
	echo "Erreur controller inexistant";
}