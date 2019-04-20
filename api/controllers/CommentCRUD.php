<?php

namespace controllers;

use \controllers\scans\ScanDataIn;
use \models\Comment;
use \models\CommentManager;


class CommentCRUD {

  public function add($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["content", "id_post", "id_user"]);
    $data = $scanDataIn->failleXSS($dataIn);
    $comment = new Comment($data);

    $commentManager = new CommentManager();
    $commentManager->add($comment);

    return TRUE;
  }

  public function update($dataIn) {
    $scanDataIn = new ScanDataIn();
    $data = $scanDataIn->failleXSS($dataIn);
    $commentManager = new CommentManager();
    $comment = $commentManager->readById($data["id"]);
    if($comment) {
      $comment->hydrate($data);
      $commentManager->update($comment);
    } else {
      throw new Exception("Le commentaire n'existe pas.");
    }
  }

   public function read($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["id"]);
    $data = $scanDataIn->failleXSS($dataIn);
    $commentManager = new CommentManager();
    $comment = $commentManager->readById($data["id"]);
    if($comment) {
      echo json_encode(array("content" => $post->GetContent(), "id_post" => $post->GetId_post(), "id_user" => $post->GetId_user(), "date_created" => $post->GetDate_created(), "date_edited" => $post->GetDate_edited()));
    } else {
      throw new Exception("Le commentaire n'existe pas.");
    }

  }

  public function delete($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["id"]);
    $data = $scanDataIn->failleXSS($dataIn);
    $commentManager = new CommentManager();
    $commentManager->deleteById($data["id"]);
    return TRUE;
  }
}