<?php

	require_once('Root.php');
	require_once("Autoloader.php");
	new Autoloader();


try {
	$index = new Root();
}

catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
