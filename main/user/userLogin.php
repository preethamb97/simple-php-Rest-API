<?php
http://localhost/aws/main/user/userLogin.php?key=encryption&login_name=preetham&login_password=password
include_once dirname(__FILE__)."/../../init.php";
$userLib = autoload::loadLibrary('internal', 'user');
$key = $_GET['key'];
$loginName = $_GET['login_name'];
$loginPassword = $_GET['login_password'];
$result = array();
$pass = getMd5Hash($loginPassword);
$securityToken = createSecurityToken();
$isVerified = autoload::verifyKey($key);
if($isVerified) {
  $userDetail = $userLib->getLoginUserDetail($loginName, $pass);
  if(!empty($userDetail)) {
    $result = $userDetail;
    $userLib->updateUser($userDetail['user_id'], array('securityToken'=>$securityToken));
    $result['security_token'] = $securityToken;
  } else {
    echo "login failed";
  }
  $jsonFormat = json_encode($result, JSON_PRETTY_PRINT);
  print_r($jsonFormat);
}
?>