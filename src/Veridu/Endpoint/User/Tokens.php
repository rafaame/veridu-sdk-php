<?php

namespace Veridu\Endpoint\User;

use Veridu\Endpoint\AbstractEndpoint;
use Veridu\API;
use Veridu\Exception;

final class Tokens extends AbstractEndpoint {
	public function getRoute($params = [], $id = null) {
		return 'token';
	}

	public function __construct($credentials, $version) {
		parent::__construct($credentials, $version);

		$this->setAuthMethod(API::AUTH_USER);
	}

	public function exchange() {
        return $this->client->post($this->getRoute(), [], $this->requiredHeaders());
    }

	public function listAll(... $params) {
		throw new Exception\ActionNotExists();
    }

    public function getOne($id, ... $params) {
    	throw new Exception\ActionNotExists();
    }

    public function create($data, ... $params) {
    	throw new Exception\ActionNotExists();
    }

    public function update($id, $data, ... $params) {
    	throw new Exception\ActionNotExists();
    }

    public function delete($id, ... $params) {
    	throw new Exception\ActionNotExists();
    }

    public function deleteAll(... $params) {
    	throw new Exception\ActionNotExists();
    }
}