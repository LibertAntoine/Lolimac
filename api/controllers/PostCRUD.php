<?php

namespace controllers;

use \controllers\scans\ScanDataIn;
use \models\Post;
use \models\PostManager;


class PostCRUD {

  public function add($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["title", "content", "id_user", "id_event"]);
    $data = $scanDataIn->failleXSS($dataIn);
    $post = new Post($data);

    $postManager = new PostManager();
    if ($postManager->readByTitle($post->getTitle()) === FALSE) {
      $postManager->add($post);
    } else {
      throw new \Exception('Une publication possède déjà ce titre.');
    }
    return TRUE;
  }

  public function update($dataIn) {
    $scanDataIn = new ScanDataIn();
    $data = $scanDataIn->failleXSS($dataIn);
    $postManager = new PostManager();
    $post = $postManager->readById($data["id"]);
    if($post) {
      $post->hydrate($data);
      $postManager->update($post);
    } else {
      throw new Exception("La publication n'existe pas.");
    }
  }

  public function read($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["id"]);
    $data = $scanDataIn->failleXSS($dataIn);
    $postManager = new PostManager();
    $post = $postManager->readById($data["id"]);
    if($post) {
      echo json_encode(array("title" => $post->GetTitle(), "content" => $post->GetContent(), "id_event" => $post->GetId_event(), "date_created" => $post->GetDate_created(), "date_edited" => $post->GetDate_edited()));
    } else {
      throw new Exception("La publication n'existe pas.");
    }

  }

  public function delete($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["id"]);
    $data = $scanDataIn->failleXSS($dataIn);
    $postManager = new PostManager();
    $postManager->deleteById($data["id"]);
    return TRUE;
  }
}
