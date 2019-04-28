<?php

namespace controllers;

use \controllers\scans\ScanDataIn;
use \controllers\scans\TokenAccess;
use \controllers\scans\TokenCreater;
use \models\Link_events_places;
use \models\Link_events_placesManager;


class Link_events_placesCRUD {

  public function add($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["id_event", "id_place"]);
    $data = $scanDataIn->failleXSS($dataIn);
    $link = new Link_events_places($data);
    $linkManager = new Link_events_placesManager();
    if ($linkManager->readById_event_place($link->getId_event(), $link->getId_place()) === FALSE) {
      $linkManager->add($link);
    } else {
      throw new \Exception('Lien déjà existant.');
    }
    return TRUE;
  }

  public function delete($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["id_event", "id_place"]);
    $data = $scanDataIn->failleXSS($dataIn);
    $token = new TokenAccess();
    $linkManager = new Link_events_placesManager();
    $linkManager->deleteById($data["id_event"], $data["id_place"]);
    return TRUE;
  }
}
