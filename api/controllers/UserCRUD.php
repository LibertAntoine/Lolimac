<?php

namespace controllers;

use \controllers\scans\ScanDataIn;
use \controllers\scans\TokenAccess;
use \controllers\scans\TokenCreater;
use \models\User;
use \models\UserManager;


class UserCRUD {

  public function add($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["firstname", "lastname", "pseudo", "pwd", "mail", "phone", "photo_url", "year_promotion"]);
    $data = $scanDataIn->failleXSS($dataIn);
    // restriction à voir
    $data["pwd_hash"] = password_hash($data["pwd"], PASSWORD_DEFAULT);
    $user = new User($data);
    $userManager = new UserManager();
    if ($userManager->readByPseudo($user->getPseudo()) === FALSE) {
      $userManager->add($user);
    } else {
      throw new \Exception('Pseudo déjà existant.');
    }
    return TRUE;
  }

  public function update($dataIn) {
    // TODO: vérifier les droits
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["id"]);
    $data = $scanDataIn->failleXSS($dataIn);
    $token = new TokenAccess();
    $token->acompteAccess($data["id"]) 
    $userManager = new UserManager();
    $user = $userManager->readById($data["id"]);
      if($user) {
        $user->hydrate($data);
        $userManager->update($user);
      } else {
        throw new Exception("L'utilisateur n'existe pas.");
      }
    }
  }

  public function read($dataIn) {
    $scanDataIn = new ScanDataIn();
    $data = $scanDataIn->failleXSS($dataIn);
    $data = $scanDataIn->orgenize($data, 2, ["type", "id"]);
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
    $token = new TokenAccess();
    if($token->acompteAccess($data["id"]) OR $token->adminAccess(1)) {
        $userManager = new UserManager();
        $userManager->deleteById($data["id"]);
        return TRUE;
    }
  }

  public function auth($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["pseudo", "pwd"]);
    $data = $scanDataIn->failleXSS($dataIn);
    $userManager = new UserManager();
    $user = $userManager->readByPseudo($data["pseudo"]);
    if(password_verify($data["pwd"], $user->getPwd_hash())) {
        $tokenCreater = new TokenCreater();
        $tokenCreater->createToken($user->GetId());
    } else {
      throw new \Exception("Le pseudo ou mot de passe est incorrect.");
    }
  }
}
