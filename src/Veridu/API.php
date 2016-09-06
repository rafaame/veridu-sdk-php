<?php

namespace Veridu;

use GuzzleHttp\Client;

final class API {

    const AUTH_MANAGEMENT = 'Management';
    const AUTH_USER = 'User';
    const AUTH_CREDENTIAL = 'Credential';

    /**
    * @var array API Credentials
    */
    private $credentials;

    /**
    * @var string API Version
    */
    private $version;

    /**
    * Namespace resolution for Endpoint classes (returns full namespaced class name)
    *
    * @param string $endpoint API Endpoint name
    *
    * @return string|null Full Class Name
    */
    private function classNameResolution($endpoint)
    {
        $endpoint = str_replace('/', '\\', $endpoint);

        return sprintf('\\Veridu\\Endpoint\\%s', $endpoint);
    }

    /**
    * Returns a new API instance
    *
    * @param array $credentials API Credentials
    * @param string $version API Version
    *
    * @return self
    */
    public static function factory($credentials, $version = '1.0')
    {
        return new API(
            $credentials,
            $version
        );
    }

    /**
    * Class constructor
    *
    * @param string $credentials API Credentials
    * @param string $version API Version
    *
    * @return void
    */
    public function __construct($credentials, $version)
    {
        $this->credentials = $credentials;
        $this->version = $version;
    }

    public function __call($method, $parameters) {
        switch ($method) {
            case 'companies':
                return (new EndpointResolver($this->credentials, $this->version))->resolve($method);

            default:
                return new EndpointResolver($this->credentials, $this->version, $method);
        }
    }
}