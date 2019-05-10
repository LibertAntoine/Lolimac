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
		if($eventType) {
			$eventType->hydrate($data);
			$eventType = $eventTypeManager->update($eventType);
			return $eventType;
		} else {
			throw new Exception("Le type n'existe pas.");
		}
	}

	public function read($dataIn) {
		$scanDataIn = new ScanDataIn();
		$data = $scanDataIn->failleXSS($dataIn);
        $scanDataIn->exists($data, ["id"]);
		$eventTypeManager = new EventTypeManager();
		$eventType = $eventTypeManager->readById($data["id"]);
		if($eventType) {
			echo json_encode(array("name" => $eventType->GetName()));
		} else {
			throw new Exception("Le lieu n'existe pas.");
		}

	}

	public function read_OBJ($dataIn) {
		$scanDataIn = new ScanDataIn();
		$data = $scanDataIn->failleXSS($dataIn);
        $scanDataIn->exists($data, ["id"]);
		$eventTypeManager = new EventTypeManager();
		$eventType = $eventTypeManager->readById($data["id"]);
		if($eventType) {
			return $eventType;
		} else {
			throw new Exception("Le type n'existe pas.");
		}

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
