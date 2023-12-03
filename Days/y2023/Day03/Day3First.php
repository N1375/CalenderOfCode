<?php

namespace Days\y2023\Day03;

class Day3First  implements \Days\Day
{
    /**
     * @param array $input
     *
     * @return int|string
     */
    public function run(array $input): int|string
    {
        $total = 0;
        $grid = [];
        foreach ($input as $row){
            $grid[] = str_split('.' . $row . '.');
        }
        foreach ($grid as $r => $row){
            $number = 0;
            foreach ($row as $c => $char){
                if (is_numeric($char)) {
                    $number = ($number * 10) + (int)$char;
                } else {
                    for ($i = strlen($number); $i > 0; $i--) {
                        if ($this->lookAround($grid, $r, $c - $i)) {
                            $total += $number;
                            break;
                        }
                    }
                    $number = 0;
                }
            }
        }

        return $total;
    }

    /**
     * @param array $grid
     * @param int $r
     * @param int $c
     *
     * @return bool
     */
    public function lookAround(array $grid, int $r, int $c): bool
    {
        return !(
            ($grid[$r-1][$c-1] ?? '.') == '.'
            && ($grid[$r-1][$c] ?? '.') == '.'
            && ($grid[$r-1][$c+1] ?? '.') == '.'
            && ($grid[$r+1][$c-1] ?? '.') == '.'
            && ($grid[$r+1][$c] ?? '.') == '.'
            && ($grid[$r+1][$c+1] ?? '.') == '.'
            && (
                ($grid[$r][$c-1] ?? '.') == '.'
                || is_numeric($grid[$r][$c-1])
            )
            && (
                ($grid[$r][$c+1] ?? '.') == '.'
                || is_numeric($grid[$r][$c+1])
            )
        );
    }
}
