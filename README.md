# OpenFabric PHP Library

This library is an abstraction of OpenFabric's API for applications written with PHP.

## Table of Contents
- [Table of Contents](#table-of-contents)
- [Installation](#installation)
- [Usage](#usage)
	- [Initialization](#initialization)
	- [Create Transaction](#create-transaction)
	- [Get Transaction](#get-transaction)

## Installation
```bash
composer require asokawotulo/cicil-php
```

## Usage
### Initialization
```php
use OpenFabric\OpenFabric;
use OpenFabric\Authentication;

OpenFabric::setEnv(OpenFabric::PRODUCTION); // or OpenFabric::SANDBOX

OpenFabric::setClientId('xxxxxxxx');
OpenFabric::setClientSecret('xxxxxxxx');

OpenFabric::setAccessToken(Authentication::requestAccessToken()->access_token);
```

### Create Transaction
```php
use OpenFabric\Transaction;

$transaction = Transaction::create([
	"partner_redirect_success_url" => "https://sample-merchant-flow.dev.openfabric.co?id=f0398e5-d045-441f-b130-bcd517964775&state=PAID",
	"partner_redirect_fail_url" => "https://sample-merchant-flow.dev.openfabric.co?id=f0398e5-d045-441f-b130-bcd517964775&state=CANCELLED",
	"customer_info" => [
		"first_name" => "BNPL",
		"last_name" => "Developer",
		"email" => "developer@bnpl1.com",
		"mobile_number" => "081234567890",
		"partner_reference_id" => "cd992711-498f-47be-b636-cf2e3eaad935"
	],
	"amount" => 1_000_000,
	"currency" => "IDR",
	"transaction_details" => [
		"shipping_address" => [
			"country" => "Indonesia",
			"country_code" => "ID",
			"address_line_1" => "Jl. R.A. Kartini No.Kav. 8",
			"address_line_2" => "",
			"address_line_3" => "",
			"post_code" => "12420"
		],
		"billing_address" => [
			"country" => "Indonesia",
			"country_code" => "ID",
			"address_line_1" => "Jl. R.A. Kartini No.Kav. 8",
			"address_line_2" => "",
			"address_line_3" => "",
			"post_code" => "12420"
		],
		"items" => [
			[
				"item_id" => "P100",
				"name" => "iPhone",
				"price" => 1_000_000,
				"quantity" => 1,
				"variation_name" => "Black, 128GB",
				"original_price" => 1_000_000,
				"categories" => [
					"Electronics"
				]
			],
		],
		"tax_amount" => 0,
		"shipping_amount" => 0,
		"original_amount" => 0
	]
]);
```

### Get Transaction
```php
use OpenFabric\Transaction;

$transaction = Transaction::get('xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx');
```