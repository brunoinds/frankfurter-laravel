<?php
namespace Brunoinds\FrankfurterLaravel;

//Require composer autoload
require __DIR__ . '/../vendor/autoload.php';

use Brunoinds\FrankfurterLaravel\Enums\Currency;
use Brunoinds\FrankfurterLaravel\Exchange;
use DateTime;

$result = Exchange::on(DateTime::createFromFormat('Y-m-d', '2023-12-10'))->convert(Currency::USD, 1)->to(Currency::BRL);
var_dump($result);


$date = DateTime::createFromFormat('Y-m-d', '2023-12-10');

$result = Exchange::on($date)
                    ->convert(Currency::USD, 1)
                    ->to(Currency::BRL);

echo $result; // 0.27


Exchange::now()->convert(Currency::USD, 1)->to(Currency::BRL); // 0.32