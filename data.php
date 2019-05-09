<?php
header("Content-type: application/; charset=utf-8");

$country_description = [
	'USD' => [
		'nameRUcurrency' => 'Доллар',
		'nameFileFlag' => 'USD.png'
	],
	'JPY' => [
		'nameRUcurrency' => 'Иена',
		'nameFileFlag' => 'JPY.png'
	],
	'BGN' => [
		'nameRUcurrency' => 'Болгарский лев',
		'nameFileFlag' => 'BGN.png'
	],
	'CZK' => [
		'nameRUcurrency' => 'Чешская крона',
		'nameFileFlag' => 'CZK.png'
	],
	'DKK' => [
		'nameRUcurrency' => 'Датская крона',
		'nameFileFlag' => 'DKK.png'
	],
	'GBP' => [
		'nameRUcurrency' => 'Фунт стерлингов',
		'nameFileFlag' => 'GBP.png'
	],
	'HUF' => [
		'nameRUcurrency' => 'Форинт',
		'nameFileFlag' => 'HUF.png'
	],
	'PLN' => [
		'nameRUcurrency' => 'Злотый',
		'nameFileFlag' => 'PLN.png'
	],
	'RON' => [
		'nameRUcurrency' => 'Новый румынский лей',
		'nameFileFlag' => 'RON.png'
	],
	'SEK' => [
		'nameRUcurrency' => 'Шведская крона',
		'nameFileFlag' => 'SEK.png'
	],
	'CHF' => [
		'nameRUcurrency' => 'Швейцарский франк',
		'nameFileFlag' => 'CHF.png'
	],
	'ISK' => [
		'nameRUcurrency' => 'Исландская крона',
		'nameFileFlag' => 'ISK.png'
	],
	'NOK' => [
		'nameRUcurrency' => 'Норвежская крона',
		'nameFileFlag' => 'NOK.png'
	],
	'HRK' => [
		'nameRUcurrency' => 'Хорватская куна',
		'nameFileFlag' => 'HRK.png'
	],
	'RUB' => [
		'nameRUcurrency' => 'Российский рубль',
		'nameFileFlag' => 'RUB.png'
	],
	'TRY' => [
		'nameRUcurrency' => 'Турецкая лира',
		'nameFileFlag' => 'TRY.png'
	],
	'AUD' => [
		'nameRUcurrency' => 'Австралийский доллар',
		'nameFileFlag' => 'AUD.png'
	],
	'BRL' => [
		'nameRUcurrency' => 'Бразильский реал',
		'nameFileFlag' => 'BRL.png'
	],
	'CAD' => [
		'nameRUcurrency' => 'Канадский доллар',
		'nameFileFlag' => 'CAD.png'
	],
	'CNY' => [
		'nameRUcurrency' => 'Юань',
		'nameFileFlag' => 'CNY.png'
	],
	'HKD' => [
		'nameRUcurrency' => 'Гонконгский доллар',
		'nameFileFlag' => 'HKD.png'
	],
	'IDR'=> [
		'nameRUcurrency' => 'Рупия',
		'nameFileFlag' => 'IDR.png'
	],
	'ILS' => [
		'nameRUcurrency' => 'Новый израильский шекель',
		'nameFileFlag' => 'ILS.png'
	],
	'INR' => [
		'nameRUcurrency' => 'Индийская рупия',
		'nameFileFlag' => 'INR.png'
	],
	'KRW' => [
		'nameRUcurrency' => 'Южнокорейская вона',
		'nameFileFlag' => 'KRW.png'
	],
	'MXN' => [
		'nameRUcurrency' => 'Мексиканское песо',
		'nameFileFlag' => 'MXN.png'
	],
	'MYR' => [
		'nameRUcurrency' => 'Малайзийский ринггит',
		'nameFileFlag' => 'MYR.png'
	],
	'NZD' => [
		'nameRUcurrency' => 'Новозеландский доллар',
		'nameFileFlag' => 'NZD.png'
	],
	'PHP' => [
		'nameRUcurrency' => 'Филиппинское песо',
		'nameFileFlag' => 'PHP.png'
	],
	'SGD' => [
		'nameRUcurrency' => 'Cингапурский доллар',
		'nameFileFlag' => 'SGD.png'
	],
	'THB' => [
		'nameRUcurrency' => 'Бат',
		'nameFileFlag' => 'THB.png'
	],
	'ZAR' => [
		'nameRUcurrency' => 'Рэнд',
		'nameFileFlag' => 'ZAR.png'
	]
];

$xmlResponse = file_get_contents('https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml');

$dom = new DOMDocument();

$dom -> loadXML($xmlResponse);


$cubes = $dom->getElementsByTagName('Cube');

$currencyData = ['currencies' =>
	[
		'EUR' => [
			'nameRUcurrency' => 'Евро',
			'nameFileFlag' => 'EUR.png',
			'currentValue' => '1',
		]
	]
];

foreach ($cubes as $cube) {
	if ($cube -> hasAttribute('currency')) {
		$currency = $cube -> getAttribute('currency'); 

		if (isset($country_description[$currency])) {
			$currencyData['currencies'][$currency] = [
				'currentValue' => $cube -> getAttribute('rate'),
				'defaultValue' => $cube -> getAttribute('rate'),
				'nameRUcurrency' => $country_description[$currency]['nameRUcurrency'],
				'nameFileFlag' => $country_description[$currency]['nameFileFlag'],
			];
		} else {
			$currencyData['currencies'][$currency] = [
				'currentValue' => $cube -> getAttribute('rate'),
				'defaultValue' => $cube -> getAttribute('rate'),
				'nameRUcurrency' => 'Неизвестная валюта',
				'nameFileFlag' => 'default.png'
			];
		};
	} elseif ($cube -> hasAttribute('time')) {
		$currencyData['dateCurrency'] = $cube -> getAttribute('time');
	}
};

echo json_encode($currencyData);

?>