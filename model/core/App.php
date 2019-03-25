<?php
namespace model\core;

class App {

	public static $menus = ['accueil', 'chapitre', 'admin'];

	public static function init() {
		define(ROOT, $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'openclassroom'. DIRECTORY_SEPARATOR .'projet4'. DIRECTORY_SEPARATOR);
		session_start();
		require 'controller/frontend.php';
		self::runAutoloader();
	}

	public static function runAutoloader() {
		require ROOT.'model'. DIRECTORY_SEPARATOR .'core'. DIRECTORY_SEPARATOR .'Autoloader.php';
		Autoloader::register();
	}

}