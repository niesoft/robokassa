<?php

class Robokassa {

	private string $url = "https://auth.robokassa.ru/Merchant/Index.aspx";

	function __construct(private string $username, private string $password){}

	public function getForm(float $amount, int $order_id, string $description = "") : string
	{
		$params = [
			'MerchantLogin' => $this->username,
			'DefaultSum' => $amount,
			'InvoiceID' => $order_id,
			'Description' => $description,
			'SignatureValue' => $this->getSignature($amount, $order_id)
		];
		return $this->url."?".http_build_query($params);
	}

	private function getSignature(float $amount, int $order_id) : string
	{
		return md5("{$this->username}:{$amount}:{$order_id}:{$this->password}");
	}

}