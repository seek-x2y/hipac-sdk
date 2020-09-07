<?php


namespace Seekx2y\HipacSDK;

use Hanson\Foundation\AbstractAPI;

class Api extends AbstractAPI
{
    private $app;

    /**
     * Api constructor.
     * @param Hipac $hipac
     */
    public function __construct(Hipac $hipac)
    {
        $this->app = $hipac;
    }

    /**
     * @param array $params 所有参数
     * @return string
     */
    public function makeSign(array &$params): string
    {
        $appSecret = $this->app->getConfig('appSecret');
        ksort($params);
        $str = '';
        foreach ($params as $k => $v) {
            if ($k == 'sign') continue;
            $str .= $k . $v;
        }
        return md5(md5($str . $appSecret) . $appSecret);
    }

    /**
     * 由于海拍客每个接口URL不同，所以下边这里URL从配置中获取
     * @param string $api
     * @param array $params 业务参数
     * @param string $httpMethod 请求方式
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function request(string $api, array &$params = null, $httpMethod = 'POST')
    {

        $data = $this->app->getConfig('common');
        if ($params) {
            $data = array_merge(['data' => $params], $data);
        }
        $data['api']  = $api;
        $data['sign'] = $this->makeSign($data);
        $response     = $this->getHttp()->request($httpMethod, $this->app->getConfig('url'), ['form_params' => $data]);

        return json_decode(strval($response->getBody()));
    }

    /**
     * 回传物流
     * @param array $data
     * @return mixed
     */
    public function delivery(array &$data)
    {
        $api = 'hipac.hsc.order.logisticsno.update';

        return $this->request($api, $data);
    }
}