<?php

namespace Veridu\Endpoint;

use Veridu\API;
use Veridu\Common\HTTPClient;
use Veridu\Exception;

abstract class AbstractEndpoint implements EndpointInterface {

	/**
    * @var array API Credentials
    */
    protected $credentials;

    /**
    * @var string API Version
    */
    private $version;

    private $client;

    private $authMethod;

    public function __construct($credentials, $version) {
    	$this->credentials = $credentials;
    	$this->version = $version;
    	$this->client = new HTTPClient($version);
    }

    public function getAuthMethod() {
        return $this->authMethod;
    }

    public function setAuthMethod($authMethod) {
        switch($authMethod) {
            case API::AUTH_MANAGEMENT:
            case API::AUTH_USER:
            case API::AUTH_CREDENTIAL:

                $className = 'Veridu\\AuthorizationMethod\\' . $authMethod;
                $this->authMethod = new $className();
                
                break;

            default:
                throw new Exception\InvalidAuthMethod();
        }
    }

    protected function requiredHeaders() {
    	return ['Authorization' => $this->getAuthMethod()->authorizationHeader($this->credentials)];
    }

    public function listAll() {
    	return $this->client->get($this->getRoute(), [], $this->requiredHeaders());
    }
}