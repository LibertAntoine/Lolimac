<?php

	namespace controllers\scans;

	use \Config;
	use \vendor\jwt\src\JWT;

class TokenCreater {

	public function createToken($id) {
			$config = new Config();

	        $tokenId = base64_encode(mcrypt_create_iv(32));
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
	        $unencodedArray = ['jwt' => $jwt];
	        echo json_encode($unencodedArray);
	    }
}