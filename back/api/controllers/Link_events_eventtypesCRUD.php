<?php

namespace controllers;

use \controllers\scans\ScanDataIn;
use \controllers\scans\TokenAccess;
use \controllers\scans\TokenCreater;
use \controllers\EventTypeCRUD;
use \models\Link_events_eventtypes;
use \models\Link_events_eventtypesManager;

class Link_events_eventtypesCRUD {

  public function add($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["id_event", "id_type"]);
    $data = $scanDataIn->failleXSS($dataIn);
    $link = new Link_events_eventtypes($data);
    $linkManager = new Link_events_eventtypesManager();
    if ($linkManager->readById_event_type($link->getId_event(), $link->getId_type()) === FALSE) {
      $linkManager->add($link);
    } else {
      throw new \Exception('Lien déjà existant.');
    }
    return TRUE;
  }

  public function readType_ARRAY($dataIn) {
      $scanDataIn = new ScanDataIn();
      $scanDataIn->exists($dataIn, ["id_event"]);
      $data = $scanDataIn->failleXSS($dataIn);
      $linkManager = new Link_events_eventtypesManager();
      $link_events_eventTypes = $linkManager->readById_event($data["id_event"]);
      if ($link_events_eventTypes) {
          $eventTypeCRUD = new EventTypeCRUD();
          $eventType = $eventTypeCRUD->read_OBJ(["id" => $link_events_eventTypes->getId_type()]);
          return $eventType->toArray();
      }
  }

  /*
  public function updateByIdEvent($dataIn) {
      $scanDataIn = new ScanDataIn();
      $data = $scanDataIn->failleXSS($dataIn);
      $scanDataIn->exists($data, ['id_event', 'id_type']);
      $linkManager = new Link_events_eventtypesManager();
      $link_events_eventTypes = $linkManager->readById_event($data["id_event"]);
      $link_events_eventTypes = $linkManager->updateType($data["id_event"]);
  }
  */

  public function readByIdEvent_OBJ($dataIn) {
      $scanDataIn = new ScanDataIn();
      $data = $scanDataIn->failleXSS($dataIn);
      $scanDataIn->exists($data, ["id_event"]);
      $linkManager = new Link_events_eventtypesManager();
      $link_events_eventTypes = $linkManager->readById_event($data["id_event"]);
      if($link_events_eventTypes) {
          return $link_events_eventTypes;
      } else {
          throw new Exception("Le type n'existe pas.");
      }

  }

  public function addIfNotExist($dataIn) {
    $scanDataIn = new ScanDataIn();
    $data = $scanDataIn->failleXSS($dataIn);
    $scanDataIn->exists($data, ['id_event', 'id_type']);
    $linkManager = new Link_events_eventtypesManager();
    $link_events_eventTypes = $linkManager->readById_event($data["id_event"]);
    if ($link_events_eventTypes) {
        $linkManager->updateType($link_events_eventTypes, $data['id_type']);
    }
    else {
        $link_events_eventTypes = new Link_events_eventtypes(['id_event' => $data['id_event'], 'id_type' => $data['id_type']]);
        $linkManager->add($link_events_eventTypes);
    }
  }

  public function delete($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["id_event", "id_type"]);
    $data = $scanDataIn->failleXSS($dataIn);
    $token = new TokenAccess();
    $linkManager = new Link_events_eventtypesManager();
    $linkManager->deleteById($data["id_event"], $data["id_type"]);
    return TRUE;
  }

  public function deleteByIdEvent($dataIn) {
      $scanDataIn = new ScanDataIn();
      $scanDataIn->exists($dataIn, ["id_event"]);
      $data = $scanDataIn->failleXSS($dataIn);
      $token = new TokenAccess();
      $linkManager = new Link_events_eventtypesManager();
      $linkManager->deleteByIdEvent($data["id_event"]);
      return TRUE;
  }
}
