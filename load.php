<?php

use App\{App, Autoloader};
use Util\ContentLoader;
use Util\DotEnv;

require_once 'App/Autoloader.php';
require_once 'Util/functions.php';

Autoloader::register();
(new DotEnv(__DIR__ . '/.env'))->load();

$year = getVal('year');
$day = getVal('day');
if (is_null($year) || is_null($day)) {
    exit;
}

$contentLoader = new ContentLoader();
echo $contentLoader->loadTask($year, $day);