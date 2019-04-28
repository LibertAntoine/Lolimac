<?php

namespace controllers;

use \controllers\scans\ScanDataIn;
use \controllers\scans\TokenAccess;
use \controllers\scans\TokenCreater;
use \models\Event;
use \models\EventManager;
use \models\Link_events_places;
use \models\Place;
use \models\PlaceManager;
use \models\Link_events_placesManager;
use \controllers\Link_events_placesCRUD;


class EventCRUD {

  public function add($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["title", "photo_url"]);
    $data = $scanDataIn->failleXSS($dataIn);
    // NOTE: User should not be able to give date_created in $scanDataIn
    // TODO: Remove if exist cate_created
    $event = new Event($data);

    $eventManager = new EventManager();
    $event = $eventManager->add($event);

    if (isset($data["place"])) {
        if(\is_array($data["place"])) {
            $place = new Place($data["place"]);
            $placeManager = new PlaceManager();
            $place = $placeManager->add($place);
        }
        else {
            $placeManager = new PlaceManager();
            $place = $placeManager->readById($data["place"]);
            if ($place == NULL) {
                throw new \Exception("Le lieu indiqué est inconnu");
            }
        }
        $link_events_placesCRUD = new Link_events_placesCRUD();
        $link_events_placesCRUD->add(["id_event"=>$event->getId(), "id_place" => $place->getId()]);

    }
    return TRUE;
  }

  public function update($dataIn) {
    $scanDataIn = new ScanDataIn();
    $data = $scanDataIn->failleXSS($dataIn);
    // NOTE: User should not be able to give date_created in $scanDataIn
    // TODO: Remove if exist cate_created
    $eventManager = new EventManager();
    $event = $eventManager->readById($data["id"]);
    // TODO: Place update - create new or edit
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

  public function readMultiple($dataIn) {
      $scanDataIn = new ScanDataIn();
      $data = $scanDataIn->failleXSS($dataIn);
      $eventManager = new EventManager();
      if (isset($data["limit"])) {
          if (empty($data["from"])) {
              $data["from"] = "0";
          }
          $events = $eventManager->readOffsetLimit($data["from"], $data["limit"]);
      }
      else {
          $events = $eventManager->readAll();
      }
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
      $scanDataIn->exists($dataIn, ["from", "limit"]);
      $data = $scanDataIn->failleXSS($dataIn);

      $eventManager = new EventManager();
      $events = $eventManager->readOffsetLimit($data["from"], $data["limit"]);
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
      echo json_encode($event->toArray());
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
