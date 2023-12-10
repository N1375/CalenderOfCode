<?php

namespace Days\y2023\Day08;

class Day8First  implements \Days\Day
{
    /**
     * @param array $input
     *
     * @return int|string
     */
    public function run(array $input): int|string
    {
        $total = 0;
        $instructions = str_split(array_shift($input));
        $map = [];

        for ($i = 1; $i <= count($input); $i++) {
            preg_match_all('/([A-Z]+)/', $input[$i], $matches);
            $map[$matches[0][0]] = ['L'=> $matches[0][1], 'R' => $matches[0][2]];
        }
        $goto = 'AAA';
        while($goto !== 'ZZZ') {
            foreach ($instructions as $step) {
                $goto = $map[$goto][$step];
                $total++;
            }
        }

        return $total;
    }
}
