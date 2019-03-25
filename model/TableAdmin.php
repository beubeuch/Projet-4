<?php
namespace model;

use \model\Comment;

class TableAdmin extends core\Table {

	public function createPostLines($data) {
		$comment = new Comment();
		foreach ($data as $value) {
			$chapitreLine = [
				$value->title,
				$value->date,
				$value->date_modif,
				$comment->getNbrComments($value->id)->nbr_comment,
				$value->name,
				$this->actionCellPost($value->id, $value->title)
			];
			$this->createLine($chapitreLine);
		}
	}

	public function createCommentLines($data, $moderation = null) {
		foreach ($data as $value) {
			if ($moderation != null) {
				if ($value->moderation == $moderation) {
					$line = [
						$value->id, 
						$value->content, 
						$value->date, 
						$value->name, 
						$value->title, 
						$value->moderation_name, 
						$this->actionCellCom($value->id)
					];
					$this->createLine($line);
				}
			} else {
				$line = [
					$value->id, 
					$value->content, 
					$value->date, 
					$value->name, 
					$value->title, 
					$value->moderation_name, 
					$this->actionCellCom($value->id)
				];
				$this->createLine($line);
			}
		}
	}

	public function actionCellPost($postId, $postTitle) {
		return '
			<a href="index.php?p=admin&e=edit&postId='.$postId.'" class="mr-3"><i class="fas fa-edit text-warning"></i></a>
			<a href="index.php?p=admin&e=supp&postId='.$postId.'&postTitle='.$postTitle.'"><i class="fas fa-trash-alt text-danger"></i></a>';
	}

	public function actionCellCom($commentId) {
		return '
			<a href="index.php?validComment&commentId='.$commentId.'" class="mr-1"><i class="fas fa-check text-success"></i></a>
			<a href="index.php?p=admin&e=edit&commentId='.$commentId.'" class="mr-1"><i class="fas fa-edit text-warning"></i></a>
			<a href="index.php?p=admin&e=supp&commentId='.$commentId.'"><i class="fas fa-trash-alt text-danger"></i></a>';
	}

}