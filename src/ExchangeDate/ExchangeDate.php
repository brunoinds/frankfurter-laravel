<?php

namespace Brunoinds\FrankfurterLaravel\ExchangeDate;

use Brunoinds\FrankfurterLaravel\Converter\Converter;
use Brunoinds\FrankfurterLaravel\Enums\Currency;
use Brunoinds\FrankfurterLaravel\ExchangeTransaction\ExchangeTransaction;
use DateTime;

class ExchangeDate{
    public DateTime $date;

    public function __construct(DateTime $date){
        $this->date = $date;
    }

    public function convert(Currency $currency, float $amount): ExchangeTransaction{
        return new ExchangeTransaction($this, $currency, $amount);
    }
}