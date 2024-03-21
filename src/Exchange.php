<?php

namespace Brunoinds\FrankfurterLaravel;


use DateTime;
use Brunoinds\FrankfurterLaravel\ExchangeDate\ExchangeDate;

class Exchange{
    public static function on(DateTime $date): ExchangeDate
    {
        return new ExchangeDate($date);
    }
    public static function now():ExchangeDate{
        return new ExchangeDate(new DateTime());
    }
}