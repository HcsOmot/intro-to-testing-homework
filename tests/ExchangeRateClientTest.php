<?php

namespace Tests;

use \ExchangeRateClient;
use PHPUnit\Framework\TestCase;

class ExchangeRateClientTest extends TestCase
{
    /** @var \ExchangeRateClient */
    private $ratesProvider;
    /** @var \DateTime */
    private $today;

    public function setUp()
    {
        $this->today = new \DateTime('now');

        $this->ratesProvider = new ExchangeRateClient();
    }

    public function testItCanBeInstantiated()
    {
        self::assertInstanceOf(ExchangeRateClient::class, $this->ratesProvider);
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
