<?php

namespace Days\y2024\Day01;

use Exception;

class Day1First  implements \Days\Day
{
    public function run(array $input): int|string
    {
        $listA = [];
        $listB = [];
        foreach ($input as $row) {
            preg_match_all('/\d+/', $row, $matches);
            $listA[] = $matches[0][0];
            $listB[] = $matches[0][1];
        }

        sort($listA);
        sort($listB);

        $difference = [];
        foreach ($listA as $k => $a) {
            $difference[] = abs($a - $listB[$k]);
        }

        return array_sum($difference);
    }
}
