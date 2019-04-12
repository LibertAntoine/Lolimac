<?php

namespace models;

class Event {

	protected $id,
  $title,
  $description,
	$date_start,
	$date_end,
  $date_created;

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

  public function getTitle() {
    return $this->title;
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

  public function setDecription($description) {
    if (is_string($description) && strlen($description) <= 65535) {
    $this->description = $description;
    }
  }

 	public function setDate_start($date_start) {
    // TODO: Check date format
  	//if (is_string($pseudo) && strlen($pseudo) <= 25) {
 		$this->date_start = $date_start;
 	  //}
  }

 	public function setDate_end($date_end) {
    // TODO: Check date format
  	//if (is_string($pseudo) && strlen($pseudo) <= 25) {
 		$this->date_end = $date_end;
 	  //}
  }

  public function setDate_created($date_created) {
    // TODO: Check date format
     $this->date_created = $date_created;
  }
}
