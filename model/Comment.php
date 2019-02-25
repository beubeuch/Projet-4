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

	public function addComment($name, $content, $postId) {
		$request = 'INSERT INTO comment(billet_id, content, name, date) VALUES(?, ?, ?, NOW())';
		return Bdd::majBdd($request, [$postId, $content, $name]);
	}

	public function isNull($commentId) {
		$request = 'SELECT moderation FROM comment WHERE id = ?';
		return Bdd::query($request, [$commentId]);
	}

	public function reportComment($commentId) {
		$request = 'UPDATE comment SET moderation = 1 WHERE id = ?';
		return Bdd::majBdd($request, [$commentId]);
	}

}