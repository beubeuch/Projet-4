<?php
namespace model;

class Alert {

	protected $fail = 'Une erreur est survenue, merci de réessayer';

	public static function visitorAlert() {
		if (isset($_SESSION['alert'])) {
			if (isset($_SESSION['alert']['success'])) {
				$alertClass = 'success';
			}
			elseif (isset($_SESSION['alert']['warning'])) {
				$alertClass = 'warning';
			}
			elseif (isset($_SESSION['alert']['danger'])) {
				$alertClass = 'danger';
			}
			return 	'<div class="alert alert-'.$alertClass.' text-center fixed-top" id="alertDiv">
						'.$_SESSION['alert'][$alertClass].'
						<button type="button" class="close" id="closeAlert">
						    <span aria-hidden="true">&times;</span>
						</button>
					</div>';
		}
	}

	public static function adminSuppAlert($message, $action) {
		return 	'<div class="row">
					<div class="col-md-12 alert alert-warning">
						<div class="row">
							<p class="col-md-12 text-center">'.$message.'</p>
							<a href="index.php?p=admin" class="btn btn-warning col-md-2 offset-md-1">Annuler</a>
							<a href="index.php?'.$action.'" class="btn btn-danger col-md-2 offset-md-6">Supprimer</a>
						</div>
					</div>
				</div>';
	}

	public static function failAlert(){
		self::dangerAlert(self::$fail);
	}

	public static function successAlert($text){
		$_SESSION['alert']['success'] = $text;
	}

	public static function warningAlert($text){
		$_SESSION['alert']['warning'] = $text;
	}

	public static function dangerAlert($text){
		$_SESSION['alert']['danger'] = $text;
	}

	public function unset() {
		unset($_SESSION['alert']);
	}


}