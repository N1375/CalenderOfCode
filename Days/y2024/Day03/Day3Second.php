<?php

namespace Days\y2024\Day03;

class Day3Second extends Day3First implements \Days\Day
{
    public function run(array $input): int|string
    {
        $total = 0;
        $do = true;
        preg_match_all('/do(?:n\'t)?\(\)|mul\((\d+?),(\d+?)\)/', implode("",$input), $matches);
        foreach ($matches[1] as $k => $v){
            if (!$v){
                $do = $matches[0][$k] == "do()";
            }elseif($do) {
                $total += ($v * $matches[2][$k]);
            }
        }
        return $total;
    }
}
