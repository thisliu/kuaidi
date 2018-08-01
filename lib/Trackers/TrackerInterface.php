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

    /**
     * 获取是否支持某个快递公司
     *
     * @param string $expressName
     * @return bool
     */
    public static function isSupported($express);

    /**
     * 获取某个快递公司的代码
     *
     * @param string $expressName
     * @return string
     */
    public static function getExpressCode($expressName);
}
