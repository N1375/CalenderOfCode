<?php

namespace Days\y2023\Day06;

class Day6Second extends Day6First implements \Days\Day
{
    /**
     * @param array $input
     *
     * @return int|string
     */
    public function run(array $input): int|string
    {
        $time = preg_replace('/[^0-9]/', '', $input[0]);
        $distance = preg_replace('/[^0-9]/','', $input[1]);

        return $this->getOptions($time, $distance);
    }
}
