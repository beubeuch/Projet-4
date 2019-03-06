<div class="row">
	<div class="starter-template col-md-8">
		<h2>Derniers chapitres publiés par Jean Forteroche</h2>
		<hr>
		<div class="lead text-justify">
			<?php
			foreach ($billet->getList() as $post) {
				echo 	'<h3>'. $post->title. '</h3>';
				echo 	'<article>
							'. $billet->getExcerpt($post->content) .'
							'. $billet->getInfoBar($post->id) .'
						</article>';
			}?>
		</div>
	</div>
	<div class="starter-template col-md-4 text-right">
		<h2>Derniers chapitres</h2>
		<hr>
		<ul class="list-group">
			<?php
			foreach ($chapterList as $chapter) {
				echo '<a href="'.ROOT.'/index.php?p=Billet&id='. $chapter->id .'" class="list-group-item list-group-item-action">'. $chapter->title .'</a>';
			} ?>
		</ul>
	</div>
</div>