<?php
class Comment {

	public function getNbrComments($postId) {
		$request = 'SELECT COUNT(*) AS nbr_comment FROM comment WHERE billet_id = ? ORDER BY id DESC';
		return Bdd::query($request, [$postId]);
	}

	public function getComments($postId) {
		$request = 'SELECT id, name, content, DATE_FORMAT(date, "%d/%m/%Y à %Hh") AS date FROM comment WHERE billet_id = ? ORDER BY id DESC';
		return Bdd::query($request, [$postId], true);
	}
}