<?php
namespace model\core;

class Table {

	protected $table;
	protected $thead;
	protected $tbody;

	public function __construct () {
		$this->tbody = '';
	}

	public function createHead($data) {
		$head = 	'<thead>';
		$head .=	'<tr>';
		foreach ($data as $value) {
			if ($value == 'Contenu') {
				$class = ' class="th-content"';
			} else {
				$class = '';
			}
			$head .=	'<th'.$class.'>'. $value .'</th>';
		}
		$head .=	'</tr>';
		$head .= 	'</thead>';
		$this->thead = $head;
	}

	public function createLine($data) {
		$line .=	'<tr>';
		foreach ($data as $value) {
			$line .=	'<td>'. $this->statutStyles($value) .'</td>';
		}
		$line .=	'</tr>';
		$this->tbody .= $line;
	}

	protected function statutStyles($statut) {
		if ($statut == 'Publié' || $statut == 'Modéré') {
			return '<div class="btn d-lg-inline-block bg-success text-white">'.$statut.'</div>';
		}
		elseif ($statut == 'Brouillon' || $statut == 'A modérer') {
			return '<div class="btn d-lg-inline-block bg-warning text-white">'.$statut.'</div>';
		}
		elseif ($statut == 'Archive' || $statut == 'Signalé') {
			return '<div class="btn d-lg-inline-block bg-danger text-white">'.$statut.'</div>';
		}
		else {
			return $statut;
		}
	}

	public function getTable() {
		if ($this->tbody == '') {
			return 	'<div class="alert alert-info col-lg-12 text-center">Aucune valeur à afficher</div>';
		} else {
			return 	'<table class="table col-lg-12">
						'. $this->thead .'
						<tbody>'. $this->tbody .'</tbody>
					</table>';
		}

	}

}