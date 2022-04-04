<?php

namespace App\Services\Distance;

/**
 * Service for calculation distance Hamming or Levenshtein
 */
class Distance implements DistanceInterface
{
    /**
     * @var
     * @type string
     */
    private $source;

    /**
     * @var
     * @type string
     */
    private $dest;

    /**
     * @var
     * @type int
     */
    private $sourceLength;

    /**
     * @var
     * @type int
     */
    private $destLength;

    /**
     * @param string $source
     * @param string $dest
     */
    public function setStrings(string $source, string $dest): void
    {
        list($this->source, $this->dest, $this->sourceLength, $this->destLength) = [
            $source,
            $dest,
            strlen($source),
            strlen($dest)
        ];
    }

    /**
     * Hamming distance calculation
     *
     * @return int
     */
    public function distanceHamming(): int
    {
        $check = $this->stringPreCheck();
        if (!is_null($check))
        {
            return $check;
        }

        $dist = range(0, $this->destLength);
        for ($i = 0; $i < $this->sourceLength; $i++) {
            $tempDist = [$i + 1];
            for ($j = 0; $j < $this->destLength; $j++) {
                $cost = ($this->source[$i] == $this->dest[$j]) ? 0 : 1;
                $tempDist[$j + 1] = min(
                    $dist[$j + 1] + 1,   // deletion
                    $dist[$j] + $cost    // substitution
                );
            }
            $dist = $tempDist;
        }

        return $dist[$this->destLength];
    }

    /**
     * Levenshtein distance calculation
     *
     * @param string $source
     * @param string $dest
     * @return int
     */
    public function distanceLevenshtein(): int
    {
        $check = $this->stringPreCheck();
        if (!is_null($check))
        {
            return $check;
        }

        $dist = range(0, $this->destLength);
        for ($i = 0; $i < $this->sourceLength; $i++) {
            $tempDist = [$i + 1];
            for ($j = 0; $j < $this->destLength; $j++) {
                $cost = ($this->source[$i] == $this->dest[$j]) ? 0 : 1;
                $tempDist[$j + 1] = min(
                    $dist[$j + 1] + 1,   // deletion
                    $tempDist[$j] + 1,      // insertion
                    $dist[$j] + $cost    // substitution
                );
            }
            $dist = $tempDist;
        }

        return $dist[$this->destLength];
    }

    /**
     * @return int|null
     */
    private function stringPreCheck():? int
    {
        if ($this->source == $this->dest) {
            return 0;
        }

        if ($this->sourceLength == 0 || $this->destLength == 0) {
            return $this->destLength != 0 ? $this->destLength : $this->sourceLength;
        }

        return null;
    }
}
