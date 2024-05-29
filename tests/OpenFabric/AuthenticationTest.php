<?php

namespace OpenFabric;

use OpenFabric\Authentication;

class AuthenticationTest extends TestCase
{
	protected function setUp(): void
	{
		parent::setUp();
		OpenFabric::setEnv(OpenFabric::SANDBOX);
	}

	protected function tearDown(): void
	{
		parent::tearDown();
		OpenFabric::setEnv(OpenFabric::PRODUCTION);
	}

	public function testRequestAccessToken()
	{
		OpenFabric::setEnv(OpenFabric::SANDBOX);

		$clientId = $_ENV['CLIENT_ID'];
		$clientSecret = $_ENV['CLIENT_SECRET'];

		$token = Authentication::requestAccessToken($clientId, $clientSecret);

		$this->assertNotEmpty($token);
		$this->assertObjectHasAttribute('access_token', $token);
		$this->assertObjectHasAttribute('token_type', $token);
		$this->assertObjectHasAttribute('expires_in', $token);
	}
}