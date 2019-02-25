<?php

function homePage() {
	$billet = new Billet();
	$chapterList = $billet->getLastChapters();
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
	$comments = $comment->getComments($postId);

	require 'view/billetView.php';
}

function newComment($postId, $content, $name) {
	$comment = new Comment();
	$comment->addComment($name, $content, $postId);
	return 'Commentaire ajouté avec succés';
}

function reportComment($commentId) {
	$comment = new Comment();
	$moderate = $comment->isNull($commentId);
	if ($moderate->moderation == null) {
		$comment->reportComment($commentId);
		return '0- Le commentaire à été signalé';
	}
	elseif ($moderate->moderation == 1) {
		return '1- Le commentaire à déjà été signalé';
	}
	else {
		return '2- Le commentaire à déjà été modéré, merci de contacter un administrateur';
	}
}