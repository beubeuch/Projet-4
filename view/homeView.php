<div class="row">
	<div class="starter-template col-md-8 col-lg-10">
		<h2>Derniers chapitres</h2>
		<hr>
		<div class="text-justify">
			<?php
			foreach ($contentList as $value) {
				echo 	'<article>
							<h3>'. $value->title. '</h3>
							'. $post->getExcerpt($value->content) .'
							'. $post->getInfoBar($value->id) .'
						</article>';
			}?>
		</div>
	</div>
	<div class="col-md-4 col-lg-2 text-right d-sm-none d-md-block">
		<h2>Liens rapides</h2>
		<hr>
		<div class="list-group">
			<?php
			foreach ($chapterList as $value) {
				echo '<a href="index.php?p=chapitre&postId='. $value->id .'" class="list-group-item list-group-item-action">'. $value->title .'</a>';
			} ?>
		</div>
	</div>
</div>