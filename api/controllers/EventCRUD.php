<?php

namespace controllers;

use \controllers\scans\ScanDataIn;
use \controllers\scans\TokenAccess;
use \controllers\scans\TokenCreater;
use \models\Event;
use \models\EventManager;
use \models\Link_events_places;
use \models\Link_events_eventtypes;
use \models\Place;
use \controllers\EventTypeCRUD;
use \controllers\NotificationCRUD;
use \controllers\Link_events_placesCRUD;
use \controllers\Link_events_eventtypesCRUD;
use \controllers\Link_events_users_modulesCRUD;

class EventCRUD {

  public function add($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["title", "photo_url"]);
    $data = $scanDataIn->failleXSS($dataIn);
    unset($data['date_created']);
    $event = new Event($data);
    $eventManager = new EventManager();
    $event = $eventManager->add($event);

    $participantManager = new Link_events_users_modulesCRUD();
    $participantManager->add($event->getId(), 1);
    if (isset($data["place"])) {
        $placeCRUD = new PlaceCRUD();
        if(\is_array($data["place"])) {
            $place = $placeCRUD->add($data["place"]);
        }
        else {
            $place = $placeCRUD->read_OBJ(['id' => $data['place']]);
        }
        $link_events_placesCRUD = new Link_events_placesCRUD();
        $link_events_placesCRUD->add(["id_event"=>$event->getId(), "id_place" => $place->getId()]);
    }

    if (isset($data['type'])) {
        $link_events_eventtypesCRUD = new Link_events_eventtypesCRUD();
        $eventTypeCRUD = new EventTypeCRUD();
        if (is_numeric($data['type'])) {
            $eventType = $eventTypeCRUD->read_OBJ(['id' => $data['type']]);
            $link_events_eventtypesCRUD->add(["id_event"=>$event->getId(), "id_type" => $eventType->getId()]);
        }
        else {
            $eventType = $eventTypeCRUD->add($data['type']);
            $link_events_eventtypesCRUD->add(["id_event"=>$event->getId(), "id_type" => $eventType->getId()]);
        }
    }
    return TRUE;
  }

  public function update($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["id"]);
    $data = $scanDataIn->failleXSS($dataIn);
    unset($data['date_created']); // NOTE: prevents user from modifying creation date
    $eventManager = new EventManager();
    $event = $eventManager->readById($data["id"]);
    $event->hydrate($data);
    $eventManager->update($event);

    $NotificationCRUD = new NotificationCRUD();
    $NotificationCRUD->add($dataIn);

    if (isset($data["place"])) {
        $placeCRUD = new PlaceCRUD();
        if(\is_array($data["place"])) { // NOTE: On ajoute un nouvel endroit
            $place = $placeCRUD->add($data["place"]);
        }
        if (isset($data['type'])) {
            $link_events_eventtypesCRUD = new Link_events_eventtypesCRUD();
            $eventTypeCRUD = new EventTypeCRUD();
            if (is_numeric($data['type'])) {
                $eventType = $eventTypeCRUD->read_OBJ(['id' => $data['type']]);
                $link_events_eventtypesCRUD->addIfNotExist(["id_event"=>$event->getId(), "id_type" => $eventType->getId()]);
            }
            else {
                $eventType = $eventTypeCRUD->add($data['type']);
                $link_events_eventtypesCRUD->addIfNotExist(["id_event"=>$event->getId(), "id_type" => $eventType->getId()]);
            }
        }
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
          $participantManager = new Link_events_users_modulesCRUD();
          $link_events_placesCRUD = new Link_events_placesCRUD();
          $link_events_eventtypesCRUD = new Link_events_eventtypesCRUD();
          foreach ($events as $key => $event) {
              $events[$key] = $event->toArray();
              $participation = $participantManager->readParticipation($event->getId());
              $events[$key]['participation'] = $participation;
              $place = $link_events_placesCRUD->readPlace_ARRAY(['id_event' => $events[$key]["id_event"]]);
              $events[$key]['place'] = $place;
              $type = $link_events_eventtypesCRUD->readType_ARRAY(['id_event' => $events[$key]["id_event"]]);
              $events[$key]['type'] = $type;
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
    $event = $event->toArray();
    $participantManager = new Link_events_users_modulesCRUD();
    $participation = $participantManager->readParticipation($event["id_event"]);
    $event['participation'] = $participation;
    $link_events_placesCRUD = new Link_events_placesCRUD();
    $link_events_eventtypesCRUD = new Link_events_eventtypesCRUD();
    $place = $link_events_placesCRUD->readPlace_ARRAY(['id_event' => $event["id_event"]]);
    $event['place'] = $place;
    $type = $link_events_eventtypesCRUD->readType_ARRAY(['id_event' => $event["id_event"]]);
    $event['type'] = $type;
    echo json_encode($event);
  }

  public function delete($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["id"]);
    $data = $scanDataIn->failleXSS($dataIn);
    $eventManager = new EventManager();
    $event = $eventManager->readById($data["id"]);
    $link_events_placesCRUD = new Link_events_placesCRUD();
    $link_events_eventtypesCRUD = new Link_events_eventtypesCRUD();
    $link_events_placesCRUD->deleteByIdEvent(['id_event'=>$event->getId()]);
    $link_events_placesCRUD->deleteByIdEvent(['id_event'=>$event->getId()]);
    $eventManager->deleteById($event->getId());
    echo json_encode(["message" => "Evenement supprimé"]);
  }
}
