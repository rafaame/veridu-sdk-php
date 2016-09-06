<?php

namespace Veridu\Endpoint;

use Veridu\API;

final class Companies extends AbstractEndpoint {
	public function getRoute() {
		return 'companies';
	}

	public function __construct($credentials, $version) {
		parent::__construct($credentials, $version);

		$this->setAuthMethod(API::AUTH_MANAGEMENT);
	}

	/*public function listAll() {

	}

	public function getOne() {

	}

	public function create() {

	}

	public function update() {

	}

	public function delete() {

	}

	public function deleteAll() {

	}*/
}