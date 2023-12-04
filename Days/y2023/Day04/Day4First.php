<?php

namespace Days\y2023\Day04;

class Day4First  implements \Days\Day
{
    /**
     * @param array $input
     *
     * @return int|string
     */
    public function run(array $input): int|string
    {
        $total = 0;
        foreach ($input as $row){
            $row = preg_replace('/Card\s+\d+\:/', '', $row);
            $numbers = explode('|', $row);
            $winningNumbers = explode(' ', $numbers[0]);
            $tickets = explode(' ', $numbers[1]);

            $win = 0;
            foreach ($winningNumbers as $n){
                if ($n !== '' && in_array($n, $tickets)){
                    if ($win === 0){
                        $win = 1;
                    }else{
                        $win *= 2;
                    }
                }
            }
            $total += $win;
        }

        return $total;
    }
}
