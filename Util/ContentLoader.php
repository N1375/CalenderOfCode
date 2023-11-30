<?php

namespace Util;

class ContentLoader
{
    /**
     * @var int
     */
    static int $TEST_CODE_BLOCK_NUMBER = 0;

    /**
     * @param int $year
     * @param int $day
     *
     * @return string
     */
    public function loadTask(int $year, int $day): string
    {
        $rawData = file_get_contents($this->constructTaskUrl($year, $day), false, $this->constructContext());

        if (!$rawData) {
            $a = file_get_contents("google.com");
            return error_get_last()['message'];
        }

        if (($pos = strpos($rawData, 'To Play,')) > 1){
            $rawData = substr($rawData, 0, $pos) . '<main>';
        }
        $pattern = "#<main>.*</main>#s";
        preg_match($pattern, $rawData, $matches);
        return $this->deleteForm($matches[0]);
    }

    /**
     * @param int $year
     * @param int $day
     *
     * @return array
     */
    public function loadInput(int $year, int $day): array
    {
        $rawData = file_get_contents($this->constructInputUrl($year, $day), false, $this->constructContext());
        return $this->createArrayFromInput($rawData);
    }

    /**
     * @param int $year
     * @param int $day
     *
     * @return array
     */
    public function loadTestInput(int $year, int $day): array
    {
        $data = $this->loadTask($year, $day);
        $pattern = "#<pre><code>(.*)</code></pre>#sU";
        preg_match_all($pattern, $data, $matches);

        return $this->createArrayFromInput($matches[1][self::$TEST_CODE_BLOCK_NUMBER]);
    }

    private function constructTaskUrl(int $year, int $day): string
    {
        return "https://adventofcode.com/$year/day/$day";
    }

    private function constructInputUrl(int $year, int $day): string
    {
        return $this->constructTaskUrl($year, $day) . '/input';
    }

    /**
     * @return resource
     */
    private function constructContext()
    {
        return stream_context_create([
            "http" => [
                "method" => "GET",
                "header" => "Accept-languange: en-US,en;q=0.9\r\n" .
                    "Cookie: session=" . getenv("AOC_SESSION") . "\r\n"
            ]
        ]);
    }

    /**
     * @return float
     */
    public function getAvailableDays($year): float
    {
        $now = time();
        $startDate = strtotime($year . "-12-01 00:00:00");
        $diff = $now - $startDate;
        $daysFromStart = ceil($diff / (60 * 60 * 24));

        return min([$daysFromStart, 25]);
    }

    /**
     * @return float
     */
    public function getActiveDay($year): float
    {
        if (time() > strtotime($year . '-12-25'))
            return 1;

        return date('d');
    }

    /**
     * @param $input
     *
     * @return array
     */
    private function createArrayFromInput($input): array
    {
        $input = explode("\n", $input);
        if (count($input) > 1)
            array_pop($input);

        return count($input) === 1 ? mb_str_split($input[0]) : $input;

    }

    /**
     * @param string $content
     *
     * @return array|string|null
     */
    private function deleteForm(string $content): array|string|null
    {
        $pattern = "#<form.*</form>#s";
        return preg_replace($pattern, '', $content);
    }
}