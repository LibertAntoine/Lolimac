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
    $scanDataIn->exists($dataIn, ["firstname", "lastname", "pseudo", "pwd", "mail", "photo_url", "year_promotion"]);
    $data = $scanDataIn->failleXSS($dataIn);
    $data["pwd_hash"] = password_hash($data["pwd"], PASSWORD_DEFAULT);
    $user = new User($data);
    $userManager = new UserManager();
    if ($userManager->readByPseudo($user->getPseudo()) === FALSE) {
      $userManager->add($user);
    } else {
      throw new \Exception('Pseudo déjà existant.', 400);
    }
    echo json_encode([
            "message" => "User added.",
    ]);;
  }

  public function update($dataIn) {
    // TODO: vérifier les droits
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["id"]);
    $data = $scanDataIn->failleXSS($dataIn);
    $token = new TokenAccess();
    $token->acompteAccess($data["id"]);
    $userManager = new UserManager();
    if (isset($data['pwd'])) {
        $data['pwd_hash'] = password_hash($data["pwd"], PASSWORD_DEFAULT);
        unset($data['pwd']);
    }

    $user = $userManager->readById($data["id"]);
      if($user) {
                $user->hydrate($data);
        $userManager->update($user);
      } else {
        throw new Exception("L'utilisateur n'existe pas.", 400);
      }
    echo json_encode([
            "message" => "User updated.",
    ]);;
    }

  public function read($dataIn) {
    $scanDataIn = new ScanDataIn();
    $data = $scanDataIn->failleXSS($dataIn);
    $data = $scanDataIn->orgenize($data, 2, ["type", "id"]);
    $userManager = new UserManager();
    $user = $userManager->readById($data["id"]);
    if($user) {
        echo json_encode([
            "firstname" => $user->GetFirstname(),
            "lastname" => $user->GetLastname(),
            "pseudo" => $user->GetPseudo(),
            "photo_url" => $user->GetPhoto_url(),
            "status" => $user->GetStatus(),
            "phone" => $user->GetPhone(),
            "mail" => $user->GetMail(),
            "year_promotion" => $user->getYear_promotion()
        ]);
    } else {
      throw new Exception("L'utilisateur n'existe pas.", 400);
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
        echo json_encode([
            "message" => "User deleted.",
        ]);;
    }
  }

  public function auth($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["pseudo", "pwd"]);
    $data = $scanDataIn->failleXSS($dataIn);
    $userManager = new UserManager();
    $user = $userManager->readByPseudo($data["pseudo"]);
    if ($user == FALSE) {
        throw new \Exception("Le nom d'utilisateur est incorrect.", 401);
    } else {
        if(password_verify($data["pwd"], $user->getPwd_hash())) {
            $tokenCreater = new TokenCreater();
            $tokenCreater->createToken($user->GetId());
        } else {
          throw new \Exception("Le mot de passe est incorrect.", 401);
        }
    }
  }
}
