<?php

namespace Veridu\Common;

final class JWT {
	/**
     * Generates a JWT.
     *
     * @param mixed  $subject
     * @param string $issuer
     * @param string $secret
     *
     * @return string
     */
    static private function generateToken($subject, $issuer, $secret) {
        $jwtSigner  = new \Lcobucci\JWT\Signer\Hmac\Sha256();
        $jwtBuilder = new \Lcobucci\JWT\Builder();

        $jwtBuilder->set('iss', $issuer);

        if (! empty($subject)) {
            $jwtBuilder->set('sub', $subject);
        }

        return (string) $jwtBuilder
            ->sign($jwtSigner, $secret)
            ->getToken();
    }

    static public function generateCompanyToken($username, $credentialPubKey, $companyPubKey, $companyPrivKey) {
    	return self::generateToken($credentialPubKey . ':'. $username, $companyPubKey, $companyPrivKey);
    }

    static public function generateUserToken($username, $credentialPubKey, $credentialPrivKey) {
    	return self::generateToken($username, $credentialPubKey, $credentialPrivKey);
    }

    static public function generateCredentialToken($credentialPubKey, $handlerPubKey, $handlerPrivKey) {
    	return self::generateToken($credentialPubKey, $handlerPubKey, $handlerPrivKey);
    }
}