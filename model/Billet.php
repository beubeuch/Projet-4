<?php
class Billet {
	
	public function getList($admin = false) {
		if ($admin == true) {
			$request = 'SELECT * FROM billet ORDER BY id DESC';
		} else {
			$request = 'SELECT * FROM billet WHERE statut = 2 ORDER BY id DESC';
		}

		return Bdd::query($request, null, true);
	}

	public function getAllChapters($admin = false) {
		if ($admin == true) {
			$request = '
				SELECT billet.title, billet.id, DATE_FORMAT(billet.date, "%d/%m/%Y à %Hh%i") AS date, DATE_FORMAT(billet.date_modif, "%d/%m/%Y à %Hh%i") AS date_modif, billet_statut.name
				FROM billet 
				LEFT JOIN billet_statut 
				ON billet.statut = billet_statut.id
				ORDER BY billet.id DESC';
		} else {
			$request = 'SELECT title, id FROM billet WHERE statut = 2 ORDER BY id DESC';
		}
		return Bdd::query($request, null, true);
	}

	public function getExcerpt($string) {
		return substr($string, 0, 400).'...';
	}

	public function getInfoBar($id) {
		$comment = new Comment();
		$nbrComment = $comment->getNbrComments($id);
		return 	'<div class="row">
					<p class="col-md-6"><a href="index.php?p=billet&id='. $id .'">Lire la suite</a></p>
					<p class="col-md-6 text-right comments">'. $nbrComment->nbr_comment .' commentaires</p>
				</div>';
	}

	public function getLastBillet() {
		$request = 'SELECT * FROM billet WHERE statut = 2 ORDER BY id DESC';
		return Bdd::query($request);
	}

	public function getBillet($id) {
		$request = 'SELECT * FROM billet WHERE id = ?';
		return Bdd::query($request, [$id]);
	}

	public function suppBillet($postId) {
		$comment = new Comment();
		$comment->suppCommentFromPost($postId);
		$request = 'DELETE FROM billet WHERE id = ?';
		return Bdd::majBdd($request, [$postId]);
	}

	public function editBillet($title, $content, $postId, $statut) {
		if ($postId == 0) {
			$request = 'INSERT INTO billet(title, content, date) VALUES(?, ?, NOW())';
			return Bdd::majBdd($request, [$title, $content]);
		} else {
			$request = 'UPDATE billet SET title = ?, content = ?, date_modif = NOW(), statut = ? WHERE id = ?';
			return Bdd::majBdd($request, [$title, $content, $statut, $postId]);
		}
	}

	public function getStatutList() {
		$request = 'SELECT * FROM billet_statut';
		return Bdd::query($request, null, true);
	}

}