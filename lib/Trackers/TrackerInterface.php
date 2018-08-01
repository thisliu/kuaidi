<?php

namespace Kuaidi\Trackers;

use Kuaidi\Waybill;

interface TrackerInterface
{
    /**
     * 追踪包裹
     *
     * @param Waybill $waybill
     * @return void
     * @throws \Kuaidi\Exceptions\TrackingException
     */
    public function track(Waybill $waybill);

    static public function getSupportedExpresses();

    static public function isSupported($express);

    static public function getExpressCode($expressName);
}
