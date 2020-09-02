# 海拍客 SDK

Based on [foundation-sdk](https://github.com/HanSon/foundation-sdk)
& [海拍客开放平台API接口文档](https://open.hipac.cn/dev-guide.html)

## Requirement
- PHP >= 7.0
- **[composer](https://getcomposer.org/)**

## Installation
```
composer require seek-x2y/hipac-sdk -vvv
```
## Usage
```php
$config = [
  'common' => [
    'appKey' => '',
    'v' => '',
    'format' => '',
    'signMethod' => '',
    'partnerId' => '',
  ],
  'appSecret' => '',
  'url' => '',
  'sign' => '',
  'debug' => true,
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
```

## License

MIT
