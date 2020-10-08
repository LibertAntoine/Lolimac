<?php

namespace models;

class NotificationManager extends DBAccess {

  public function readAll($id_user) {
	 $q = $this->db->prepare("SELECT MAX(notification_events.id) AS id, notification_events.id_event, MAX(notification_events.date_edit) AS date_edit, notification_events.type_edit FROM notification_events INNER JOIN link_events_users_modules ON link_events_users_modules.id_event = notification_events.id_event INNER JOIN users ON users.id = link_events_users_modules.id_user WHERE link_events_users_modules.id_user = :id_user AND notification_events.date_edit >= users.date_notification_check GROUP BY notification_events.id_event, notification_events.type_edit ;");
	 $q->bindValue(':id_user', $id_user);

	 $q->execute();
	 while ($data = $q->fetch(\PDO::FETCH_ASSOC)) {
		 $allNotifications[$data['id']] = new Notification($data);
	 }
	if(isset($allNotifications)) {
	 		 return $allNotifications;
	} else {
		return NULL;
	}
 }
 public function add(Notification $notification){
	 $q = $this->db->prepare('INSERT INTO notification_events (id_event, type_edit, date_edit) VALUES (:id_event, :type_edit, NOW());');

	 $q->bindValue(':id_event', $notification->getId_event());
	 $q->bindValue(':type_edit', $notification->getType_edit());

	 $q->execute();
 }

 public function countNotifications($id_user) {
	$q = $this->db->prepare("SELECT COUNT(DISTINCT notification_events.type_edit ) AS Count FROM notification_events INNER JOIN link_events_users_modules ON link_events_users_modules.id_event = notification_events.id_event  INNER JOIN users ON users.id = link_events_users_modules.id_user  WHERE link_events_users_modules.id_user = :id_user  AND notification_events.date_edit >= users.date_notification_check;");

	$q->bindValue(':id_user', $id_user);
	$q->execute();

 	return $q->fetch(\PDO::FETCH_ASSOC)['Count'];
}
}
