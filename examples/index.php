<?php

require_once __DIR__ . '/../vendor/autoload.php';

$waybill = new \Kuaidi\Waybill('800832115688166239', '圆通');

try {
    (new \Kuaidi\Trackers\Kuaidi100)->track($waybill);
} catch (\Exception $ex) {
    print_r($ex);
    exit;
}

$traces = $waybill->getTraces();
$traces->sort();

if(php_sapi_name() == 'cli') {
    foreach ($traces as $trace) {
        echo $trace['datetime'] . "\t" . $trace['desc'] . PHP_EOL;
    }
} else {
    echo json_encode($traces, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}