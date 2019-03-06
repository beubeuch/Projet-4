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

	require 'view/adminView.php';
}

function editPage() {
	$billet = new Billet();
	if (isset($_GET['id'])) {
		$postId = $_GET['id'];
		$post = $billet->getBillet($_GET['id']);
	} else {
		$postId = 0;
	}
	require 'view/editView.php';
}

function newComment($postId, $content, $name) {
	$comment = new Comment();
	$comment->addComment($name, $content, $postId);
	return 'Commentaire ajouté avec succés';
}

function reportComment($commentId) {
	$comment = new Comment();
	$moderate = $comment->moderationIsNull($commentId);
	if ($moderate->moderation == 1) {
		$comment->reportComment($commentId);
		return '0- Le commentaire à été signalé';
	}
	elseif ($moderate->moderation == 2) {
		return '1- Le commentaire à déjà été signalé';
	}
	else {
		return '2- Le commentaire à déjà été modéré, merci de contacter un administrateur';
	}
}

function suppPost($postId) {
	$post = new Billet();
	return $post->suppBillet($postId);
}

function editPost($title, $content, $postId, $statut) {
	$post = new Billet();
	return $post->editBillet($title, $content, $postId, $statut);
}

function validComment($commentId) {
	$comment = new Comment();
	return $comment->validComment($commentId);
}