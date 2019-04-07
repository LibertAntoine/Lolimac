<?php 

	namespace controllers\scans;

// Ensemble de méthode visant à effectuer des vérification sur des données entrantes dans l'api.



class ScanDataIn {

    public function exists(array $dataIn, array $champs) {
    	foreach ($champs as $champ) {
    		if(!isset($dataIn[$champ])) {
    			throw new \Exception('Champ ' . $champ . ' non inexistant.');
    	   }
        }
	}

	public function failleXSS(array $dataIn) {
    	foreach ($dataIn as $data) {
    		if(is_string($data)) {
    			$data = htmlspecialchars($data);
    		}
    	}
    	return $dataIn;
	}
}