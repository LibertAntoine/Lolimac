<?php

namespace models;
use \controllers\scans\ScanDataIn;

class Event {

	protected $id,
	$title,
	$photo_url,
	$description = NULL,
	$date_start = NULL,
	$date_end = NULL,
	$date_created;

	public function __construct(array $data) {
		$this->hydrate($data);
	}

	public function toArray() {
		$array = [
			"id_event" => $this->getId(),
			"title" => $this->getTitle(),
			"description" => $this->getDescription(),
			"date_start" => $this->getDate_start(),
			"date_end" => $this->getDate_end(),
			"date_created" => $this->getDate_created(),
			"photo_url" => $this->getPhoto_url()
		];
		return $array;
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
	  if (is_null($title)) {
		  throw new \Exception("Veuilliez entrer un titre");
	  }
	  if (is_string($title) && strlen($title) <= 255) {
		  $this->title = $title;
	  }
  }

  public function setPhoto_url($photo_url) {
	  if (is_null($photo_url)) {
		  throw new \Exception("Veuilliez indiquer une photo");
	  }
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
	  if (\is_null($date_start) || $scanDataIn->validateDate($date_start)) {
		  $this->date_start = $date_start;
	  }
	  else {
		  throw new \Exception("Veuilliez entrer une date de début valide.", 400);
	  }
  }

 	public function setDate_end($date_end) {
		$scanDataIn = new ScanDataIn();
		if (\is_null($date_end) || $scanDataIn->validateDate($date_end)) {
			$this->date_end = $date_end;
		}
		else {
			throw new \Exception("Veuilliez entrer une date de fin valide.", 400);
		}
  }

  public function setDate_created($date_created) {
		$scanDataIn = new ScanDataIn();
		if (\is_null($date_created) || $scanDataIn->validateDate($date_created)) {
			$this->date_created = $date_created;
		}
		else {
			throw new \Exception("Veuilliez entrer une date de création valide.", 400);
		}
  }
}
