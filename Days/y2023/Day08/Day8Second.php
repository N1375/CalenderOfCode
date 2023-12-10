<?php

namespace Days\y2023\Day08;

class Day8Second extends Day8First implements \Days\Day
{
    /**
     * @param array $input
     *
     * @return int|string
     */
    public function run(array $input): int|string
    {
        $instructions = str_split(array_shift($input));
        $map = [];

        $goto = [];
        $first_Z = [];
        $allZ = [];

        for ($i = 0; $i < count($input); $i++) {
            preg_match_all('/([A-Z]+)/', $input[$i], $matches);
            $map[$matches[0][0]] = ['L'=> $matches[0][1], 'R' => $matches[0][2]];
            if(str_ends_with($matches[0][0], 'A')){
                $goto[] = $matches[0][0];
            }
        }

        foreach ($goto as $k => &$loc) {
            $count = 0;
            while(true) {
                foreach ($instructions as $step) {
                    $loc = $map[$loc][$step];
                    $count++;
                    if(str_ends_with($loc, 'Z')){
                        if(!isset($first_Z[$k])){
                            $first_Z[$k] = $loc;
                            $allZ[$k][0] = $count;
                            $count = 0;
                        }elseif($loc === $first_Z[$k]) {
                            $allZ[$k][1] = $count;
                            break 2;
                        }
                    }
                }
            }
        }

        $total = $allZ[0][0];

        for ($j = 1; $j < count($allZ); $j++) {
            $total = $this->LCM($allZ[$j][0], $total);
        }

        return $total;

    }

    /**
     * @param $x
     * @param $y
     *
     * @return int
     */
    public function LCM($x, $y): int
    {

        if ($x > $y) {
            $temp = $x;
            $x = $y;
            $y = $temp;
        }

        for($i = 1; $i < ($x+1); $i++) {
            if ($x%$i == 0 && $y%$i == 0) {
                $gcd = $i;
            }
        }

        return ($x*$y)/$gcd;
    }
}
