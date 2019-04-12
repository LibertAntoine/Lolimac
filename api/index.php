<?php
// Page de routage de l'api

	require_once('Root.php');
	require_once("Autoloader.php");
	new Autoloader(); // Active le chargement automatique des classes.

try {
    if (isset($_GET['action'])) {
        $index = new Root($_GET['action']); //Redirige vers le routeur.
    } else {
        echo "Merci de spécifier une requête"; //Action par défaut si la requête n'est pas renseignée.
    }
}

catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
