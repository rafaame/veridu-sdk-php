<?php

namespace Veridu\AuthorizationMethod;

interface AuthorizationMethodInterface {
	function generateToken($credentials);
	function authorizationHeader($credentials);
}