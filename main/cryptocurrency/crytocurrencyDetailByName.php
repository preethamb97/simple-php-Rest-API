<?php
//http://localhost/database/main/cryptocurrency/crytocurrencyDetailByName.php?key=encryption&name=BTC
include_once dirname(__FILE__)."/../../init.php";
$cryptocurrencyLib = autoload::loadLibrary('internal', 'cryptocurrency');
$cryptocurrencyName = $_GET['name'];
$cryptoCurrencyDetail = $cryptocurrencyLib->getCryptocurrencyDetailByName($cryptocurrencyName);

print_r(json_encode($cryptoCurrencyDetail));
?>