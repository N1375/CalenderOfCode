<?php

namespace Days\y2023\Day01;

use \Exception;

class Day1First  implements \Days\Day
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
            $letters = str_split($row);
            $total += ($this->getNumber($letters) * 10 ) + $this->getNumber(array_reverse($letters));
        }
        return $total;
    }

    /**
     * @param array $letters
     *
     * @return int
     *
     * @throws Exception
     */
    private function getNumber(array $letters): int
    {
        foreach ($letters as $char){
            if (is_numeric($char)) {
                return (int)$char;
            }
        }

        throw new Exception('no number found');
    }
}
