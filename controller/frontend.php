<?php

function homePage() {
	$titlePage = 'Billet simple pour l\'Alaska';
	$post = new Post();
	$contentList = $post->getList();
	$chapterList = $post->getAllPost();
	require 'view/homeView.php';
}

function postPage() {
	$post = new Post();
	if (isset($_GET['postId'])) {
		$postId = $_GET['postId'];
	} else {
		$postId = $post->getLastPost()->id;
	}

	$chapitre = $post->getPost($postId);

	if ($chapitre->statut != 2) {
		Alert::dangerAlert('Vous n\'avez pas l\'autorisation d\'afficher ce chapitre');
		header('location:index.php');
	}

	$comment = new Comment();
	$comments = $comment->getPostComments($postId);

	require 'view/postView.php';
}

function adminLoginPage() {
	echo '<h2>Connexion à la zone administration</h2>';
	echo FormBuilder::connexionForm();
}

function adminPage() {
	$post = new Post();
	$postList = $post->getAllPost(true);
	$comment = new Comment();
	$commentList = $comment->getAllComments();

	if (isset($_GET['e']) && $_GET['e'] == 'supp') {
		if (isset($_GET['postId'])) {
			$alertMessage = 'Etes-vous sur de vouloir supprimer le <strong class="text-strong">'.$_GET['postTitle'].'</strong> et tous les commentaires qui lui sont associés ?';
			$alertAction = 'suppPost&postId='.$_GET['postId'];
		}
		if (isset($_GET['commentId'])) {
			$alertMessage = 'Etes-vous sur de vouloir supprimer le <strong class="text-strong">commentaire '.$_GET['commentId'].'</strong> ?';
			$alertAction = 'suppComment&commentId='.$_GET['commentId'];
		}
		echo Alert::adminSuppAlert($alertMessage, $alertAction);
	}

	require 'view/adminView.php';
}

function editPage() {
	if (isset($_GET['postId'])) {
		$billet = new Post();
		$postId = $_GET['postId'];
		$post = $billet->getPost($postId);
		if ($postId > 0) {
			$select = $post->statut;
		}
		else {
			$select = null;
		}
	}
	elseif (isset($_GET['commentId']) && $_GET['commentId'] > 0) {
		$comment = new Comment();
		$commentId = $_GET['commentId'];
		$com = $comment->getSingleComments($commentId);
	}
	else {
		Alert::failAlert();
		header('location:index.php?p=admin');
	}
	require 'view/editView.php';
}

function adminConnexion($login, $pass) {
	$user = new User();
	$admin = $user->getUser($login);
	var_dump($admin);
	if (!$admin) {
		Alert::dangerAlert('Idantifiant ou mot de passe incorrect');
	} else {
		if ($user->verifyPassword($pass, $admin->pass, $admin->statut)) {
			Alert::successAlert('Vous vous êtes connecté avec succès');
		} else {
			Alert::dangerAlert('Idantifiant ou mot de passe incorrect');
		}
	}
}

function disconnectAdmin() {
	unset($_SESSION['admin']);
	Alert::successAlert('Vous êtes déconnecté de la zone administrateur');
}

function newComment($postId, $content, $name) {
	unset($_SESSION['alert']);
	$comment = new Comment();
	$result = $comment->addComment($name, $content, $postId);
	if ($result > 0) {
		Alert::successAlert('Commentaire ajouté avec succès');
	}
	else {
		Alert::failAlert();
		header('location:index.php?p=admin');
	}
}

function reportComment($commentId) {
	unset($_SESSION['alert']);
	$comment = new Comment();
	$moderate = $comment->getModeration($commentId);
	if ($moderate->moderation == 1) {
		$comment->reportComment($commentId);
		Alert::successAlert('Le commentaire à été signalé');
	}
	elseif ($moderate->moderation == 2) {
		Alert::warningAlert('Le commentaire à déjà été signalé');
	}
	elseif ($moderate->moderation == 3) {
		Alert::dangerAlert('Le commentaire à déjà été modéré, merci de contacter un administrateur');
	}
	else {
		Alert::failAlert();
		header('location:index.php');
	}
}

function suppPost($postId) {
	$post = new Post();
	$result = $post->suppPost($postId);
	if ($result > 0) {
		Alert::successAlert('Le Chapitre a été supprimé avec succès');
	}
	else {
		Alert::failAlert();
		header('location:index.php?p=admin');
	}
}

function suppComment($commentId) {
	$comment = new Comment();
	$result = $comment->suppSingleComment($commentId);
	if ($result > 0) {
		Alert::successAlert('Le commentaire à été supprimé avec succès');
	}
	else {
		Alert::failAlert();
		header('location:index.php?p=admin');
	}
}

function editPost($title, $content, $postId, $statut) {
	$post = new Post();
	$result = $post->editPost($title, $content, $postId, $statut);
	if ($result > 0) {
	 	Alert::successAlert('Le chapitre a été modifié avec succès');
	}
	else {
		Alert::failAlert();
		header('location:index.php?p=admin');
	}
}

function editComment($content, $commentId) {
	$comment = new Comment();
	$result = $comment->editComment($content, $commentId);
	if ($result > 0) {
	 	Alert::successAlert('Le commentaire a été modifié avec succès');
	}
	else {
		Alert::failAlert();
		header('location:index.php?p=admin');
	}
}

function validComment($commentId) {
	$comment = new Comment();
	$moderate = $comment->getModeration($commentId);
	if ($moderate->moderation == 1 || $moderate->moderation == 2) {
		$comment->reportComment($commentId);
		Alert::successAlert('Le commentaire à correctement été validé');
	}
	elseif ($moderate->moderation == 3) {
		Alert::warningAlert('Le commentaire est déjà modéré');
	}
	else {
		Alert::failAlert();
		header('location:index.php?p=admin');
	}

	return $comment->validComment($commentId);
}