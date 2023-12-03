<?php

namespace Days\y2023\Day01;

class Day1Second extends Day1First implements \Days\Day
{
    /**
     * @param array $input
     *
     * @return int
     */
    public function run(array $input): int
    {
        $total = 0;
        foreach ($input as $row) {
            while(true){
                $first = $this->getFirstNumber($row);
                if ($first === false) {
                    $row = substr($row, 1);
                } else {
                    break;
                }
            }
            while(true){
                $last = $this->getLastNumber($row);
                if ($last === false){
                    $row = substr($row, 0, -1);
                } else {
                    break;
                }
            }

            $total += ($first * 10 ) + $last;
        }
        return (int)$total;
    }

    /**
     * @param string $string
     *
     * @return false|int
     */
    private function getFirstNumber(string $string): false|int
    {
        return match (true) {
            str_starts_with($string, 'one') => 1,
            str_starts_with($string, 'two') => 2,
            str_starts_with($string, 'three') => 3,
            str_starts_with($string, 'four') => 4,
            str_starts_with($string, 'five') => 5,
            str_starts_with($string, 'six') => 6,
            str_starts_with($string, 'seven') => 7,
            str_starts_with($string, 'eight') => 8,
            str_starts_with($string, 'nine') => 9,
            is_numeric(substr($string, 0, 1)) => (int)substr($string, 0, 1),
            default => false,
        };
    }

    /**
     * @param string $string
     *
     * @return false|int
     */
    private function getLastNumber(string $string): false|int
    {
        return match (true) {
            str_ends_with($string, 'one') => 1,
            str_ends_with($string, 'two') => 2,
            str_ends_with($string, 'three') => 3,
            str_ends_with($string, 'four') => 4,
            str_ends_with($string, 'five') => 5,
            str_ends_with($string, 'six') => 6,
            str_ends_with($string, 'seven') => 7,
            str_ends_with($string, 'eight') => 8,
            str_ends_with($string, 'nine') => 9,
            is_numeric(substr($string, -1, 1)) => (int)substr($string, -1, 1),
            default => false,
        };
    }
}
