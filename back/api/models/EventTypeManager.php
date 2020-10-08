<?php

namespace models;

class EventTypeManager extends DBAccess {
	public function add(EventType $eventType) {
		$q = $this->db->prepare("INSERT INTO eventtypes
      (`name`)
      VALUES (:name);");

	  $q->bindValue(':name', $eventType->getName());

	  $q->execute();

    $eventType->hydrate(['id' => $this->db->lastInsertId()]);
    return $eventType;
  }

  public function readById($id) {
      $q = $this->db->prepare("SELECT * FROM eventtypes WHERE id = :id;");
	  $q->bindValue(':id', $id);
	  $q->execute();
      $eventType = $q->fetch(\PDO::FETCH_ASSOC);
	  //\var_dump($place);
      $eventTypeObj = new EventType($eventType);
      if($eventTypeObj) {
        return $eventTypeObj;
      } else {
        throw new \Exception("Le type n'existe pas.", 400);
      }
  }

  public function readByName($name) {
      $q = $this->db->prepare("SELECT * FROM eventtypes WHERE name = :name");
	  $q->bindValue(':name', $name);
      //$q->execute([':name' => $name]);
      $eventType = $q->fetch(\PDO::FETCH_ASSOC);
      return ($eventType) ? new EventType($eventType) : false;
  }

  public function readAll() {
    $allEventTypes = [];

    $q = $this->db->query("SELECT * FROM eventtypes");
    while ($data = $q->fetch(\PDO::FETCH_ASSOC)) {
     $allEventTypes[$data['id']] = new EventType($data);
    }
    return $allEventTypes;
  }

  public function update(EventType $eventType) {
    $q = $this->db->prepare('UPDATE eventtypes SET name = :name WHERE id = :id');

    $q->bindValue(':name', $eventType->getName());

    $q->execute();

    return $eventType;
  }

  public function deleteById(int $id) {
    $q = $this->db->prepare("DELETE FROM eventtypes WHERE id = :id;");
    $q->bindValue(':id', $id);
    return $q->execute();
  }
}
