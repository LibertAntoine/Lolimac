<?php

namespace notifications;

class Notifications {

	protected $id,
  $id_event,
  $date_edit,
  $info_edit,
  $type_edit;

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

  public function getId_event() {
    return $this->id_event;
  }

  public function getDate_edit() {
    return $this->date_edit;
  }

  public function getType_edit() {
    return $this->type_edit;
  }

  public function getInfo_edit() {
  	return $this->info_edit;
  }

  //Assesseurs
  //Attention le nom de méthode doit obligatoirement être composé de "set" suivi du nom de l'attribut correspondant, avec une majuscule, pour que la méthode hydrate soit fonctionnelle.
	public function setId($id) {
 	  $id = (int) $id;
 	  if ($id > 0) {
 		 $this->id = $id;
 	  }
  }

  public function setInfo_edit($content) {
    if (is_string($content)) {
    $this->info_edit = $content;
    }
  }

  public function setType_edit($type) {
    if (is_string($type_edit) && strlen($type_edit) <= 255) {
    $this->type_edit = $type_edit;
    }
  }

  public function setDate_edit($date_edit) {
		$scanDataIn = new ScanDataIn();
		if (\is_null($date_edit) || $scanDataIn->validateDate($date_edit)) {
			$this->date_edit = $date_edit;
		}
		else {
			throw new \Exception("Date de modification invalide.");
		}
  }
}
