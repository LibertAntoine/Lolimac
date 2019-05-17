<?php

namespace models;

class NotificationManager extends DBAccess {
	public function add(Notification $notification) {
		$q = $this->db->prepare("INSERT INTO notification_events
			(`date_edit`, `id_event`, `type_edit`, `info_edit`)
      VALUES (NOW(), :id_event, :type, :info);");

	$q->bindValue(':id_event', $notification->getId_event());
    $q->bindValue(':type', $notification->getType_edit());
    $q->bindValue(':info_edit', $notification->getInfo_edit());

	$q->execute();

    $post->hydrate(['id' => $this->db->lastInsertId()]);

    return $notification;
  }
}
