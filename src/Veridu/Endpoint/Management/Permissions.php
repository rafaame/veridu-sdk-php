<?php

namespace Veridu\Endpoint\Management;

use Veridu\Endpoint\AbstractEndpoint;
use Veridu\API;
use Veridu\Exception;

final class Permissions extends AbstractEndpoint {
	public function getRoute($params = [], $id = null) {
		$route = sprintf('companies/%s/permissions', array_pop($params));

		if ($id !== null) {
			$route .= '/' . $id;
		}

		return $route;
	}

	public function __construct($credentials, $version) {
		parent::__construct($credentials, $version);

		$this->setAuthMethod(API::AUTH_MANAGEMENT);
	}

	public function update($id, $data, ... $params) {
		throw new Exception\ActionNotExists();
	}
}