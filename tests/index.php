<?php

require_once '../vendor/autoload.php';

use Hejiang\Express\Waybill;
use Hejiang\Express\Trackers\Kuaidi100;
use Hejiang\Express\Trackers\Kuaidiwang;
use Hejiang\Express\Exceptions\TrackingException;

$wb = new Waybill();

$wb->id = '70105425727637';
$wb->express = '百世汇通';

$tracker = new Kuaidi100();

try {
    $traces = $wb->getTraces($tracker);
} catch (TrackingException $ex) {
    print_r($ex->getResponse());
    exit;
}

echo json_encode($wb, JSON_PRETTY_PRINT);