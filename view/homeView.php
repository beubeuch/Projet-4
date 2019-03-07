<div class="row">
	<div class="starter-template col-md-8">
		<h2>Derniers chapitres publiés par Jean Forteroche</h2>
		<hr>
		<div class="text-justify">
			<?php
			foreach ($billet->getList() as $post) {
				echo 	'<article>
							<h3>'. $post->title. '</h3>
							'. $billet->getExcerpt($post->content) .'
							'. $billet->getInfoBar($post->id) .'
						</article>';
			}?>
		</div>
	</div>
	<div class="col-md-4 text-right">
		<h2>Derniers chapitres</h2>
		<hr>
		<div class="list-group">
			<?php
			foreach ($chapterList as $chapter) {
				echo '<a href="index.php?p=billet&id='. $chapter->id .'" class="list-group-item list-group-item-action">'. $chapter->title .'</a>';
			} ?>
		</div>
	</div>
</div>