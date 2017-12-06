<?php

namespace Tests;

use CurrencyRatesHNBProvider;
use PHPUnit\Framework\TestCase;

//use Mockery;
class CurrencyRatesHNBProviderTest extends TestCase
{
    /** @var CurrencyRatesHNBProvider */
    private $ratesProvider;
    /** @var \DateTime */
    private $today;

    public function setUp()
    {
        $this->today = new \DateTime('now');

        $this->ratesProvider = new CurrencyRatesHNBProvider();
    }

    public function testItCanBeInstatiated()
    {
        self::assertInstanceOf(CurrencyRatesHNBProvider::class, $this->ratesProvider);
    }

    public function testItCanRetrieveSpecificCurrencyRateForToday()
    {
        $euroRates = $this->ratesProvider->getRatesFor('EUR', $this->today->format('Y-m-d'));

        self::assertEquals('EUR', $euroRates['currency_code']);
    }

    /** @dataProvider provideCurrencyCodeWithMedianRateValuesOnDate */
    public function testItCorrectlyExtractsRateInfoForCurrencyOnDate($currencyCode, $onDate, $medianRateValue)
    {
        $rates = $this->ratesProvider->getRatesFor($currencyCode, $onDate);

        self::assertEquals($medianRateValue, $rates['median_rate']);
    }

    public function provideCurrencyCodeWithMedianRateValuesOnDate()
    {
        return [
          ['EUR', '2017-11-23', 7.561483],
          ['USD', '2017-11-23', 6.435852],
          ['JPY', '2017-11-23', 5.742317],
          ['GBP', '2017-11-23', 8.527668],
        ];
    }
}
