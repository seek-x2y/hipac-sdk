<?php

namespace Tests\Unit;

use Seekx2y\HipacSDK\Hipac;
use PHPUnit\Framework\TestCase;

class DeliveryTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDevEnv()
    {
        $config = [
            'common'    => [
                'appKey'     => 'HIPAC2017032310020001',
                'v'          => '1.0.0',
                'format'     => 'json',
                'signMethod' => 'md5',
            ],
            'appSecret' => 'testmd5key',
            'url'       => '',
            'debug'     => true,
        ];
        $data   = '{
 "Orders": [
  {
   "orderNum": "YT201703295686382234c",
   "LogisticsInfoList": [
    {
     "logisticsName": "百世快递",
     "logisticsNo": "50393201809412",
     "logisticsCode": "shunfeng"
    },
    {
     "logisticsName": "百世快递",
     "logisticsNo": "50393201809413",
     "logisticsCode": "shunfeng"
    }
   ]
  }
 ]
}';

        $data = json_decode($data, true);

        $api = new Hipac($config);
        $res = $api->delivery($data);
        var_dump($res);
        $this->assertObjectHasAttribute('success', $res);
        $this->assertEquals(1, $res->success);
    }
}
