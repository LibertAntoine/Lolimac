<?php

namespace models;
use \controllers\scans\ScanDataIn;

class User {

	protected $id,
  $firstname,
  $lastname,
	$pseudo,
	$pwd_hash,
  $mail,
	$phone,
  $photo_url,
  $status,
  $year_promotion,
  $date_notification_check;

	public function __construct(array $data) {
		$this->hydrate($data);
	}

  //Gère la récupération de données des attributs lorsqu'elle proviennent de la bdd
	public function hydrate(array $data) {
    foreach ($data as $key => $value) {
     	$method = 'set'.ucfirst($key);
      if (method_exists($this, $method)) {
        $this->$method($value);
      }
    }
  }

  public function toArray() {
    $array = [
      "id" => $this->getId(),
      "firstmane" => $this->getFirstname(),
      "lastname" => $this->getLastname(),
      "pseudo" => $this->getPseudo(),
      "photo_url" => $this->getPhoto_url(),
      "status" => $this->getStatus()
    ];
    return $array;
  }

  // Getters
  public function getId() {
    return $this->id;
  }

  public function getFirstname() {
    return $this->firstname;
  }

  public function getLastname() {
    return $this->lastname;
  }

  public function getPseudo() {
    return $this->pseudo;
  }

  public function getPwd_hash() {
  	return $this->pwd_hash;
  }

  public function getMail() {
    return $this->mail;
  }

  public function getPhone() {
    return $this->phone;
  }

  public function getPhoto_url() {
    return $this->photo_url;
  }

  public function getStatus() {
    return $this->status;
  }

  public function getYear_promotion() {
    return $this->year_promotion;
  }

  public function getDate_notification_check() {
    return $this->date_notification_check;
  }

  //Assesseurs
  //Attention le nom de méthode doit obligatoirement être composé de "set" suivi du nom de l'attribut correspondant, avec une majuscule, pour que la méthode hydrate soit fonctionnelle.
	public function setId($id) {
 	  $id = (int) $id;
 	  if ($id > 0) {
 		 $this->id = $id;
 	  }
  }

  public function setFirstname($firstname) {
    if (is_string($firstname) && strlen($firstname) <= 22) {
    $this->firstname = $firstname;
    }
  }

  public function setLastname($lastname) {
    if (is_string($lastname) && strlen($lastname) <= 22) {
    $this->lastname = $lastname;
    }
  }

 	public function setPseudo($pseudo) {
  	if (is_string($pseudo) && strlen($pseudo) <= 25) {
 		$this->pseudo = $pseudo;
 	  }
  }

 	public function setPwd_hash($pwd_hash) {
  	if (is_string($pwd_hash)) {
 		 $this->pwd_hash = $pwd_hash;
 	  }
  }

  public function setMail($mail) {
    $mail = filter_var($mail, FILTER_VALIDATE_EMAIL);
    if ($mail == TRUE) {
     $this->mail = $mail;
    }
	else {
		throw new \Exception("L'adresse email est invalide.");
	}
  }

  public function setPhone($phone) {
    if (is_string($phone) && preg_match('#^(\d\d\s){4}(\d\d)$#', $phone)) {
     $this->phone = $phone;
    }
  }

  public function setPhoto_url($photo_url) {
    if (is_string($photo_url) && strlen($photo_url) <= 255) {
     $this->photo_url = $photo_url;
    }
  }

 	public function setStatus($status) {
  	$status = (int) $status;
 		$this->status = $status;
 	}

  public function setYear_promotion($year_promotion) {
    $year_promotion = (int) $year_promotion;
    if ($year_promotion > 0) {
     $this->year_promotion = $year_promotion;
    }
  }

  public function setDate_notification_check($date_notification) {
		$scanDataIn = new ScanDataIn();
		if (\is_null($date_notification) || $scanDataIn->validateDate($date_notification)) {
			$this->date_notification_check = $date_notification;
		}
		else {
			throw new \Exception("Veuilliez entrer une date de vérification de notifications valide.");
		}
  }
}
