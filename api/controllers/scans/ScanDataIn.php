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
	
	function validateDate($date, $format = 'Y-m-d H:i:s')
	{
		$d = \DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) === $date;
	}

    public function orgenize(array $dataIn, $numberIn, array $keys) {
        $data = [];
        for ($i=0; $i < $numberIn; $i++) {
            if(!isset($dataIn[$i])) {
                throw new \Exception('Champ ' . $keys[$i] . ' manquant pour satisfaire la requête.');
            }
            $data[$keys[$i]] = $dataIn[$i];
        }
            return $data;
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
