<?php 

// Fichier de routage de l'api.

    use \controllers\UserCRUD;
    use \controllers\scans\ScanDataIn; // prise en concidérations des namespaces.


class Root {
    function __construct($action) {
        $this->$action(); 
    }


    public function user() {
        // verif de token à ajouter.
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $userCRUD = new UserCRUD();
                $userCRUD->read($_GET);
                break;

            case 'POST':
                $_POST = json_decode(file_get_contents("php://input"), TRUE);
                $userCRUD = new UserCRUD();
                $userCRUD->add($_POST);
                break;
            
            case 'PUT':
                $_PUT = json_decode(file_get_contents("php://input"), TRUE);
                $userCRUD = new UserCRUD();
                $userCRUD->update($_PUT);
                break;

            case 'DELETE':
                $_DELETE = json_decode(file_get_contents("php://input"), TRUE);
                $userCRUD = new UserCRUD();
                $userCRUD->delete($_DELETE);
                break;

            default:
                break;
        }
    }
}    