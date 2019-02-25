<?php
class Comment {

	public function getNbrComments($postId) {
		$request = 'SELECT COUNT(*) AS nbr_comment FROM comment WHERE billet_id = ? ORDER BY id DESC';
		return Bdd::query($request, [$postId]);
	}

}