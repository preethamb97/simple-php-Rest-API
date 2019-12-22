<?php
// http://localhost/aws/main/user/userInsert.php?key=encryption&username=preetham&password=password
include_once dirname(__FILE__)."/../../init.php";
$userLib = autoload::loadLibrary('internal', 'user');
$result = array();
$key = $_GET['key'];
$loginUserName = $_GET['username'];
$loginPassword = $_GET['password'];
$pass = getMd5Hash($loginPassword);
$securityToken = createSecurityToken();
$isVerified = autoload::verifyKey($key);
if($isVerified) {
  $isUserNameExists = $userLib->checkIfUserNameExists($loginUserName);
  if(empty($isUserNameExists)) {
    $data = array(
      'security_token'=>$securityToken,
      'user_name'=>$loginUserName,
      'password'=>$pass,
      'status'=>1
    );
    $userId = $userLib->insertUser($data);
    unset($data['password']);
    $result = $data;
    $result['user_id'] = $userId;
    $jsonFormat = json_encode($result, JSON_PRETTY_PRINT);
    print_r($jsonFormat);
  } else {
    echo "userName should be unique";
  }
}
?>