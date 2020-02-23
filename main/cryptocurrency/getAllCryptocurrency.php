<?php
include_once dirname(__FILE__)."/../../init.php";
$cryptocurrencyLib = autoload::loadLibrary('internal', 'cryptocurrency');

$cryptocurrencyDetail = $cryptocurrencyLib->getCryptocurrencyDetail();
print_r(json_encode($cryptocurrencyDetail));
?>