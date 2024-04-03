<?php

namespace Brunoinds\FrankfurterLaravel\ExchangeDate;

use Brunoinds\FrankfurterLaravel\Converter\Converter;
use Brunoinds\FrankfurterLaravel\Enums\Currency;
use Brunoinds\FrankfurterLaravel\ExchangeTransaction\ExchangeTransaction;
use DateTime;
use Brunoinds\FrankfurterLaravel\Store\Store;

class ExchangeDate{
    public DateTime $date;

    public function __construct(DateTime $date){
        if (!Converter::$store){
            Converter::$store = Store::newFromLaravelCache();
        }
        
        $this->date = $date;
    }

    public function convert(Currency $currency, float $amount): ExchangeTransaction{
        return new ExchangeTransaction($this, $currency, $amount);
    }
}