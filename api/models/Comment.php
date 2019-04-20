<?php

namespace models;

class Comment {

	protected $id,
  $content,
  $date_created,
  $date_edited,
  $id_user;
  $id_post;

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

  public function getId_post() {
    return $this->id_post;
  }

  public function setId(int $id) {
    $id = (int) $id;
    if ($id > 0) {
     $this->id = $id;
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