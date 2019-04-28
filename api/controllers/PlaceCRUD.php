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
		$placeManager->add($place);
		return TRUE;
	}

	public function update($dataIn) {
		$scanDataIn = new ScanDataIn();
        $data = $scanDataIn->failleXSS($dataIn);
		$placeManager = new PlaceManager();
		$place = $placeManager->readById($data["id"]);
		if($place) {
			$place->hydrate($data);
			$placeManager->update($place);
		} else {
			throw new Exception("Le lieu n'existe pas.");
		}
	}

	public function read($dataIn) {
		$scanDataIn = new ScanDataIn();
		$data = $scanDataIn->failleXSS($dataIn);
        $data = $scanDataIn->exists($data, ["id"]);
		$placeManager = new PlaceManager();
		$place = $placeManager->readById($data["id"]);
		if($place) {
			echo json_encode(array("name" => $place->GetName(), "postcode" => $place->GetPostcode(), "street" => $place->GetStreet(), "number" => $place->GetNumber(), "city" => $place->GetCity()));
		} else {
			throw new Exception("Le lieu n'existe pas.");
		}

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
