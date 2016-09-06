<?php

namespace Veridu\AuthorizationMethod;

use Veridu\Common\JWT as JWTHelper;

final class Credential implements AuthorizationMethodInterface {
	public function generateToken($credentials) {
        return JWTHelper::generateCompanyToken(
            $credentials['credentialPubKey'],
            $credentials['handlerPubKey'],
            $credentials['handlerPrivKey']
        );
    }

    public function authorizationHeader($credentials) {
    	return 'CredentialToken ' . $this->generateToken($credentials);
    }
}