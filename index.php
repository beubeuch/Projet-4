<?php
require 'model/core/App.php';
App::init();

// Fonctionnement du site ---------------------------------------------------

if (isset($_POST['newComment'])) {
    newComment($_GET['postId'], $_POST['newComment'], $_POST['name']);
    header('location:index.php?p=chapitre&id='.$_GET['id']);
}

if (isset($_GET['report'])) {
    reportComment($_GET['commentId']);
    header('location:index.php?p=chapitre&id='.$_GET['postId']);
}

if (isset($_GET['suppPost'])) {
    suppPost($_GET['postId']);
    header('location:index.php?p=admin');
}

if (isset($_GET['suppComment'])) {
    suppComment($_GET['commentId']);
    header('location:index.php?p=admin');
}

if (isset($_GET['editContent'])) {
    if (isset($_POST['editPostContent'])) {
        editPost($_POST['editPostTitle'], $_POST['editPostContent'], $_POST['editPostId'], $_POST['editPostStatut']);
    }
    elseif (isset($_POST['editCommentContent'])) {
        editComment($_POST['editCommentContent'], $_POST['editCommentId']);
    }
    header('location:index.php?p=admin');
}

if (isset($_GET['validComment'])) {
    validComment($_GET['commentId']);
    header('location:index.php?p=admin');
}

if (isset($_GET['removeAlert'])) {
    Alert::unset();
}

// Affichage des pages ------------------------------------------------------

ob_start();
if(isset($_GET['p'])) {
    if(in_array($_GET['p'], App::$menus)) {
        if ($_GET['p'] == 'accueil') {
            homePage();
        }
        elseif ($_GET['p'] == 'chapitre') {
            postPage();
        }
        elseif ($_GET['p'] == 'admin') {
            if (isset($_GET['disconnect'])) {
                disconnectAdmin();
                header('location:index.php');
            }
            elseif (isset($_SESSION['admin']) && $_SESSION['admin']['statut'] == 1) {
                if (isset($_GET['e']) && $_GET['e'] == 'edit') {
                    editPage();
                }
                else {
                    adminPage();
                }
            }
            else {
                if (isset($_POST['adminLogin'])) {
                    adminConnexion($_POST['adminLogin'], $_POST['adminPass']);
                    header('location:index.php?p=admin');
                } else {
                    adminLoginPage();
                }
            }
        }
    }
    else {
        Alert::dangerAlert('La page demandé n\'existe pas');
        homePage();
    }
}
else {
    homePage();
}
$content = ob_get_clean();

// Titre du site ------------------------------------------------------------

if ($_GET['p'] == 'chapitre') {
    $titlePage = 'Chapitre';
}
elseif ($_GET['p'] == 'admin' && !isset($_GET['e'])) {
    $titlePage = 'Zone Administrateur';
}
elseif ($_GET['e'] == 'edit') {
    $titlePage = 'Edition de contenu';
} else {
    $titlePage = 'Billet simple pour l\'Alaska';
}


// Appel du template --------------------------------------------------------

require 'view/template.php';