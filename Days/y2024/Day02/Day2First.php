<?php

namespace Days\y2024\Day02;

class Day2First  implements \Days\Day
{
    public function run(array $input): int|string
    {
        $total = 0;
        foreach ($input as $row) {
            if ($this->check(explode(' ', $row))) {
                $total++;
            }
        }
        return $total;
    }

    public function check($row){
        $upDown = Null;
        foreach ($row as $k => $value){
            if ($k==0) continue;
            if (
                   $value > ($row[$k-1] + 3)
                || $value < ($row[$k-1] - 3)
                || $value == $row[$k-1])
            {
                return false;
            }
            if($upDown === Null){
                $upDown = ($value > $row[$k-1]);
            } elseif ($upDown == ($value < $row[$k - 1])) {
                return false;
            }
        }
        return true;
    }
}

