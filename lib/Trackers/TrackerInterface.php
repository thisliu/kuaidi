<?php

namespace Kuaidi\Trackers;

use Kuaidi\Waybill;

interface TrackerInterface
{
    /**
     * 追踪运单（即：查快递）
     *
     * @param Waybill $waybill
     *
     * @throws \Kuaidi\Exceptions\TrackingException
     *
     * @return void
     */
    public function track(Waybill $waybill);

    /**
     * 获取完整的快递公司支持列表
     *
     * @return array
     */
    public static function getSupportedExpresses();
}
