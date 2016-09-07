<?php

namespace Test\Functional;

use Veridu\API;

abstract class AbstractFunctional extends \PHPUnit_Framework_TestCase {
	static private $API;

	static public function setUpBeforeClass() {
		self::$API = new API([
			'companyPubKey' => '8b5fe9db84e338b424ed6d59da3254a0',
			'companyPrivKey' => '4e37dae79456985ae0d27a67639cf335',
			'credentialPubKey' => '4c9184f37cff01bcdc32dc486ec36961',
			'credentialPrivKey' => '2c17c6393771ee3048ae34d6b380c5ec',
			'servicePubKey' => 'ef970ffad1f1253a2182a88667233991',
			'servicePrivKey' => '213b83392b80ee98c8eb2a9fed9bb84d',
			'username' => 'f67b96dcf96b49d713a520ce9f54053c'
		], '1.0');

		self::getApi()->companies()->deleteAll();

		self::getApi()->companies()->create([
			'name' => 'App Deck',
			'slug' => 'app-deck'
		]);
	}

	public function setUp() {

	}

	static protected function getApi() {
		return self::$API;
	}

	protected function assertResponseArray($expected, $response) {
		foreach ($expected as $key => $value) {
			if (is_integer($key)) {
				$this->assertArrayHasKey($value, $response);
			} else {
				$this->assertSame($value, $response[$key]);
			}
		}
	}
}