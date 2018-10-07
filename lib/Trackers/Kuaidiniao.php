<?php

namespace Kuaidi\Trackers;

use Curl\Curl;
use Kuaidi\Exceptions\TrackingException;
use Kuaidi\Traces;
use Kuaidi\Waybill;

class Kuaidiniao implements TrackerInterface
{
    use TrackerTrait;

    public $businessId;

    public $appKey;

    /**
     * 快递鸟
     *
     * @param string $businessId EBusinessID
     * @param string $appKey     AppKey
     */
    public function __construct($businessId, $appKey)
    {
        $this->businessId = $businessId;
        $this->appKey = $appKey;
    }

    public static function getSupportedExpresses()
    {
        return [
            '京东'            => 'JD',
            '顺丰'            => 'SF',
            '申通'            => 'STO',
            '韵达'            => 'YD',
            '圆通'            => 'YTO',
            '中通'            => 'ZTO',
            '百世快运'          => 'HTKY',
            'EMS'           => 'EMS',
            '天天'            => 'HHTT',
            '邮政'            => 'YZPY',
            '宅急送'           => 'ZJS',
            '国通'            => 'GTO',
            '全峰'            => 'QFKD',
            '优速'            => 'UC',
            '中铁快运'          => 'ZTKY',
            '中铁物流'          => 'ZTWL',
            '亚马逊'           => 'AMAZON',
            '城际'            => 'CJKD',
            '德邦'            => 'DBL',
            '汇丰'            => 'HFWL',
            '百世物流'          => 'BTWL',
            '安捷'            => 'AJ',
            '安能'            => 'ANE',
            '安信达'           => 'AXD',
            '北青小红帽'         => 'BQXHM',
            '百福东方'          => 'BFDF',
            'CCES'          => 'CCES',
            '城市100'         => 'CITY100',
            'COE东方'         => 'COE',
            '长沙创一'          => 'CSCY',
            '成都善途'          => 'CDSTKY',
            'D速'            => 'DSWL',
            '大田'            => 'DTWL',
            '快捷'            => 'FAST',
            '联邦'            => 'FEDEX',
            'FEDEX'         => 'FEDEX_GJ',
            '飞康达'           => 'FKD',
            '广东邮政'          => 'GDEMS',
            '共速达'           => 'GSD',
            '高铁'            => 'GTSD',
            '恒路'            => 'HLWL',
            '天地华宇'          => 'HOAU',
            '华强'            => 'hq568',
            '华夏龙'           => 'HXLWL',
            '好来运'           => 'HYLSD',
            '京广'            => 'JGSD',
            '九曳供应链'         => 'JIUYE',
            '佳吉'            => 'JJKY',
            '嘉里'            => 'JLDT',
            '捷特'            => 'JTKD',
            '急先达'           => 'JXD',
            '晋越'            => 'JYKD',
            '加运美'           => 'JYM',
            '佳怡'            => 'JYWL',
            '跨越'            => 'KYWL',
            '龙邦'            => 'LB',
            '联昊通'           => 'LHT',
            '民航'            => 'MHKD',
            '明亮'            => 'MLWL',
            '能达'            => 'NEDA',
            '平安达腾飞'         => 'PADTF',
            '全晨'            => 'QCKD',
            '全日通'           => 'QRT',
            '如风达'           => 'RFD',
            '赛澳递'           => 'SAD',
            '圣安'            => 'SAWL',
            '盛邦'            => 'SBWL',
            '上大'            => 'SDWL',
            '盛丰'            => 'SFWL',
            '盛辉'            => 'SHWL',
            '速通'            => 'ST',
            '速腾'            => 'STWL',
            '速尔'            => 'SURE',
            '唐山申通'          => 'TSSTO',
            '全一'            => 'UAPEX',
            '万家'            => 'WJWL',
            '万象'            => 'WXWL',
            '新邦'            => 'XBWL',
            '信丰'            => 'XFEX',
            '希优特'           => 'XYT',
            '新杰'            => 'XJ',
            '源安达'           => 'YADEX',
            '远成'            => 'YCWL',
            '义达'            => 'YDH',
            '越丰'            => 'YFEX',
            '原飞航'           => 'YFHEX',
            '亚风'            => 'YFSD',
            '运通'            => 'YTKD',
            '亿翔'            => 'YXKD',
            '增益'            => 'ZENY',
            '汇强'            => 'ZHQKD',
            '众通'            => 'ZTE',
            '中邮'            => 'ZYWL',
            '速必达'           => 'SUBIDA',
            '瑞丰'            => 'RFEX',
            '快客'            => 'QUICK',
            'CNPEX中邮'       => 'CNPEX',
            '鸿桥供应链'         => 'HOTSCM',
            '海派通'           => 'HPTEX',
            '澳邮专线'          => 'AYCA',
            '泛捷'            => 'PANEX',
            'PCA Express'   => 'PCA',
            'UEQ Express'   => 'UEQ',
        ];
    }

    public function track(Waybill $waybill)
    {
        $requestData = json_encode([
            'LogisticCode' => $waybill->id,
            'ShipperCode'  => $this->getExpressCode($waybill),
            // 'OrderCode' => $waybill->orderId,
        ]);
        if ($requestData === false) {
            throw new \RuntimeException('Function json_encode returns false');
        }
        $params = [
            'RequestData' => urlencode($requestData),
            'EBusinessID' => $this->businessId,
            'RequestType' => '1002',
            'DataSign'    => base64_encode(md5($requestData . $this->appKey)),
            'DataType'    => '2',
        ];
        $curl = (new Curl())->post(
            'http://api.kdniao.cc/Ebusiness/EbusinessOrderHandle.aspx',
            $params
        );
        $response = static::getJsonResponse($curl);

        if ($response->Success == false) {
            throw new TrackingException($response->Reason, $response);
        }
        $statusMap = [
            2 => Waybill::STATUS_TRANSPORTING,
            3 => Waybill::STATUS_DELIVERED,
            4 => Waybill::STATUS_REJECTED,
        ];
        $waybill->setStatus($response->State, $statusMap);
        $waybill->setTraces(
            Traces::parse($response->Traces, 'AcceptTime', 'AcceptStation', 'Remark')
        );
    }
}
