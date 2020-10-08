<?php

namespace models;

class UserManager extends DBAccess {
	public function add(User $user) {
		$q = $this->db->prepare("INSERT INTO users
      (`firstname`, `lastname`, `pseudo`, `mail`, `phone`, `pwd_hash`, `photo_url`, `status`, `year_promotion`)
      VALUES (:firstname, :lastname, :pseudo, :mail, :phone, :pwd_hash, :photo_url, 3, :year_promotion);");

		$q->bindValue(':firstname', $user->getFirstname());
    $q->bindValue(':lastname', $user->getLastname());
    $q->bindValue(':pseudo', $user->getPseudo());
    $q->bindValue(':phone', $user->getPhone());
    $q->bindValue(':mail', $user->getMail());
    $q->bindValue(':pwd_hash', $user->getPwd_hash());
    $q->bindValue(':photo_url', $user->getPhoto_url());
    $q->bindValue(':year_promotion', $user->getYear_promotion());

	  $q->execute();

    $user->hydrate(['id' => $this->db->lastInsertId()]);
    return $user;
  }

  public function count() {
    return $this->db->query('SELECT COUNT(*) FROM users;')->fetchColumn();
  }

  public function readById($id) {
      $q = $this->db->query('SELECT * FROM users WHERE id = '.$id);
      $user = $q->fetch(\PDO::FETCH_ASSOC);
	  if ($user) {
		  return new User($user);
	  }
	  return NULL;
  }

  public function readByPseudo($pseudo) {
      $q = $this->db->prepare('SELECT * FROM users WHERE pseudo = :pseudo');
      $q->execute([':pseudo' => $pseudo]);
      $user = $q->fetch(\PDO::FETCH_ASSOC);
      return ($user) ? new User($user) : false;
  }

  public function readAll() {
    $allUsers = [];

    $q = $this->db->query('SELECT * FROM users');
    while ($data = $q->fetch(\PDO::FETCH_ASSOC)) {
     $allUsers[$data['id']] = new User($data);
    }
    return $allUsers;
  }

  public function update(User $user) {
    $q = $this->db->prepare('UPDATE users SET firstname = :firstname, lastname = :lastname, pseudo = :pseudo, mail = :mail, phone = :phone, pwd_hash = :pwd_hash, photo_url = :photo_url, status = :status, year_promotion = :year_promotion WHERE id = :id');

    $q->bindValue(':id', $user->getId());
    $q->bindValue(':firstname', $user->getFirstname());
    $q->bindValue(':lastname', $user->getLastname());
    $q->bindValue(':pseudo', $user->getPseudo());
    $q->bindValue(':mail', $user->getMail());
    $q->bindValue(':phone', $user->getPhone());
    $q->bindValue(':pwd_hash', $user->getPwd_hash());
    $q->bindValue(':photo_url', $user->getPhoto_url());
    $q->bindValue(':status', $user->getStatus());
    $q->bindValue(':year_promotion', $user->getYear_promotion());

    $q->execute();

    return $user;
  }

  public function updateNotificationDate($id_user) {
	  $q = $this->db->prepare('UPDATE users SET date_notification_check = NOW() WHERE id = :id_user;');
	  $q->bindValue(':id_user', $id_user);
	  $q->execute();
  }

  public function deleteById($id) {
    $this->db->exec("DELETE FROM users WHERE id = $id;");
    return TRUE;
  }
}
