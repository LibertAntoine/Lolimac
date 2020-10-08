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

  public function add($data) {
      $notificationManager = new NotificationManager();
      foreach ($data as $key => $value) {
          if ($key == 'id') continue;
          $notification = new Notification([
              "id_event" => $data['id'],
              'type_edit' => $key
          ]);
          $notificationManager->add($notification);
      }
  }

  public function read() {
      $token = new TokenAccess();
      $id_user = $token->getId();
      $userManager = new UserManager();
      $user = $userManager->readById($id_user);
      $notificationManager = new NotificationManager();
      $notifications = $notificationManager->readAll($id_user);
      if ($notifications) {
          $eventManager = new EventManager();
          foreach ($notifications as $key => $notification) {
              $notifications[$key] = $notification->toArray();
              $event = $eventManager->readById_noException($notification->getId_event());
              //var_dump($event);
              if ($event) {
                  $event = new Event($event);
                  $notifications[$key]["title"] = $event->getTitle();
                  $notifications[$key]["photo_url"] = $event->getPhoto_url();
              }
              else {
                  unset($notifications[$key]);
              }
          }
          $userManager->updateNotificationDate($id_user);
          $notifications = \array_values($notifications);
          echo json_encode([
              "events" => $notifications
          ]);
      }
      else {
          json_encode(['message'=>"Il n'y a pas de notifications"]);
      }
  }

  public function count() {
      $token = new TokenAccess();
      $id_user = $token->getId();
      $userManager = new UserManager();
      $user = $userManager->readById($id_user);
      $notificationManager = new NotificationManager();
      $notifications = $notificationManager->countNotifications($id_user);
      echo json_encode(["notifications" => $notifications]);
  }
}
