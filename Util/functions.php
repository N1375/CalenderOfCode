<?php

/**
 * @param $value
 * @param $array
 * @param $default
 *
 * @return mixed
 */
function getVal($value, $array = null, $default = null): mixed
{
    if ($array !== null) {
        return $array[$value] ?? $default;
    } else {
        return $_REQUEST[$value] ?? $default;
    }
}

/**
 * @param int $year
 * @param int $day
 *
 * @return string
 */
function constructNamespace(int $year, int $day): string
{
    return "Days\\$year\Day" . str_pad($day, 2, "0", STR_PAD_LEFT);
}

/**
 * @param int $day
 * @param int $part
 *
 * @return string
 */
function constructDayClassName(int $day, int $part): string
{
    $partName = $part == 1 ? "First" : "Second";
    return "Day$day" . $partName;
}

/**
 * @param int $year
 * @param int $day
 * @param int $part
 *
 * @return string
 */
function constructDayClassFullName(int $year, int $day, int $part): string
{
    $namespace = constructNamespace($year, $day);
    return $namespace . "\\" . constructDayClassName($day, $part);
}

/**
 * create file with content, and create folder structure IF it does not exist.
 *
 * @param String $filepath
 * @param String $message
 */
function forceFilePutContents(string $filepath, string $message): void
{
    try {
        $isInFolder = preg_match("/^(.*)\/([^\/]+)$/", $filepath, $filepathMatches);
        if ($isInFolder) {
            $folderName = $filepathMatches[1];
            if (!is_dir($folderName)) {
                mkdir($folderName, 0777, true);
            }
        }
        file_put_contents($filepath, $message);
    } catch (Exception $e) {
        echo "ERR: error writing '$message' to '$filepath', " . $e->getMessage();
    }
}
