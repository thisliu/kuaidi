<?php

namespace Kuaidi\Trackers;

use Kuaidi\Waybill;

interface TrackerInterface
{
    /**
     * 运单追踪
     *
     * @param Waybill $waybill
     * @return void
     * @throws \Kuaidi\Exceptions\TrackingException
     */
    public function track(Waybill $waybill);

    /**
     * 获取完整的快递公司支持列表
     *
     * @return array
     */
    public static function getSupportedExpresses();
}
