<?php

namespace Days\y2023\Day08;

class Day8Second extends Day8First implements \Days\Day
{
    public function run(array $input): int|string
    {
        $total = 0;
        $instructions = str_split(array_shift($input));

        $map = [];
        $goto = [];

        for ($i = 1; $i <= count($input); $i++) {
            preg_match_all('/([A-Z]+)/', $input[$i], $matches);
            $map[$matches[0][0]] = ['L'=> $matches[0][1], 'R' => $matches[0][2]];
            if(str_ends_with($matches[0][0], 'A')){
                $goto[] = $matches[0][0];
            }
        }

        while(true){
            foreach ($instructions as $step) {
                foreach ($goto as &$loc) {
                    $loc = $map[$loc][$step];
                }
                $total++;
                $stop = true;
                foreach ($goto as $Eloc){
                    if(!str_ends_with($Eloc, 'Z')){
                        $stop = false;
                    }
                }
                if($stop){
                    break 2;
                }
            }
        }

        return $total;
    }
}
