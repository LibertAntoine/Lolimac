<?php

	require_once('Root.php');
	require_once("Autoloader.php");
	new Autoloader();


try {
	$index = new Root();
}

catch(Exception $e) {
	http_response_code($e->getCode());
	echo json_encode([
				"code" => $e->getCode(),
				"message" => $e->getMessage()
				] );
}
