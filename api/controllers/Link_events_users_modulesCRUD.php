<?php

namespace controllers;

use \controllers\scans\ScanDataIn;
use \controllers\scans\TokenAccess;
use \controllers\scans\TokenCreater;
use \models\Link_events_users_modules;
use \models\Link_events_users_modulesManager;
use \models\UserManager;


class Link_events_users_modulesCRUD {

  public function add($id_event, $id_module) {
    $token = new TokenAccess();
    $id_user = $token->getId();
    $data["id_event"] = $id_event;
    $data["id_module"] = $id_module;
    $data["id_user"] = $id_user;
    $link = new Link_events_users_modules($data);
    $linkManager = new Link_events_users_modulesManager();
    if ($linkManager->readById_event_user_module($link->getId_event(), $link->getId_user(), $link->getId_module()) === FALSE) {
      $linkManager->add($link);
    } else {
      throw new \Exception('Lien déjà existant.');
    }
    echo \json_encode([
        'message' => 'Event joined.'
    ]);
    return TRUE;
  }

  public function readParticipation($id_event) {
    $token = new TokenAccess();
    $id_user = $token->getId();
    $linkManager = new Link_events_users_modulesManager();
    $link = $linkManager->readById_user_event($id_user, $id_event);
    if ($link != NULL) {
      return $link->getId_module();
    } else {
      return 0;
    }
  }

  public function readParticipants($id_event) {
    $linkManager = new Link_events_users_modulesManager();
    $listParticipants = $linkManager->readById_event($id_event);
    if ($listParticipants != NULL) {
      foreach ($listParticipants as $key => $value) {
        $userManager = new UserManager();
        $user = $userManager->readById($key);
        if ($user) {
            $participant = $user->toArray();
            $listParticipants[$key] = $participant;
            $listParticipants[$key]['participation'] = $value;
        }
        else {
            unset($listParticipants[$key]);
        }
      }
      return array_values($listParticipants);
    }
  }

  public function delete($id_event) {
    $token = new TokenAccess();
    $id_user = $token->getId();
    $linkManager = new Link_events_users_modulesManager();
    $linkManager->deleteById($id_event, $id_user);
    echo \json_encode([
        'message' => 'Event leaved.'
    ]);
    return TRUE;
  }
}
