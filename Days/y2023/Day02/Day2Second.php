<?php

namespace Days\y2023\Day02;

class Day2Second extends Day2First implements \Days\Day
{
    /**
     * @param array $input
     *
     * @return int|string
     */
    public function run(array $input): int|string
    {
        $total = 0;
        foreach ($input as $row) {
            preg_match('/Game\s(\d+):/', $row, $gameNr);
            $row = preg_replace('/Game\s(\d+):/', '', $row);
            $game = explode(';',$row);
            $red = 1;
            $blue = 1;
            $green = 1;
            foreach ($game as $round){
                preg_match_all('/(\d+) red|(\d+) green|(\d+) blue/',$round, $matches);
                foreach ($matches[1] as $reds){
                    if($reds > $red){
                        $red = $reds;
                    }
                }
                foreach ($matches[2] as $greens){
                    if ($greens > $green){
                        $green = $greens;
                    }
                }
                foreach ($matches[3] as $blues){
                    if ($blues > $blue){
                        $blue = $blues;
                    }
                }
            }
            $total += ($red * $blue * $green);
        }

        return $total;
    }
}
