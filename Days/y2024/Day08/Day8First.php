<?php

namespace Days\y2024\Day08;

class Day8First  implements \Days\Day
{
    public function run(array $input): int|string
    {
        $total = 0;
        $chars = [];
        $width = 0;
        $done = [];
        $antannas = [];
        foreach ($input as $y => &$row) {
            $row = str_split($row);
            $width = count($row);
            foreach ($row as $x => $char) {
                if ($char != '.') {
                    $chars[($y* $width)+$x] = $char;
                }
            }
        }

        foreach($chars as $pos => $char){
            $done[] = $pos;
            $x = $pos%$width;
            $y = floor($pos/$width);
            $same = array_keys($chars, $char);
            $same = array_diff($same,$done);
            $same = array_values($same);
            for($i=0;$i<count($same);$i++){
                $xs = $same[$i]%$width;
                $ys = floor($same[$i]/$width);

                $difx = $xs - $x;
                $dify = $ys - $y;

                if($x > $xs){
                    $difx1 = $x - $difx;
                    $difx2 = $xs + $difx;
                }else{
                    $difx1 = $x - $difx;
                    $difx2 = $xs + $difx;
                }
                if($y > $ys){
                    $dify1 = $y + $dify;
                    $dify2 = $ys - $dify;
                }else{
                    $dify1 = $y - $dify;
                    $dify2 = $ys + $dify;
                }
                if ($difx1 >= 0 && $difx1 < $width && $dify1 >= 0 && $dify1 < count($input)){
                    //	print_r("added {$char} at {$dify1}.{$difx1}\n");
                    if (!isset($antannas[$dify1][$difx1])){
                        $antannas[$dify1][$difx1] = 1;
                        $total ++;
                    }
                }
                if ($difx2 >= 0 && $difx2 < $width && $dify2 >= 0 && $dify2 < count($input)){
                    //	print_r("added {$char} at {$dify2}.{$difx2}\n");
                    if (!isset($antannas[$dify2][$difx2])){
                        $antannas[$dify2][$difx2] = 1;
                        $total ++;
                    }
                }

            }
        }
        return $total;
    }
}
