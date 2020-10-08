<?php

namespace controllers;

use \controllers\scans\ScanDataIn;
use \controllers\scans\TokenAccess;
use \controllers\parser\IcsParser;
use \controllers\EventCRUD;
use \controllers\Link_events_placesCRUD;
use \models\Event;
use \models\Link_events_places;
use \models\Place;
use \models\EventManager;
use \models\UserManager;

class IcsCRUD {
    public function readOne($dataIn) {
        $encryptionMethod = "AES-256-CBC";
        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
        $iv = "6546445734219402";
        $token = openssl_decrypt($dataIn, $encryptionMethod, $secretHash, $options=0, $iv);
        $data = \explode('/', $token);
        $data['id_user'] = $data[0];
        $data['id_event'] = $data[1];
        $eventCRUD = new EventCRUD();
        $event = $eventCRUD->readOBJ(['id' => $data['id_event']]);
        $IcsParser = new IcsParser();
        if ($event && $event->getDate_start() && $event->getDate_end()) {
            $IcsParser->openEvent();
            $IcsParser->setSUMMARY($event->getTitle());
            $IcsParser->setUID($event->getId());
            $IcsParser->setStatus();
            $IcsParser->setDate_start($event->getDate_start());
            $IcsParser->setDate_end($event->getDate_end());
            $IcsParser->setDate_timeStamp();
            $link_events_placesCRUD = new Link_events_placesCRUD();
            $place = $link_events_placesCRUD->readPlace_OBJ(['id_event' => $event->getId()]);
            if ($place) {
                $IcsParser->setLocation($place);
            }
            $IcsParser->closeEvent();
            $IcsParser->closeCalendar();

            $filename = urlencode($event->getTitle());

            header('Content-type: text/calendar; charset=utf-8');
            header("Content-Disposition: inline; filename=lolimac-{$filename}.ics");
            echo $IcsParser->ics;
            exit;
        }
        else {
            throw new \Exception("Impossible d'accéder à l'événement", 401);

        }
    }

    public function readAll($dataIn) {
        $scanDataIn = new ScanDataIn();
        $encryptionMethod = "AES-256-CBC";
        $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
        $iv = "6546445734219402";
        $token = openssl_decrypt($dataIn, $encryptionMethod, $secretHash, $options=0, $iv);
        $data['pseudo'] = $token;
        $data = $scanDataIn->failleXSS($data);
        $userManager = new UserManager();
        $user = $userManager->readByPseudo($data['pseudo']);
        if (!$user) {
            throw new \Exception("Accès refusé", 401);
        }

        $eventManager = new EventManager();
        $events = $eventManager->readAllValid();
        $IcsParser = new IcsParser();
        if ($events) {
            $link_events_placesCRUD = new Link_events_placesCRUD();
            foreach ($events as $key => $event) {
                $IcsParser->openEvent();
                $IcsParser->setSUMMARY($event->getTitle());
                $IcsParser->setUID($event->getId());
                $IcsParser->setStatus();
                $IcsParser->setDate_start($event->getDate_start());
                $IcsParser->setDate_end($event->getDate_end());
                $IcsParser->setDate_timeStamp();
                $place = $link_events_placesCRUD->readPlace_OBJ(['id_event' => $event->getId()]);
                if ($place) {
                    $IcsParser->setLocation($place);
                }
                $IcsParser->closeEvent();
            }
            $IcsParser->closeCalendar();

            header('Content-type: text/calendar; charset=utf-8');
            header('Content-Disposition: inline; filename=lolimac-calendar.ics');
            echo $IcsParser->ics;
            exit;

        }
    }
}
