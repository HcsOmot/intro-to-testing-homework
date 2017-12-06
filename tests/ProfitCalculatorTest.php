<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class ProfitCalculatorTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    private $profitCalculator;
    private $mockedDateTimeFactory;
    private $mockedClient;

    public function setUp()
    {
        $this->mockedDateTimeFactory = \Mockery::mock(\DateTimeFactory::class);
        $this->mockedClient = \Mockery::mock(\ExchangeRateClient::class);
        $this->profitCalculator = new \ProfitCalculator($this->mockedClient, $this->mockedDateTimeFactory);
    }

    public function testItCanBeConstructed() {
        self::assertInstanceOf(\ProfitCalculator::class, new \ProfitCalculator($this->mockedClient, $this->mockedDateTimeFactory));
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
     * @param $currency
     * @param $daysAgo
     * @param $amount
     * @param $expected
     *
     * @dataProvider provideTestCalculateProfitWorks
     */
    public function testCalculateProfitWorks($currency, $daysAgo, $amount, $expected)
    {
        $sevenDaysAgo = \Mockery::mock(\DateTime::class);
        $today = \Mockery::mock(\DateTime::class);
        $oneDayAgo = \Mockery::mock(\DateTime::class);
        $twoDaysAgo = \Mockery::mock(\DateTime::class);
        $monthAgo = \Mockery::mock(\DateTime::class);

        $this->mockedDateTimeFactory->shouldReceive('getDaysAgo')->with(0)->andReturn($today);
        $this->mockedDateTimeFactory->shouldReceive('getDaysAgo')->with(1)->andReturn($oneDayAgo);
        $this->mockedDateTimeFactory->shouldReceive('getDaysAgo')->with(2)->andReturn($twoDaysAgo);
        $this->mockedDateTimeFactory->shouldReceive('getDaysAgo')->with(30)->andReturn($monthAgo);

        $this->mockedClient->shouldReceive('getRatesFor')->with('EUR', $today)->andReturn(100);
        $this->mockedClient->shouldReceive('getRatesFor')->with('EUR', $oneDayAgo)->andReturn(50);
        $this->mockedClient->shouldReceive('getRatesFor')->with('EUR', $twoDaysAgo)->andReturn(150);
        $this->mockedClient->shouldReceive('getRatesFor')->with('EUR', $monthAgo)->andReturn(10);

        $this->mockedClient->shouldReceive('getRatesFor')->with('USD', $today)->andReturn(100);
        $this->mockedClient->shouldReceive('getRatesFor')->with('USD', $oneDayAgo)->andReturn(50);

        self::assertEquals($expected, $this->profitCalculator->calculateProfit($currency, $daysAgo, $amount));
    }

    public function provideTestCalculateProfitWorks()
    {
        return [
            ['EUR', 0, 1, 0],
            ['EUR', 0, 100, 0],
            ['EUR', 1, 1, 50],
            ['EUR', 30, 10, 900],
            ['USD', 1, 1, 50],
            ['EUR', 2, 1, -50]
        ];
    }
}

