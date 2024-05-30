<?php

namespace OpenFabric;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use OpenFabric\Common\Utils;

class Authentication
{
	public static function requestAccessToken()
	{
		$clientId = OpenFabric::getClientId();
		$clientSecret = OpenFabric::getClientSecret();

		$token = Utils::generateBasicAuthToken($clientId, $clientSecret);

		$guzzleClient = new Client([
			'base_uri' => OpenFabric::getAuthUrl(),
			'headers' => [
				'Content-Type' => 'application/x-www-form-urlencoded',
				'Authorization' => 'Basic ' . $token,
			]
		]);

		$response = $guzzleClient->request(
			'POST',
			'/oauth2/token',
			[
				RequestOptions::FORM_PARAMS => [
					'grant_type' => 'client_credentials',
					'scope' => 'resources/transactions.read resources/transactions.create'
				]
			]
		);

		$responseData = json_decode($response->getBody()->getContents());

		return $responseData;
	}
}