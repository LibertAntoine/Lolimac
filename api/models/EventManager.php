<?php

namespace models;

class EventManager extends DBAccess {
	public function add(Event $event) {
		$q = $this->db->prepare("INSERT INTO events
      (`title`, `description`, `date_start`, `date_end`, `date_created`)
      VALUES (:title, :description, :date_start, :date_end, :date_created);");

		$q->bindValue(':title', $user->getTitle());
    $q->bindValue(':description', $user->getDescription());
    $q->bindValue(':date_start', $user->getDate_start());
    $q->bindValue(':date_end', $user->getDate_end());
    $q->bindValue(':date_created', $user->getDate_created());

	  $q->execute();

    $user->hydrate(['id' => $this->db->lastInsertId()]);
    return $user;
  }

  public function count() {
    return $this->db->query('SELECT COUNT(*) FROM events;')->fetchColumn();
  }

  public function readById($id) {
      $q = $this->db->query('SELECT * FROM events WHERE id = '.$id);
      $user = $q->fetch(\PDO::FETCH_ASSOC);
      return new Event($event);
  }

  public function readAll() {
    $allEvents = [];

    $q = $this->db->query('SELECT * FROM events');
    while ($data = $q->fetch(\PDO::FETCH_ASSOC)) {
     $allEvents[$data['id']] = new Event($data);
    }
    return $allEvents;
  }

  public function update(Event $event) {
    $q = $this->db->prepare('UPDATE events SET title = :title, description = :description, date_start = :date_start, date_end = :date_end, date_created = :date_created WHERE id = :id');

    $q->bindValue(':id', $user->getId());
    $q->bindValue(':title', $user->getTitle());
    $q->bindValue(':description', $user->getDescription());
    $q->bindValue(':date_start', $user->getDate_start());
    $q->bindValue(':date_end', $user->getDate_end());
    $q->bindValue(':date_created', $user->getDate_created());

    $q->execute();

    return $event;
  }

  public function deleteById(int $id) {
    $this->db->exec("DELETE FROM events WHERE id = {$id};");
    return TRUE;
  }
}
