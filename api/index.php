<?php
// Page de routage de l'api

	require_once('Root.php');
	require_once("Autoloader.php");
	new Autoloader(); // Active le chargement automatique des classes.


try {
        $index = new Root(); //Redirige vers le routeur.

        //echo "Merci de spécifier une requête"; //Action par défaut si la requête n'est pas renseignée.

}

catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
