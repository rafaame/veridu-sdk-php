<?php

namespace Veridu\Endpoint;

use Veridu\API;

final class Companies extends AbstractEndpoint {
	public function getRoute($params = [], $id = null) {
		$route = 'companies';

		if ($id !== null) {
			$route .= '/' . $id;
		}

		return $route;
	}

	public function __construct($credentials, $version) {
		parent::__construct($credentials, $version);

		$this->setAuthMethod(API::AUTH_MANAGEMENT);
	}
}