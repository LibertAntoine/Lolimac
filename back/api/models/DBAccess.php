<?php

namespace models;

// Classe mère de tous les modèles, gérant l'identification d'accès à la base de donnée.
abstract class DBAccess {

  protected $db;

  public function __construct()
  {
    include "dbID.php"; // This file must not be staged
    $db = new \PDO("mysql:host={$dbHost};dbname={$dbTableName}", $dbUsername, $dbPassword);
    $this->db = $db;
  }
}
