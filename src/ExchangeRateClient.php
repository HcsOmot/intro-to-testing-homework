<?php


class ExchangeRateClient
{
    private $exchangeListApi;
    private $exchangeRates;
    private $exchangeRatesValidOn;

    public function __construct()
    {
        $this->exchangeListApi = 'http://hnbex.eu/api/v1/rates/daily/';
    }

    public function getRatesFor(string $currencyCode, $onDate)
    {
        if ($this->exchangeRatesValidOn !== $onDate) {
            $this->exchangeRates        = file_get_contents($this->exchangeListApi."?date=$onDate");
            $this->exchangeRatesValidOn = $onDate;
        }

        return $this->extractRatesFor($currencyCode);
    }

    private function extractRatesFor($currencyCode)
    {
        $rates = json_decode($this->exchangeRates, true);

        foreach ($rates as $index => $currencyRates) {
            if (in_array($currencyCode, $currencyRates)) {
                return $currencyRates;
            }
        }
    }
}
