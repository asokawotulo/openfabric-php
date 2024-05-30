<?php

namespace OpenFabric;

use OpenFabric\ApiOperations\Create;
use OpenFabric\ApiOperations\Request;

class Transaction
{
	use Create;
	use Request;

	public static function classUrl()
	{
		return '/v1/tenants/partners/transactions';
	}

	public static function requiredCreateParams()
	{
		return [
			'partner_redirect_success_url',
			'partner_redirect_fail_url',
			'partner_reference_id',
			'customer_info.first_name',
			'amount',
			'currency',
			'transaction_details.shipping_address.address_line_1',
			'transaction_details.shipping_address.post_code',
			'transaction_details.billing_address.address_line_1',
			'transaction_details.billing_address.post_code',
			'transaction_details.items',

			// Note: The following are required but are nested in an array so we can't use the current dot notation implementation
			// 'transaction_details.items.*.item_id',
			// 'transaction_details.items.*.name',
			// 'transaction_details.items.*.quantity',
			// 'transaction_details.items.*.price',
		];
	}
}