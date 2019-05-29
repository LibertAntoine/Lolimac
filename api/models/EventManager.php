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

  public function readById_noException($id) {
      $q = $this->db->prepare("SELECT * FROM events WHERE id = :id");
	  $q->bindValue(':id', $id);
	  $q->execute();
      $event = $q->fetch(\PDO::FETCH_ASSOC);
	  return $event;
  }

  public function readById($id) {
      $q = $this->db->prepare("SELECT * FROM events WHERE id = :id");
	  $q->bindValue(':id', $id);
	  $q->execute();
      $event = $q->fetch(\PDO::FETCH_ASSOC);
	  if ($event) {
		  return new Event($event);
	  }
	  else {
	  	throw new \Exception("Aucun événement ne correspond à l'id $id", 400);
	  }
  }

  public function readOffsetLimit(int $offset, int $limit) {
    $allEvents = [];

    $q = $this->db->prepare("SELECT * FROM events WHERE date_start >= DATE_SUB(NOW(), INTERVAL 1 MONTH) OR date_start IS NULL ORDER BY CASE WHEN date_start IS NULL THEN 1 ELSE 0 END, date_start LIMIT :limit OFFSET :offset");
    $q->bindValue(":limit", (int) $limit, \PDO::PARAM_INT);
    $q->bindValue(':offset', (int) $offset, \PDO::PARAM_INT);
	$q->execute();
    while ($data = $q->fetch(\PDO::FETCH_ASSOC)) {
     $allEvents[$data['id']] = new Event($data);
    }
    return $allEvents;
  }

  public function readAll() {
    $allEvents = [];

    $q = $this->db->query("SELECT * FROM events WHERE date_start IS NOT NULL AND date_start >= NOW() ORDER BY date_start ASC LIMIT 10;");
    while ($data = $q->fetch(\PDO::FETCH_ASSOC)) {
     $allEvents[$data['id']] = new Event($data);
    }
    return $allEvents;
  }

  public function search($keywords) {
	  $allEvents = [];

	  $query = "SELECT * FROM events";
	  $i = 0;
	  foreach ($keywords as $key => $keyword) {
		  if ($i != 0) $query .= " AND";
		  else $query .= " WHERE";
		  $query .= " title LIKE '%$keyword%'";
		  $i++;
	  }
	  $query .= ";";
	  $q = $this->db->query($query);
	  while ($data = $q->fetch(\PDO::FETCH_ASSOC)) {
	   $allEvents[$data['id']] = new Event($data);
	  }
	  return $allEvents;
  }

  public function readAllValid() {
    $allEvents = [];

    $q = $this->db->query("SELECT * FROM events WHERE date_start < date_end;");
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
