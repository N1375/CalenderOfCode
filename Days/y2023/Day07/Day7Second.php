<?php

namespace Days\y2023\Day07;

class Day7Second extends Day7First implements \Days\Day
{
    /**
     * @param array $input
     *
     * @return int|string
     */
    public function run(array $input): int|string
    {
        $this->order = 'BCZEFGHIJKLM';
        return parent::run($input);
    }

    /**
     * @param string $hand
     *
     * @return int
     */
    public function checkHand(string $hand): int
    {
        $card = str_split($hand);
        $J = 0;
        while(in_array('J', $card)){
            $J++;
            unset($card[array_search('J', $card)]);
        }
        $filter = array_unique($card);
        if (count($filter) <= 1){
            return 6; // Five of a kind
        } elseif (count($filter) === 2){
            if(in_array(2, array_count_values($card)) && $J<=1) {
                return 4; // Full house
            }
            return 5; // Four of a kind
        } elseif (count($filter) === 3){
            if ($J == 0 && !in_array(3, array_count_values($card))) {
                return 2; // Two pair
            }
            return 3; // Three of a kind
        } elseif (count($filter) === 4){
            return 1; // One pair
        } else {
            return 0; // Hi Card
        }
    }
}
