<?php

namespace models;

class Link_events_placesManager extends DBAccess {

  public function add(Link_events_places $link) {
      $q = $this->db->prepare("INSERT INTO link_events_places
          (`id_event`, `id_place`)
          VALUES (:id_event, :id_place);");

          $q->bindValue(':id_event', $link->getId_event());
          $q->bindValue(':id_place', $link->getId_place());
          
	  $q->execute();

    $link->hydrate(['id' => $this->db->lastInsertId()]);
    return $link;
  }

  public function count() {
    return $this->db->query("SELECT COUNT(*) FROM link_events_places;")->fetchColumn();
  }

  public function readById_event($id_event) {
      $q = $this->db->query('SELECT * FROM link_events_places WHERE id_event = '.$id_event);
      $link = $q->fetch(\PDO::FETCH_ASSOC);
      return new Link_events_places($link);
  }

  public function readById_place($id_place) {
      $q = $this->db->query("SELECT * FROM link_events_places WHERE id_place = :id_place");
	  $q->bindValue(':id_place', $id_place);
      $link = $q->fetch(\PDO::FETCH_ASSOC);
	  if ($link) {
		  return new Link_events_places($link);
	  }
	  else {
		  return NULL;
	  }
  }

  public function readById_event_place($id_event, $id_place) {
      $q = $this->db->prepare('SELECT * FROM link_events_places WHERE id_event = :id_event AND id_place = :id_place;');

      $q->bindValue(':id_event', $id_event);
      $q->bindValue(':id_place', $id_place);
      $q->execute();

      $link = $q->fetch(\PDO::FETCH_ASSOC);

      return $link ? True : False;
  }


  public function readAll() {
    $allLink = [];

    $q = $this->db->query('SELECT * FROM link_events_places');
    while ($data = $q->fetch(\PDO::FETCH_ASSOC)) {
     $allLink[$data['id']] = new Link_events_places($data);
    }
    return $allLink;
  }

  public function deleteById($id_event, $id_place) {
     $q = $this->db->prepare('DELETE FROM link_events_places WHERE id_event = :id_event AND id_place = :id_place;');

      $q->bindValue(':id_event', $id_event);
      $q->bindValue(':id_place', $id_place);
      $q->execute();
      return TRUE;
  }
}
