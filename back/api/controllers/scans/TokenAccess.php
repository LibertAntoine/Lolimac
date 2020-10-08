<?php

	namespace controllers\scans;

    use \Config;
    use \vendor\jwt\src\JWT;
    use \models\UserManager;
    use \models\Link_events_users_modulesManager;

class TokenAccess {

    protected $token;

    public function __construct() {
        $config = new Config();

        $headers = getallheaders();
        if($headers['Authorization']) {
        list($jwt) = sscanf($headers['Authorization'], 'Bearer %s');
            if ($jwt) {
                $this->token = JWT::decode($jwt, $config->getJwtKey(), array('HS512'));
            } else {
                throw new \Exception('Absense d\'autorization', 401);
            }
        }
    }

    public function getId() {
        return $this->token->data->userId;
    }

    public function adminAccess($level) {
        $userManager = new UserManager();
        $user = $userManager->readById($this->token->data->userId);
        if($user->getStatus() <= $level) {
            return TRUE;
        } else {
            throw new \Exception('Droits utilisateur insuffisants', 400);
        }
    }

    public function acompteAccess($id) {
        $userManager = new UserManager();
        $user = $userManager->readById($this->token->data->userId);
        if($user->getId() == $id OR $this->adminAccess(1)) {
            return TRUE;
        } else {
            throw new \Exception('Droits d\'accès au compte restrint', 400);
        }
    }

    public function moduleAccess($event_id, $module_id) {
        $userManager = new UserManager();
        $user = $userManager->readById($this->token->data->userId);
        $linkManager = new Link_events_users_modulesManager();
        if($linkManager->readById_event_user_module($event_id, $user->getId(), $module_id)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
