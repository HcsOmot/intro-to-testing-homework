<?php

namespace Tests;

use \Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase {

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
        self::assertEquals($result, $this->calculator->add($a,$b));
    }

    /**
     * @dataProvider provideSubtractionInput
     */
    public function testItCanSubtractTwoNumbers($a, $b, $result)
    {
        self::assertEquals($result, $this->calculator->subtract($a, $b));
    }

    /**
     * @dataProvider provideMultiplierInput
     */
    public function testItCanMultiplyTwoNumbers($a, $b, $expected)
    {
//        Arrange
        $calculator = new Calculator();

//        Act
        $result = $calculator->multiply($a, $b);

//        Assert
        self::assertEquals($expected, $result);
    }


    public function test100PercentWillDoubleTheInput()
    {
        $result = $this->calculator->calculateWithPercentage(10, 100);
        self::assertEquals(20, $result);
    }

    public function test25PercentWillRoundUp()
    {
        $result = $this->calculator->calculateWithPercentage(10001, 25);
        self::assertEquals(12502, $result);
    }

    public function provideAdditionInput()
    {
        return [
            [3, 4, 7],
        ];
    }

    public function provideSubtractionInput()
    {
        return [
            [5, 3, 2],
            [666, 616, 50]
        ];
    }

    public function provideMultiplierInput()
    {
        return [
            [1, 2, 2],
            [2, 2, 4],
            [4, 4, 16],
            [7, 9, 63],
            [10, 10, 100]
        ];
    }
}
