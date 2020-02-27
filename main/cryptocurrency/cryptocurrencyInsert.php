<?php
// http://localhost/aws/main/cryptocurrency/cryptocurrencyInsert.php?key=encryption&link_name=a&link_url=https:://www.duckduckgo.com&link_img=c&status=1
include_once dirname(__FILE__)."/../../init.php";
$cryptocurrencyLib = autoload::loadLibrary('internal', 'cryptocurrency');
$result = array();
$key = $_GET['key'];
$cryptocurrency_symbol = $_GET['cryptocurrency_symbol'];
$max_supply = $_GET['max_supply'];
$last_updated = $_GET['last_updated'];
$num_market_pairs = $_GET['num_market_pairs'];
$symbol = $_GET['symbol'];
$rank = $_GET['rank'];
$date_added = $_GET['date_added'];
$cmc_rank = $_GET['cmc_rank'];
$total_supply = $_GET['total_supply'];
$name = $_GET['name'];
$tags = $_GET['tags'];
$circulating_supply = $_GET['circulating_supply'];
$data_compare = $_GET['data_compare'];
$status = 1;

$isVerified = autoload::verifyKey($key);
if($isVerified) {
  $cryptoData = array(
    'cryptocurrency' => $cryptocurrency_symbol,
    'max_supply' => $max_supply,
    'last_updated' => $last_updated,
    'num_market_pairs' => $num_market_pairs,
    'symbol' => $symbol,
    'rank' => $rank,
    'date_added' => $date_added,
    'cmc_rank' => $cmc_rank,
    'total_supply' => $total_supply,
    'name' => $name,
    'tags' => $tags,
    'circulating_supply' => $circulating_supply,
    'data_compare' => $data_compare,
    'updated_at' => date('Y-m-d H:i:s'),
    'created_at' => date('Y-m-d H:i:s'),
    'status' => $status
  );

  $result = $cryptoData;
  
  $cryptoCurrencyDetail = $cryptocurrencyLib->getCryptocurrencyDetailByName($cryptoData['symbol']);
  if (empty($cryptoCurrencyDetail)) {
    $cryptoId = $cryptocurrencyLib->insertCryptocurrency($cryptoData);
  } else {
    $cryptoData['created_at'] = $cryptoCurrencyDetail['created_at'];
    $cryptoId = $cryptocurrencyLib->updateCryptocurrency($cryptoData['symbol'], $cryptoData);
  }
  
  $result['cryptoId'] = $cryptoData;
  $jsonFormat = json_encode($result, JSON_NUMERIC_CHECK);
  print_r($jsonFormat);  
}
?>