<?php

namespace models;

class Link_events_users_modules {

	protected $id_event,
  $id_user,
  $id_module;


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

  public function getId_event() {
    return $this->id_event;
  }

  public function getId_user() {
    return $this->id_user;
  }

  public function getId_module() {
    return $this->id_module;
  }

  public function setId_event($id_event) {
    $id_event = (int) $id_event;
    if ($id_event > 0) {
     $this->id_event = $id_event;
    }
  }

  public function setId_user($id_user) {
    $id_user = (int) $id_user;
    if ($id_user > 0) {
     $this->id_user = $id_user;
    }
  }

  public function setId_module($id_module) {
    $id_module = (int) $id_module;
    if ($id_module >= 0) {
     $this->id_module = $id_module;
    }
  }
}