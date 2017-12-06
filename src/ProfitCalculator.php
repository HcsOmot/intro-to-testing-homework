<?php
/**
 * Created by PhpStorm.
 * User: latz
 * Date: 30.11.17.
 * Time: 10:05
 */

class ProfitCalculator {

    protected $priceProvider;

    //public function __construct(\priceProvider $priceProvider)
    //{
    //    $this->priceProvider = $priceProvider;
    //}

    public function calculateProfit(Int $daysAgo, Int $amount)
    {

        $todayDate = new \DateTime();
        $openDate = $this->getDateFromDaysAgo($todayDate, $daysAgo);

        $priceNew = $this->priceProvider->getRatesFor('EUR', $todayDate);
        $priceOld = $this->priceProvider->getRatesFor('EUR', $openDate);

        return $amount * $this->calculateDiff($priceOld, $priceNew);

    }

    public function getDateFromDaysAgo(\DateTime $startDate, $daysAgo)
    {
        return $startDate->sub(new DateInterval('P'. $daysAgo . 'D'))->setTime(0,0);
    }

    public function calculateDiff($priceOld, $priceNew)
    {
        return $priceNew - $priceOld;
    }
}