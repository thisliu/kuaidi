<?php

define('YII_DEBUG', true);

require_once '../vendor/autoload.php';
require_once '../vendor/yiisoft/yii2/Yii.php';

use Hejiang\Express\Waybill;
use Hejiang\Express\Trackers\Kuaidi100;
use Hejiang\Express\Trackers\Kuaidiwang;
use Hejiang\Express\Exceptions\TrackingException;

$wb = \Yii::createObject(
    [
        'class' => 'Hejiang\Express\Waybill',
        'id' => '70044318801859',
        'express' => '百世',
    ]
);

$tracker = \Yii::createObject(
    [
        'class' => 'Hejiang\Express\Trackers\Kuaidi100',
    ]
);

try {
    $traces = $wb->getTraces($tracker);
} catch (TrackingException $ex) {
    var_dump($ex);
    exit;
}

echo json_encode($wb, JSON_PRETTY_PRINT);