<?php

namespace models;

class Module {

	protected $id,
  $name;


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

  public function getId() {
    return $this->id;
  }

  public function getName() {
    return $this->name;
  }

  public function setId($id) {
    $id = (int) $id;
    if ($id > 0) {
     $this->id = $id;
    }
  }

  public function setName($name) {
    if (is_string($name) && strlen($name) <= 255) {
    $this->name = $name;
    }
  }
}