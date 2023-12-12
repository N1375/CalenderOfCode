<?php

namespace Days\y2023\Day10;

class Day10Second extends Day10First implements \Days\Day
{
    public function run(array $input): int|string
    {
        if(isset($_GET['test'])) {
            $input = [
'FF7FSF7F7F7F7F7F---7',
'L|LJ||||||||||||F--J',
'FL-7LJLJ||||||LJL-77',
'F--JF--7||LJLJ7F7FJ-',
'L---JF-JLJ.||-FJLJJ7',
'|F|F-JF---7F7-L7L|7|',
'|FFJF7L7F-JF7|JL---7',
'7-L-JL7||F7|L7F-7F7|',
'L.L7LFJ|||||FJL7||LJ',
'L7JLJL-JLJLJL--JLJ.L',
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
        $newlocations =  $this->checkAround($map,$startX, $startY);

        for ($i = 0; $i < count($newlocations); $i++) {
            $locations = $this->getNext($map, $newlocations[$i][0], $newlocations[$i][1]);
            foreach ($locations as $pos) {
                if (!isset($path[$pos[0]][$pos[1]])) {
                    $nr = $path[$newlocations[$i][0]][$newlocations[$i][1]] + 1;
                    $path[$pos[0]][$pos[1]] = $nr;
                    $newlocations[] = $pos;
                }
            }
        }
        $z = count($map);
        foreach ($map as $x => $row){
            foreach ($row as $y => $tile){
                if(
                    !isset($path[$x][$y])
                    && ($x > ($z/4) && $x < $z - ($z/4))
                    && ($y > ($z/4) && $y < $z - ($z/4))
                ){
                    $total++;
                }
            }
        }

//        $this->show2($map, count($map), count($map[0]), $path);
        return $total;
    }

    /**
     * @param array $map
     * @param int $sizeX
     * @param int $sizeY
     * @param array $path
     *
     * @return void
     */
    public function show2(array $map, int $sizeX, int $sizeY, array $path): void
    {
        echo "<style>
.U {border-top: darkred 1px solid;}
.D {border-bottom: darkred 1px solid;}
.L {border-left: darkred 1px solid;}
.R {border-right: darkred 1px solid;}
.W {background-color: white; color: white;}
body{background-color: darkred;}
</style>";
        echo "<table cellspacing='0'>";
        for ($i = 0; $i < $sizeX; $i++) {
            echo "<tr>";
            for ($j = 0; $j < $sizeY; $j++) {
                if(!isset($path[$i][$j])){
                    if(($i > ($sizeX/4) && $i < $sizeX - ($sizeX/4)) && ($j > ($sizeX/4) && $j < $sizeY - ($sizeX/4))){
                        echo "<td style='color: yellow; background-color: yellow'>";
                    }else {
                        echo "<td style='color: darkred;'>";
                    }
                }else{
                    echo "<td class='W ".$this->getBorder($map[$i][$j])."'>".$map[$i][$j];
                }
                echo "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    /**
     * @param string $sign
     *
     * @return string
     */
    public function getBorder(string $sign): string
    {
        switch ($sign){
            case '|': return 'L R';
            case '-': return 'U D';
            case 'F': return 'U L';
            case '7': return 'U R';
            case 'J': return 'D R';
            case 'L': return 'D L';
            default: return'';
        }
    }

    /**
     * @param $map
     * @param $x
     * @param $y
     *
     * @return array[]
     */
    public function getNext($map, $x, $y): array
    {
        return match ($map[$x][$y]) {
            '|' => [[$x - 1, $y], [$x + 1, $y]],
            '-' => [[$x, $y - 1], [$x, $y + 1]],
            'F' => [[$x + 1, $y], [$x, $y + 1]],
            '7' => [[$x + 1, $y], [$x, $y - 1]],
            'J' => [[$x - 1, $y], [$x, $y - 1]],
            'L' => [[$x - 1, $y], [$x, $y + 1]],
        };
    }
}