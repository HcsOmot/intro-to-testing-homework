<?php

namespace Tests;

use Brackets;
use PHPUnit\Framework\TestCase;

class BracketsTest extends TestCase
{
    public function testItCanBeInitialized()
    {
        $brackets = new Brackets();
        self::assertInstanceOf(Brackets::class, $brackets);
    }

    /**
     * @dataProvider provideSimpleBracketsFormation
     * @dataProvider provideSimpleNestedFormation
     * @dataProvider provideUnmatchedFormation
     * @dataProvider provideUnmatchedNestedFormation
     */
    public function testItCanDetectSingleBracketFormation($bracketsFormation, $isProperlyFormated)
    {
        $brackets = new Brackets();

        self::assertEquals($isProperlyFormated, $brackets->isValid($bracketsFormation));
    }

    public function provideSimpleBracketsFormation()
    {
        return [
            ['()[]{}', true],
            ['()[]{}()()', true],
            ['()[]{}[](){}()', true],
        ];
    }

    public function provideSimpleNestedFormation()
    {
        return [
            ['[{}()]', true],
            ['[{(}()]', false]
        ];
    }

    public function provideUnmatchedFormation()
    {
        return [
            ['[]{}({}()', false],
            ['[]{}{}{()', false],
            ['(', false],
            ['((', false],
            ['([', false],
            ['([{', false],
            [')', false],
            [')]', false],
            [')]}', false],

        ];
    }

    public function provideUnmatchedNestedFormation()
    {
        return [
            ['[]{}{[}()', false],
            ['[]{}{(}()', false],
            ['{[]{}{]}()}', false],
            ['{[]{}{[}()}', false],
        ];
    }
}
