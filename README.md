#### 例子
```
use ZincsearchEs\ClientBuilder;

$client = ClientBuilder::create()
    ->setHosts(['localhost:4080'])
    ->setApiKey("you-zincsearch-apikey")
    ->build();

$hosts = array("localhost:4080");
$apikey=""you-zincsearch-apikey";
$esClient = ClientBuilder::create()->setHosts($hosts)->setApiKey($apikey)->build();
$market_data  = [
    "id"=>"101",
    "base-currency"=>"btc",
    "quote-currency"=>"usdt",
    "period"=>"5min"

];

$type = $market_data['base-currency'] . '.' . $market_data['quote-currency'] . '.' . $market_data['period'];
$params = [
    'index' => 'market.kline',
    'type' => '_doc',
    'id' => $type . '.' . $market_data['id'],
    'body' => $market_data,
];

$response = $client->index($params);
print_r($response);
```
