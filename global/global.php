<?php
function getMd5Hash($data)
{
  return md5(md5($data)).md5("password");
}

function createSecurityToken()
{
  return md5(md5(rand(111111,999999))).md5(rand(10,1000));
}
?>