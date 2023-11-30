<?php
namespace Days;

interface Day
{
    /**
     * Let's just don't touch this, ok.
     *
     * @param array $input
     *
     * @return int|string
     */
    public function run(array $input): int|string;
}