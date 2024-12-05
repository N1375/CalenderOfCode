<?php

namespace Days\y2024\Day05;

class Day5First  implements \Days\Day
{
    public function run(array $input): int|string
    {
        $total = 0;
        $list = [];
        $data = [];
        $boolList = true;
        foreach ($input as $row) {
            if (empty($row)){
                $boolList = false;
                continue;
            }
            if ($boolList) {
                $list[] = explode("|", $row);
            }else{
                $data[] = explode(",",$row);
            }
        }

        foreach ($data as $check) {
            $total += $this->checkPage($list,$check);
        }

        return $total;
    }

    public function checkPage($list, $data):int|bool{
        foreach ($list as $rule) {
            if (in_array($rule[0], $data) && in_array($rule[1], $data)) {
                $beforeIndex = array_search($rule[0], $data);
                $afterIndex = array_search($rule[1], $data);

                if ($beforeIndex > $afterIndex) {
                    return false;  // Rule violated, return 0
                }
            }
        }

        return $data[floor(count($data) / 2)];
    }
}
