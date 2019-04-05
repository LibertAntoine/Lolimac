<?php

namespace models;

// Classe mère de tous les modèles, gérant l'identification d'accès à la base de donnée.
abstract class DBAccess {
	
  	protected $db;

	public function __construct()
	{
		$db = new \PDO('mysql:host=localhost;dbname=lolimac', 'root', '');
		$this->db = $db;
	}
}

