<?php

namespace Kuaidi\Trackers;

use Kuaidi\Waybill;

interface DetectorInterface
{
    /**
     * 识别快递公司
     *
     * @param Waybill $waybill
     *
     * @return array
     */
    public function detect(Waybill $waybill);
}
