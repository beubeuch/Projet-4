<?php
class Billet {
	
	public function getList() {
		$request = 'SELECT * FROM billet ORDER BY id DESC';
		return Bdd::query($request, null, true);
	}

	public function getLastChapters() {
		$request = 'SELECT title, id, DATE_FORMAT(date, "%d/%m/%Y à %Hh") AS date FROM billet ORDER BY id DESC';
		return Bdd::query($request, null, true);
	}

	public function getExcerpt($string) {
		return substr($string, 0, 400).'...';
	}

	public function getInfoBar($id) {
		$comment = new Comment();
		$nbrComment = $comment->getNbrComments($id);
		return 	'<div class="row">
					<p class="col-md-6"><a href="index.php?p=Billet&id='. $id .'">Lire la suite</a></p>
					<p class="col-md-6 text-right comments">'. $nbrComment->nbr_comment .' commentaires</p>
				</div>';
	}

	public function getLastBillet() {
		$request = 'SELECT * FROM billet ORDER BY id DESC';
		return Bdd::query($request);
	}

	public function getBillet($id) {
		$request = 'SELECT * FROM billet WHERE id = ?';
		return Bdd::query($request, [$id]);
	}

	public function suppBillet($postId) {
		$comment = new Comment();
		$comment->suppComment($postId);
		$request = 'DELETE FROM billet WHERE id = ?';
		return Bdd::majBdd($request, [$postId]);
	}

	public function editBillet($title, $content, $postId) {
		if ($postId == 0) {
			$request = 'INSERT INTO billet(title, content, date) VALUES(?, ?, NOW())';
			return Bdd::majBdd($request, [$title, $content]);
		} else {
			$request = 'UPDATE billet SET title = ?, content = ? WHERE id = ?';
			return Bdd::majBdd($request, [$title, $content, $postId]);
		}
	}

}