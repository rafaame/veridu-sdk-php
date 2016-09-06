<?php

namespace Veridu;

final class EndpointResolver {

	private $namespace;

	private $class;

	/**
    * @var array API Credentials
    */
    private $credentials;

	/**
    * @var array Endpoints instances
    */
    private $endpoints = [];

    /**
    * @var string API Version
    */
    private $version;

	public function __construct($credentials, $version = '1.0', $namespace = null) {
		$this->credentials = $credentials;
		$this->version = $version;
		$this->namespace = $namespace;
	}

	public function resolve($class) {
		$class = [ucfirst($class)];

		if ($this->namespace !== null) {
			array_unshift($class, ucfirst($this->namespace));
		}

		array_unshift($class, 'Endpoint');
		array_unshift($class, 'Veridu');

		$className = implode('\\', $class);

		if (class_exists($className)) {
            if (! isset($this->endpoints[$className])) {
                $this->endpoints[$className] = new $className(
                    $this->credentials,
                    $this->version
                );
            }

            return $this->endpoints[$className];
        }

        return null;
	}

	public function __call($method, $parameters) {
		return $this->resolve($method);
	}
}