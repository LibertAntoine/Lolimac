<?php

namespace models;
use \controllers\scans\ScanDataIn;

class Event {

	protected $id,
	$title,
	$photo_url,
	$description,
	$date_start,
	$date_end,
	$date_created;

	public function __construct(array $data) {
		$this->hydrate($data);
	}

	public function __isset($property) {
		return isset($this->$property);
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

  public function getTitle() {
    return $this->title;
  }

  public function getPhoto_url() {
    return $this->photo_url;
  }

  public function getDescription() {
    return $this->description;
  }

  public function getDate_start() {
    return $this->date_start;
  }

  public function getDate_end() {
  	return $this->date_end;
  }

  public function getDate_created() {
    return $this->date_created;
  }

  //Assesseurs
  //Attention le nom de méthode doit obligatoirement être composé de "set" suivi du nom de l'attribut correspondant, avec une majuscule, pour que la méthode hydrate soit fonctionnelle.
	public function setId(int $id) {
 	  $id = (int) $id;
 	  if ($id > 0) {
 		 $this->id = $id;
 	  }
  }

  public function setTitle($title) {
    if (is_string($title) && strlen($title) <= 255) {
    $this->title = $title;
    }
  }

  public function setPhoto_url($photo_url) {
    if (filter_var($photo_url, FILTER_VALIDATE_URL) && strlen($photo_url) <= 2083) {
    $this->photo_url = $photo_url;
    }
  }

  public function setDescription($description) {
    if (is_string($description) && (strlen($description) <= 65535)) {
    $this->description = $description;
    }
  }

  public function setDate_start($date_start) {
	  $scanDataIn = new ScanDataIn();
	  if ($scanDataIn->validateDate($date_start)) {
		  $this->date_start = $date_start;
	  }
	  else {
		  throw new \Exception("Veuilliez entrer une date de début valide.");
	  }
  }

 	public function setDate_end($date_end) {
		$scanDataIn = new ScanDataIn();
		if ($scanDataIn->validateDate($date_end)) {
			$this->date_end = $date_end;
		}
		else {
			throw new \Exception("Veuilliez entrer une date de fin valide.");
		}
  }

  public function setDate_created($date_created) {
		$scanDataIn = new ScanDataIn();
		if ($scanDataIn->validateDate($date_created)) {
			$this->date_created = $date_created;
		}
		else {
			throw new \Exception("Veuilliez entrer une date de création valide.");
		}
  }
}
