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
    $scanDataIn->exists($dataIn, ["title", "photo_url"]);
    $data = $scanDataIn->failleXSS($dataIn);
    // NOTE: User should not be able to give date_created in $scanDataIn
    // TODO: Remove if exist cate_created
    $event = new Event($data);

    $eventManager = new EventManager();
    $eventManager->add($event);
    return TRUE;
  }

  public function update($dataIn) {
    $scanDataIn = new ScanDataIn();
    $data = $scanDataIn->failleXSS($dataIn);
    // NOTE: User should not be able to give date_created in $scanDataIn
    // TODO: Remove if exist cate_created
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

  public function readAll() {
    $eventManager = new EventManager();
    $events = $eventManager->readAll();
    if($events) {
        foreach ($events as $key => $event) {
            $events[$key] = $event->toArray();
        }
      echo json_encode($events);
    } else {
      throw new Exception("L'événement n'existe pas.");
    }
  }

  public function readOffsetLimit($dataIn) {
      $scanDataIn = new ScanDataIn();
      $scanDataIn->exists($dataIn, ["offset", "limit"]);
      $data = $scanDataIn->failleXSS($dataIn);

      $eventManager = new EventManager();
      $events = $eventManager->readOffsetLimit($data["offset"], $data["limit"]);
      if($events) {
          foreach ($events as $key => $event) {
              $events[$key] = $event->toArray();
          }
          echo json_encode($events);
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
