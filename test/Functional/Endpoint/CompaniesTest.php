<?php

namespace Test\Functional\Endpoint;

use Test\Functional\AbstractFunctional;

class CompaniesTest extends AbstractFunctional {
	public function testListAll() {
		$entities = $this->getApi()->companies()->listAll();

		$this->assertCount(1, $entities);
		$this->assertResponseArray([
			'name' => 'App Deck',
			'slug' => 'app-deck',
			'public_key'
		], $entities[0]);

		//@FIXME: should the returned company have the private key also?
	}

	public function testGetOne() {
		$entity = $this->getApi()->companies()->getOne('app-deck');

		$this->assertResponseArray([
			'name' => 'App Deck',
			'slug' => 'app-deck',
			'public_key'
		], $entity);
	}

	public function testCreate() {
		$data = [
			'name' => 'Company Test',
			'slug' => 'company-test'
		];
		$entity = $this->getApi()->companies()->create($data);

		$this->assertResponseArray(array_merge($data, [
			'public_key'
		]), $entity);
	}

	public function testUpdate() {
		$data = [
			'name' => 'Company Test 2',
			'slug' => 'company-test-2'
		];
		$entity = $this->getApi()->companies()->update('company-test', $data);

		$this->assertResponseArray(array_merge($data, [
			'public_key'
		]), $entity);
	}

	public function testDelete() {
		$result = $this->getApi()->companies()->delete('company-test-2');

		$this->assertTrue($result);
		$this->testListAll();
	}

	public function testDeleteAll() {
		$this->testCreate();

		$result = $this->getApi()->companies()->deleteAll();
		$this->assertTrue($result);

		$entities = $this->getApi()->companies()->listAll();
		$this->assertCount(0, $entities);
	}
}