<?php

	namespace controllers;

  use \controllers\scans\ScanDataIn;
  use \models\Place;
  use \models\PlaceManager;


class PlaceCRUD {

	public function add($dataIn) {
		$scanDataIn = new ScanDataIn();
        //$scanDataIn->exists($dataIn, ["postcode", "street", "number", "city", "name"]);
        $data = $scanDataIn->failleXSS($dataIn);
		$place = new Place($data);

		$placeManager = new PlaceManager();
		$place = $placeManager->add($place);
		return $place;
	}

	public function update($dataIn) {
		$scanDataIn = new ScanDataIn();
        $data = $scanDataIn->failleXSS($dataIn);
		$placeManager = new PlaceManager();
		$place = $placeManager->readById($data["id"]);
		$place->hydrate($data);
		$place = $placeManager->update($place);
		return $place;
	}

	public function read($dataIn) {
		$scanDataIn = new ScanDataIn();
		$data = $scanDataIn->failleXSS($dataIn);
        $scanDataIn->exists($data, ["id"]);
		$placeManager = new PlaceManager();
		$place = $placeManager->readById($data["id"]);
		echo json_encode(array("name" => $place->GetName(), "postcode" => $place->GetPostcode(), "street" => $place->GetStreet(), "number" => $place->GetNumber(), "city" => $place->GetCity()));

	}

	public function read_OBJ($dataIn) {
		$scanDataIn = new ScanDataIn();
		$data = $scanDataIn->failleXSS($dataIn);
        $scanDataIn->exists($data, ["id"]);
		$placeManager = new PlaceManager();
		$place = $placeManager->readById($data["id"]);
		return $place;
	}

	public function delete($dataIn) {
		$scanDataIn = new ScanDataIn();
        $scanDataIn->exists($dataIn, ["id"]);
        $data = $scanDataIn->failleXSS($dataIn);
		$placeManager = new PlaceManager();
		$placeManager->deleteById($data["id"]);
		return TRUE;
	}
}
