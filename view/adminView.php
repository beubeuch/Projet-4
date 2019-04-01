<div class="row">
	<div class="d-sm-none d-lg-block col-lg-2">
		<div class="list-group sticky-top">
			<a href="#chap" class="list-group-item list-group-item-action">Chapitres</a>
			<div class="list-group-item">Commentaires
				<div class="list-group">
					<a href="#signal" class="list-group-item list-group-item-action">Signalés</a>
					<a href="#modere" class="list-group-item list-group-item-action">Modérés</a>
					<a href="#all" class="list-group-item list-group-item-action">Tous</a>
				</div>
			</div>
		</div>
	</div>

	<section class="col-sm-12 col-lg-10 mt-3">
		<section class="row">
			<div class="col-lg-12 text-center">
				<a href="index.php?p=admin&e=edit&postId=0" class="btn btn-primary mb-5 col-lg-4">Créer un nouveau chapitre</a>
			</div>
		</section>

		<section class="row">
			<h2 class="col-lg-12 pt-2 pb-2 sticky-top" id="chap">Chapitres</h2>
			<?= $chapitreTable->getTable(); ?>
		</section>

		<section class="row">
			<h2 class="col-lg-12 mb-4">Commentaires</h2>
			<div class="col-lg-12">
				<article class="row">
					<h3 class="col-lg-12 pl-5 pt-2 pb-2 sticky-top" id="signal">Signalés par un visiteur</h3>
					<?= $tableSignal->getTable(); ?>
				</article>

				<article class="row">
					<h3 class="col-lg-12 pl-5 pt-2 pb-2 sticky-top" id="modere">Modérés</h3>
					<?= $tableModerate->getTable(); ?>
				</article>

				<article class="row">
					<h3 class="col-lg-12 pl-5 pt-2 pb-2 sticky-top" id="all">Tous les commentaires</h3>
					<?= $tableAll->getTable(); ?>
				</article>
			</div>
		</section>
	</section>
</div>