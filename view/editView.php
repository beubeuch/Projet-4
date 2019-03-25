<?php
use \model\FormBuilder;
?>

<div class="row mb-5">
	<a href="index.php?p=admin" class="btn btn-danger col-md-3">Annuler</a>
</div>

<div class="row">
	<div class="col-md-12">
		<?php
		if (isset($post)) {
			echo FormBuilder::editPostForm('index.php?editContent', $post->title, $post->content, $postId, $post->img, $select);
		}
		elseif (isset($com)) {
			echo FormBuilder::editCommentForm('index.php?editContent', $com->content, $commentId);
		}
		?>
	</div>
</div>