<?php

namespace controllers;

use \controllers\scans\ScanDataIn;
use \controllers\scans\TokenAccess;
use \controllers\scans\TokenCreater;
use \models\Event;
use \models\EventManager;


class EventCRUD {

  public function add($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["title", "photo_url", "description", "date_start", "date_end"]);
    #$scanDataIn->exists($dataIn, ["title", "photo_url", "date_start", "date_end"]);
    $data = $scanDataIn->failleXSS($dataIn);
    $event = new Event($data);

    $eventManager = new EventManager();
    $eventManager->add($event);
    return TRUE;
  }

  public function update($dataIn) {
    $scanDataIn = new ScanDataIn();
    $data = $scanDataIn->failleXSS($dataIn);
    $eventManager = new EventManager();
    $event = $eventManager->readById($data["id"]);
    if (empty($data["id"])) {
      throw new Exception("Merci de spécifier un événement!");
    }
    if($event) {
      $event->hydrate($data);
      $eventManager->update($event);
    } else {
      throw new Exception("L'événement n'existe pas.");
    }
  }

  public function read($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["id"]);
    $data = $scanDataIn->failleXSS($dataIn);
    $eventManager = new EventManager();
    $event = $eventManager->readById($data["id"]);
    if($event) {
      echo json_encode(array("title" => $event->GetTitle()));
    } else {
      throw new Exception("L'événement n'existe pas.");
    }

  }

  public function delete($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["id"]);
    $data = $scanDataIn->failleXSS($dataIn);
    $eventManager = new EventManager();
    $eventManager->deleteById($data["id"]);
    return TRUE;
  }
}
