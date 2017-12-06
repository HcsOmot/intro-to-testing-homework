<?php
/**
 * Created by PhpStorm.
 * User: latz
 * Date: 06.12.17.
 * Time: 14:29
 */

namespace Tests;

use PHPUnit\Framework\TestCase;

class DateTimeFactoryTest extends TestCase
{

    protected $factory;

    public function setUp()
    {
        $this->factory = new \DateTimeFactory();
    }

    public function testItCanBeConstructed() {
        self::assertInstanceOf(\DateTimeFactory::class, new \DateTimeFactory());
    }

    /**
     * @param $daysAgo
     * @param $today
     * @param $expected
     *
     * @dataProvider provideTestGetDaysAgo
     */
    public function testGetDaysAgo($daysAgo, $today, $expected)
    {
        $result = $this->factory->getDaysAgo($daysAgo, $today);
        self::assertEquals($expected, $result);
    }

    public function provideTestGetDaysAgo()
    {
        return [
            [0, new \DateTime('2017-11-10'), '2017-11-10'],
            [1, new \DateTime('2017-11-10'), '2017-11-09'],
            [31, new \DateTime('2017-11-10'), '2017-10-10'],
            [400, new \DateTime('2017-11-10'), '2016-10-06']
        ];
    }
}