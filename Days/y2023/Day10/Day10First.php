<?php

namespace Days\y2023\Day10;

class Day10First  implements \Days\Day
{
    /**
     * @param array $input
     *
     * @return int|string
     */
    public function run(array $input): int|string
    {
        if(isset($_GET['test'])) {
            $input = [
                '..F7.',
                '.FJ|.',
                'SJ.L7',
                '|F--J',
                'LJ...',
            ];
        }
        $total = 0;
        $map = [];
        $path = [];
        $startX = 0;
        $startY = 0;

        foreach ($input as $r => $row) {
            $map[] = str_split($row);
            $x = strpos($row, "S");
            if($x !== false){
                $startY = $x;
                $startX = $r;
            }
        }

        $path[$startX][$startY] = 0;
//        $newlocations = $this->checkAround($map,$startX, $startY);
        $newlocations = [[$startX, $startY]];


        for ($i = 0; $i < count($newlocations); $i++) {
            $locations = $this->checkAround($map, $newlocations[$i][0], $newlocations[$i][1]);
            foreach ($locations as $pos) {
                if (!isset($path[$pos[0]][$pos[1]])) {
                    $nr = $path[$newlocations[$i][0]][$newlocations[$i][1]] + 1;
                    $path[$pos[0]][$pos[1]] = $nr;
                    $newlocations[] = $pos;
                    if($total < $nr){
                        $total = $nr;
                    }
                }
            }
        }


//        $this->show($path, count($map), count($map[0]));
        return $total;
    }

    /**
     * @param array $map
     * @param int $x
     * @param int $y
     *
     * @return array
     */
    public function checkAround(array $map, int $x, int $y): array
    {
        $return = [];
        if(in_array($map[$x-1][$y] ?? '.', ['|','F','7'])){
            $return[] = [$x-1, $y];
        }
        if(in_array($map[$x+1][$y] ?? '.', ['|','J','L'])){
            $return[] = [$x+1, $y];
        }
        if(in_array($map[$x][$y-1] ?? '.', ['-','F','L'])){
            $return[] = [$x, $y-1];
        }
        if(in_array($map[$x][$y+1] ?? '.', ['-','J','7'])){
            $return[] = [$x, $y+1];
        }
        return $return;
    }

    /**
     * @param array $map
     * @param int $sizeX
     * @param int $sizeY
     *
     * @return void
     */
    public function show(array $map, int $sizeX, int $sizeY){
        echo "<table>";
        for ($i = 0; $i < $sizeX; $i++) {
            echo "<tr>";
            for ($j = 0; $j < $sizeY; $j++) {
                echo "<td>";
                echo $map[$i][$j];
                echo "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
}
