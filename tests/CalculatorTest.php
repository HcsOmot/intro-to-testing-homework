<?php

namespace Tests;

use Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    private $calculator;

    public function setUp()
    {
        $this->calculator = new Calculator();
    }

    public function testItCanBeConstructed()
    {
        self::assertInstanceOf(\Calculator::class, $this->calculator);
    }

    /**
     * @dataProvider provideAdditionInput
     */
    public function testItCanAddTwoNumbers($a, $b, $result)
    {
        self::assertEquals($result, $this->calculator->add($a, $b));
    }

    public function provideAdditionInput()
    {
        return [
            [3, 4, 7],
        ];
    }

    /**
     * @dataProvider provideSubtractionInput
     */
    public function testItCanSubtractTwoNumbers($a, $b, $result)
    {
        self::assertEquals($result, $this->calculator->subtract($a, $b));
    }

    public function provideSubtractionInput()
    {
        return [
            [5, 3, 2],
            [666, 616, 50],
        ];
    }

    /**
     * @dataProvider provideMultiplierInput
     */
    public function testItCanMultiplyTwoNumbers($a, $b, $expected)
    {
        $result = $this->calculator->multiply($a, $b);

        self::assertEquals($expected, $result);
    }

    public function provideMultiplierInput()
    {
        return [
            [1, 2, 2],
            [2, 2, 4],
            [4, 4, 16],
            [7, 9, 63],
            [10, 10, 100],
        ];
    }

    public function test100PercentWillDoubleTheInput()
    {
        $result = $this->calculator->calculateWithPercentage(10, 100);
        self::assertEquals(20, $result);
    }

    public function testCalculateSalesTax()
    {
        $result = $this->calculator->calculateWithPercentage(100.00, 8.00);
        self::assertEquals(108.00, $result);
    }

    /**
     * @dataProvider provideRoundingUpCents
     */
    public function testRoundingUpSalesTax($price, $tax, $finalPrice)
    {
        $result = $this->calculator->calculateWithPercentage($price, $tax);
        self::assertEquals($finalPrice, $result);
    }

    public function provideRoundingUpCents()
    {
        return [
            [100.00, 25.00, 125.00],
            [100, 25, 125],
            [100.00, 8.00, 108.00],
            [100, 8, 108],
            [100.01, 8.00, 108.02], //108.0108
            [100.19, 8.00, 108.21], //108.2052
            [84.63, 17.63, 99.56],  //99.5502
        ];
    }
}
