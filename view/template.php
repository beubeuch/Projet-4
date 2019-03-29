<?php
$menuListe = model\core\App::$menus;
$navActive = isset($_GET['p']) ? $_GET['p'] : 'Accueil';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<title><?= $titlePage;?> | Jean Forteroche</title>
	<meta name="description" content="Blog de l'écrivain Jean Forteroche - Billet simple pour l'Alaska">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="public/css/styles.css">
	<script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=jpl1upzthyr8idk4ytcv6rw78s1r5n2zahqo09mx82tk2sll"></script>
</head>
<body>
 	<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
		<a class="navbar-brand" href="index.php">Jean Forteroche</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
		  <span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarsExampleDefault">
			<ul class="navbar-nav mr-auto">
				<?php
				foreach ($menuListe as $menu) {
					if ($navActive == $menu) {
						$classActive = ' active';
					} else {
						$classActive = '';
					} ?>
					<li class="nav-item<?= $classActive ?>">
						<a class="nav-link" href="index.php?p=<?= $menu ?>"><?= ucfirst($menu);?></a>
					</li>
					<?php
				}
				if (isset($_SESSION['admin'])) { ?>
					<li class="nav-item<?= $classActive ?>">
						<a class="nav-link text-danger" href="index.php?p=admin&disconnect">Se déconnecter</a>
					</li> <?php
				} ?>
			</ul>
		</div>
	</nav>

	<?php
	if (!isset($_GET['p']) || $_GET['p'] == 'accueil') {
		echo '	<div class="container-fluid home-body">
					<div class="row">
						<h1 class="col-md-12 text-center text-white mt-3 mb-5">Billet simple pour l\'Alaska</h1>
						<div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 author-div mb-5">
							<div class="row">
								<div class="col-sm-12 col-md-3">
									<img src="public/images/photo_profil.jpg" alt="Photo de Jean Forteroche">
								</div>
								<div class="col-sm-12 col-md-9">
									<h3>Jean Forteroche</h3>
									<p>Ecrivain depuis 10 ans, je souhaite aujourd\'hui interagir avec les fans à travers ce blog.......</p>
								</div>
							</div>
						</div>
						<div class="col-xl-12 text-center mb-5 d-none d-md-block">
							<a href="#chaps" class="btn btn-primary">Commencer la lecture</a>
						</div>
					</div>
				</div>';
	} ?>
	
	<main class="container-fluid" id="chaps">
		<?php
		echo model\Alert::visitorAlert();
		echo $content;
		?>
		<a href="projet4.zip">Telecharger .zip</a>
	</main><!-- /.container -->


	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="public/js/ajax.js"></script>
	<script src="public/js/script.js"></script>
</body>
</html>