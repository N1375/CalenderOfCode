<?php

namespace Days\y2023\Day07;

class Day7First  implements \Days\Day
{
    /**
     * @var string
     */
    protected string $order = 'BCDEFGHIJKLM';

    /**
     * @param array $input
     *
     * @return int|string
     */
    public function run(array $input): int|string
    {
        $winnings = [];
        $dims = [];
        foreach ($input as $k => $row){
            $line = explode(' ', $row);
            $dims[$k] = $line[1];
            $winnings[$this->checkHand($line[0])][$k] = str_replace(str_split('KQJT987654321'), str_split($this->order), $line[0]);
        }
        asort($winnings);
        return $this->calcTotal($winnings,$dims);
    }

    /**
     * @param string $hand
     *
     * @return int
     */
    public function checkHand(string $hand): int
    {
        $card = str_split($hand);
        $filter = array_unique($card);
        if (count($filter) === 1){
            // Five of a kind
            return 6;
        } elseif (count($filter) === 2){
            if(in_array(1, array_count_values($card))) {
                // Four of a kind
                return 5;
            }
            // Full house
            return 4;
        } elseif (count($filter) === 3){
            if(in_array(3, array_count_values($card))) {
                // Three of a kind
                return 3;
            }
            // Two pair
            return 2;
        } elseif (count($filter) === 4){
            // One pair
            return 1;
        } else {
            // High card
            return 0;
        }
    }

    /**
     * @param array $winnings
     * @param array $dims
     *
     * @return int
     */
    public function calcTotal(array $winnings, array $dims):int
    {
        $total = 0;
        $win = 1;
        for ($i = 0; $i <= 6; $i++) {
            if(!isset($winnings[$i])){
                continue;
            }
            $type = $winnings[$i];
            arsort($type);
            foreach ($type as $hand => $cards){
//                echo $win." = card " . $hand . " :" . $dims[$hand]. " '".$cards."' $i<br/>";
                $total += $win * $dims[$hand];
                $win++;
            }
        }
        return $total;
    }
}
