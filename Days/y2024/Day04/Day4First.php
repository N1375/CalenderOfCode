<?php

namespace Days\y2024\Day04;

class Day4First  implements \Days\Day
{
    public function run(array $input): int|string
    {
        $grid = [];
        foreach ($input as $row){
            $grid[] = str_split($row);
        }

        return $this->countGrid($grid);
    }

    public function countGrid($grid): int
    {
        $total = 0;
        for ($y = 0; $y < count($grid); $y++) {
            for ($x = 0; $x < count($grid[$y]); $x++) {
                $total += $this->checkXMAS($x, $y, $grid);
            }
        }

        return $total;
    }

    public function checkXMAS(int $x, int $y, array $grid): int{
        $total = 0;
        if ($grid[$y][$x] == "X") {
            for ($i = -1 ; $i <= 1; $i++) {
                for ($j = -1 ; $j <= 1; $j++) {
                    if ($i == 0 && $j == 0) continue; // not needed.
                    if (isset($grid[$y+$i][$x+$j])){
                        if($grid[$y+$i][$x+$j] == "M") {
                            if(isset($grid[$y+($i*2)][$x+($j*2)])) {
                                if ($grid[$y + ($i * 2)][$x + ($j * 2)] == "A") {
                                    if (isset($grid[$y + ($i * 3)][$x + ($j * 3)])) {
                                        if ($grid[$y + ($i * 3)][$x + ($j * 3)] == "S") {
                                            $total++;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $total;
    }
}
