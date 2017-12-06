<?php
/**
 * Created by PhpStorm.
 * User: latz
 * Date: 30.11.17.
 * Time: 10:05
 */

class ProfitCalculator {

    protected $client;

    public function __construct(\ExchangeRateClient $client, \DateTimeFactory $factory)
    {
        $this->client = $client;
        $this->factory = $factory;
    }

    public function calculateProfit(String $currency,Int $daysAgo, Int $amount)
    {
        $todayDate = $this->factory->getDaysAgo(0);
        $openingDate = $this->factory->getDaysAgo($daysAgo);


        $openingPrice = $this->client->getRatesFor($currency, $openingDate);
        $currentPrice = $this->client->getRatesFor($currency, $todayDate);

        return $amount * $this->calculateDiff($openingPrice, $currentPrice);
    }

    public function calculateDiff($priceOld, $priceNew)
    {
        return $priceNew - $priceOld;
    }
}