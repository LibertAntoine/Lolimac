<?php

namespace models;

class Link_events_eventtypesManager extends DBAccess {

  public function add(Link_events_eventtypes $link) {
      $q = $this->db->prepare("INSERT INTO link_events_eventtypes
          (`id_event`, `id_type`)
          VALUES (:id_event, :id_type);");

          $q->bindValue(':id_event', $link->getId_event());
          $q->bindValue(':id_type', $link->getId_type());

	  $q->execute();

    $link->hydrate(['id' => $this->db->lastInsertId()]);
    return $link;
  }

  public function count() {
    return $this->db->query("SELECT COUNT(*) FROM link_events_eventtypes;")->fetchColumn();
  }

  public function updateType(Link_events_eventtypes $link_events_eventtypes, int $new_id_type) {
    $q = $this->db->prepare("UPDATE link_events_eventtypes SET id_event = :id_event, id_type = :new_id_type WHERE id_event = :id_event AND id_type = :id_type");

    $q->bindValue(':id_event', $link_events_eventtypes->getId_event());
    $q->bindValue(':id_type', $link_events_eventtypes->getId_type());
    $q->bindValue(':new_id_type', $new_id_type);

    $q->execute();

    return $link_events_eventtypes;
  }

  public function readById_event($id_event) {
      $q = $this->db->prepare("SELECT * FROM link_events_eventtypes WHERE id_event = :id_event LIMIT 1;");
      $q->bindValue(':id_event', $id_event);
      $q->execute();
      $link = $q->fetch(\PDO::FETCH_ASSOC);
      if ($link) {
          return new Link_events_eventtypes($link);
      }
      else {
          return NULL;
      }
  }

  public function readById_type($id_type) {
      $q = $this->db->query("SELECT * FROM link_events_eventtypes WHERE id_type = :id_type");
	  $q->bindValue(':id_type', $id_type);
      $link = $q->fetch(\PDO::FETCH_ASSOC);
	  if ($link) {
		  return new Link_events_eventtypes($link);
	  }
	  else {
		  return NULL;
	  }
  }

  public function readById_event_type($id_event, $id_type) {
      $q = $this->db->prepare('SELECT * FROM link_events_eventtypes WHERE id_event = :id_event AND id_type = :id_type;');

      $q->bindValue(':id_event', $id_event);
      $q->bindValue(':id_type', $id_type);
      $q->execute();

      $link = $q->fetch(\PDO::FETCH_ASSOC);

      return $link ? True : False;
  }


  public function readAll() {
    $allLink = [];

    $q = $this->db->query('SELECT * FROM link_events_eventtypes');
    while ($data = $q->fetch(\PDO::FETCH_ASSOC)) {
     $allLink[$data['id']] = new Link_events_eventtypes($data);
    }
    return $allLink;
  }

  public function deleteById($id_event, $id_type) {
     $q = $this->db->prepare('DELETE FROM link_events_eventtypes WHERE id_event = :id_event AND id_type = :id_type;');

      $q->bindValue(':id_event', $id_event);
      $q->bindValue(':id_type', $id_type);
      $q->execute();
      return TRUE;
  }

  public function deleteByIdEvent($id_event) {
       $q = $this->db->prepare('DELETE FROM link_events_eventtypes WHERE id_event = :id_event;');
        $q->bindValue(':id_event', $id_event);
        $q->execute();
        return TRUE;
    }
}
