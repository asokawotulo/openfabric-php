<?php

namespace OpenFabric;

use OpenFabric\Common\Utils;

class UtilsTest extends TestCase {
	public function testGenerateBasicAuthToken() {
		$clientId = 'test';
		$clientSecret = 'test';

		$token = Utils::generateBasicAuthToken($clientId, $clientSecret);

		$this->assertNotEmpty($token);

		$this->assertEquals('dGVzdDp0ZXN0', $token);
	}
}