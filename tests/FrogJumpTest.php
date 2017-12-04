<?php

namespace Tests;

use FrogJumpCounter;
use PHPUnit\Framework\TestCase;

class FrogJumpTest extends TestCase
{
    /** @var FrogJumpCounter */
    private $frogger;

    public function testItCanBeInitialized()
    {
        $frogger = new FrogJumpCounter();

        self::assertInstanceOf(\FrogJumpCounter::class, $frogger);
    }

    public function setUp()
    {
        $this->frogger = new FrogJumpCounter();
    }

    /**
     * @dataProvider provideRandomJumpData
     * @dataProvider provideJumpsFromGroundZero
     * @dataProvider provideLongJumps
     */
    public function testItCanFrogCanReachOtherSideOfRoad(
        $startPosition,
        $destination,
        $jumpLength,
        $expectedNumberOfJumps
    ) {
        self::assertEquals($expectedNumberOfJumps,
            $this->frogger->findMinimalNumberOfJumpsToReachOtherSide($startPosition, $destination,
                $jumpLength));
    }

    public function provideRandomJumpData()
    {
        return [
            [10, 85, 30, 3],
            [1, 10, 2, 5],
        ];
    }

    public function provideJumpsFromGroundZero()
    {
        return [
            [0, 3, 1, 3],
            [0, 30, 3, 10],
        ];
    }

    public function provideLongJumps()
    {
        return [
            [5, 20, 30, 1],
        ];
    }
}
