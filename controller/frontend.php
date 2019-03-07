<?php

function homePage() {
	$billet = new Billet();
	$chapterList = $billet->getAllChapters();
	require 'view/homeView.php';
}

function billetPage() {
	$billet = new Billet();
	if (isset($_GET['id'])) {
		$postId = $_GET['id'];
	} else {
		$postId = $billet->getLastBillet()->id;
	}

	$post = $billet->getBillet($postId);

	$comment = new Comment();
	$comments = $comment->getPostComments($postId);

	require 'view/billetView.php';
}

function adminPage() {
	$billet = new Billet();
	$billetList = $billet->getAllChapters(true);
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
		$billet = new Billet();
		$postId = $_GET['postId'];
		$post = $billet->getBillet($postId);
	}
	elseif (isset($_GET['commentId']) && $_GET['commentId'] > 0) {
		$comment = new Comment();
		$commentId = $_GET['commentId'];
		$com = $comment->getSingleComments($commentId);
	}
	else {
		$_SESSION['alert']['danger'] = 'Une erreur est survenue, merci de réessayer';
		header('location:index.php?p=Admin');
	}
	require 'view/editView.php';
}

function newComment($postId, $content, $name) {
	unset($_SESSION['alert']);
	$comment = new Comment();
	$comment->addComment($name, $content, $postId);
	$_SESSION['alert']['success'] = 'Commentaire ajouté avec succés';
}

function reportComment($commentId) {
	unset($_SESSION['alert']);
	$comment = new Comment();
	$moderate = $comment->getModeration($commentId);
	if ($moderate->moderation == 1) {
		$comment->reportComment($commentId);
		$_SESSION['alert']['success'] = 'Le commentaire à été signalé';
	}
	elseif ($moderate->moderation == 2) {
		$_SESSION['alert']['warning'] = 'Le commentaire à déjà été signalé';
	}
	elseif ($moderate->moderation == 3) {
		$_SESSION['alert']['danger'] = 'Le commentaire à déjà été modéré, merci de contacter un administrateur';
	} else {
		// throw new exception
	}
}

function suppPost($postId) {
	$post = new Billet();
	return $post->suppBillet($postId);
}

function suppComment($commentId) {
	$comment = new Comment();
	$comment->suppSingleComment($commentId);
	$_SESSION['alert']['success'] = 'Le commentaire à été supprimé avec succès';
}

function editPost($title, $content, $postId, $statut) {
	$post = new Billet();
	$result = $post->editBillet($title, $content, $postId, $statut);
	if ($result > 0) {
	 	$_SESSION['alert']['success'] = 'Le billet a été modifié avec succès';
	} else {
		$_SESSION['alert']['danger'] = 'Une erreur est survenue, merci de rééssayer';
	}
}

function editComment($content, $commentId) {
	$comment = new Comment();
	$result = $comment->editComment($content, $commentId);
	if ($result > 0) {
	 	$_SESSION['alert']['success'] = 'Le commentaire a été modifié avec succès';
	} else {
		$_SESSION['alert']['danger'] = 'Une erreur est survenue, merci de rééssayer';
	}
}

function validComment($commentId) {
	$comment = new Comment();
	$moderate = $comment->getModeration($commentId);
	if ($moderate->moderation == 1 || $moderate->moderation == 2) {
		$comment->reportComment($commentId);
		$_SESSION['alert']['success'] = 'Le commentaire à correctement été validé';
	}
	elseif ($moderate->moderation == 3) {
		$_SESSION['alert']['warning'] = 'Le commentaire est déjà modéré';
	} else {
		// throw new exception
	}

	return $comment->validComment($commentId);
}