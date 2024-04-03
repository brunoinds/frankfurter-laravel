<?php

namespace Brunoinds\FrankfurterLaravel;


use DateTime;
use Brunoinds\FrankfurterLaravel\ExchangeDate\ExchangeDate;
use Brunoinds\FrankfurterLaravel\Store\Store;
use Brunoinds\FrankfurterLaravel\Converter\Converter;

class Exchange{
    public static function on(DateTime $date): ExchangeDate
    {
        return new ExchangeDate($date);
    }
    public static function now():ExchangeDate{
        return new ExchangeDate(new DateTime());
    }
    
    public static function useStore(Store $store) :void
    {
        Converter::$store = $store;
    }
}