<?php

class Calculator
{
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

    public function calculateWithPercentage(float $amount, float $percentage): float
    {
        return $amount + ceil($amount * $percentage) / 100.00;
    }
}
