<?php

namespace OpenFabric;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use OpenFabric\OpenFabric;

class HttpClient
{
	/**
	 * @var \GuzzleHttp\Client
	 */
	private $_guzzleClient;

	/**
	 * @return array
	 */
	public function request($method, $url, $params, $headers)
	{
		return json_decode($this->_requestRaw($method, $url, $params, $headers));
	}

	/**
	 * @return \Psr\Http\Message\StreamInterface
	 */
	private function _requestRaw($method, $url, $params, $headers = [])
	{
		$response = $this->_guzzleClient()->request(
			$method,
			$url,
			[
				RequestOptions::JSON => $params,
				'headers' => $headers,
			]
		);

		return $response->getBody()->getContents();
	}

	/**
	 * @return \GuzzleHttp\Client
	 */
	private function _guzzleClient()
	{
		if (!$this->_guzzleClient) {
			$this->_guzzleClient = new Client([
				'base_uri' => OpenFabric::getApiUrl()
			]);
		}

		return $this->_guzzleClient;
	}
}
