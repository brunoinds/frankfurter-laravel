# PHP Frankfurter Currency Exchange

A simple PHP library for exchanging currencies based on api.frankfurter.app

## Installation

Install via Composer:

```bash
composer require brunoinds/frankfurter-laravel
```

## Usage

The `Exchange` class provides methods for exchanging between BRL and USD:

```php
use Brunoinds\FrankfurterLaravel\Exchange;
use Brunoinds\FrankfurterLaravel\Enums\Currency;

// Get current exchange rate
$result = Exchange::now()->convert(Currency::USD, 1)->to(Currency::BRL);

// Get historical exchange rate 
$date = new DateTime('2023-12-10');
$result = Exchange::on($date)
                ->convert(Currency::USD, 1)
                ->to(Currency::BRL);
echo $result // 0.27

```

The `Currency` enum provides constants for the supported currencies:

```php
use Brunoinds\FrankfurterLaravel\Enums\Currency;

Currency::USD;
Currency::BRL;
Currency::EUR;
Currency::AUD;
Currency::BGN;
Currency::CAD;
Currency::CHF;
Currency::CNY;
Currency::CZK;
Currency::DKK;
Currency::GBP;
Currency::HKD;
Currency::HUF;
Currency::IDR;
Currency::ILS;
Currency::INR;
Currency::ISK;
Currency::JPY;
Currency::KRW;
Currency::MXN;
Currency::MYR;
Currency::NOK;
Currency::NZD;
Currency::PHP;
Currency::PLN;
Currency::RON;
Currency::SEK;
Currency::SGD;
Currency::THB;
Currency::TRY;
Currency::ZAR;
```

## Testing

Unit tests are located in the `tests` directory. Run tests with:

```
composer test
```

## Contributing

Pull requests welcome!

## License

MIT License

## Powered by:
- [API Frankfurter.app](https://www.frankfurter.app/docs/)

Let me know if you would like any sections expanded or have any other feedback!