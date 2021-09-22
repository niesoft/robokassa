<?php

class Robokassa {

	private string $url = "https://auth.robokassa.ru/Merchant/Index.aspx";

	function __construct(private string $username, private string $password){}

	public function getForm(float $amount, int $order_id, string $description = "", array $ship = []) : string
	{
		ksort($ship);
		$params = [
			'MerchantLogin' => $this->username,
			'OutSum' => $amount,
			'InvoiceID' => $order_id,
			'Description' => $description,
			'SignatureValue' => $this->getSignature($amount, $order_id, $ship)
		];
		foreach ($ship as $key => $value) {
			$params["Shp_{$key}"] = $value;
		}
		return $this->url."?".http_build_query($params);
	}

	private function getSignature(float $amount, int $order_id, array $ship = []) : string
	{
		$crc = "{$this->username}:{$amount}:{$order_id}:{$this->password}";
		foreach ($ship as $key => $value) $crc .= ":Shp_{$key}={$value}";
		return md5($crc);
	}

}
