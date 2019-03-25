<div class="row">
	<div class="col-md-12"> 
		<section class="row">
			<div class="col-md-12">
				<h3><?= $chapitre->title; ?></h3>
				<article>
					<?= $chapitre->content; ?>
				</article>
			</div>
		</section>
		<section class="row mt-4">
			<div class="col-md-12">
				<hr>
				<h3 class="mb-4">Commentaires</h3>
				<?php
				if ($comments == null) {
					echo '<div class="alert alert-info col-md-12 text-center">Aucun commentaire publié</div>';
				} else {
					foreach ($comments as $value) {
						if ($value->moderation == 2) {
							$link = '<span class="small offset-md-1 text-warning">Commentaire signalé par un visiteur</span>';
						}
						else {
							$link = '<a href="index.php?report&postId='.$postId.'&commentId='.$value->id.'" class="small offset-md-1">Signaler le commentaire</a>';
						} ?>

						<article class="row mb-4">
							<div class="col-md-12">
								<div class="row">
									<h4 class="col-md-12">
										<?= $value->name; ?> <span class="comment-date">le <?= $value->date; ?></span><?= $link;?>
									</h4>
								</div>
								<div class="row">
									<article class="col-md-10 offset-md-1">
										<?= $value->content;?>
									</article>
								</div>
							</div>
						</article>
						<?php
					}
				} ?>
			</div>
		</section>
		<section class="row mt-4">
			<div class="col-md-12">
				<hr>
				<h3 class="mb-4">Ajouter un commentaire</h3>
				<?php
				$action = 'index.php?p=chapitre&postId='.$chapitre->id;
				echo model\FormBuilder::newCommForm($action);
				?>
			</div>
		</section>
	</div>
</div>