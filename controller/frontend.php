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