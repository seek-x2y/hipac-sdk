<?php

namespace Seekx2y\HipacSDK;

use Hanson\Foundation\Foundation;

class Hipac extends Foundation
{
    protected $providers = [
        ServiceProvider::class
    ];

    public function __construct($config)
    {
        $config['debug'] = $config['debug'] ?? false;
        parent::__construct($config);
    }

    /**
     * 回传物流
     * @param array $data
     * @return mixed
     */
    public function delivery(array &$data)
    {
        return $this->api->delivery($data);
    }
}