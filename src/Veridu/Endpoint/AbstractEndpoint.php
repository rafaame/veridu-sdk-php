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

    public function listAll(... $params) {
    	return $this->client->get($this->getRoute($params), [], $this->requiredHeaders());
    }

    public function getOne($id, ... $params) {
        return $this->client->get($this->getRoute($params, $id), [], $this->requiredHeaders());
    }

    public function create($data, ... $params) {
        return $this->client->post($this->getRoute($params), $data, $this->requiredHeaders());
    }

    public function update($id, $data, ... $params) {
        return $this->client->put($this->getRoute($params, $id), $data, $this->requiredHeaders());
    }

    public function delete($id, ... $params) {
        return $this->client->delete($this->getRoute($params, $id), [], $this->requiredHeaders());
    }

    public function deleteAll(... $params) {
        return $this->client->delete($this->getRoute($params), [], $this->requiredHeaders());
    }
}