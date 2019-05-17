<?php

namespace models;

class PlaceManager extends DBAccess {
	public function add(Place $place) {
		$q = $this->db->prepare("INSERT INTO places
      (`postcode`, `street`, `number`, `city`, `name`)
      VALUES (:postcode, :street, :number, :city, :name);");

	  $q->bindValue(':postcode', $place->getPostcode());
	  $q->bindValue(':street', $place->getStreet());
	  $q->bindValue(':number', $place->getNumber());
	  $q->bindValue(':city', $place->getCity());
	  $q->bindValue(':name', $place->getName());

	  $q->execute();

    $place->hydrate(['id' => $this->db->lastInsertId()]);
    return $place;
  }

  public function count() {
    return $this->db->query('SELECT COUNT(*) FROM places;')->fetchColumn();
  }

  public function readById($id) {
      $q = $this->db->prepare("SELECT * FROM places WHERE id = :id;");
	  $q->bindValue(':id', $id);
	  $q->execute();
      $place = $q->fetch(\PDO::FETCH_ASSOC);
      if($place) {
        return new Place($place);
      } else {
        throw new \Exception("Le lieu de l'évenement n'existe pas.", 400);
      }
  }

  public function readByName($name) {
      $q = $this->db->prepare("SELECT * FROM places WHERE name = :name");
	  $q->bindValue(':name', $name);
      //$q->execute([':name' => $name]);
      $place = $q->fetch(\PDO::FETCH_ASSOC);
      return ($place) ? new Place($place) : false;
  }

  public function readAll() {
    $allPlaces = [];

    $q = $this->db->query("SELECT * FROM places");
    while ($data = $q->fetch(\PDO::FETCH_ASSOC)) {
     $allPlaces[$data['id']] = new Place($data);
    }
    return $allPlaces;
  }

  public function update(Place $place) {
    $q = $this->db->prepare('UPDATE places SET postcode = :postcode, street = :street, number = :number, city = :city, name = :name WHERE id = :id');

    $q->bindValue(':id', $place->getId());
    $q->bindValue(':postcode', $place->getPostcode());
    $q->bindValue(':street', $place->getStreet());
    $q->bindValue(':number', $place->getNumber());
    $q->bindValue(':city', $place->getCity());
    $q->bindValue(':name', $place->getName());

    $q->execute();

    return $place;
  }

  public function deleteById(int $id) {
    $q = $this->db->prepare("DELETE FROM places WHERE id = :id;");
    $q->bindValue(':id', $id);
    return $q->execute();
  }
}
