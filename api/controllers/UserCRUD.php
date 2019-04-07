<?php

	namespace controllers;

	use \controllers\scans\ScanDataIn;
    use \models\User;
    use \models\UserManager;


class UserCRUD {
	
	public function add($dataIn) {
		$scanDataIn = new ScanDataIn(); 
        $scanDataIn->exists($dataIn, ["firstname", "lastname", "pseudo", "pwd_hash", "mail", "phone", "photo_url", "status", "year_promotion"]);
        $data = $scanDataIn->failleXSS($dataIn);
        $data["pwd_hash"] = password_hash($data["pwd_hash"], PASSWORD_DEFAULT);
		$user = new User($data);

		$userManager = new UserManager();
		if (!$userManager->readByPseudo($user->getPseudo())) {
			$userManager->add($user);
		} else {
			throw new \Exception('Pseudo déjà existant.');
		}
		return TRUE;
	}

	public function update($dataIn) {
		$scanDataIn = new ScanDataIn();
        $data = $scanDataIn->failleXSS($dataIn);	
		$userManager = new UserManager();
		$user = $userManager->readById($data["id"]);
		if($user) {
			$user->hydrate($data);
			$userManager->update($user);
		} else {
			throw new Exception("L'utilisateur n'existe pas.");
		}
	}

	public function read($dataIn) {
		$scanDataIn = new ScanDataIn(); 
        $scanDataIn->exists($dataIn, ["id"]);
        $data = $scanDataIn->failleXSS($dataIn);
		$userManager = new UserManager();
		$user = $userManager->readById($data["id"]);
		if($user) {
			echo json_encode(array("firstname" => $user->GetFirstname(), "lastname" => $user->GetLastname(), "pseudo" => $user->GetPseudo()));
		} else {
			throw new Exception("L'utilisateur n'existe pas.");
		}

	}

	public function delete($dataIn) {
		$scanDataIn = new ScanDataIn(); 
        $scanDataIn->exists($dataIn, ["id"]);
        $data = $scanDataIn->failleXSS($dataIn);
		$userManager = new UserManager();
		$userManager->deleteById($data["id"]);
		return TRUE;
	}
}