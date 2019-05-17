<?php

namespace models;

class Post {

	protected $id,
  	$title,
  	$content,
	  $date_created,
	  $date_edited,
    $id_user,
  	$id_event;

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
      "title" => $this->getTitle(),
      "content" => $this->getContent(),
      "date_created" => $this->getDate_created(),
      "date_edited" => $this->getDate_edited(),
      "id_user" => $this->getId_user(),
      "id_event" => $this->getId_event()
    ];
    return $array;
  }


  // Getters 
  public function getId() {
    return $this->id;
  }

  public function getTitle() {
    return $this->title;
  }

  public function getContent() {
    return $this->content;
  }

  public function getDate_created() {
    return $this->date_created;
  }

  public function getDate_edited() {
  	return $this->date_edited;
  }

  public function getId_user() {
    return $this->id_user;
  }

  public function getId_event() {
    return $this->id_event;
  }

  //Assesseurs
  //Attention le nom de méthode doit obligatoirement être composé de "set" suivi du nom de l'attribut correspondant, avec une majuscule, pour que la méthode hydrate soit fonctionnelle.
	public function setId($id) {
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

  public function setContent($content) {
    if (is_string($content) && strlen($content) <= 5000) {
    $this->content = $content;
    }
  }

 	public function setDate_created($date_created) {
  	if (is_string($date_created)) {
 		 $this->date_created = $date_created;
 	  }
  }

  public function setDate_edited($date_edited) {
    if (is_string($date_edited)) {
     $this->date_edited = $date_edited;
    }
  }

  public function setId_user($id_user) {
    $id_user = (int) $id_user;
    if ($id_user > 0) {
     $this->id_user = $id_user;
    }
  }

  public function setId_event($id_event) {
    $id_event = (int) $id_event;
    if ($id_event > 0) {
     $this->id_event = $id_event;
    }
  }
}