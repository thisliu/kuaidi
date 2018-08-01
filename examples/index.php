<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Kuaidi\Waybill;
use Kuaidi\Trackers\Kuaidi100;
use Kuaidi\Trackers\Kuaidiwang;
use Kuaidi\Trackers\Kuaidiniao;

$wb =  new Waybill('800832115688166239', '圆通');

$tracker = new Kuaidi100();

try {
    $tracker->track($wb);
} catch (\Exception $ex) {
    var_dump($ex);
    exit;
}

print_r($wb);