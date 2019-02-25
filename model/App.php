<?php
class App {

	public static $menus = ['Accueil', 'Billet', 'Admin'];
	public static $db_setting = [
		'BDD_HOST' => 'localhost',
		'BDD_NAME' => 'openclassroomProjet4',
		'BDD_LOGIN' => 'openclassroomProjet4',
		'BDD_MDP' => 'KJ31rxKp5y0D8B0l'];

	public static function init() {
		// define(ROOT, str_replace('volume1/web/', '', dirname(__DIR__)).'/');
		session_start();
		require 'controller/frontend.php';
		self::runAutoloader();
	}

	public static function runAutoloader() {
		require 'model'. DIRECTORY_SEPARATOR .'Autoloader.php';
		Autoloader::register();
	}
}