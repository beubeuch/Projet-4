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

if (isset($_GET['suppPost'])) {
    suppPost($_GET['postId']);
    header('location:index.php?p=Admin');
}

if (isset($_POST['editPostContent'])) {
    $_SESSION['alert'] = editPost($_POST['editPostTitle'], $_POST['editPostContent'], $_POST['editPostId'], $_POST['editPostStatut']);
    header('location:index.php?p=Admin');
}

if (isset($_GET['validComment'])) {
    $_SESSION['alert'] = validComment($_GET['id']);
    header('location:index.php?p=Admin');
}

// Affichage des pages ------------------------------------------------------

ob_start();
if(isset($_GET['p'])) {
    if(in_array($_GET['p'], App::$menus)) {
        if ($_GET['p'] == 'Accueil') {
            homePage();
            // App::getHome();
        }
        elseif ($_GET['p'] == 'Billet') {
            billetPage();
        }
        elseif ($_GET['p'] == 'Admin') {
            // if (!isset($_SESSION['admin'])) {
            //  header('location:index.php');
            // }
            if ($_GET['e'] == 'edit') {
                editPage();
            }
            else {
                adminPage();
            }
        }
    }
}
else {
    homePage();
}
$content = ob_get_clean();

require 'view/template.php';