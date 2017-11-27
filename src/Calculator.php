<?php


class Calculator {

    public function add(int $a, int $b): int
    {
        return $a + $b;
    }

    public function subtract(int $a, int $b): int
    {
        return $a - $b;
    }

    public function multiply(int $a, int $b): int
    {
        return $a * $b;
    }

    public function calculateWithPercentage(float $input, float $percentage): float
    {
        return ceil($input * (100 + $percentage)/ 100);


    }
}