<?php

namespace models;

class ModuleManager extends DBAccess {
	public function add(Module $module) {
		$q = $this->db->prepare("INSERT INTO modules 
      (`name`) 
      VALUES (:name);");

		$q->bindValue(':name', $module->getName());

	  $q->execute();

    $module->hydrate(['id' => $this->db->lastInsertId()]);
    return $module;
  }

  public function count() {
    return $this->db->query('SELECT COUNT(*) FROM modules;')->fetchColumn();
  }

  public function readById($id) {
      $q = $this->db->query('SELECT * FROM modules WHERE id = '.$id);
      $module = $q->fetch(\PDO::FETCH_ASSOC);

      $moduleObj = new Module($module);
      if($moduleObj) {
        return $moduleObj;
      } else {
        throw new \Exception("Le module n'existe pas.", 400);
      }
  }

  public function readByName($name) {
      $q = $this->db->prepare('SELECT * FROM modules WHERE name = :name');
      $q->execute([':name' => $name]);
      $module = $q->fetch(\PDO::FETCH_ASSOC); 
      return ($module) ? new Module($module) : false;
  }

  public function readAll() {
    $allModules = [];
    
    $q = $this->db->query('SELECT * FROM modules');
    while ($data = $q->fetch(\PDO::FETCH_ASSOC)) {
     $allModules[$data['id']] = new Module($data);
    }
    return $allModules;
  }

  public function update(Module $module) {
    $q = $this->db->prepare('UPDATE modules SET name = :name WHERE id = :id');

    $q->bindValue(':id', $module->getId());
    $q->bindValue(':name', $module->getName());

    $q->execute();

    return $module;
  }

  public function deleteById($id) {
    $this->db->exec('DELETE FROM modules WHERE id = '.$id.';');
    return TRUE;
  }
}
