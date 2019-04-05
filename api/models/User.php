<?php

namespace models;

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
  $year_promotion;

	public function __construct(array $data) {
		$this->hydrate($data);
	}

  //gère la récupération de données des attributs lorsqu'elle proviennent de la bdd
	public function hydrate(array $data) {
    foreach ($data as $key => $value) {
     	$method = 'set'.ucfirst($key);
      if (method_exists($this, $method)) {
        $this->$method($value);
      }
    }
  }

  // Getters 
  public function getId() {
    return $this->id;
  }

  public function getFirstname() {
    return $this->id;
  }

  public function getLastname() {
    return $this->id;
  }

  public function getPseudo() {
    return $this->pseudo;
  }

  public function getPwd_hash() {
  	return $this->mdp;
  }

  public function getMail() {
    return $this->mdp;
  }

  public function getPhone() {
    return $this->mdp;
  }

  public function getPhoto_url() {
    return $this->mdp;
  }

  public function getStatus() {
    return $this->status;
  }

  public function getYear_Promotion() {
    return $this->nbPublication;
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
  	if (is_string($pwd_hash) && strlen($pwd_hash) <= 30) {
 		 $this->$pwd_hash = $pwd_hash;
 	  }
  }

  public function setMail($mail) {
    if (is_string($mail) && preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i',$mail)) {
     $this->$mail = $mail;
    }
  }

  public function setPhone($phone) {
    if (is_string($phone) && preg_match(' \^(\d\d\s){4}(\d\d)$\ ', $phone)) {
     $this->$phone = $phone;
    }
  }

  public function setPhoto_url($photo_url) {
    if (is_string($photo_url) && strlen($photo_url) <= 255) {
     $this->photo_url = $photo_url;
    }
  }

 	public function setStatus($status) {
  	if (is_bool($status)) {
 		 $this->status = $status;
 	  }
  }

  public function setYear_promotion($year_promotion) {
    if (is_int($year_promotion) && $year_promotion > 0) {
     $this->year_promotion = $year_promotion;
    }
  }
}