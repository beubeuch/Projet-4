<?php
require 'model/App.php';
define(ROOT, __DIR__.'/');
session_start();
require 'controller/frontend.php';
require ROOT.'model'. DIRECTORY_SEPARATOR .'Autoloader.php';
Autoloader::register();

// Affichage des pages ------------------------------------------------------

ob_start();
if(isset($_GET['p'])) {
    if(in_array($_GET['p'], App::$menus)) {
    	if ($_GET['p'] == 'Accueil') {
    		homePage();
    	}
    	elseif ($_GET['p'] == 'Billet') {
    		billetPage();
    	}
    	elseif ($_GET['p'] == 'Admin') {
            adminPage();
        }
    }
}
else {
    homePage();
}
$content = ob_get_clean();

require 'view/template.php';