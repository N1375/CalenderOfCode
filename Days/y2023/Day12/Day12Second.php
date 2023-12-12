<?php

namespace Days\y2023\Day12;

class Day12Second extends Day12First implements \Days\Day
{
    public function run(array $input): int|string
    {
        $path = 'Days/y2023/Day12/';
        if (file_exists($path.'second.txt')){
            return file_get_contents($path.'second.txt');
        }
        if (isset($_GET['test'])) {
            $input = [
                '???.### 1,1,3',
                '.??..??...?##. 1,1,3',
                '?#?#?#?#?#?#?#? 1,3,1,6',
                '????.#...#... 4,1,1',
                '????.######..#####. 1,6,5',
                '?###???????? 3,2,1',
            ];
        }

        $subTotal = 0;
        foreach ($input as $row) {
            $pattern = explode(' ', $row);
            $this->sequence = explode(',', substr(str_repeat($pattern[1] . ',', 5), 0, -1));
            $this->pattern = '.' . substr(str_repeat($pattern[0] . '?', 5), 0, -1) . '.';
            $total = $this->checkPattern(0, 0, 0);
//            echo $this->pattern . ' ' . implode(',',$this->sequence) ."::".$total."<br/>";
            $subTotal += $total;
        }

        return $subTotal;
    }
}
