<?php

namespace Days\y2023\Day11;

use PgSql\Connection;

class Day11First  implements \Days\Day
{
    public function run(array $input): int|string
    {
        $map = [];

        foreach ($input as $row){
            if(!str_contains($row, '#'))
            {
                $map[] = str_split($row);
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
                for ($i = 0; $i < count($map); $i++) {
                    array_splice($map[$i], $j, 0, ['.']);
                }
                $j++;
            }
        }

        $points = $this->getNumbers($map);

//        $this->show($map);

        return $this->count($points);
    }

    public function show(array $map){
        echo "<table border='1px solid black'>";
        foreach ($map as $row) {
            echo "<tr>";
            foreach ($row as $tile) {
                echo "<td width='15px'>";
                echo $tile;
                echo "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    public function getNumbers(array $map)
    {
        $numbers = [];
        $count = 1 ;
        for ($i = 0; $i < count($map); $i++) {
            for ($j = 0; $j < count($map[0]); $j++) {
                if($map[$i][$j]==='#'){
                    $numbers[$count] = [$i,$j];
                    $count++;
                }
            }
        }
        return $numbers;
    }

    public function count($points){
        $total = 0;
        for ($p = 1; $p <= count($points); $p++) {
            for ($k = $p+1; $k <= count($points) ; $k++) {
                $x = $points[$p][0] - $points[$k][0];
                if($x < 0){
                    $x *= -1;
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
