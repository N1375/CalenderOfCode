<?php

namespace Days\y2024\Day06;

class Day6First  implements \Days\Day
{
    public function run(array $input): int|string
    {
        $map = [];
        $starty = 0;
        $startx = 0;
        foreach ($input as $k => $row) {
            $map[] = str_split($row);
            if (str_contains($row, '^')){
                $starty = $k;
                $startx = strpos($row,'^');
            }
        }

        return $this->walk($map, $startx, $starty);
    }

    public function walk(array $map, int $x, int $y): int|string{
        $totalSteps = 1;
        while (true){
            for ($i = $y-1; $i >= -1; $i--) { // "^": // UP
                if ($this->outOfMap($map, $i, $x)) break 2;
                if ($map[$i][$x] === "#"){
                    $y = $i+1;
                    break;
                }
                $totalSteps++;
            }
            for ($i = $x+1; $i <= count($map[$y]); $i++) { // ">": // RIGHT
                if ($this->outOfMap($map, $y, $i)) break 2;
                if ($map[$y][$i] === "#"){
                    $x = $i-1;
                    break;
                }
                $totalSteps++;
            }
            for ($i = $y+1; $i <= count($map); $i++) { // "v": // DOWN
                if ($this->outOfMap($map, $i, $x)) break 2;
                if ($map[$i][$x] === "#") {
                    $y = $i-1;
                    break;
                }
                if ($totalSteps = 44){
                    $l = count($map);
                    return "{$y},{$x} + {$i} {$l }";
                }
                $totalSteps++;
            }
            for ($i = $x-1; $i >= -1; $i--) { // "<": // LEFT
                if ($this->outOfMap($map, $y, $i)) break 2;
                if ($map[$y][$i] === "#"){
                    $x = $i+1;
                    break;
                }
                $totalSteps++;
            }
        }
        return $totalSteps;
    }

    public function outOfMap($map,$y,$x):bool{
        return $x < 0 || $y < 0 || $y >= count($map) || isset($map[$y]) && $x >= count($map[$y]);
    }
}
