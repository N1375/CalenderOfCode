<?php

namespace Days\y2023\Day13;

class Day13First  implements \Days\Day
{
    public function run(array $input): int|string
    {
        $total = 0;
        $map = [];
        $m = 1;
        foreach ($input as $row){
            if($row === ''){
                $m++;
                $map[$m] = [];
                continue;
            }
            $map[$m][] = $row;
        }

        $this->checkRows($map, 100);

        

        $this->checkRows($map);

        var_dump($total);
        echo "<pre>";
        print_r($map);

    }

    public function checkRows($map, $multiply = 1){
        $total = 0;
        for ($i = 1; $i <= count($map); $i++) {
            for ($r = 1; $r < count($map[$i]); $r++) {
                if($map[$i][$r-1]===$map[$i][$r]){
                    $middle = $r;
                }
            }
            for ($j = 1; $j <= $middle; $j++) {
                if(
                    isset($map[$i][$middle - $j],$map[$i][$middle + $j -1])
                    && $map[$i][$middle - $j] !== $map[$i][$middle + $j -1]
                ){
                    continue 2;
                }
            }
//            echo "map".$i.' split at' . $middle;
            $total += ($multiply * $middle);
        }
        return $total;
    }
}
