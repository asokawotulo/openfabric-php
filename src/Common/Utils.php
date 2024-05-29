<?php

namespace OpenFabric\Common;

class Utils
{
	public static function generateBasicAuthToken(string $clientId, string $clientSecret)
	{
		return base64_encode($clientId . ':' . $clientSecret);
	}

	public static function getArrayByPath($array, $path, $seperator = '.')
	{
		$keys = explode($seperator, $path);

		foreach ($keys as $key) {
			$array = $array[$key] ?? null;
		}

		return $array;
	}
}