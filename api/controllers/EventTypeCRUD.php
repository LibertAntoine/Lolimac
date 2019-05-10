<?php

	namespace controllers;

  use \controllers\scans\ScanDataIn;
  use \models\EventType;
  use \models\EventTypeManager;


class EventTypeCRUD {

	public function add($dataIn) {
		$scanDataIn = new ScanDataIn();
        $data = $scanDataIn->failleXSS($dataIn);
		$scanDataIn->exists($dataIn, ['name']);
		$eventType = new EventType($data);

		$eventTypeManager = new EventTypeManager();
		$eventType = $eventTypeManager->add($eventType);
		return $eventType;
	}

	public function update($dataIn) {
		$scanDataIn = new ScanDataIn();
        $data = $scanDataIn->failleXSS($dataIn);
        $scanDataIn->exists($data, ["id_event"]);
		$eventTypeManager = new EventTypeManager();
		$eventType = $eventTypeManager->readById($data["id_event"]);
			$eventType->hydrate($data);
			$eventType = $eventTypeManager->update($eventType);
			return $eventType;
	}

	public function read($dataIn) {
		$scanDataIn = new ScanDataIn();
		$data = $scanDataIn->failleXSS($dataIn);
        $scanDataIn->exists($data, ["id"]);
		$eventTypeManager = new EventTypeManager();
		$eventType = $eventTypeManager->readById($data["id"]);
		echo json_encode(array("name" => $eventType->GetName()));
	}

	public function read_OBJ($dataIn) {
		$scanDataIn = new ScanDataIn();
		$data = $scanDataIn->failleXSS($dataIn);
        $scanDataIn->exists($data, ["id"]);
		$eventTypeManager = new EventTypeManager();
		$eventType = $eventTypeManager->readById($data["id"]);
		return $eventType;
	}

	public function delete($dataIn) {
		$scanDataIn = new ScanDataIn();
        $scanDataIn->exists($dataIn, ["id"]);
        $data = $scanDataIn->failleXSS($dataIn);
		$eventTypeManager = new EventTypeManager();
		$eventTypeManager->deleteById($data["id"]);
		return TRUE;
	}
}
