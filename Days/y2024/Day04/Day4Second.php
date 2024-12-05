<?php

namespace Days\y2024\Day04;

class Day4Second extends Day4First implements \Days\Day
{
    public function run(array $input): int|string
    {
        $grid = [];
        foreach ($input as $row){
            $grid[] = str_split($row);
        }

        return $this->countGrid($grid);
    }

    public function checkXMAS(int $x, int $y, array $grid): int
    {
        $total = 0;
        if ($grid[$y][$x] == "A") {
            if ($y == 0 || $x == 0 || $y == count($grid) -1 || $x == count($grid[$y]) -1) {
                return 0;
            }
            if (
                $grid[$y-1][$x-1] == "M" && $grid[$y+1][$x+1] == "S"
                || $grid[$y-1][$x-1] == "S" && $grid[$y+1][$x+1] == "M"
            ) {
                if (
                    $grid[$y-1][$x+1] == "M" && $grid[$y+1][$x-1] == "S"
                    || $grid[$y-1][$x+1] == "S" && $grid[$y+1][$x-1] == "M"
                ) {
                    $total += 1;
                }
            }
        }
        return $total;
    }
}
