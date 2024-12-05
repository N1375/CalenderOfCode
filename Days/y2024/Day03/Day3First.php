<?php

namespace Days\y2024\Day03;

class Day3First  implements \Days\Day
{
    public function run(array $input): int|string
    {
        $total = 0;
        preg_match_all('/mul\((\d+?),(\d+?)\)/', implode("",$input), $matches);
        foreach ($matches[1] as $k => $v){
            $total += ($v*$matches[2][$k]);
        }
        return $total;
    }
}
