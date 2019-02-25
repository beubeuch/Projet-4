<?php
require 'model/App.php';
App::init();

// Fonctionnement du site ---------------------------------------------------

if (isset($_POST['newComment'])) {
    $_SESSION['alert'] = newComment($_GET['id'], $_POST['newComment'], $_POST['name']);
    header('location:index.php?p=Billet&id='.$_GET['id']);
}

if (isset($_GET['report'])) {
    $_SESSION['alert'] = reportComment($_GET['commentId']);
    header('location:index.php?p=Billet&id='.$_GET['postId']);
}

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