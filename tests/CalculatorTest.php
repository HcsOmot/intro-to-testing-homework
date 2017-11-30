<?php
namespace Tests;

use PHPUnit\Framework\TestCase;


class CalculatorTest extends TestCase {

    private $calculator;

    public function setUp()
    {
        $this->calculator = new \Calculator();
    }

    public function testItCanBeConstructed() {
        self::assertInstanceOf(\Calculator::class, new \Calculator);
    }

    /**
     * @dataProvider provideAddInput
     */
    public function testAddWorks($a, $b, $expected)
    {

        $result = $this->calculator->add($a, $b);

        self::assertEquals($result, $expected);
    }

    public function provideAddInput()
    {
        return [
            [2, 2, 4],
            [2, 8, 10],
            [0, 3, 3]
        ];
    }

    /**
     * @dataProvider provideSubtractInput
     */
    public function testSubtractWorks($a, $b, $expected)
    {

        $result = $this->calculator->subtract($a, $b);

        self::assertEquals($result, $expected);
    }

    public function provideSubtractInput()
    {
        return [
            [2, 2, 0],
            [10, 4, 6],
            [11, 1, 10]
        ];
    }

    /**
     * @dataProvider provideMultiplierInput
     */
    public function testMultiplyWorks($a, $b, $expected)
    {

        // Act
        $result = $this->calculator->multiply($a, $b);

        // Assert
        self::assertEquals($result, $expected);
    }

    public function provideMultiplierInput()
    {
        return [
            [2, 2, 4],
            [1, 4, 4],
            [5, 4, 20]
        ];
    }

    public function test100PercentsWillDoubleTheInput()
    {
        $result = $this->calculator->calculateWithPercentage(10, 100);

        self::assertEquals(20, $result);
    }


    public function test25PercentsWillWork()
    {
        $result = $this->calculator->calculateWithPercentage(100, 25);

        self::assertEquals(125, $result);
    }

    public function test25PercentsWillRoundUp()
    {
        $result = $this->calculator->calculateWithPercentage(10001, 25);

        self::assertEquals(12502, $result);
    }


    public function testFloatsWillWork()
    {
        $result = $this->calculator->calculateWithPercentage(100.00, 8);

        self::assertEquals(108.00, $result);
    }

    public function testFloatsWillRoundUp()
    {
        $result = $this->calculator->calculateWithPercentage(100.01, 8);

        self::assertEquals(108.02, $result);
    }


}

