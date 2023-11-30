<?php

namespace Util;

class ExecutionTime
{
    /**
     * @var int
     */
    public static int $iterations = 1;

    /**
     * @var array|false
     */
    private array|false $startTime;

    /**
     * @var array|false
     */
    private array|false $endTime;

    /**
     * @var int|float
     */
    private int|float $cpu = 0;

    /**
     * @var int|float
     */
    private int|float $syscall = 0;

    /**
     * @return void
     */
    private function start(): void
    {
        $this->startTime = getrusage();
    }

    /**
     * @return void
     */
    private function end(): void
    {
        $this->endTime = getrusage();
    }

    /**
     * @param $index
     *
     * @return float|int
     */
    private function runTime($index): float|int
    {
        return ($this->endTime["ru_$index.tv_sec"] * 1000 + intval($this->endTime["ru_$index.tv_usec"] / 1000))
            - ($this->startTime["ru_$index.tv_sec"] * 1000 + intval($this->startTime["ru_$index.tv_usec"] / 1000));
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "CPU:&nbsp;$this->cpu&nbsp;ms</br>
                Syscall:&nbsp;$this->syscall&nbsp;ms";
    }

    /**
     * @param callable $func
     * @param ...$args
     *
     * @return array
     */
    public static function measure(callable $func, ...$args): array
    {
        $executionTime = new ExecutionTime();

        for ($i = 0; $i < ExecutionTime::$iterations; $i++) {
            $executionTime->start();
            $result = call_user_func($func, ...$args);
            $executionTime->end();

            $executionTime->cpu += $executionTime->runTime("utime") / ExecutionTime::$iterations;
            $executionTime->syscall += $executionTime->runTime("stime") / ExecutionTime::$iterations;
        }

        return [
            'result' => $result,
            'execTime' => "$executionTime"
        ];
    }
}
