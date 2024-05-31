<?php

namespace OpenFabric;

class TransactionTest extends TestCase
{
	private $transactionData = [
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
			"tax_amount" => 390.6,
			"shipping_amount" => 1020,
			"original_amount" => 13020
		]
	];

	protected function setUp(): void
	{
		parent::setUp();
		OpenFabric::setEnv(OpenFabric::SANDBOX);

		$clientId = $_ENV['CLIENT_ID'];
		$clientSecret = $_ENV['CLIENT_SECRET'];

		OpenFabric::setClientId($clientId);
		OpenFabric::setClientSecret($clientSecret);

		OpenFabric::setAccessToken(Authentication::requestAccessToken()->access_token);
	}

	protected function tearDown(): void
	{
		parent::tearDown();
		OpenFabric::setEnv(OpenFabric::PRODUCTION);
	}

	public function testCreateTransaction()
	{
		$response = Transaction::create([
			"partner_reference_id" => "P-" . uniqid(),
		] + $this->transactionData);

		$this->assertIsObject($response);
		$this->assertObjectHasAttribute('id', $response);
		$this->assertObjectHasAttribute('status', $response);
		$this->assertObjectHasAttribute('amount', $response);
		$this->assertObjectHasAttribute('currency', $response);
	}

	public function testCreateTransactionWithoutParams()
	{
		$this->expectException(\InvalidArgumentException::class);

		Transaction::create([]);
	}

	public function testGetTransaction()
	{
		$transaction = Transaction::create([
			"partner_reference_id" => "P-" . uniqid(),
		] + $this->transactionData);

		$response = Transaction::get($transaction->id);

		$this->assertIsObject($response);
		$this->assertObjectHasAttribute('id', $response);
		$this->assertObjectHasAttribute('status', $response);
		$this->assertObjectHasAttribute('amount', $response);
		$this->assertObjectHasAttribute('currency', $response);
	}

	public function testGetTransactionWithoutId()
	{
		$this->expectException(\InvalidArgumentException::class);

		Transaction::get(null);
	}

}