<?php

namespace Hejiang\Express\Trackers;

use Hejiang\Express\Waybill;


interface TrackerInterface
{
    /**
     * Track a willbay and return traces
     *
     * @param Waybill $waybill
     * @return void
     * @throws \Hejiang\Express\Exceptions\TrackingException
     */
    function track(Waybill $waybill);

    static function getSupportedExpresses();

    static function isSupported($express);

    static function getExpressCode($expressName);
}