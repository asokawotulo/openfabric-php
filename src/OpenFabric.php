<?php

namespace OpenFabric;

class OpenFabric
{
	const SANDBOX = 'SANDBOX';
	const SANDBOX_URL = 'https://api.sandbox.openfabric.co';
	const SANDBOX_AUTH_URL = 'https://auth.sandbox.openfabric.co';

	const PRODUCTION = 'PRODUCTION';
	const PRODUCTION_URL = 'https://api.openfabric.co';
	const PRODUCTION_AUTH_URL = 'https://auth.openfabric.co';

	/**
	 * @var string
	 */
	public static $apiUrl = self::PRODUCTION_URL;

	/**
	 * @var string
	 */
	public static $authUrl = self::PRODUCTION_AUTH_URL;

	/**
	 * @var string
	 */
	public static $clientId;

	/**
	 * @var string
	 */
	public static $clientSecret;

	/**
	 * @var string
	 */
	public static $accessToken;

	/**
	 * Get the API URL
	 * 
	 * @return string 
	 */
	public static function getApiUrl()
	{
		return self::$apiUrl;
	}

	/**
	 * Set the API URL
	 * 
	 * @param string $apiUrl
	 */
	public static function setApiUrl(string $apiUrl)
	{
		self::$apiUrl = $apiUrl;
	}

	/**
	 * Get the API URL
	 * 
	 * @return string 
	 */
	public static function getAuthUrl()
	{
		return self::$authUrl;
	}

	/**
	 * Set the API URL
	 * 
	 * @param string $authUrl
	 */
	public static function setAuthUrl(string $authUrl)
	{
		self::$authUrl = $authUrl;
	}

	/**
	 * Get merchant id
	 * 
	 * @return string
	 */
	public static function getClientId()
	{
		return self::$clientId;
	}

	/**
	 * Set merchant id
	 * 
	 * @param string $clientId 
	 * @return void 
	 */
	public static function setClientId(string $clientId)
	{
		self::$clientId = $clientId;
	}

	/**
	 * Get merchant secret
	 * 
	 * @return string
	 */
	public static function getClientSecret()
	{
		return self::$clientSecret;
	}

	/**
	 * Set merchant secret
	 * 
	 * @param string $clientSecret 
	 * @return void 
	 */
	public static function setClientSecret(string $clientSecret)
	{
		self::$clientSecret = $clientSecret;
	}

	/**
	 * Get access token
	 * 
	 * @return string
	 */
	public static function getAccessToken()
	{
		return self::$accessToken;
	}

	/**
	 * Set access token
	 * 
	 * @param string $accessToken 
	 * @return void 
	 */
	public static function setAccessToken(string $accessToken)
	{
		self::$accessToken = $accessToken;
	}

	/**
	 * Set environment
	 * 
	 * @param string $env 
	 * @return void 
	 * @throws \InvalidArgumentException 
	 */
	public static function setEnv(string $env)
	{
		$apiUrl = __CLASS__ . '::' . $env . '_URL';
		$authUrl = __CLASS__ . '::' . $env . '_AUTH_URL';

		if (!defined($apiUrl) || !defined($authUrl))
			throw new \InvalidArgumentException('Invalid environment provided.');

		self::setApiUrl(constant($apiUrl));
		self::setAuthUrl(constant($authUrl));
	}
}