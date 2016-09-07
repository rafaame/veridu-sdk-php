<?php

namespace Veridu\Endpoint\Credential;

use Veridu\Endpoint\AbstractEndpoint;
use Veridu\API;
use Veridu\Exception;

final class Normalised extends AbstractEndpoint {
	public function getRoute($params = [], $id = null) {
		$route = sprintf('profiles/%s/sources/%s/normalised', $params[0], $params[1]);

		if ($id !== null) {
			$route .= '/' . $id;
		}

		return $route;
	}

	public function __construct($credentials, $version) {
		parent::__construct($credentials, $version);

		$this->setAuthMethod(API::AUTH_CREDENTIAL);
	}
}