<?php

require_once __DIR__ . '/../vendor/autoload.php';

error_reporting(E_ALL);

function track($number, $express = '')
{
    $waybill = new \Kuaidi\Waybill($number, $express);
    (new \Kuaidi\Trackers\Kuaidi100)->track($waybill);
    return $waybill->getTraces()->sort();
}

if (php_sapi_name() == 'cli') {
    $traces = track($argv[1], isset($argv[2]) ? $argv[2] : '');
    foreach ($traces as $trace) {
        echo $trace['datetime'] . "\t" . $trace['desc'] . PHP_EOL;
    }
} else {
    $traces = track($_GET['number'], isset($_GET['express']) ? $_GET['express'] : '');
    echo json_encode($traces, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}
