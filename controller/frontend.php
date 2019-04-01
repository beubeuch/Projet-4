<?php
use \model\Post;
use \model\Comment;
use \model\User;
use \model\Alert;
use \model\FormBuilder;
use model\TableAdmin;

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
	if ($chapitre->img != null && file_exists('public/images/'.$chapitre->img)) {
		$imgUrl = $chapitre->img;
	} else {
		$imgUrl = 'photo-1531884422565-1b4a26326a31.jpg';
	}

	if ($chapitre->statut != 2) {
		Alert::dangerAlert('Vous n\'avez pas l\'autorisation d\'afficher ce chapitre');
		header('location:index.php');
	}
	if ($chapitre == false) {
		Alert::dangerAlert('Désolé, ce chapitre n\'existe pas');
		header('location:index.php');
	}

	$comment = new Comment();
	$comments = $comment->getPostComments($postId);

	require 'view/postView.php';
}

function contactPage() {
	require 'view/contactView.php';
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

	$chapitreTable = new TableAdmin();
	$chapitreHead = ['N°', 'Date de publication', 'Date de modification', 'nbr Commentaire', 'Statut', 'Actions'];
	$chapitreTable->createHead($chapitreHead);
	$chapitreTable->createPostLines($postList);

	$head = ['N°', 'Contenu', 'Le', 'Par', 'Billet', 'Modéré', 'Actions'];

	$tableSignal = new TableAdmin();
	$tableSignal->createHead($head);
	$tableSignal->createCommentLines($commentList, 2);

	$tableModerate = new TableAdmin();
	$tableModerate->createHead($head);
	$tableModerate->createCommentLines($commentList, 3);

	$tableAll = new TableAdmin();
	$tableAll->createHead($head);
	$tableAll->createCommentLines($commentList);

	require 'view/adminView.php';
}

function editPage() {
	if (!isset($_GET['postId']) && !isset($_GET['commentId']) && isset($_SESSION['edit'])) {
		class SimulPost{}
		$post = new SimulPost();
		$postId = $_SESSION['edit']['postId'];
		$select = $_SESSION['edit']['select'];
		$post->title = $_SESSION['edit']['title'];
		$post->content = $_SESSION['edit']['content'];
		$post->img = $_SESSION['edit']['img'];
	}
	elseif (isset($_GET['postId']) && $_GET['postId'] >= 0) {
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