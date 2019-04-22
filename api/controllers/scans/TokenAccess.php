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
                $this->token = JWT::decode($jwt, $config->getJwtKey(), array('HS512'));
            }
        }   
    }

    public function adminAccess($level) {
        $userManager = new UserManager();
        $user = $userManager->readById($this->token->data->userId);
        if($user->getStatus() <= $level) {
            return TRUE;
        }
    }

    public function acompteAccess($id) {
        $userManager = new UserManager();
        $user = $userManager->readById($this->token->data->userId);
        if($user->getId() == $id) {
            return TRUE;
        }
    }

    public function moduleAccess($event_id, $module_id) {
    }
}