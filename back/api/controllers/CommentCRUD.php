<?php

namespace controllers;

use \controllers\scans\ScanDataIn;
use \models\Comment;
use \models\CommentManager;
use \models\PostManager;
use \controllers\scans\TokenAccess;
use \controllers\Link_events_users_modulesCRUD;

class CommentCRUD {

  public function add($dataIn, $id_event) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["content", "id_post"]);
    $data = $scanDataIn->failleXSS($dataIn);
    $token = new TokenAccess();
    $data['id_user'] = $token->getId();
    $postManager = new PostManager();
    $postManager->readById($data["id_post"]);
    $participantManager = new Link_events_users_modulesCRUD();
    $participation = $participantManager->readParticipation($id_event);
    if($participation != 0) {
      $comment = new Comment($data);
      $commentManager = new CommentManager();
      $commentManager->add($comment);
    } else {
      throw new \Exception('Vous n\'etes pas autorisé à publier sur cette event.', 400);
    }
    echo \json_encode([
        'message' => 'Comment added.'
    ]);
    return TRUE;
  }

  public function update($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["id"]);
    $data = $scanDataIn->failleXSS($dataIn);
    $commentManager = new CommentManager();
    $comment = $commentManager->readById($data["id"]);
    $comment->hydrate($data);
    $token = new TokenAccess();
    $token->acompteAccess($comment->getId_user());
    $commentManager->update($comment);
    echo \json_encode([
        'message' => 'Comment updated.'
    ]);
  }

   public function read($dataIn) {
    $scanDataIn = new ScanDataIn();
    $data = $scanDataIn->failleXSS($dataIn);
    $data = $scanDataIn->orgenize($data, 2 ,["user", "id"]);
    $commentManager = new CommentManager();
    $comment = $commentManager->readById($data["id"]);
    echo json_encode(array("content" => $comment->GetContent(), "id_post" => $comment->GetId_post(), "id_user" => $comment->GetId_user(), "date_created" => $comment->GetDate_created(), "date_edited" => $comment->GetDate_edited()));
  }

  public function delete($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["id"]);
    $data = $scanDataIn->failleXSS($dataIn);
    $commentManager = new CommentManager();
    $comment = $commentManager->readById($data["id"]);
    $comment->hydrate($data);
    $token = new TokenAccess();
    $token->acompteAccess($comment->getId_user());
    $commentManager->deleteById($data["id"]);
    return TRUE;
  }
}