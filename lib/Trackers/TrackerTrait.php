<?php

namespace Kuaidi\Trackers;

use Curl\Curl;
use Kuaidi\Exceptions\TrackingException;

trait TrackerTrait
{
    /**
     * 解析 JSON 响应
     *
     * @param Curl $curl
     * @return \stdClass
     */
    protected static function getJsonResponse(Curl $curl)
    {
        $responseRaw = $curl->response;
        $response = json_decode($responseRaw);
        if ($response == false) {
            throw new TrackingException('Response data cannot be decoded as json', $responseRaw);
        }
        return $response;
    }

    public static function isSupported($expressName)
    {
        $list = static::getSupportedExpresses();
        return isset($list[$expressName]);
    }

    public static function getExpressCode($expressName)
    {
        if (static::isSupported($expressName)) {
            $list = static::getSupportedExpresses();
            return $list[$expressName];
        } else {
            throw new \InvalidArgumentException("Unsupported express name: {$expressName}");
        }
    }
}
