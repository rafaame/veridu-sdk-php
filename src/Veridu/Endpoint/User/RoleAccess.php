<?php

namespace Veridu\Endpoint\User;

use Veridu\Endpoint\AbstractEndpoint;
use Veridu\API;
use Veridu\Exception;

final class RoleAccess extends AbstractEndpoint {
	public function getRoute($params = [], $id = null) {
		$route = 'access/roles';

		if ($id !== null) {
			$route .= '/' . $id;
		}

		return $route;
	}

	public function __construct($credentials, $version) {
		parent::__construct($credentials, $version);

		$this->setAuthMethod(API::AUTH_USER);
	}
}