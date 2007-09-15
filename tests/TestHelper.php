<?php

error_reporting( E_ALL | E_STRICT );
date_default_timezone_set('Europe/London');

$prRoot    = dirname(dirname(__FILE__));
$prTests   = $prRoot . DIRECTORY_SEPARATOR . 'tests';

set_include_path($prRoot . PATH_SEPARATOR
               . $prTests   . PATH_SEPARATOR
               . get_include_path());

if (is_readable($prTests . DIRECTORY_SEPARATOR . 'TestConfiguration.php')) {
    require_once 'TestConfiguration.php';
} else {
    require_once 'TestConfiguration.php.dist';
}