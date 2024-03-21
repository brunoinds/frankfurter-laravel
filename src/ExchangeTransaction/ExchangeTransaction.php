<?php

namespace Brunoinds\FrankfurterLaravel\ExchangeTransaction;

use Brunoinds\FrankfurterLaravel\Converter\Converter;
use Brunoinds\FrankfurterLaravel\Enums\Currency;
use Brunoinds\FrankfurterLaravel\ExchangeDate\ExchangeDate;

class ExchangeTransaction
{
    private ExchangeDate $exchangeDate;
    private Currency $currency;
    private float $amount;

    public function __construct(ExchangeDate $exchangeDate, Currency $currency, float $amount)
    {
        $this->exchangeDate = $exchangeDate;
        $this->currency = $currency;
        $this->amount = $amount;
    }

    public function to(Currency $currency): float
    {
        if ($this->currency === $currency) {
            return $this->amount;
        }

        return Converter::convertFromTo($this->exchangeDate->date, $this->amount, $this->currency->value, $currency->value);

        throw new \Exception('Invalid currency');
    }
}