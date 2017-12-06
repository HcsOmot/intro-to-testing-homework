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

    
}

