<?php

namespace Days\y2023\Day12;

class Day12First implements \Days\Day
{
    /**
     * @var string[]
     */
    public array $sequence;

    /**
     * @var string
     */
    public string $pattern;

    public function run(array $input): int|string
    {
        $path = 'Days/y2023/Day12/';
        if (file_exists($path.'first.txt')){
            return file_get_contents($path. 'first.txt');
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
            $this->sequence = explode(',', $pattern[1]);
            $this->pattern = '.' . $pattern[0] . '.';
            $total = $this->checkPattern(0, 0, 0);
//            echo $this->pattern . ' ' . implode(',',$this->sequence) ."::".$total."<br/>";
            $subTotal += $total;
        }

        return $subTotal;
    }

    /**
     * @param int $char
     * @param int $step
     * @param int $left
     *
     * @return int
     */
    public function checkPattern(int $char, int $step, int $left): int
    {
        if ($char === strlen($this->pattern)) {
            if ($step === count($this->sequence) && $left === 0) {
                return 1;
            }
            return 0;
        }
        if ($step > count($this->sequence)) {
            return 0;
        }
        $total = 0;
        if (substr($this->pattern, $char, 1) === '.') {
            if ($left === 0) {
                if ($step < count($this->sequence)) {
                    $total += $this->checkPattern($char + 1, $step + 1, $this->sequence[$step]);
                }
                $total += $this->checkPattern($char + 1, $step, 0);
            }
        } elseif (substr($this->pattern, $char, 1) === '#') {
            if ($left > 0) {
                $total += $this->checkPattern($char + 1, $step, $left - 1);
            }
        } else {
            if ($left === 0) {
                if ($step < count($this->sequence)) {
                    $total += $this->checkPattern($char + 1, $step + 1, $this->sequence[$step]);
                }
                $total += $this->checkPattern($char + 1, $step, 0);
            }
            if ($left > 0) {
                $total += $this->checkPattern($char + 1, $step, $left - 1);
            }
        }
        return $total;
    }
}
