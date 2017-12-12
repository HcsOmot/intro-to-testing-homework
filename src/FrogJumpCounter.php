<?php

class FrogJumpCounter
{
    public function findMinimalNumberOfJumpsToReachOtherSide($startPosition, $destination, $jumpLength): int
    {
        return (int) ceil(($destination - $startPosition) / $jumpLength);
    }
}
