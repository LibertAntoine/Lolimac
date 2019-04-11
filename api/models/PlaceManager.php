<?php

namespace models;

class PlaceManager extends DBAccess {
	public function add(Place $place) {
		$q = $this->db->prepare("INSERT INTO places 
      (`postcode`, `street`, `number`, `city`, `name`) 
      VALUES (:postcode, :street, :number, :city, :name);");
      
		$q->bindValue(':postcode', $user->getPostcode());
    $q->bindValue(':street', $user->getStreet());
    $q->bindValue(':number', $user->getNumber());
    $q->bindValue(':city', $user->getCity());
    $q->bindValue(':name', $user->getName());

	  $q->execute();

    $user->hydrate(['id' => $this->db->lastInsertId()]);
    return $user;
  }

  public function count() {
    return $this->db->query('SELECT COUNT(*) FROM places;')->fetchColumn();
  }

  public function readById($id) {
      $q = $this->db->query('SELECT * FROM places WHERE id = '.$id);
      $place = $q->fetch(\PDO::FETCH_ASSOC);
      return new Place($place);
  }

  public function readByName($name) {
      $q = $this->db->prepare('SELECT * FROM places WHERE name = :name');
      $q->execute([':name' => $name]);
      $place = $q->fetch(\PDO::FETCH_ASSOC); 
      return ($place) ? new Place($place) : false;
  }

  public function readAll() {
    $allPlaces = [];
    
    $q = $this->db->query('SELECT * FROM places');
    while ($data = $q->fetch(\PDO::FETCH_ASSOC)) {
     $allPlaces[$data['id']] = new Place($data);
    }
    return $allPlaces;
  }

  public function update(Place $place) {
    $q = $this->db->prepare('UPDATE places SET postcode = :postcode, street = :street, number = :number, city = :city, name = :name WHERE id = :id');

    $q->bindValue(':id', $user->getId());
    $q->bindValue(':postcode', $user->getPostcode());
    $q->bindValue(':street', $user->getStreet());
    $q->bindValue(':number', $user->getNumber());
    $q->bindValue(':city', $user->getCity());
    $q->bindValue(':name', $user->getName());

    $q->execute();

    return $place;
  }

  public function deleteById(int $id) {
    $this->db->exec('DELETE FROM places WHERE id = '.$id.';');
    return TRUE;
  }
}
