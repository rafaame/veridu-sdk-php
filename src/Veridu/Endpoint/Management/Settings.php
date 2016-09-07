<?php

namespace Veridu\Endpoint\Management;

use Veridu\Endpoint\AbstractEndpoint;
use Veridu\API;
use Veridu\Exception;

final class Settings extends AbstractEndpoint {
	public function getRoute($params = [], $id = null) {
		$route = sprintf('companies/%s/settings', array_pop($params));

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