<?php

namespace Days\y2024\Day05;

class Day5Second extends Day5First implements \Days\Day
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
            $value = $this->checkPage($list,$check);
            if($value != false)
                $total += $value;
            while(true) {
                $newCheck = $this->reorder($list, $check);
                if($newCheck != false) break;
            }
            $total += $this->checkPage($list,$newCheck);
        }

        return $total;
    }

    public function reorder($list, $data)
    {
        foreach ($list as $rule) {
            if (in_array($rule[0], $data) && in_array($rule[1], $data)) {
                $beforeIndex = array_search($rule[0], $data);
                $afterIndex = array_search($rule[1], $data);

                if ($beforeIndex > $afterIndex) {
                    $temp = $data[$beforeIndex];
                    $data[$beforeIndex] = $data[$afterIndex];
                    $data[$afterIndex] = $temp;
                }
            }
        }

        return $data;
    }
}
