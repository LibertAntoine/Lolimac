<?php 
// Ce fichier gère la récupération des fichiers de class en fonction des besoins de la requète et en prenant en compte les namespaces (devant correspondre à l'architecture de fichier).

class Autoloader {
	
	function __construct()
	{
		$this->autoload();
	}

	public function autoload() {
		spl_autoload_register(function ($class_name) {
        		include_once  str_replace("\\", "/", $class_name) . '.php';
    	});
	}

}