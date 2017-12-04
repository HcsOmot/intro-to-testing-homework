<?php

class FrogJumpCounter
{
    public function findMinimalNumberOfJumpsToReachOtherSide($startPosition, $destination, $jumpLength)
    {
        return ceil(($destination - $startPosition) / $jumpLength);
    }
}
