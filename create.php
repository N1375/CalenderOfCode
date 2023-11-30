<?php
require_once "Util/functions.php";

$year = getVal('year');
$day = getVal('day');
$part = getVal('part');

if (is_null($day) || is_null($part))
    exit(0);

$classFullName = constructDayClassFullName($year, $day, $part);
$fileName = str_replace('\\', DIRECTORY_SEPARATOR, $classFullName).'.php';

$namespace = constructNamespace($year, $day);
$className = constructDayClassName($day, $part);
$extends = $part == 2
    ? "extends " . constructDayClassName($day, 1)
    : "";

$classContent = "<?php

namespace $namespace;

class $className $extends implements \Days\Day
{
    public function run(array \$input): int|string
    {
        return 'Not Implemented';
    }
}
";

forceFilePutContents($fileName, $classContent);

if (file_exists($fileName)) {
    echo 1;
} else {
    echo 0;
}
