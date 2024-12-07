<?php

namespace Days\y2024\Day07;

class Day7Second extends Day7First implements \Days\Day
{
    public function run(array $input): int|string
    {
        $total = 0;
        foreach ($input as $row) {
            preg_match_all('/(\d+):\s(\d+(?:\s\d+)+)/', $row, $matches);
            $total += $this->checkSum($matches[1][0], explode(" ", $matches[2][0]), ['+','*','||']);
        }

        return $total;
    }
}
