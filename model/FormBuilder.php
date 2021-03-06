<?php
namespace model;

use model\Post;

class FormBuilder extends core\Form {

	public static function contactForm() {
		$form = '<form method="post" action="index.php?contact">';
		$form .= self::text('Nom', 'lastnameContact');
		$form .= self::text('Prénom', 'firstnameContact');
		$form .= self::mail('E-mail', 'mailContact');
		$form .= self::textArea('Message', 'messageContact');
		$form .= self::submit('Envoyer');
		$form .= '</form>';
		return $form;
	}

	public static function newCommForm($action) {
		$form = '<form method="post" action="'. $action .'">';
		$form .= self::text('Nom', 'name');
		$form .= self::textArea('Commentaire', 'newComment');
		$form .= self::submit('Envoyer');
		$form .= '</form>';
		return $form;
	}

	public static function editPostForm($action, $titleContent, $bodyContent, $postId, $img, $select = null) {
		$post = new Post();
		$statutList = $post->getStatutList();

		if ($img != null) {
			$imgName = 'public/images/'.$img;
		} else {
			$imgName = '';
		}

		$form = '<form method="post" action="'. $action .'" enctype="multipart/form-data">';
		$form .= self::text('Titre', 'editPostTitle', $titleContent);
		$form .= self::list('Statut', 'editPostStatut', $statutList, $select);

		$form .= '<div class="edit-img">';
		$form .= 	self::upload('Image', 'editPostImg');
		$form .= 	'<div class="img-div">';
		$form .= 		'<img src="'.$imgName.'">';
		$form .= 		self::hidden('editPostImgName', $img);
		$form .= 	'</div>';
		$form .= '</div>';

		$form .= self::textArea('', 'editPostContent', $bodyContent, true);
		$form .= self::hidden('editPostId', $postId);
		$form .= self::submit('Valider');
		$form .= '</form>';
		return $form;
	}

	public static function editCommentForm($action, $bodyContent, $commentId) {
		$form = '<form method="post" action="'. $action .'">';
		$form .= self::textArea('', 'editCommentContent', $bodyContent, true);
		$form .= self::hidden('editCommentId', $commentId);
		$form .= self::submit('Valider');
		$form .= '</form>';
		return $form;
	}

	public static function connexionForm() {
		$form = '<form method="post" action="index.php?p=admin" class="col-md-6 offset-3">';
		$form .= self::text('Login', 'adminLogin');
		$form .= self::pass('Mot de passe', 'adminPass');
		$form .= self::submit('Valider');		
		$form .= '</form>';
		return $form;
	}

}