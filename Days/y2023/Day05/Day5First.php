<?php

namespace Days\y2023\Day05;

class Day5First  implements \Days\Day
{
    /**
     * @param array $input
     *
     * @return int|string
     */
    public function run(array $input): int|string
    {
        $text = implode(' ', $input);
        preg_match_all('/.+?:([^a-z]+)/', $text, $matches);
        $seeds = explode(' ',trim($matches[1][0]));

        return $this->getNumber($seeds, $matches);
    }

    /**
     * @param int $seed
     * @param array $numbers
     *
     * @return int
     */
    protected function getMapping(int $seed, array $numbers):int
    {
        for ($i = 0; $i < count($numbers); $i+=3) {
            if($seed >= $numbers[$i+1] && $seed <= ($numbers[$i+1] + $numbers[$i+2])) {
                $seed += ($numbers[$i] - $numbers[$i+1]);
                return $seed;
            }
        }
        return $seed;
    }

    /**
     * @param array $realSeeds
     * @param array $matches
     *
     * @return int
     */
    public function getNumber(array $realSeeds, array $matches):int
    {
        $locations = [];
        foreach ($realSeeds as $originalSeed) {
            $seed = $originalSeed;
            for ($i = 1; $i < count($matches[1]); $i++) {
                $seed = $this->getMapping($seed, explode(' ', trim($matches[1][$i])));
            }
            $locations[] = $seed;
        }

        return min($locations);
    }
}
