<?php

    use \controllers\UserCRUD;
    use \controllers\PlaceCRUD;
    use \controllers\EventCRUD;
    use \controllers\PostCRUD;
    use \controllers\CommentCRUD;
    use \controllers\ModuleCRUD;
    use \controllers\Link_events_users_modulesCRUD;
    use \controllers\Link_events_placesCRUD;
    use \controllers\scans\ScanDataIn;
    use \controllers\scans\CutURL;


class Root {

    protected $root;

    function __construct() {
        header("Content-Type: application/json; charset=UTF-8");

        $CutURL = new CutURL($_SERVER["REQUEST_URI"]);
        $this->root = $CutURL->getURL_cut();
        $key = $this->root[0];
        if (!$key) {
            // Called if the user access /api without any other argument
            echo json_encode(
                [
                    "status" => "running",
                    "commit" => trim(shell_exec("git rev-parse HEAD"), "\n")
                ]
        );
        }
        else {
            $this->$key();
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = json_decode(file_get_contents("php://input"), TRUE);
            $userCRUD = new UserCRUD();
            $userCRUD->auth($_POST);
        }
    }

    public function users() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                if ($this->root[1] == "notifications"){
                    echo "notif";
                }
                else {
                    echo "infos user";
                    $userCRUD = new UserCRUD();
                    $userCRUD->read($this->root);
                }
                break;

            case 'POST':
                $_POST = json_decode(file_get_contents("php://input"), TRUE);
                $userCRUD = new UserCRUD();
                $userCRUD->add($_POST);
                break;

            case 'PATCH':
                $_PATCH = json_decode(file_get_contents("php://input"), TRUE);
                $userCRUD = new UserCRUD();
                $userCRUD->update($_PATCH);
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

    public function events() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $eventCRUD = new EventCRUD();
                $_GET;
                //print_r($this->root);
                if (isset($this->root[1])) {
                    $_GET["id"] = $this->root[1];
                    // We read one specific event
                    $eventCRUD->read($_GET);
                }
                else {
                    // TODO: afficher les 10 prochains ?
                    // TODO gérer le FROM et LIMIT GET?from=&limit
                    $eventCRUD->readMultiple($_GET);
                    //$eventCRUD->readOffsetLimit($_GET);
                }
                break;

            case 'POST':
                if(isset($this->root[2])) {
                    $linkCRUD = new Link_events_users_modulesCRUD();
                    if($this->root[2] == "join") {
                        $linkCRUD->add($this->root[1], "1");
                    }
                } else {
                    $_POST = json_decode(file_get_contents("php://input"), TRUE);
                    $eventCRUD = new EventCRUD();
                    $eventCRUD->add($_POST);
                }
        

                break;

            case 'PATCH':
                $idEvent = $this->root[1];
                $_PUT = json_decode(file_get_contents("php://input"), TRUE);
                $_PUT["id"] = $idEvent;
                $eventCRUD = new EventCRUD();
                $eventCRUD->update($_PUT);
                break;

            case 'DELETE':
                if(isset($this->root[2])) {
                    $linkCRUD = new Link_events_users_modulesCRUD();
                    if ($this->root[2] == "leave") {
                        $linkCRUD->delete($this->root[1]);
                    }
                } else {
                    $idEvent = $this->root[1];
                    $_DELETE["id"] = $idEvent;
                    $eventCRUD = new EventCRUD();
                    $eventCRUD->delete($_DELETE);
                }
                break;

            default:
                break;
        }
    }

    public function place() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $placeCRUD = new PlaceCRUD();
                $placeCRUD->read($this->root);
                break;

            case 'POST':
                $_POST = json_decode(file_get_contents("php://input"), TRUE);
                $placeCRUD = new PlaceCRUD();
                $placeCRUD->add($_POST);
                break;

            case 'PUT':
                $_PUT = json_decode(file_get_contents("php://input"), TRUE);
                $placeCRUD = new PlaceCRUD();
                $placeCRUD->update($_PUT);
                break;

            case 'DELETE':
                $_DELETE = json_decode(file_get_contents("php://input"), TRUE);
                $placeCRUD = new PlaceCRUD();
                $placeCRUD->delete($_DELETE);
                break;

            default:
                break;
        }
    }

    public function post() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $postCRUD = new PostCRUD();
                $postCRUD->read($this->root);
                break;

            case 'POST':
                $_POST = json_decode(file_get_contents("php://input"), TRUE);
                $postCRUD = new PostCRUD();
                $postCRUD->add($_POST);
                break;

            case 'PUT':
                $_PUT = json_decode(file_get_contents("php://input"), TRUE);
                $postCRUD = new PostCRUD();
                $postCRUD->update($_PUT);
                break;

            case 'DELETE':
                $_DELETE = json_decode(file_get_contents("php://input"), TRUE);
                $postCRUD = new PostCRUD();
                $postCRUD->delete($_DELETE);
                break;

            default:
                break;
        }
    }

    public function comment() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $commentCRUD = new CommentCRUD();
                $commentCRUD->read($this->root);
                break;

            case 'POST':
                $_POST = json_decode(file_get_contents("php://input"), TRUE);
                $commentCRUD = new CommentCRUD();
                $commentCRUD->add($_POST);
                break;

            case 'PUT':
                $_PUT = json_decode(file_get_contents("php://input"), TRUE);
                $commentCRUD = new CommentCRUD();
                $commentCRUD->update($_PUT);
                break;

            case 'DELETE':
                $_DELETE = json_decode(file_get_contents("php://input"), TRUE);
                $commentCRUD = new CommentCRUD();
                $commentCRUD->delete($_DELETE);
                break;

            default:
                break;
        }
    }

    public function module() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $moduleCRUD = new ink_events_users_modulesCRUD();
                $moduleCRUD->read($this->root);
                break;

            case 'POST':
                $_POST = json_decode(file_get_contents("php://input"), TRUE);
                $moduleCRUD = new ModuleCRUD();
                $moduleCRUD->add($_POST);
                break;

            case 'PUT':
                $_PUT = json_decode(file_get_contents("php://input"), TRUE);
                $moduleCRUD = new ModuleCRUD();
                $moduleCRUD->update($_PUT);
                break;

            case 'DELETE':
                $_DELETE = json_decode(file_get_contents("php://input"), TRUE);
                $moduleCRUD = new ModuleCRUD();
                $moduleCRUD->delete($_DELETE);
                break;

            default:
                break;
        }
    }

    public function linkEUM() {
        switch ($_SERVER['REQUEST_METHOD']) {

            case 'POST':
                $_POST = json_decode(file_get_contents("php://input"), TRUE);
                $linkCRUD = new Link_events_users_modulesCRUD();
                $linkCRUD->add($_POST);
                break;


            case 'DELETE':
                $_DELETE = json_decode(file_get_contents("php://input"), TRUE);
                $linkCRUD = new Link_events_users_modulesCRUD();
                $linkCRUD->delete($_DELETE);
                break;

            default:
                break;
        }
    }
}
