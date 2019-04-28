<?php

namespace models;

class EventManager extends DBAccess {
	public function add(Event $event) {
		$q = $this->db->prepare("INSERT INTO events (`title`, `photo_url`, `description`, `date_start`, `date_end`, `date_created`) VALUES (:title, :photo_url, :description, :date_start, :date_end, NOW());");

			$q->bindValue(':title', $event->getTitle());
			$q->bindValue(':photo_url', $event->getPhoto_url());
			$q->bindValue(':description', $event->getDescription());
			$q->bindValue(':date_start', $event->getDate_start());
			$q->bindValue(':date_end', $event->getDate_end());

			$q->execute();

			$event->hydrate(['id' => $this->db->lastInsertId()]);
			return $event;
  }

  public function count() {
    return $this->db->query('SELECT COUNT(*) FROM events;')->fetchColumn();
  }

  public function readById($id) {
      $q = $this->db->query('SELECT * FROM events WHERE id = '.$id);
      $event = $q->fetch(\PDO::FETCH_ASSOC);
      return new Event($event);
  }

  public function readOffsetLimit($offset, $limit) {
	  // TODO: finir et lier
    $allEvents = [];

    $q = $this->db->query('SELECT * FROM events LIMIT :limit OFFSET :offset');
    $q->bindValue(':limit', $limit);
    $q->bindValue(':offset', $offset);
    while ($data = $q->fetch(\PDO::FETCH_ASSOC)) {
     $allEvents[$data['id']] = new Event($data);
    }
    return $allEvents;
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
    $q = $this->db->prepare('UPDATE events SET title = :title, photo_url = :photo_url, description = :description, date_start = :date_start, date_end = :date_end, date_created = :date_created WHERE id = :id');

    $q->bindValue(':id', $event->getId());
    $q->bindValue(':title', $event->getTitle());
    $q->bindValue(':photo_url', $event->getPhoto_url());
    $q->bindValue(':description', $event->getDescription());
    $q->bindValue(':date_start', $event->getDate_start());
    $q->bindValue(':date_end', $event->getDate_end());
    $q->bindValue(':date_created', $event->getDate_created());
    $q->execute();

    return $event;
  }

  public function deleteById(int $id) {
    $this->db->exec("DELETE FROM events WHERE id = {$id};");
    return TRUE;
  }
}
