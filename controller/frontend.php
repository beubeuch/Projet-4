<?php

function homePage() {
	$billet = new Billet();
	$chapterList = $billet->getLastChapters();
	require 'view/homeView.php';
}