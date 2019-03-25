<?php
namespace model;

class User {

	public function getUser($login) {
		$request = 'SELECT * FROM user WHERE name = ?';
		return core\Bdd::query($request, [$login]);
	}

	public function verifyPassword($writingPass, $bddPass, $statut) {
		password_verify($writingPass, $bddPass);
		if (password_verify($writingPass, $bddPass)) {
			$_SESSION['admin']['statut'] = $statut;
			return true;
		} else {
			return false;
		}
	}

}