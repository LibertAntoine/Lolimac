<?php

namespace models;

class CommentManager extends DBAccess {

	public function add(Comment $comment) {
		$q = $this->db->prepare("INSERT INTO comments
      (`content`, `date_created`, `date_edited`, `id_user`, `id_post`)
      VALUES (:content, NOW(), NOW(), :id_user, :id_post);");

    $q->bindValue(':content', $comment->getContent());
    $q->bindValue(':id_user', $comment->getId_user());
    $q->bindValue(':id_post', $comment->getId_post());

	  $q->execute();

    $comment->hydrate(['id' => $this->db->lastInsertId()]);
    return $comment;
  }

  public function count() {
    return $this->db->query("SELECT COUNT(*) FROM comments;")->fetchColumn();
  }

  public function readById($id) {
      $q = $this->db->query("SELECT * FROM comments WHERE id = {$id}");
      $comment = $q->fetch(\PDO::FETCH_ASSOC);
      $commentObject = new Comment($comment);
      if($commentObject) {
        return $commentObject;
      } else {
        throw new \Exception("Le commentaire n'existe pas.", 400);
      }
  }

  public function readByPost($id_post) {
    $allComment = [];

    $q = $this->db->query("SELECT * FROM comments
      WHERE id_post = {$id_post};");
    for($i = 0;$data = $q->fetch(\PDO::FETCH_ASSOC); $i++) {
     $allComments[$i] = new Comment($data);
    }
    if(!empty($allComments)) {
      return $allComments;
    }

  }

  public function update(Comment $comment) {
    $q = $this->db->prepare('UPDATE comments SET content = :content, date_edited = NOW(), id_user = :id_user , id_post = :id_post WHERE id = :id');

    $q->bindValue(':id', $comment->getId());
    $q->bindValue(':content', $comment->getContent());
    $q->bindValue(':id_user', $comment->getId_user());
    $q->bindValue(':id_post', $comment->getId_post());

    $q->execute();

    return $comment;
  }

  public function deleteById($id) {
    $this->db->exec('DELETE FROM comments WHERE id = '.$id.';');
    return TRUE;
  }

  public function deleteByIdPost($id_post) {
    $this->db->exec('DELETE FROM comments WHERE id_post = '.$id_post.';');
    return TRUE;
  }
}
