<?php
namespace model;

use model\core\Bdd;
use model\Comment;

class Post {
	
	public function getList($admin = false) {
		if ($admin == true) {
			$request = 'SELECT * FROM post ORDER BY id DESC';
		} else {
			$request = 'SELECT * FROM post WHERE statut = 2 ORDER BY id DESC';
		}

		return Bdd::query($request, null, true);
	}

	public function getAllPost($admin = false) {
		if ($admin == true) {
			$request = '
				SELECT post.title, post.id, DATE_FORMAT(post.date, "%d/%m/%Y à %Hh%i") AS date, DATE_FORMAT(post.date_modif, "%d/%m/%Y à %Hh%i") AS date_modif, post_statut.name
				FROM post 
				LEFT JOIN post_statut 
				ON post.statut = post_statut.id
				ORDER BY post.id DESC';
		} else {
			$request = 'SELECT title, id FROM post WHERE statut = 2 ORDER BY id DESC';
		}
		return Bdd::query($request, null, true);
	}

	public function getExcerpt($string) {
		return substr($string, 0, 500).'...';
	}

	public function getInfoBar($postId) {
		$comment = new Comment();
		$nbrComment = $comment->getNbrComments($postId);
		return 	'<div class="row">
					<p class="col-md-6"><a href="index.php?p=chapitre&postId='. $postId .'">Lire la suite</a></p>
					<p class="col-md-6 text-right comments">'. $nbrComment->nbr_comment .' commentaires</p>
				</div>';
	}

	public function getLastPost() {
		$request = 'SELECT * FROM post WHERE statut = 2 ORDER BY id DESC';
		return Bdd::query($request);
	}

	public function getPost($id) {
		$request = 'SELECT * FROM post WHERE id = ?';
		return Bdd::query($request, [$id]);
	}

	public function suppPost($postId) {
		$comment = new Comment();
		$comment->suppCommentFromPost($postId);
		$request = 'DELETE FROM post WHERE id = ?';
		return Bdd::majBdd($request, [$postId]);
	}

	public function editPost($title, $content, $postId, $statut, $img = null) {
		if ($postId == 0) {
			if ($img != null) {
				$request = 'INSERT INTO post(title, content, img, date) VALUES(?, ?, ?, NOW())';
				return Bdd::majBdd($request, [$title, $content, $img]);
			} else {
				$request = 'INSERT INTO post(title, content, date) VALUES(?, ?, NOW())';
				return Bdd::majBdd($request, [$title, $content]);
			}
		} else {
			if ($img != null) {
				$request = 'UPDATE post SET title = ?, content = ?, date_modif = NOW(), statut = ?, img = ? WHERE id = ?';
				return Bdd::majBdd($request, [$title, $content, $statut, $img, $postId]);
			} else {
				$request = 'UPDATE post SET title = ?, content = ?, date_modif = NOW(), statut = ? WHERE id = ?';
				return Bdd::majBdd($request, [$title, $content, $statut, $postId]);
			}
		}
	}

	public function getStatutList() {
		$request = 'SELECT * FROM post_statut';
		return Bdd::query($request, null, true);
	}

}