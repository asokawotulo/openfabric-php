<?php

namespace OpenFabric\ApiOperations;

use GuzzleHttp\Exception\ClientException;
use OpenFabric\OpenFabric;

trait Get
{
	public static function get($id, $params = [])
	{
		if (!$id) {
			throw new \InvalidArgumentException('The ID is required.');
		}

		$url = self::classUrl() . '/' . $id;

		$accessToken = OpenFabric::getAccessToken();

		try {
			$response = self::_request(
				'GET',
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