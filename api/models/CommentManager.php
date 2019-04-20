<?php

namespace models;

class CommentManager extends DBAccess {

	public function add(Comment $comment) {
		$q = $this->db->prepare("INSERT INTO comments 
      (`content`, `date_created`, `date_edited`, 'id_user', `id_post`) 
      VALUES (:content, NOW(), NOW(), :id_user, :id_post);");
      
    $q->bindValue(':content', $comment->getContent());
    $q->bindValue(':id_user', $comment->getId_user());
    $q->bindValue(':id_post', $comment->getId_post());

	  $q->execute();

    $comment->hydrate(['id' => $this->db->lastInsertId()]);
    return $comment;
  }

  public function count() {
    return $this->db->query('SELECT COUNT(*) FROM comments;')->fetchColumn();
  }

  public function readById($id) {
      $q = $this->db->query('SELECT * FROM comments WHERE id = '.$id);
      $post = $q->fetch(\PDO::FETCH_ASSOC);
      return new Comment($comment);
  }

  public function readByPost($id_post) {
    $allComment = [];
    
    $q = $this->db->query('SELECT * FROM comments 
      WHERE id_post = '. $id_post .';');
    while ($data = $q->fetch(\PDO::FETCH_ASSOC)) {
     $allComments[$data['id']] = new Comment($data);
    }
    return $allComments;
  }

  public function update(Comment $comment) {
    $q = $this->db->prepare('UPDATE comments SET content = :content, date_edited = NOW(), id_user = :id_post ,id_post = :id_post WHERE id = :id');

    $q->bindValue(':id', $comment->getId());
    $q->bindValue(':content', $comment->getContent());
    $q->bindValue(':id_user', $comment->getId_user());
    $q->bindValue(':id_post', $comment->getId_post());

    $q->execute();

    return $comment;
  }



