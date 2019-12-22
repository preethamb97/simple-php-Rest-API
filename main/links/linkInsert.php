<?php
// http://localhost/aws/main/links/linkInsert.php?key=encryption&link_name=a&link_url=https:://www.duckduckgo.com&link_img=c&status=1
include_once dirname(__FILE__)."/../../init.php";
$userLib = autoload::loadLibrary('internal', 'user');
$linkLib = autoload::loadLibrary('internal', 'links');
$result = array();
$key = $_GET['key'];
$linkName = $_GET['link_name'];
$linkUrl = $_GET['link_url'];
$linkImg = $_GET['link_img'];
$status = $_GET['status'];
$isVerified = autoload::verifyKey($key);
if($isVerified) {
  $linkData = array(
    'link_name'=>$linkName,
    'link_url'=>$linkUrl,
    'link_img'=>$linkImg,
    'status'=>$status
  );
  $result = $linkData;
  $linkId = $linkLib->insertLink($linkData);
  
  $result['link_id'] = $linkId;
  $jsonFormat = json_encode($result, JSON_NUMERIC_CHECK);
  print_r($jsonFormat);  
} else {
  $linkData = array(
    'link_name'=>$linkName,
    'link_url'=>$linkUrl,
    'link_img'=>$linkImg,
    'status'=>$status
  );
  $result = $linkData;
  // $linkId = $linkLib->insertLink($linkData);
  
  $result['link_id'] = rand(1,10000000);
  $jsonFormat = json_encode($result, JSON_NUMERIC_CHECK);
  print_r($jsonFormat);  
}
?>