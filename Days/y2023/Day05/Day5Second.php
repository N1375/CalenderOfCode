<?php

namespace Days\y2023\Day05;

class Day5Second extends Day5First implements \Days\Day
{
    public function run(array $input): int|string
    {
        $text = implode(' ', $input);
        preg_match_all('/.+?:([^a-z]+)/', $text, $matches);
        $seeds = explode(' ', trim($matches[1][0]));
        $nr = 100000000000;
        $path = 'Days/y2023/Day05/';
        for ($i = 0; $i < count($seeds); $i+=2) {
            if(file_exists($path . $i. '.php')){
                $data = json_decode(file_get_contents($path . $i.'.php'));
                if($data[0] < $nr){
                    $nr = $data[0];
                }
            }
        }
        return $nr;
    }
}
