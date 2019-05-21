<?php

    use \controllers\UserCRUD;
    use \controllers\PlaceCRUD;
    use \controllers\EventCRUD;
    use \controllers\PostCRUD;
    use \controllers\IcsCRUD;
    use \controllers\CommentCRUD;
    use \controllers\ModuleCRUD;
    use \controllers\Link_events_users_modulesCRUD;
    use \controllers\NotificationCRUD;
    use \controllers\Link_events_placesCRUD;
    use \controllers\scans\ScanDataIn;
    use \controllers\scans\CutURL;


class Root {

    protected $root;

    function __construct() {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS, HEAD');
        header('Access-Control-Allow-Headers: Content-Type, Origin, Accept, Authorization, Content-Length, X-Requested-With');
        header('Content-Type: application/json; charset=UTF-8');

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
                $userCRUD = new UserCRUD();
                $userCRUD->read($this->root);
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
                $userCRUD = new UserCRUD();
                $_DELETE['id'] = $this->root[1];
                $userCRUD->delete($_DELETE);
                break;

            default:
                break;
        }
    }

    public function me() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                if (isset($this->root[1]) && $this->root[1] == "notifications") {
                    $notificationsCRUD = new NotificationCRUD();
                    if (isset($this->root[2]) && $this->root[2] == "count") {
                        $notificationsCRUD->count();
                    }
                    else {
                        $notificationsCRUD->read();
                    }
                }
                break;
        }
    }

    public function ics() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (isset($this->root[1])) {
                $icsCRUD = new IcsCRUD();
                if ($this->root[1] == "all") {
                    if (isset($this->root[2])) {
                        $icsCRUD->readAll($this->root[2]);
                    }
                }
                else {
                    $icsCRUD->readOne($this->root[1]);
                }
            }
        }
    }

    public function events() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $eventCRUD = new EventCRUD();
                $_GET;
                //print_r($this->root);
                if (isset($this->root[1])) {
                    if ($this->root[1] == "export") {
                        if (isset($this->root[2])) {
                            $eventCRUD->generateSingleEventICS($this->root[2]);
                        } else {
                            $eventCRUD->generateAllEventICS();
                        }
                    }
                    elseif ($this->root[1] == "search") {
                        $_GET['query'] = $_GET['q'];
                        $eventCRUD->search($_GET);
                    }
                     else if (empty($this->root[2])) {
                        $_GET["id"] = $this->root[1];
                        // We read one specific event
                        $eventCRUD->read($_GET);
                    }
                }
                else {
                    $eventCRUD->readMultiple($_GET);
                    //$eventCRUD->readOffsetLimit($_GET);
                }
                break;

            case 'POST':
                $_POST = json_decode(file_get_contents("php://input"), TRUE);
                if(isset($this->root[2])) {
                    if($this->root[2] == "posts") {
                        if(isset($this->root[4])) {
                            if($this->root[4] == "comments") {
                                $commentCRUD = new CommentCRUD();
                                $_POST["id_post"] = $this->root[3];
                                $commentCRUD->add($_POST, $this->root[1]);
                            }
                        } else {
                            $postCRUD = new PostCRUD();
                            $_POST["id_event"] = $this->root[1];
                            $postCRUD->add($_POST);
                        }
                    } else if ($this->root[2] == "join") {
                        $linkCRUD = new Link_events_users_modulesCRUD();
                        $linkCRUD->add($this->root[1], 2);
                    }
                } else {
                    $eventCRUD = new EventCRUD();
                    $eventCRUD->add($_POST);
                }


                break;

            case 'PATCH':
                $_PUT = json_decode(file_get_contents("php://input"), TRUE);
                if(isset($this->root[2])) {
                    if($this->root[2] == "posts" && isset($this->root[3])) {
                        if(isset($this->root[4])) {
                            if($this->root[4] == "comments" && isset($this->root[5])) {
                                $commentCRUD = new CommentCRUD();
                                $_PUT["id"] = $this->root[5];
                                $commentCRUD->update($_PUT);
                            }
                        } else {
                            $postCRUD = new PostCRUD();
                            $_PUT['id'] = $this->root[3];
                            $postCRUD->update($_PUT);
                        }
                    }
                } else {
                    $idEvent = $this->root[1];
                    $_PUT["id"] = $idEvent;
                    $eventCRUD = new EventCRUD();
                    $eventCRUD->update($_PUT);
                }
                break;

            case 'DELETE':
                if(isset($this->root[2])) {
                    if(isset($this->root[2])) {
                        if ($this->root[2] == "leave") {
                            $linkCRUD = new Link_events_users_modulesCRUD();
                            $linkCRUD->delete($this->root[1]);
                        } else if ($this->root[2] == "posts" && isset($this->root[3])) {
                            if(isset($this->root[4])) {
                                if ($this->root[4] == "comments" && isset($this->root[5])) {
                                    $commentCRUD = new CommentCRUD();
                                    $_DELETE['id'] = $this->root[5];
                                    $commentCRUD->delete($_DELETE);
                                }
                            } else {
                                $postCRUD = new PostCRUD();
                                $_DELETE['id'] = $this->root[3];
                                $postCRUD->delete($_DELETE);
                            }
                        }
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
