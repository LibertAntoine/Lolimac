<?php

namespace controllers;

use \controllers\scans\ScanDataIn;
use \controllers\scans\TokenAccess;
use \controllers\scans\TokenCreater;
use \models\Link_events_users_modules;
use \models\Link_events_users_modulesManager;


class Link_events_users_modulesCRUD {

  public function add($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["id_event", "id_user", "id_module"]);
    $data = $scanDataIn->failleXSS($dataIn);
    $link = new Link_events_users_modules($data);
    $linkManager = new Link_events_users_modulesManager();
    if ($linkManager->readById_event_user_module($link->getId_event(), $link->getId_user(), $link->getId_module()) === FALSE) {
      $linkManager->add($link);
    } else {
      throw new \Exception('Lien déjà existant.');
    }
    return TRUE;
  }

  public function delete($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["id_event", "id_user", "id_module"]);
    $data = $scanDataIn->failleXSS($dataIn);
    $token = new TokenAccess();
    $linkManager = new Link_events_users_modulesManager();
    $linkManager->deleteById($data["id_event"], $data["id_user"], $data["id_module"]);
    return TRUE;
  }
}