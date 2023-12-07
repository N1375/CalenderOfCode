<?php

namespace Days\y2023\Day06;

class Day6First  implements \Days\Day
{
    /**
     * @param array $input
     *
     * @return int|string
     */
    public function run(array $input): int|string
    {
        preg_match_all('/(\d+)/', $input[0], $times);
        preg_match_all('/(\d+)/', $input[1], $distance);

        $total = 1;
        foreach ($times[0] as $k => $time) {
            $total *= $this->getOptions($time, $distance[0][$k]);
        }

        return $total;
    }

    /**
     * @param int $time
     * @param int $distance
     *
     * @return int
     */
    public function getOptions(int $time, int $distance):int
    {
        $options = 0;
        for ($i = 0; $i <= $time; $i++) {
            if ($i * ($time - $i) > $distance) {
             $options++;
            }
        }
        return $options;
    }
}
