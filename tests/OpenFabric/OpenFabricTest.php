<?php

namespace OpenFabric;

use OpenFabric\OpenFabric;

class OpenFabricTest extends TestCase
{
	public function testApiUrlIsProductionByDefault()
	{
		$this->assertEquals(OpenFabric::PRODUCTION_URL, OpenFabric::getApiUrl(), 'OpenFabric API URL is production by default');
	}

	public function testSwitchEnvironments()
	{
		OpenFabric::setEnv(OpenFabric::SANDBOX);

		$this->assertEquals(OpenFabric::SANDBOX_URL, OpenFabric::getApiUrl(), 'Change environment to sandbox');

		$this->assertEquals(OpenFabric::SANDBOX_AUTH_URL, OpenFabric::getAuthUrl(), 'Change environment to sandbox');

		OpenFabric::setEnv(OpenFabric::PRODUCTION);

		$this->assertEquals(OpenFabric::PRODUCTION_URL, OpenFabric::getApiUrl(), 'Change environment to production');

		$this->assertEquals(OpenFabric::PRODUCTION_AUTH_URL, OpenFabric::getAuthUrl(), 'Change environment to production');
	}

	public function testThrowInvalidArgumentException()
	{
		$this->expectException(\InvalidArgumentException::class);

		OpenFabric::setEnv('');
	}

	public function testClientId()
	{
		$clientId = $_ENV['CLIENT_ID'];

		OpenFabric::setClientId($clientId);

		$this->assertEquals($clientId, OpenFabric::getClientId());
	}

	public function testClientSecret()
	{
		$clientSecret = $_ENV['CLIENT_SECRET'];

		OpenFabric::setClientSecret($clientSecret);

		$this->assertEquals($clientSecret, OpenFabric::getClientSecret());
	}
}
