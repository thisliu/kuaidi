<?php

namespace Kuaidi;

class Waybill
{
    /**
     * 揽件
     */
    const STATUS_UNKNOWN = -1;

    /**
     * 揽件
     */
    const STATUS_PICKEDUP = 0;

    /**
     * 发出
     */
    const STATUS_DEPART = 1;

    /**
     * 在途
     */
    const STATUS_TRANSPORTING = 2;

    /**
     * 派件
     */
    const STATUS_DELIVERING = 3;

    /**
     * 签收
     */
    const STATUS_DELIVERED = 4;

    /**
     * 自取
     */
    const STATUS_SELFPICKUP = 5;

    /**
     * 疑难
     */
    const STATUS_REJECTED = 6;

    /**
     * 退回
     */
    const STATUS_RETURNING = 7;

    /**
     * 退签
     */
    const STATUS_RETURNED = 8;

    /**
     * 运单 ID
     *
     * @var string
     */
    public $id;

    /**
     * 快递公司名称，不带结尾 `物流` / `快递` / `快运` / `速递` / `速运`
     *
     * @var string
     */
    public $express;

    /**
     * 运单实时状态
     *
     * @var int
     *
     * @see self::STATUS_*
     */
    public $status;

    /**
     * 运单路径
     *
     * @var Traces
     */
    protected $traces;

    public function __construct($id, $express = '')
    {
        $this->id = $id;
        $this->express = $express;
    }

    public function setTraces(Traces $traces)
    {
        $this->traces = $traces;
    }

    public function getTraces()
    {
        return $this->traces;
    }
}
