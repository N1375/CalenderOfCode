<?php

namespace Days\y2023\Day03;

class Day3Second extends Day3First implements \Days\Day
{
    /**
     * @param array $input
     *
     * @return int|string
     */
    public function run(array $input): int|string
    {
        $total = 0;
        $grid = [];
        $numbers = [];
        foreach ($input as $row) {
            $grid[] = str_split('.' . $row . '.');
        }
        foreach ($grid as $r => $row) {
            $number = 0;
            foreach ($row as $c => $char) {
                if (is_numeric($char)) {
                    $number = ($number * 10) + (int)$char;
                } elseif ($number != 0) {
                    for ($i = strlen($number); $i > 0; $i--) {
                        $result = $this->lookForStar($grid, $r, $c - $i);
                        if ($result !== false) {
                            $numbers[] = [$number, $result];
                            break;
                        }
                    }
                    $number = 0;
                }
            }
        }

        foreach ($numbers as $k => $number) {
            unset($numbers[$k]);
            foreach ($numbers as $s => $secondNumber) {
                if (
                    $number[1][0] == $secondNumber[1][0]
                    && $number[1][1] == $secondNumber[1][1]
                ) {
                    $total += ($number[0] * $secondNumber[0]);
                    unset($numbers[$s]);
                    continue 2;
                }
            }
        }

        return $total;
    }

    /**
     * @param array $grid
     * @param int $r
     * @param int $c
     *
     * @return false|array
     */
    public function lookForStar(array $grid, int $r, int $c): false|array
    {
        return match(true){
            (($grid[$r - 1][$c - 1] ?? '.') === '*') => [$r - 1, $c - 1],
            (($grid[$r - 1][$c] ?? '.') === '*') => [$r - 1, $c],
            (($grid[$r - 1][$c + 1] ?? '.') === '*') => [$r - 1, $c + 1],
            (($grid[$r + 1][$c - 1] ?? '.') === '*') => [$r + 1, $c - 1],
            (($grid[$r + 1][$c] ?? '.') === '*') => [$r + 1, $c],
            (($grid[$r + 1][$c + 1] ?? '.') === '*') => [$r + 1, $c + 1],
            (($grid[$r][$c - 1] ?? '.') === '*') => [$r, $c - 1],
            (($grid[$r][$c + 1] ?? '.') === '*') => [$r, $c + 1],
            default => false
        };
    }
}
