<?php

namespace Veridu\Common;

use Veridu\Exception;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

final class HTTPClient {
	const BASE_URL = 'http://idos-api.veridu.local.rafaa.me';

    private $version;

    private $client;

    public function __construct($apiVersion) {
        $this->version = $apiVersion;
        $this->client = new Client([
                'connect_timeout' => 10,

                'headers' => [
                    'User-Agent' => sprintf(
                        'Veridu-PHP/%d (%s)',
                        $this->version,
                        PHP_VERSION
                    )
                ],

                'http_errors' => false,
                'timeout' => 10
            ]);
    }

    private function assembleUrl($route) {
        return implode('/', [self::BASE_URL, $this->version, $route]);
    }

    public function __call($method, $parameters) {
        $route = $parameters[0];
        $data = isset($parameters[1]) ? $parameters[1] : [];
        $headers = isset($parameters[2]) ? $parameters[2] : [];
        $options = ['headers' => $headers];

        switch(strtoupper($method)) {
            case 'GET':
                if (! empty($data)) {
                    $options['query'] = $data;
                }
                break;

            case 'POST':
            case 'PUT':
            case 'DELETE':
                if (! empty($data)) {
                    $options['form_params'] = $data;
                }
                break;

            default:
                throw new Exception\InvalidHttpMethod();
        }

        $response = $this->client->{strtolower($method)}($this->assembleUrl($route), $options);
        $json = json_decode((string) $response->getBody(), true);

        if ($json === null) {
            throw new Exception\InvalidHttpResponseFormat();
        }

        if (! isset($json['status'])) {
            throw new Exception\InvalidHttpResponse();
        }

        if ($json['status'] === false) {
            throw new Exception\APIError($json['error']['message']);
        }

        return $json['data'];
    }
}