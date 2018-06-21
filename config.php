<?php

define('DS', DIRECTORY_SEPARATOR);

//Constantes pour le fonctionnement de l'autoloader afin d'atteindre les classes, controllers, modèles et handlers
define('CLASSES_PATH', 'Classes');
define('CLASSES_EXTENSION', '.class.php');
define('CONTROLLERS_PATH','Controllers');
define('CONTROLLERS_EXTENSION', '.php');
define('MODELS_PATH', 'Models');
define('MODELS_EXTENSION', '.php');
define('HANDLER_PATH', 'Handlers');
define('HANDLER_EXTENSION', '.php');

// Constantes pour la connexion à la base de données
define('DB_HOST', 'localhost');
define('DB_NAME', 'portfolio');
define('DB_USER', 'root');
define('DB_PASS', '');

//Constantes pour atteindre les Views
define('VIEWS', '.' . DS . 'Views' . DS);

//Constantes pour atteindre les Layout
define('LAYOUT', '.' . DS . 'Layout' . DS);

// Constantes pour atteindre les layout
define('COMMON','.' . DS . 'Layout' . DS . 'commonLayout.php');
define('AJAX_LAYOUT', '.' . DS . 'Layout' . DS . 'ajaxLayout.php');
define('HEADER', '.' . DS . 'Layout' . DS . 'headerLayout.php');
define('FOOTER', '.' . DS . 'Layout' . DS . 'footerLayout.php');
define('ERREUR', '.' . DS . 'Layout' . DS . 'erreurLayout.php');

//Constante accès menu
define('MENU', '.' . DS . 'Views' . DS . 'Modules' . DS . 'menu.php');

//Constantes pour atteindre le css
define('CSS_PATH', '.' . DS . 'assets' . DS . 'css' . DS);
define('CSS_EXTENSION', 'Style.css');

// Constantes permettant à l'image d'être dirigée vers le bon fichier pendant l'upload
define('PHOTO_PATH', '.' . DS . 'assets' . DS . 'images' . DS);


//Constante des tailles des string
define('TITLE_MIN',1);
define('TITLE_MAX',300);

define('MAIN_MIN',1);
define('MAIN_MAX',400);

define('DESCRIPTION_MIN',1);
define('DESCRIPTION_MAX',800);

define('NAME_MIN', 2);
define('NAME_MAX',50);
