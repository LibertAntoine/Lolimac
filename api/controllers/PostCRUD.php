<?php

namespace controllers;

use \controllers\scans\ScanDataIn;
use \models\Post;
use \models\PostManager;
use \models\CommentManager;
use \controllers\scans\TokenAccess;
use \controllers\Link_events_users_modulesCRUD;
use \controllers\NotificationCRUD;


class PostCRUD {

  public function add($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["title", "content", "id_event"]);
    $data = $scanDataIn->failleXSS($dataIn);
    $token = new TokenAccess();
    $data['id_user'] = $token->getId();
    $post = new Post($data);
    $participantManager = new Link_events_users_modulesCRUD();
    $participation = $participantManager->readParticipation($post->getId_event());
    if($participation != 0) {
        $postManager = new PostManager();
        if ($postManager->readByTitle($post->getTitle()) === FALSE) {
        $postManager->add($post);
        } else {
           throw new \Exception('Une publication possède déjà ce titre.', 400);
        }
    } else {
      throw new \Exception('Vous n\'etes pas autorisé à publier sur cette event.', 400);
    }

    $NotificationCRUD = new NotificationCRUD();
    $NotificationCRUD->add([
        'id' => $data['id_event'],
        'post' => 'post'
    ]);
    return TRUE;
  }

  public function update($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["id"]);
    $data = $scanDataIn->failleXSS($dataIn);
    $postManager = new PostManager();
    $post = $postManager->readById($data["id"]);
    $post->hydrate($data);
    $token = new TokenAccess();
    $token->acompteAccess($post->getId_user());
    $postManager->update($post);
  }

  public function read($id_event) {
    $postManager = new PostManager();
    $posts = $postManager->readByIdEvent($id_event);
    if($posts) {
        $commentManager = new CommentManager();
        foreach ($posts as $key => $post) {
            $posts[$key] = $post->toArray();
            $comments = $commentManager->readByPost($post->getId());
            if ($comments) {
                foreach ($comments as $key => $comment) {
                    $comments[$key] = $comment->toArray();
                }
                $posts[$key]["comments"] = $comments;
            }
        }
        return $posts;
    }
  }

  public function delete($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["id"]);
    $data = $scanDataIn->failleXSS($dataIn);
    $postManager = new PostManager();
    $post = $postManager->readById($data["id"]);
    $post->hydrate($data);
    $token = new TokenAccess();
    $token->acompteAccess($post->getId_user());
    $commentManager = new CommentManager();
    $commentManager->deleteByIdPost($data["id"]);
    $postManager->deleteById($data["id"]);
    return TRUE;
  }
}
