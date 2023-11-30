<?php

namespace App;

use Util\ContentLoader;
use Util\ExecutionTime;

class App
{
    /**
     * @var ContentLoader
     */
    private ContentLoader $contentLoader;

    public function __construct()
    {
        $this->contentLoader = new ContentLoader();
    }

    /**
     * Runs the whole thingy.
     *
     * @return void
     */
    public function run(): void
    {
        if (!isset($_GET['day'])) {
            $this->badRequest("Please specify required argument `day`");
        }

        $year = getVal('year');
        $day = getVal('day');
        $test = getVal('test');

        try {
            $this->executeDay($year, $day, !is_null($test));
        } catch (\Throwable $e) {
            $message = $e->getMessage() . " in <i>" . $e->getFile() . "</i> on line <i>" . $e->getLine() . "</i>";
            $trace = $e->getTraceAsString();
            $msg = <<<EOD
                    <p>
                      <strong>$message</strong>
                    </p>
                    <p>$trace</p>
                    EOD;
            $this->send($msg, 500);
        }
    }

    /**
     * @param int $year
     * @param int $day
     * @param bool $test
     *
     * @return void
     */
    private function executeDay(int $year, int $day, bool $test): void
    {
        $classNotFound = "Class dont exists";
        $partOneClass = constructDayClassFullName($year, $day, 1);
        if (class_exists($partOneClass)) {
            $partOne = new $partOneClass();
        }

        $input = $test
            ? $this->contentLoader->loadTestInput($year, $day)
            : $this->contentLoader->loadInput($year, $day);

        $res = [
            ['result' => $classNotFound, 'execTime' => ''],
            ['result' => $classNotFound, 'execTime' => ''],
        ];

        if (isset($partOne)) {
            $res[0] = ExecutionTime::measure([$partOne, 'run'], $input);
        }

        $partTwoClass = constructDayClassFullName($year, $day, 2);
        if (class_exists($partTwoClass)) {
            $partTwo = new $partTwoClass();
            $res[1] = ExecutionTime::measure([$partTwo, 'run'], $input);
        }

        $this->send($res);
    }


    /**
     * Create reaction
     *
     * @param $msg
     * @param int $code
     *
     * @return void
     */
    private function send($msg, int $code = 200): void
    {
        http_response_code($code);
        exit(json_encode($msg));
    }

    /**
     * Something whent wong...
     *
     * @param $msg
     *
     * @return void
     */
    private function badRequest($msg): void
    {
        $this->send($msg, 400);
    }
}