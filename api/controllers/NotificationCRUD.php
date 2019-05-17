<?php

namespace controllers;

use \controllers\scans\ScanDataIn;
use \models\Notification;
use \models\NotificationManager;
use \models\User;
use \models\UserManager;
use \models\Event;
use \models\EventManager;
use \controllers\scans\TokenAccess;


class NotificationCRUD {

  public function add($dataIn) {
    // TODO: A faire.
  }

  public function read() {
      $token = new TokenAccess();
      $id_user = $token->getId();
      var_dump($id_user);
      $userManager = new UserManager();
      $user = $userManager->readById($id_user);
      $notificationManager = new NotificationManager();
      $notifications = $notificationManager->readAll($id_user);
      if ($notifications) {
          $eventManager = new EventManager();
          foreach ($notifications as $key => $notification) {
              //var_dump($notification);
              $notifications[$key] = $notification->toArray();
              $event = $eventManager->readById($notification->getId_event());
              $notifications[$key]["title"] = $event->getTitle();
              $notifications[$key]["photo_url"] = $event->getPhoto_url();
          }
          $notifications = \array_values($notifications);
          echo json_encode([
              "events" => $notifications
          ]);
      }
      else {
          throw new \Exception("Il n'y a pas de notifications");
      }
  }
}
