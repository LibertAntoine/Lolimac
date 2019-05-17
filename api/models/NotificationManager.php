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

  public function readAll($id_user) {
	 $q = $this->db->prepare("SELECT notification_events.id, notification_events.id_event, notification_events.type_edit, notification_events.date_edit FROM notification_events INNER JOIN link_events_users_modules ON link_events_users_modules.id_event = notification_events.id_event  INNER JOIN users ON users.id = link_events_users_modules.id_user  WHERE link_events_users_modules.id_user = :id_user  AND notification_events.date_edit >= users.date_notification_check;");
	 $q->bindValue(':id_user', $id_user);

	 $q->execute();
	 while ($data = $q->fetch(\PDO::FETCH_ASSOC)) {
		 $allNotifications[$data['id']] = new Notification($data);
	 }
	 return $allNotifications;
 }
}
