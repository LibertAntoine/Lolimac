<?php

namespace models;

class Link_events_users_modulesManager extends DBAccess {
	
  public function add(Link_events_users_modules $link) {
		$q = $this->db->prepare("INSERT INTO link_events_users_modules 
      (`id_event`, `id_user`, `id_module`) 
      VALUES (:id_event, :id_user, :id_module);");

		$q->bindValue(':id_event', $link->getId_event());
    $q->bindValue(':id_user', $link->getId_user());
    $q->bindValue(':id_module', $link->getId_module());

	  $q->execute();

    $link->hydrate(['id' => $this->db->lastInsertId()]);
    return $link;
  }

  public function count() {
    return $this->db->query('SELECT COUNT(*) FROM link_events_users_modules;')->fetchColumn();
  }

  public function readById_event($id_event) {
      $q = $this->db->query('SELECT * FROM link_events_users_modules WHERE id_event = '.$id_event);
      for($i = 0; $data = $q->fetch(\PDO::FETCH_ASSOC); $i++) {
          $allParticipants[$data["id_user"]] = $data["id_module"];
      }
      if(isset($allParticipants)) {
        return $allParticipants;
      } else {
        return NULL;
      }
    
  }

  public function readById_user_event($id_user, $id_event) {
      $q = $this->db->query('SELECT * FROM link_events_users_modules WHERE id_user = '. $id_user .' AND id_event = '. $id_event);
      $link = $q->fetch(\PDO::FETCH_ASSOC);
      if ($link != NULL) {
        return new Link_events_users_modules($link);
      } else {
        return NULL;
      }  
  }

  public function readById_user_module($id_user, $id_module) {
      $q = $this->db->query('SELECT * FROM link_events_users_modules WHERE id_user = '. $id_user .' AND id_module = '. $id_module);
      $link = $q->fetch(\PDO::FETCH_ASSOC);
      return new Link_events_users_modules($link);
  }

  public function readById_event_user_module($id_event, $id_user, $id_module) {
      $q = $this->db->prepare('SELECT * FROM link_events_users_modules WHERE id_event = :id_event AND id_user = :id_user AND id_module = :id_module;');

      $q->bindValue(':id_event', $id_event);
      $q->bindValue(':id_user', $id_user);
      $q->bindValue(':id_module', $id_module);
      $q->execute();

      $link = $q->fetch(\PDO::FETCH_ASSOC);

      return $link ? True : False;
  }


  public function readAll() {
    $allLink = [];
    
    $q = $this->db->query('SELECT * FROM link_events_users_modules');
    while ($data = $q->fetch(\PDO::FETCH_ASSOC)) {
     $allLink[$data['id']] = new Link_events_users_modules($data);
    }
    return $allLink;
  }

  public function deleteById($id_event, $id_user) {
     $q = $this->db->prepare('DELETE FROM link_events_users_modules WHERE id_event = :id_event AND id_user = :id_user');

      $q->bindValue(':id_event', $id_event);
      $q->bindValue(':id_user', $id_user);
      $q->execute();
      return TRUE;
  }
}