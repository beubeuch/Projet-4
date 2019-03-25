<?php
namespace model\core;

class Autoloader{
	
	static function register() {
		spl_autoload_register(array(__CLASS__, 'autoload'));
	}

	static function autoload($class)
	{
		$parts = explode('\\', $class);

		$className = array_pop($parts);

		$path = implode(DIRECTORY_SEPARATOR, $parts);
		$classFile = $className.'.php';

		$filePath = ROOT.strtolower($path).DIRECTORY_SEPARATOR.$classFile;

		require $filePath;


		// $classFile = ROOT.'model/'.$class.'.php';
		// if (!file_exists($classFile)) {
		// 	$classFile = ROOT.'model'.DIRECTORY_SEPARATOR.'core/'.$class.'.php';
		// }		
		// require $classFile;
	}

}