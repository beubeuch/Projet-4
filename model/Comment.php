<?php
class Comment {

	public function getNbrComments($postId) {
		$request = 'SELECT COUNT(*) AS nbr_comment FROM comment WHERE billet_id = ? ORDER BY id DESC';
		return Bdd::query($request, [$postId]);
	}

	public function getAllComments() {
		$request = 'SELECT comment.id, comment.name, comment.content, billet.title, comment_moderate.moderation_name, comment.moderation, DATE_FORMAT(comment.date, "%d/%m/%Y à %Hh") AS date
					FROM comment
					LEFT JOIN billet
					ON comment.billet_id = billet.id
					LEFT JOIN comment_moderate
					ON comment.moderation = comment_moderate.id
					ORDER BY comment.id DESC';
		return Bdd::query($request, null, true);
	}

	public function getPostComments($postId) {
		$request = 'SELECT id, name, content, DATE_FORMAT(date, "%d/%m/%Y à %Hh") AS date FROM comment WHERE billet_id = ? ORDER BY id DESC';
		return Bdd::query($request, [$postId], true);
	}

	public function getSingleComments($commentId) {
		$request = 'SELECT content FROM comment WHERE id = ? ORDER BY id DESC';
		return Bdd::query($request, [$commentId]);
	}

	public function addComment($name, $content, $postId) {
		$request = 'INSERT INTO comment(billet_id, content, name, date) VALUES(?, ?, ?, NOW())';
		return Bdd::majBdd($request, [$postId, $content, $name]);
	}

	public function getModeration($commentId) {
		$request = 'SELECT moderation FROM comment WHERE id = ?';
		return Bdd::query($request, [$commentId]);
	}

	public function reportComment($commentId) {
		$request = 'UPDATE comment SET moderation = 2 WHERE id = ?';
		return Bdd::majBdd($request, [$commentId]);
	}

	public function editComment($content, $commentId) {
		$request = 'UPDATE comment SET content = ? WHERE id = ?';
		return Bdd::majBdd($request, [$content, $commentId]);
	}

	public function suppCommentFromPost($postId) {
		$request = 'DELETE FROM comment WHERE billet_id = ?';
		return Bdd::majBdd($request, [$postId]);
	}

	public function suppSingleComment($commentId) {
		$request = 'DELETE FROM comment WHERE id = ?';
		return Bdd::majBdd($request, [$commentId]);
	}

	public function validComment($commentId) {
		$request = 'UPDATE comment SET moderation = 3 WHERE id = ?';
		return Bdd::majBdd($request, [$commentId]);
	}

}