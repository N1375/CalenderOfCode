<?php

namespace Days\y2023\Day11;

class Day11Second extends Day11First implements \Days\Day
{
    public function run(array $input): int|string
    {
        $map = [];
        $rows = [];
        $columns = [];

        foreach ($input as $r => $row){
            if(!str_contains($row, '#'))
            {
                $rows[] = $r;
            }
            $map[] = str_split($row);
        }

        for ($j = 0; $j < count($map[0]); $j++) {
            $check = true;
            for ($i = 0; $i < count($map); $i++) {
                if($map[$i][$j] === '#'){
                    $check = false;
                }
            }
            if ($check) {
                $columns[] = $j;
            }
        }

        $points = $this->getNumbers($map);

        $this->show($map);

        return $this->count2($points, $rows, $columns);
    }

    public function count2($points, $rows, $columns){
        $total = 0;
        for ($p = 1; $p <= count($points); $p++) {
            for ($k = $p+1; $k <= count($points) ; $k++) {
                $x = $points[$p][0] - $points[$k][0];
                if($x < 0){

                    $x *= -1;
                }else{

                }
                $y = $points[$p][1] - $points[$k][1];
                if($y < 0){
                    $y *= -1;
                }
                $total += $x + $y;
            }
        }
        return $total;
    }
}
