<?php

namespace models;

class Link_events_eventtypes {

	protected $id_event,
  $id_type;


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
          "id_type" => $this->getId_place()
      ];
      return $array;
  }

  public function getId_event() {
    return $this->id_event;
  }

  public function getId_type() {
    return $this->id_type;
  }

  public function setId_event($id_event) {
    if ($id_event > 0) {
     $this->id_event = $id_event;
    }
  }

  public function setId_type($id_type) {
    if ($id_type > 0) {
     $this->id_type = $id_type;
    }
  }
}
