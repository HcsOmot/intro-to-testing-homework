<?php
namespace Tests;

use PHPUnit\Framework\TestCase;


class ProfitCalculatorTest extends TestCase {

    private $profitCalculator;
    private $startDate;

    public function setUp()
    {
        $this->profitCalculator = new \ProfitCalculator();
    }

    public function testItCanBeConstructed() {
        self::assertInstanceOf(\ProfitCalculator::class, new \ProfitCalculator);
    }

    /**
     * @param $priceOld
     * @param $priceNew
     * @param $expected
     *
     * @dataProvider provideTestCalculateDiff
     */
    public function testCalculateDiff($priceOld, $priceNew, $expected)
    {
        $result = $this->profitCalculator->calculateDiff($priceOld, $priceNew);

        self::assertEquals($expected, $result);
    }

    public function provideTestCalculateDiff()
    {
        return [
            [1, 11, 10],
            [1, 100, 99],
            [10, 5, -5],
            [10, 10, 0]
        ];
    }

    /**
     * @param $startDate
     * @param $daysAgo
     * @return array
     *
     * @dataProvider provideTestGetDateFromDaysAgo
     */
    public function testGetDateFromDaysAgo($startDate, $daysAgo, $expected)
    {
        $result = $this->profitCalculator->getDateFromDaysAgo($startDate, $daysAgo);

        self::assertEquals($expected, $result);
    }

    public function provideTestGetDateFromDaysAgo()
    {

        /**
         * startDate is constructed on every test input to reset date to original state, since
         * sub() function used for getting dates in the past modifies passed object
         * instead of returning new instance of DateTime
         *
         * http://php.net/manual/en/datetime.sub.php
         */
        return [
            [new \DateTime('2017-11-15 00:00:00'), 0, new \DateTime('2017-11-15 00:00:00')],
            [new \DateTime('2017-11-15 00:00:00'), 5, new \DateTime('2017-11-10 00:00:00')],
            [new \DateTime('2017-11-15 00:00:00'), 30, new \DateTime('2017-10-16 00:00:00')],
            [new \DateTime('2017-11-15 00:00:00'), 400, new \DateTime('2016-10-11 00:00:00')]
        ];
    }
    
}

