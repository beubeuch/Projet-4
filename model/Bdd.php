<?php

class Bdd {

	const BDD_HOST = 'localhost';
	const BDD_NAME = 'openclassroomProjet4';
	const BDD_LOGIN = 'openclassroomProjet4';
	const BDD_MDP = 'KJ31rxKp5y0D8B0l';

	// private $bdd_host;
	// private $bdd_name;
	// private $bdd_login;
	// private $bdd_mpd;

	private static $bdd;

	public function __construct()
	{
		$this->bdd_host = App::$db_setting['BDD_HOST'];
		$this->bdd_name = App::$db_setting['BDD_NAME'];
		$this->bdd_login = App::$db_setting['BDD_LOGIN'];
		$this->bdd_mpd = App::$db_setting['BDD_MDP'];
	}

	protected function getBdd()
	{
		if (self::$bdd === null) {			// ASSESSEUR
			$bdd = new \PDO(
				'mysql:host='.self::BDD_HOST.';
				dbname='.self::BDD_NAME.';
				charset=utf8',
				self::BDD_LOGIN,
				self::BDD_MDP,
				array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			));
			self::$bdd = $bdd;
		}
		return self::$bdd;
	}

	public static function query($request, $data = null, $all = false)
	{
		$bdd = self::getBdd();
		if ($data === null) {
			$reponse = $bdd->query($request);
		} else {
			$reponse = $bdd->prepare($request);
			$reponse->execute($data);
		}
		if ($all === false) {
			$data = $reponse->fetch(PDO::FETCH_OBJ);
		} else {
			$data = $reponse->fetchAll(PDO::FETCH_OBJ);
		}
		return $data;
	}

	public static function majBdd($request, $data = null) {
		$bdd = self::getBdd();
		if ($data === null) {
			$result = $bdd->exec($request);		// return nbr ligne affectées / 0 si aucune lignes affectées
			return $result->rowCount();

		} else {
			$reponse = $bdd->prepare($request);
			$result = $reponse->execute($data);	// return TRUE or FALSE
			return $reponse->rowCount();
		}
	}

}