<?php

namespace controllers;

use \controllers\scans\ScanDataIn;
use \controllers\scans\TokenAccess;
use \controllers\scans\TokenCreater;
use \controllers\PlaceCRUD;
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

  public function readPlace_ARRAY($dataIn) {
      $scanDataIn = new ScanDataIn();
      $scanDataIn->exists($dataIn, ["id_event"]);
      $data = $scanDataIn->failleXSS($dataIn);
      $linkManager = new Link_events_placesManager();
      $link_events_places = $linkManager->readById_event($data["id_event"]);
      if ($link_events_places) {
          $placeCRUD = new PlaceCRUD();
          $place = $placeCRUD->read_OBJ(["id" => $link_events_places->getId_place()]);
          return $place->toArray();
      }
  }

  public function readPlace_OBJ($dataIn) {
        $scanDataIn = new ScanDataIn();
        $scanDataIn->exists($dataIn, ["id_event"]);
        $data = $scanDataIn->failleXSS($dataIn);
        $linkManager = new Link_events_placesManager();
        $link_events_places = $linkManager->readById_event($data["id_event"]);
        if ($link_events_places) {
            $placeCRUD = new PlaceCRUD();
            $place = $placeCRUD->read_OBJ(["id" => $link_events_places->getId_place()]);
            return $place;
        }
    }

  public function update($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["id_event", "id_place"]);
    $data = $scanDataIn->failleXSS($dataIn);
    $token = new TokenAccess();
    $linkManager = new Link_events_placesManager();
    $link = $linkManager->readById_event($data["id_event"]);
    if ($link) {
        $linkManager->updatePlace($link, $data["id_place"]);
    }
    else {
        self::add($dataIn);
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

  public function deleteByIdEvent($dataIn) {
      $scanDataIn = new ScanDataIn();
      $scanDataIn->exists($dataIn, ["id_event"]);
      $data = $scanDataIn->failleXSS($dataIn);
      $token = new TokenAccess();
      $linkManager = new Link_events_placesManager();
      $linkManager->deleteByIdEvent($data["id_event"]);
      return TRUE;
  }

}
