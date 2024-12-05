<?php

namespace Days\y2024\Day01;

class Day1Second extends Day1First implements \Days\Day
{
    public function run(array $input): int|string
    {
        $total = 0;
        $listA = [];
        $listB = [];
        foreach ($input as $row) {
            preg_match_all('/\d+/', $row, $matches);
            $listA[] = $matches[0][0];
            $listB[] = $matches[0][1];
        }

        $listB_counts = array_count_values($listB);

        foreach ($listA as $k => $a) {
            $total += $a * ($listB_counts[$a] ?? 0);
        }

        return $total;
    }
}
