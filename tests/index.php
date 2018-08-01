<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Kuaidi\Waybill;
use Kuaidi\Trackers\Kuaidi100;
use Kuaidi\Trackers\Kuaidiwang;
use Kuaidi\Exceptions\TrackingException;
use Kuaidi\Trackers\Kuaidiniao;

$wb =  new Waybill();
$wb->id = '800832115688166239';
$wb->express = '圆通';

$tracker = new Kuaidi100();

try {
    $traces = $wb->getTraces($tracker);
} catch (TrackingException $ex) {
    var_dump($ex);
    exit;
}

print_r($wb);