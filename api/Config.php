<?php

class Config {

    protected $jwtKey,
    $serverName;

    public function __construct() {
    	include "configVar.php";
		$this->jwtKey = $secretKey;
		$this->serverName = $ip;
    }

  	public function getJwtKey() {
    	return $this->jwtKey;
  	}

  	public function getServerName() {
    	return $this->serverName;
  	}
}