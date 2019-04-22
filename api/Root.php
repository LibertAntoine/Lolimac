<?php

    use \controllers\UserCRUD;
    use \controllers\PlaceCRUD;
    use \controllers\PostCRUD;
    use \controllers\CommentCRUD;
    use \controllers\ModuleCRUD;
    use \controllers\scans\ScanDataIn;
    use \controllers\scans\CutURL;


class Root {

    protected $root;

    function __construct() {
        $CutURL = new CutURL($_SERVER["REQUEST_URI"]);
        $this->root = $CutURL->getURL_cut();
        $key = $this->root[0];
        $this->$key();
    }


    public function user() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $userCRUD = new UserCRUD();
                $userCRUD->read($this->root);
                break;

            case 'POST':
                $_POST = json_decode(file_get_contents("php://input"), TRUE);
                $userCRUD = new UserCRUD();
                if ($this->root[1] == "add") {
                    $userCRUD->add($_POST);
                } else if ($this->root[1] == "auth") {
                    $userCRUD->auth($_POST);
                }
                
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
                $moduleCRUD = new ModuleCRUD();
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
}
