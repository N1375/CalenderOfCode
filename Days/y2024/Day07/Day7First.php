<?php

namespace Days\y2024\Day07;

class Day7First  implements \Days\Day
{
    public function run(array $input): int|string
    {
        $total = 0;
        foreach ($input as $row) {
            preg_match_all('/(\d+):\s(\d+(?:\s\d+)+)/', $row, $matches);
            $total += $this->checkSum($matches[1][0], explode(" ", $matches[2][0]), ['+', '*']);
        }

        return $total;
    }
    public function checkSum(string $sum, array $numbers, array $operators):int{
        $combinations = $this->getOperatorCombinations($operators, count($numbers));
        foreach($combinations as $combination){
            $total = $numbers[0];
            for ($i = 1; $i < count($numbers); $i++) {
                $total = eval("return ". $total ." " . $combination[$i] . " " . $numbers[$i] . ";");
            }
            if($total == $sum){
                return $sum;
            }

        }
        return 0;
    }

    public function getOperatorCombinations($operators, $count) {
        $combinations = [];
        if ($count == 1) {
            foreach ($operators as $operator) {
                $combinations[] = [$operator];
            }
        } else {
            foreach ($operators as $operator) {
                $subCombinations = $this->getOperatorCombinations($operators, $count - 1);
                foreach ($subCombinations as $subCombination) {
                    $combinations[] = array_merge([$operator], $subCombination);
                }
            }
        }
        return $combinations;
    }
}
