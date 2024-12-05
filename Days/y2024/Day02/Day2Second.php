<?php

namespace Days\y2024\Day02;

class Day2Second extends Day2First implements \Days\Day
{
    public function run(array $input): int|string
    {
        $total = 0;
        foreach ($input as $row) {
            $line = explode(' ', $row);
            if ($this->check($line)) {
                $total++;
            }else{
                for ($i = 0; $i <= count($line); $i++) {
                    $copy = $line;
                    unset($copy[$i]);
                    $copy = array_values($copy);
                    if ($this->check($copy)) {
                        $total++;
                        break;
                    }
                }
            }
        }
        return $total;
    }
}
