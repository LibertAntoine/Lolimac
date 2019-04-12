<?php

namespace models;

class Place {

	protected $id,
  $postcode,
  $street,
	$number,
	$city,
  $name ;

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

  // Getters 
  public function getId() {
    return $this->id;
  }

  public function getPostcode() {
    return $this->postcode;
  }

  public function getStreet() {
    return $this->street;
  }

  public function getNumber() {
    return $this->number;
  }

  public function getCity() {
  	return $this->city;
  }

  public function getName() {
    return $this->name;
  }

  //Assesseurs
  //Attention le nom de méthode doit obligatoirement être composé de "set" suivi du nom de l'attribut correspondant, avec une majuscule, pour que la méthode hydrate soit fonctionnelle.
	public function setId(int $id) {
 	  $id = (int) $id;
 	  if ($id > 0) {
 		 $this->id = $id;
 	  }
  }

  public function setPostcode($postcode) {
    $postcode = (int) $postcode;
    $this->postcode = $postcode;
  }

  public function setStreet($street) {
    if (is_string($street) && strlen($street) <= 255) {
    $this->street = $street;
    }
  }

 	public function setNumber($number) {
  	$number = (int) $number;
 		$this->number = $number;
  }

 	public function setCity($city) {
  	if (is_string($city) && strlen($city) <= 63 ) {
 		 $this->city = $city;
 	  }
  }

  public function setName($name) {
    if (is_string($name) && strlen($name) < 63 ) {
     $this->name = $name;
    }
  }

}