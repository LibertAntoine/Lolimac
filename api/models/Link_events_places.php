<?php

namespace models;

class Link_events_places {

	protected $id_event,
  $id_place;


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
          "id_event" => $this->getId_event(),
          "id_event" => $this->getId_place()
      ];
      return $array;
  }

  public function getId_event() {
    return $this->id_event;
  }

  public function getId_place() {
    return $this->id_place;
  }

  public function setId_event($id_event) {
    if ($id_event > 0) {
     $this->id_event = $id_event;
    }
  }

  public function setId_place($id_place) {
    if ($id_place > 0) {
     $this->id_place = $id_place;
    }
  }
}
