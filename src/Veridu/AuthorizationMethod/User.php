<?php

namespace Veridu\AuthorizationMethod;

use Veridu\Common\JWT as JWTHelper;

final class User implements AuthorizationMethodInterface {
	public function generateToken($credentials) {
        return JWTHelper::generateCompanyToken(
            $credentials['username'],
            $credentials['credentialPubKey'],
            $credentials['credentialPrivKey']
        );
    }

    public function authorizationHeader($credentials) {
    	return 'UserToken ' . $this->generateToken($credentials);
    }
}