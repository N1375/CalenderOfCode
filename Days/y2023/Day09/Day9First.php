<?php

namespace Days\y2023\Day09;

class Day9First  implements \Days\Day
{
    public function run(array $input): int|string
    {
        $total = 0;

        $numbers = [];
        foreach ($input as $r => $row){
            $numbers[$r][0] = explode(" ", $row);
            for ($i = 0; $i <$numbers[$r][$i]; $i++) {
                foreach ($numbers[$r][$i] as $l => $line) {
                    if ($l === 0) {
                        continue;
                    }
                    $numbers[$r][$i + 1][] = $line - $numbers[$r][$i][$l - 1];
                }
                if ((array_count_values($numbers[$r][$i + 1])[0] ?? 1) === count($numbers[$r][$i + 1])) {
                    $numbers[$r][$i + 1][] = 0; // add zero
                    break;
                }
            }
            for ($j = count($numbers[$r]) - 2; $j >= 0; $j--) {
                $numbers[$r][$j][] = $numbers[$r][$j + 1][count($numbers[$r][$j + 1]) - 1] + $numbers[$r][$j][count($numbers[$r][$j]) - 1];
            }
            $total += $numbers[$r][0][count($numbers[$r][0])-1];
        }


        return $total;
    }
}
