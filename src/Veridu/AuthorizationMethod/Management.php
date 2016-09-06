<?php

namespace Veridu\AuthorizationMethod;

use Veridu\Common\JWT as JWTHelper;

final class Management implements AuthorizationMethodInterface {
	public function generateToken($credentials) {
        return JWTHelper::generateCompanyToken(
            $credentials['username'],
            $credentials['credentialPubKey'],
            $credentials['companyPubKey'],
            $credentials['companyPrivKey']
        );
    }

    public function authorizationHeader($credentials) {
    	return 'CompanyToken ' . $this->generateToken($credentials);
    }
}