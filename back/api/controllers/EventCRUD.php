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
use \models\Link_events_users_modules;
use \models\Link_events_users_modulesManager;
use \models\User;
use \models\UserManager;

class EventCRUD {

  public function add($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["title", "photo_url"]);
    $data = $scanDataIn->failleXSS($dataIn);
    unset($data['date_created']);
    $event = new Event($data);
    $eventManager = new EventManager();
    $event = $eventManager->add($event);
    $token = new TokenAccess();

    $link = new Link_events_users_modules([
        'id_event'=>$event->getId(),
        'id_module'=>1,
        'id_user'=>$token->getId()
    ]);
    $linkManager = new Link_events_users_modulesManager();
    $linkManager->add($link);

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

    echo \json_encode([
        'message' => 'New event added.',
        'id_user' => $token->getId(),
        'id_event' => $event->getId()
    ]);
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
    $NotificationCRUD->add($data);
    if (isset($data["place"])) {
        $placeCRUD = new PlaceCRUD();
        if(\is_array($data["place"])) { // NOTE: On ajoute un nouvel endroit
            $place = $placeCRUD->add($data["place"]);
        }
        else { // On lie à un autre endroit déjà existant
            $place = $placeCRUD->read_OBJ(['id' => $data['place']]);
        }
        $link_events_placesCRUD = new Link_events_placesCRUD();
        $link_events_places = $link_events_placesCRUD->deleteByIdEvent(['id_event'=>$event->getId()]);
        $link_events_placesCRUD->add(["id_event"=>$event->getId(), "id_place" => $place->getId()]);

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
       echo \json_encode([
        'message' => 'Event updated.',
    ]);
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
          echo json_encode(array_values($events));
      } else {
          echo \json_encode([]);
      }
  }

  public function search($dataIn) {
      $scanDataIn = new ScanDataIn();
      $data = $scanDataIn->failleXSS($dataIn);
      $scanDataIn->exists($dataIn, ["query"]);
      $full = [];
      $parts = [];
      $eventManager = new EventManager();
      $keywords = $scanDataIn->explodeSearchQuery($data['query']);
      $keywords = array_merge($keywords['full'], $keywords['words']);
      if (!empty($keywords)) {
          $events = $eventManager->search($keywords);
      }
      else $events = [];
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
          echo json_encode(array_values($events));
      } else {
          echo \json_encode([]);
      }

  }

  public function generateSingleEventICS($id_event) {
      $token = new TokenAccess();
      $scanDataIn = new ScanDataIn();
      $data = $scanDataIn->failleXSS(['id_event'=>$id_event]);
      $eventManager = new EventManager();
      $event = $eventManager->readById($data['id_event']);
      if ($event) {
          if ($event->getDate_start() && $event->getDate_end()) {
              $encryptionMethod = "AES-256-CBC";
              $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
              $iv = "6546445734219402";
              $token = "{$token->getId()}/{$data['id_event']}";
              $encrypted = openssl_encrypt($token, $encryptionMethod, $secretHash, $options=0, $iv);
              $url = "https://www.lolimac.fr/";
              echo \json_encode([
                 'url'=> "{$url}api/ics/{$encrypted}"
             ], $options = JSON_UNESCAPED_SLASHES);
          }
          else {
              throw new \Exception("Impossible de générer le lien iCalendar, l'événement n'est pas totalement prêt", 400);
          }
      }
      else {
          throw new \Exception("Evenement non existant", 400);
      }
  }

  public function generateAllEventICS() {
      $token = new TokenAccess();
      $scanDataIn = new ScanDataIn();
      $eventManager = new EventManager();
      $encryptionMethod = "AES-256-CBC";
      $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
      $userManager = new UserManager();
      $user = $userManager->readById($token->getId());
      $iv = "6546445734219402";
      $token = "{$user->getPseudo()}";
      $encrypted = openssl_encrypt($token, $encryptionMethod, $secretHash, $options=0, $iv);
      $url = "https://www.lolimac.fr/";
      echo \json_encode([
          'url'=>"{$url}lolimac-back/api/ics/all/{$encrypted}"
      ], $options = JSON_UNESCAPED_SLASHES);
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
    $listParticipants = $participantManager->readParticipants($event["id_event"]);
    $event['participants'] = $listParticipants;
    $link_events_placesCRUD = new Link_events_placesCRUD();
    $link_events_eventtypesCRUD = new Link_events_eventtypesCRUD();
    $place = $link_events_placesCRUD->readPlace_ARRAY(['id_event' => $event["id_event"]]);
    $event['place'] = $place;
    $type = $link_events_eventtypesCRUD->readType_ARRAY(['id_event' => $event["id_event"]]);
    $event['type'] = $type;
    $postCRUD = new PostCRUD();
    $posts = $postCRUD->read($data["id"]);
    $event['posts'] = $posts;
    echo json_encode($event);
  }

  public function readOBJ($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["id"]);
    $data = $scanDataIn->failleXSS($dataIn);
    $eventManager = new EventManager();
    $event = $eventManager->readById($data["id"]);
    return $event;
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
    echo json_encode(["message" => "Event deleted"]);
  }
}
