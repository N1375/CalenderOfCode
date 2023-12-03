<?php

namespace Days\y2023\Day02;

class Day2First  implements \Days\Day
{
    /**
     * @var array|int[]
     */
    private array $impossible = [12, 13, 14];

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
            foreach ($game as $round){
                preg_match_all('/(\d+) red|(\d+) green|(\d+) blue/',$round, $matches);
                foreach ($matches[1] as $red){
                    if($red > $this->impossible[0]){
                        continue 3;
                    }
                }
                foreach ($matches[2] as $green){
                    if($green > $this->impossible[1]){
                        continue 3;
                    }
                }
                foreach ($matches[3] as $blue){
                    if($blue > $this->impossible[2]){
                        continue 3;
                    }
                }
            }
            $total += (int)$gameNr[1];
        }

        return $total;
    }
}
