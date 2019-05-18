<?php

namespace models;

class PostManager extends DBAccess {
	public function add(Post $post) {
		$q = $this->db->prepare("INSERT INTO posts
      (`title`, `content`, `date_created`, `date_edited`,`id_user` ,`id_event`)
      VALUES (:title, :content, NOW(), NOW(), :id_user, :id_event);");

		$q->bindValue(':title', $post->getTitle());
    $q->bindValue(':content', $post->getContent());
    $q->bindValue(':id_user', $post->getId_user());
    $q->bindValue(':id_event', $post->getId_event());

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
      if($post != NULL) {
        return new Post($post);
      } else {
        throw new \Exception("La publication n'existe pas.", 400);
      }
  }

  public function readByIdEvent($id_event) {
      $q = $this->db->query('SELECT * FROM posts WHERE id_event = '.$id_event);
    for($i = 0; $data = $q->fetch(\PDO::FETCH_ASSOC); $i++) {
     $allPosts[$i] = new Post($data);
    }
	if (isset($allPosts)) {
		return $allPosts;
	}
	else return NULL;
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

  public function update(Post $post) {
    $q = $this->db->prepare('UPDATE posts SET  title = :title, content = :content, date_edited = NOW(), id_user = :id_user, id_event = :id_event WHERE id = :id');

    $q->bindValue(':id', $post->getId());
    $q->bindValue(':title', $post->getTitle());
    $q->bindValue(':content', $post->getContent());
    $q->bindValue(':id_user', $post->getId_user());
    $q->bindValue(':id_event', $post->getId_event());

    $q->execute();

    return $post;
  }

  public function deleteById($id) {
    $this->db->exec('DELETE FROM posts WHERE id = '.$id.';');
    return TRUE;
  }
}
