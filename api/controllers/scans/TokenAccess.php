<?php

	namespace controllers\scans;
    
    use \Config;
    use \vendor\jwt\src\JWT;
    use \models\UserManager;

class TokenAccess {

    protected $token;

    public function __construct() {
        $config = new Config();

        $headers = getallheaders();
        if($headers['Authorization']) {
        list($jwt) = sscanf($headers['Authorization'], 'Bearer %s');
            if ($jwt) {
                //echo($jwt);
                $this->token = JWT::decode($jwt, $config->getJwtKey(), array('HS512'));
            }
        }   
    }

    public function adminAccess($level) {
        $userManager = new UserManager();
        $user = $userManager->readById($this->token["id"]);
        if($user->getStatus() >= $level) {
            return TRUE;
        }
    }

    public function acompteAccess($id) {
        $userManager = new UserManager();
        $user = $userManager->readById($this->token->data->userId);
        if($user->getId() == $id) {
            echo "ok";
            return TRUE;
        }
    }

    public function moduleAccess($module_id, $event_id) {
    }
}