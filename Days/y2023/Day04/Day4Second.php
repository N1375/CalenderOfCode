<?php

namespace Days\y2023\Day04;

class Day4Second extends Day4First implements \Days\Day
{
    /**
     * @param array $input
     *
     * @return int|string
     */
    public function run(array $input): int|string
    {
        $total = 0;
        $double = [];
        foreach ($input as $game => $row){
            $row = preg_replace('/Card\s+\d+\:/', '', $row);
            $numbers = explode('|', $row);
            $winningNumbers = explode(' ', $numbers[0]);
            $tickets = explode(' ', $numbers[1]);

            $win = 0;
            foreach ($winningNumbers as $n){
                if ($n !== '' && in_array($n, $tickets)){
                    $win++;
                    $double[$game + $win] = ($double[$game + $win] ?? 1) + ($double[$game] ?? 1);
                }
            }
            $total += ($double[$game] ?? 1);
        }

        return $total;
    }
}
