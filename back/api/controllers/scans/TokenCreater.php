<?php

	namespace controllers\scans;

	use \Config;
	use \vendor\jwt\src\JWT;

class TokenCreater {

	public function createToken($id) {
			$config = new Config();

			/* NOTE: mcrypt_create_iv function was DEPRECATED in PHP 7.1.0, and REMOVED in PHP 7.2.0.
	        $tokenId = base64_encode(mcrypt_create_iv(32));*/
	        $tokenId = base64_encode(random_bytes(32));
	        $issuedAt = time();
	        $notBefore = $issuedAt + 10;
	        $expire = $notBefore + 10800;
	        $serverName = $config->getServerName();

	        $data = [
	        'iat'  => $issuedAt,
	        'jti'  => $tokenId,
	        'iss'  => $serverName,
	        'nbf'  => $notBefore,
	        'exp'  => $expire,
	        'data' => [
	            'userId'   => $id
	            ]
	        ];
	        $jwt = JWT::encode($data, $config->getJwtKey(),'HS512');
			$unencodedArray = [
				'jwt' => $jwt,
				'id_user'   => $id
			];
	        echo json_encode($unencodedArray);
	    }
}
