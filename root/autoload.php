<?php
class autoload {
  public static function loadLibrary($library, $fileName)
  {
    include_once dirname(__FILE__)."/../queries/".$library."/".$fileName.".php";
    $result = new $fileName;
    return $result;
  }

  public static function verifyKey($key)
  {
    $security = (md5(md5("encryption")).md5(md5("secure")));
    $verifcation = (md5(md5($key)).md5(md5("secure")));
    if ($security == $verifcation) {
      return true;
    }
    return false;
  }
}

?>