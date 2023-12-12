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

//        $this->show($map);

        return $this->count2($points, $rows, $columns);
    }

    public function count2($points, $rows, $columns){
        $up = 1000000 - 1;
        $total = 0;
        for ($p = 1; $p <= count($points); $p++) {
            for ($k = $p+1; $k <= count($points) ; $k++) {
                $x = $points[$p][0] - $points[$k][0];
                if($x < 0){
                    $x *= -1;
                    for ($i = $points[$p][0]; $i < $points[$k][0]; $i++) {
                        if(in_array($i, $rows)){
                            $x += $up;
                        }
                    }
                }else{
                    for ($i = $points[$k][0]; $i < $points[$p][0]; $i++) {
                        if(in_array($i, $rows)){
                            $x += $up;
                        }
                    }
                }
                $y = $points[$p][1] - $points[$k][1];
                if($y < 0){
                    $y *= -1;
                    for ($i = $points[$p][1]; $i < $points[$k][1]; $i++) {
                        if(in_array($i, $columns)){
                            $y += $up;
                        }
                    }
                }else{
                    for ($i = $points[$k][1]; $i < $points[$p][1]; $i++) {
                        if(in_array($i, $columns)){
                            $y += $up;
                        }
                    }
                }
                $total += $x + $y;
            }
        }
        return $total;
    }
}
