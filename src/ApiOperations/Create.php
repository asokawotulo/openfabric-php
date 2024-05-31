<?php

namespace OpenFabric\ApiOperations;

use GuzzleHttp\Exception\ClientException;
use OpenFabric\OpenFabric;

trait Create
{
	public static function create($params)
	{
		self::validateParams($params, self::requiredCreateParams());

		$url = self::classUrl();

		$accessToken = OpenFabric::getAccessToken();

		try {
			$response = self::_request(
				'POST',
				$url,
				$params,
				[
					'Authorization' => 'Bearer ' . $accessToken
				]
			);
			return $response;
		} catch (ClientException $e) {
			throw $e;
		}
	}
}