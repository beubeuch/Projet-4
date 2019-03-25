<?php
namespace model\core;

class Bdd {

	private static $bdd_host = 'localhost';
	private static $bdd_name = 'openclassroomProjet4';
	private static $bdd_login = 'openclassroomProjet4';
	private static $bdd_mpd = 'KJ31rxKp5y0D8B0l';

	protected static $bdd;

	protected function getBdd()
	{
		if (self::$bdd === null) {			// ASSESSEUR
			$bdd = new \PDO(
				'mysql:host='.self::$bdd_host.';
				dbname='.self::$bdd_name.';
				charset=utf8',
				self::$bdd_login,
				self::$bdd_mpd,
				array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
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
			$data = $reponse->fetch(\PDO::FETCH_OBJ);
		} else {
			$data = $reponse->fetchAll(\PDO::FETCH_OBJ);
		}
		return $data;
	}

	public static function majBdd($request, $data = null)
	{
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