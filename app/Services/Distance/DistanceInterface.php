<?php

namespace App\Services\Distance;

interface DistanceInterface
{
    /**
     * @return int
     */
    public function distanceHamming(): int;

    /**
     * @return int
     */
    public function distanceLevenshtein(): int;
}
