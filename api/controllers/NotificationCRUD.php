<?php

namespace controllers;

use \controllers\scans\ScanDataIn;
use \models\Notification;
use \models\NotificationManager;


class NotificationCRUD {

  public function add($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["id_event", "date_notification_check", "id_user", "id_event"]);
    $data = $scanDataIn->failleXSS($dataIn);
    // TODO: A faire.
  }
}
