<?php

namespace Days\y2023\Day05;

class Day5Second extends Day5First implements \Days\Day
{
    public function run(array $input): int|string
    {
        $text = implode(' ', $input);
        preg_match_all('/.+?:([^a-z]+)/', $text, $matches);
        $seeds = explode(' ', trim($matches[1][0]));
        $path = 'Days/y2023/Day05/';

        $cut = 100000;

        if (!file_exists($path. 'nr.txt')){
            file_put_contents($path. 'nr.txt', 100000000000);
        }
        if (!file_exists($path. 'seed.txt')){
            file_put_contents($path. 'seed.txt', 0);
        }
        if (!file_exists($path. 'cutStart.txt')){
            file_put_contents($path. 'cutStart.txt', 0);
        }
        if (!file_exists($path. 'cutEnd.txt')){
            file_put_contents($path. 'cutEnd.txt', $cut);
        }

        (int)$nr = file_get_contents($path. 'nr.txt');
        (int)$seedsNumber = file_get_contents($path. 'seed.txt');
        (int)$seedsCutterStart = file_get_contents($path. 'cutStart.txt');
        (int)$seedsCutterEnd = file_get_contents($path. 'cutEnd.txt');

        if((int)$seedsCutterEnd === (int)$seeds[$seedsNumber+1] + $cut){
            $seedsNumber+=2;
            if($seedsNumber>= count($seeds)){
                print_r($nr);
            }
            file_put_contents($path. 'seed.txt', $seedsNumber);
            $seedsCutterStart = 0;
            $seedsCutterEnd = $cut;
        }

        if ($seedsCutterEnd > $seeds[$seedsNumber+1]){
            $seedsCutterEnd = $seeds[$seedsNumber+1];
        }

        $range = range((int)$seeds[$seedsNumber] + $seedsCutterStart, (int)$seeds[$seedsNumber] + $seedsCutterEnd);

        file_put_contents($path. 'cutStart.txt', $seedsCutterStart + $cut);
        file_put_contents($path. 'cutEnd.txt', $seedsCutterEnd + $cut);

        $newNr = $this->getNumber($range, $matches);

        if ($newNr < $nr){
            $nr = $newNr;
            file_put_contents($path. 'nr.txt', $nr);
        }

//        print_r("Seed =".$seeds[$seedsNumber] + $seedsCutter.' : lowest='. $nr);

        header("Refresh:0");
    }
}
