<?php

use App\Rafinita\Exception\RafinitaException;
use App\Rafinita\HttpClient\RafinitaClient;
use App\Rafinita\HttpClient\RafinitaRequest;

require __DIR__.'/vendor/autoload.php';

$key = '5b6492f0-f8f5-11ea-976a-0242c0a85007';
$pass = 'd0ec0beca8a3c30652746925d5380cf3';

$client = new RafinitaClient($key, $pass);

$options = ['action' => 'SALE',
    'order_id' => 'ORDER-' . random_int(10000, 99999),
    'order_amount' => '1.99',
    'order_currency' => 'USD',
    'order_description' => 'Product',
    'card_number' => '4111111111111111',
    'card_exp_month' => '01',
    'card_exp_year' => '2025',
    'card_cvv2' => '000',
    'payer_first_name' => 'John',
    'payer_last_name' => 'Doe',
    'payer_address' => 'BigStreet',
    'payer_country' => 'US',
    'payer_state' => 'CA',
    'payer_city' => 'City',
    'payer_zip' => '123456',
    'payer_email' => 'doe@example.com',
    'payer_phone' => '199999999',
    'payer_ip' => '123.123.123.123',
    'term_url_3ds' => 'http://client.site.com/return.php'
    ];

$request = new RafinitaRequest($options);

try {
    $response = $client->sendRequest($request);
} catch (RafinitaException $e) {
    exit('Error: ' . $e->getMessage());
}

var_dump($response);

