<?php

namespace models;

class PostManager extends DBAccess {
	public function add(Post $post) {
		$q = $this->db->prepare("INSERT INTO posts 
      (`title`, `content`, `date_created`, `date_edited`, `id_event`) 
      VALUES (:title, :content, :date_created, :date_edited, :id_event);");
      
		$q->bindValue(':title', $user->getTitle());
    $q->bindValue(':content', $user->getContent());
    $q->bindValue(':date_created', $user->getDate_created());
    $q->bindValue(':date_edited', $user->getDate_edited());
    $q->bindValue(':id_event', $user->getId_event());

	  $q->execute();

    $post->hydrate(['id' => $this->db->lastInsertId()]);
    return $post;
  }

  public function count() {
    return $this->db->query('SELECT COUNT(*) FROM posts;')->fetchColumn();
  }

  public function readById($id) {
      $q = $this->db->query('SELECT * FROM posts WHERE id = '.$id);
      $post = $q->fetch(\PDO::FETCH_ASSOC);
      return new Post($post);
  }

  public function readByTitle($title) {
      $q = $this->db->prepare('SELECT * FROM posts WHERE title = :title');
      $q->execute([':title' => $title]);
      $title = $q->fetch(\PDO::FETCH_ASSOC); 
      return ($title) ? new Post($title) : false;
  }

  public function readAll() {
    $allPosts = [];
    
    $q = $this->db->query('SELECT * FROM posts');
    while ($data = $q->fetch(\PDO::FETCH_ASSOC)) {
     $allPosts[$data['id']] = new Post($data);
    }
    return $allPosts;
  }

  public function update(User $post) {
    $q = $this->db->prepare('UPDATE posts SET  title = :title, content = :content, date_created = :date_created, date_edited = :date_edited, id_event = :id-event WHERE id = :id');

    $q->bindValue(':id', $user->getId());
    $q->bindValue(':title', $user->getTitle());
    $q->bindValue(':content', $user->getContent());
    $q->bindValue(':date_created', $user->getDate_created());
    $q->bindValue(':date_edited', $user->getDate_edited());
    $q->bindValue(':id_event', $user->getId_event());

    $q->execute();

    return $post;
  }

  public function deleteById(int $id) {
    $this->db->exec('DELETE FROM posts WHERE id = '.$id.';');
    return TRUE;
  }
}