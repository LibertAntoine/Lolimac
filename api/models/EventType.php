<?php

namespace models;

class EventType {

	protected $id,
	$name = NULL;

	public function __construct(array $data) {
		$this->hydrate($data);
	}

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
          "id_type" => $this->getId(),
          "name" => $this->getName()
      ];
      return $array;
  }

  // Getters
  public function getId() {
    return $this->id;
  }

  public function getName() {
    return $this->name;
  }

  //Assesseurs
  //Attention le nom de méthode doit obligatoirement être composé de "set" suivi du nom de l'attribut correspondant, avec une majuscule, pour que la méthode hydrate soit fonctionnelle.
	public function setId($id) {
 	  $id = (int) $id;
 	  if ($id > 0) {
 		 $this->id = $id;
 	  }
  }
  
  public function setName($name) {
    if (is_string($name) && strlen($name) < 63 ) {
     $this->name = $name;
    }
  }

}
