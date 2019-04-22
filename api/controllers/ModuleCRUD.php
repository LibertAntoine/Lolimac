<?php

namespace controllers;

use \controllers\scans\ScanDataIn;
use \controllers\scans\TokenAccess;
use \controllers\scans\TokenCreater;
use \models\Module;
use \models\ModuleManager;


class ModuleCRUD {

  public function add($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["name"]);
    $data = $scanDataIn->failleXSS($dataIn);
    $token = new TokenAccess();
    if($token->adminAccess(1)) {
      $module = new Module($data);
      $moduleManager = new ModuleManager();
      if ($moduleManager->readByName($module->getName()) === FALSE) {
        $moduleManager->add($module);
      } else {
        throw new \Exception('Nom de module déjà existant.');
      }
      return TRUE;
    }
  }

  public function update($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["id"]);
    $data = $scanDataIn->failleXSS($dataIn);
    $token = new TokenAccess();
    if($token->adminAccess(1)) {
      $moduleManager = new ModuleManager();
      $module = $moduleManager->readById($data["id"]);
      if($module) {
        $module->hydrate($data);
        $moduleManager->update($module);
      } else {
        throw new Exception("Le module n'existe pas.");
      }
    }
  }

  public function read($dataIn) {
    $scanDataIn = new ScanDataIn();
    $data = $scanDataIn->failleXSS($dataIn);
    $data = $scanDataIn->orgenize($data, 2, ["type", "id"]);
    $moduleManager = new ModuleManager();
    $module = $moduleManager->readById($data["id"]);
    if($module) {
      echo json_encode(array("name" => $module->GetName()));
    } else {
      throw new Exception("Le module n'existe pas.");
    }
  }

  public function delete($dataIn) {
    $scanDataIn = new ScanDataIn();
    $scanDataIn->exists($dataIn, ["id"]);
    $data = $scanDataIn->failleXSS($dataIn);
    $token = new TokenAccess();
    if($token->adminAccess(1)) {
        $moduleManager = new ModuleManager();
        $moduleManager->deleteById($data["id"]);
        return TRUE;
    }
  }
}